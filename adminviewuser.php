

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
		body {
  font-family: Arial, sans-serif;
  background-color: #f0f2f5;
  color: #1c1e21;
}

h2 {
  color: black;
  margin-bottom: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

thead {
  background-color: #1877f2;
  color: #fff;
}

thead th {
  padding: 12px 16px;
  font-weight: bold;
  text-align: left;
}

tbody td {
  padding: 12px 16px;
  border-bottom: 1px solid #dddfe2;
}

tbody tr:hover {
  background-color: #f5f6f7;
}

tbody td:first-child {
  font-weight: bold;
}
	</style>
	<link rel="stylesheet" href="div.css">

	<title>AdminHub-User Bookings</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="adminhome.php" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li >
				<a href="adminhome.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="adminviewuser.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">User Bookings</span>
				</a>
			</li>
			<li>
				<a href="adminadddevice.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Register</span>
				</a>
			</li>
			<li>
				<a href="adminprofileupdate.php">
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
		<!-- NAVBAR -->
	
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
							<a class="active" href="#">View User Bookings</a>
						</li>
					</ul>
				</div>
			
			</div>

			<div class=div-container>
				
				</div>

			<h2>All Bookings</h2>
    
			<?php
    include 'config.php';

    // Start the session
    session_start();

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'] ?? null;

    // Check if the user is logged in
    if (!isset($user_id)) {
        // If the user is not logged in, redirect them to the admin login page
        header('location:adminlogin.php');
        exit;
    }

    // Query to select all records from the bookings table
    $query = "SELECT booking_date, start_time, end_time, projectors, laptops, customer_id, department, phone_extension, phone_number 
              FROM bookings
              ORDER BY booking_date ASC";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Display the table headers
        echo "<table>";
        echo "<tr>
                <th>Booking Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Projectors</th>
                <th>Laptops</th>
                <th>Customer ID</th>
                <th>Department</th>
                <th>Phone Extension</th>
                <th>Phone Number</th>
              </tr>";

        // Display the booking details
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['booking_date'] . "</td>";
            echo "<td>" . $row['start_time'] . "</td>";
            echo "<td>" . $row['end_time'] . "</td>";
            echo "<td>" . $row['projectors'] . "</td>";
            echo "<td>" . $row['laptops'] . "</td>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['phone_extension'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }
    ?>



		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>