<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:adminlogin.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:adminlogin.php');
}
 // Query to get the total number of devices
$query = "SELECT COUNT(*) AS total_devices FROM devices";
$result = mysqli_query($conn, $query);

// Get the total number of devices
$row = mysqli_fetch_assoc($result);
$total_devices = $row['total_devices'];


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

	<title>AdminHub-Home</title>
	<style>
:root {
  --color1: #f44336;
  --color2: #e91e63;
  --color3: #9c27b0;
  --color4: #673ab7;
  --color5: #3f51b5;
  --color6: #2196f3;
  --color7: #03a9f4;
  --color8: #00bcd4;
  --color9: #009688;
}
body {
  background-color: white;
  margin: 0;
  padding: 0;
}


.grid-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 20px;
  max-width: 900px;
  margin: 0 auto;
  padding: 40px 20px;
}

.grid-item {
  background-color: var(--color1);
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  color: #fff;
  transition: transform 0.3s ease;
}

.grid-item:nth-child(2) {
  background-color: var(--color2);
}

.grid-item:nth-child(3) {
  background-color: var(--color3);
}

.grid-item:nth-child(4) {
  background-color: var(--color4);
}

.grid-item:nth-child(5) {
  background-color: var(--color5);
}

.grid-item:nth-child(6) {
  background-color: var(--color6);
}

.grid-item:nth-child(7) {
  background-color: var(--color7);
}

.grid-item:nth-child(8) {
  background-color: var(--color8);
}

.grid-item:nth-child(9) {
  background-color: var(--color9);
}

.grid-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
  color: #333;
}

.grid-item h3 {
  margin-bottom: 10px;
}

.grid-item p {
  font-size: 14px;
  color: #fff;
}
    </style>
	<link rel="stylesheet" href="div.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="adminhome.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
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
							<a class="active" href="#">Home</a>
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
						<h3><?php
						echo " " . $total_devices;
						?></h3>
						<p>Total Devices</p>
					</span>
				</li>
				
				
			</ul>


			<div class="grid-container">
        <a href="adminedit.php" class="grid-item">
          <h3>View Devices</h3>
          <p>Click to go</p>
        </a>
        <a href="adminregister.php" class="grid-item">
          <h3>New Account</h3>
          <p>Click to go</p>
        </a>
        <a href="adminviewuser.php" class="grid-item">
          <h3>View User Bookings</h3>
          <p>Click to go</p>
        </a>
        <a href="adminprofileupdate.php" class="grid-item">
          <h3> View Profile</h3>
          <p>Click to go</p>
        </a>
        <a href="adminadddevice.php" class="grid-item">
          <h3>Add New Device</h3>
          <p>Click to go</p>
        </a>
       
      </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>