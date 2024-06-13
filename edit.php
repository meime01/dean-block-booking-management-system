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

// Fetch the user's existing bookings
$sql = "SELECT * FROM bookings WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Count the total number of rows
$total_rows = $result->num_rows;

// Process the booking edit form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $booking_id = $_POST['booking_id'];

    if ($action === 'update') {
        $booking_date = $_POST['booking_date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $requested_projectors = $_POST['projectors'];
        $requested_laptops = $_POST['laptops'];

        // Prepare the SQL query to update the booking
        $sql = "UPDATE bookings
                SET booking_date = ?, start_time = ?, end_time = ?, projectors = ?, laptops = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiis", $booking_date, $start_time, $end_time, $requested_projectors, $requested_laptops, $booking_id);

        // Execute the query and check if the booking was updated successfully
        if ($stmt->execute()) {
            $message[] = 'Booking updated successfully!';
        } else {
            $message[] = 'Error updating the booking. Please try again.';
        }

        // Close the prepared statement
        $stmt->close();
    } elseif ($action === 'delete') {
        // Prepare the SQL query to delete the booking
        $sql = "DELETE FROM bookings WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $booking_id);

        // Execute the query and check if the booking was deleted successfully
        if ($stmt->execute()) {
            $message[] = 'Booking deleted successfully!';
        } else {
            $message[] = 'Error deleting the booking. Please try again.';
        }

        // Close the prepared statement
        $stmt->close();
    }
}
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

	<style>
		/* Table Styles */
table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: #1c1e21;
}

/* Table Header Styles */
th {
  background-color: #f0f2f5;
  padding: 12px 16px;
  text-align: left;
  font-weight: bold;
}

/* Table Row Styles */
tr {
  border-bottom: 1px solid #dddfe2;
}

td {
  padding: 12px 16px;
}

/* Input Styles */
input[type="date"],
input[type="time"],
input[type="number"] {
  border: 1px solid #dddfe2;
  border-radius: 4px;
  padding: 8px 12px;
  font-size: 14px;
  color: #1c1e21;
  background-color: #f0f2f5;
}

/* Button Styles */
button {
  background-color: #1877f2;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 8px 16px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #166fe5;
}

button[name="action"][value="delete"] {
  background-color: #e4e6eb;
  color: #1c1e21;
}

button[name="action"][value="delete"]:hover {
  background-color: #d0d2d6;
}
	</style>
  <link rel="stylesheet" href="div.css">
	<title>UserHub</title>
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
			<li>
				<a href="view.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">View Bookings</span>
				</a>
			</li>
			<li  class="active">
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
							<a class="active" href="#">Edit</a>
						</li>
					</ul>
				</div>
			
			</div>
      <div class=div-container>
				
        </div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $total_rows; ?></h3>
						<p>Total bookings</p>
					</span>
				</li>
			</ul>
      

        <div>
        <table>
        <tr>
            <th>Booking Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Projectors</th>
            <th>Laptops</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <form method="post">
                    <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="action" value="update">
                    <td><input type="date" name="booking_date" value="<?php echo $row['booking_date']; ?>"></td>
                    <td><input type="time" name="start_time" value="<?php echo $row['start_time']; ?>"></td>
                    <td><input type="time" name="end_time" value="<?php echo $row['end_time']; ?>"></td>
                    <td><input type="number" name="projectors" value="<?php echo $row['projectors']; ?>"></td>
                    <td><input type="number" name="laptops" value="<?php echo $row['laptops']; ?>"></td>
                    <td>
                        <button type="submit">Update</button>
                        <button type="submit" name="action" value="delete">Delete</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
        </div>
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>