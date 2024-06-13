<?php
// Include the database configuration file
include 'config.php';

// Start the session
session_start();

// Check if the user is logged in
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
    exit;
}


// Get the current available projectors and laptops
$sql = "SELECT available_projectors, available_laptops FROM resources";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$available_projectors = $row['available_projectors'];
$available_laptops = $row['available_laptops'];

// Process the booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_date = $_POST['booking_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $requested_projectors = $_POST['projectors'];
    $requested_laptops = $_POST['laptops'];

    // Check if the requested resources are available
    if ($requested_projectors <= $available_projectors && $requested_laptops <= $available_laptops) {
        // Prepare the SQL query to insert the booking
        $sql = "INSERT INTO bookings (booking_date, start_time, end_time, projectors, laptops, customer_id)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiis", $booking_date, $start_time, $end_time, $requested_projectors, $requested_laptops, $user_id);

        // Execute the query and check if the booking was successful
        if ($stmt->execute()) {
            // Update the available resources
            $available_projectors -= $requested_projectors;
            $available_laptops -= $requested_laptops;
            $sql = "UPDATE resources SET available_projectors = ?, available_laptops = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $available_projectors, $available_laptops);
            $stmt->execute();

            $message[] = 'Booking created successfully!';
        } else {
            $message[] = 'Error creating the booking. Please try again.';
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        $message[] = 'Requested resources are not available. Please try again.';
    }
}

// Fetch the user's existing bookings
$sql = "SELECT * FROM bookings WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the deadline for the day has been reached and reset the available resources
$current_date = date('Y-m-d');
$sql = "SELECT SUM(projectors) AS total_projectors, SUM(laptops) AS total_laptops
        FROM bookings
        WHERE booking_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $current_date);
$stmt->execute();
$result2 = $stmt->get_result();
$row = $result2->fetch_assoc();
$total_projectors = $row['total_projectors'];
$total_laptops = $row['total_laptops'];

if ($total_projectors === null) {
    $total_projectors = 0;
}
if ($total_laptops === null) {
    $total_laptops = 0;
}

if ($total_projectors === 0 && $total_laptops === 0) {
    $available_projectors = 5;
    $available_laptops = 5;
    $sql = "UPDATE resources SET available_projectors = ?, available_laptops = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $available_projectors, $available_laptops);
    $stmt->execute();
}

// Display the booking form and the user's existing bookings
// Add your HTML code here to display the booking form and the user's existing bookings
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="homeuser.css">
	/* General Styles */<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f0f2f5;
  margin: 0;
  padding: 0;
}

/* Form Styles */
.form-container {
  max-width: 400px;
  margin: 50px auto;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.form-container h1 {
  text-align: center;
  color: #1c1e21;
  margin-bottom: 20px;
}

.form-container form {
  display: flex;
  flex-direction: column;
}

.form-container label {
  font-weight: bold;
  color: #1c1e21;
  margin-bottom: 5px;
}

.form-container input[type="date"],
.form-container input[type="time"],
.form-container input[type="number"] {
  padding: 10px;
  border: 1px solid #dddfe2;
  border-radius: 6px;
  font-size: 16px;
  margin-bottom: 10px;
}

.form-container input[type="submit"] {
  background-color: #1877f2;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.form-container input[type="submit"]:hover {
  background-color: #166fe5;
}

.form-container .message {
  color: #1877f2;
  font-weight: bold;
  text-align: center;
  margin-top: 10px;
}

/* Table Styles */
table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

thead {
  background-color: #1877f2;
  color: #fff;
}

th, td {
  padding: 12px 16px;
  text-align: left;
}

th {
  font-weight: bold;
}

tbody tr:nth-child(even) {
  background-color: #f0f2f5;
}

tbody tr:hover {
  background-color: #e7f3ff;
}

tbody td {
  border-bottom: 1px solid #dddfe2;
}

/* Container Styles */
.table-container {
  max-width: 800px;
  margin: 50px auto;
}

.table-container h2 {
  text-align: center;
  color: #1c1e21;
  margin-bottom: 20px;
}
</style>
<link rel="stylesheet" href="div.css">

	<title>UserHub-view bookings</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">UserHub</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="homeuser.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li  class="active">
				<a href="view.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">View Bookings</span>
				</a>
			</li>
			<li>
				<a href="booking.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Booking</span>
				</a>
			</li>
			<li>
				<a href="userprofileupdate.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Profile</span>
				</a>
			</li>
		
		</ul>
		<ul class="side-menu">
		
		
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
	

		<!-- MAIN -->
		<main>
    <div class=div-container>
				
        </div>
        <div class=div-container1>
          
        </div>
        <div class=div-container2>
          
        </div>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">View Bookings</a>
						</li>
					</ul>
				</div>
				<a href="edit.php" class="btn-download">
					<i class='bx bxs-pen' ></i>
					<span class="text">Edit</span>
				</a>
			</div>
      <div class=div-container>
				
        </div>

			<ul class="box-info">
			
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
					<h3><?php echo "" . $available_projectors . "<br>"; ?></h3>
						<p>Total Projectors</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?php echo "" . $available_laptops . "<br>"; ?></h3>
						<p>Total Laptops</p>
					</span>
				</li>
			</ul>



			<div>
            <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message">' . $msg . '</div>';
        }
    }
    ?>
    <h2>My Bookings</h2>
	<div class="table-container">
    <table>
        <tr>
            <th>Booking ID</th>
            <th>Booking Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Projectors</th>
            <th>Laptops</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . date('Y-m-d', strtotime($row['booking_date'])) . "</td>";
            echo "<td>" . date('H:i', strtotime($row['start_time'])) . "</td>";
            echo "<td>" . date('H:i', strtotime($row['end_time'])) . "</td>";
            echo "<td>" . $row['projectors'] . "</td>";
            echo "<td>" . $row['laptops'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
	</div>
    
			</div>
			<div><p>
		
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>