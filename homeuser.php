<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
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

	<title>AdminHub</title>
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

.grid-container {
  display: grid;
  grid-template-columns: repeat(2, 2fr);
  grid-gap: 30px;
  
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
  color: black;
}

.grid-item h3 {
  margin-bottom: 10px;
}

.grid-item p {
  font-size: 14px;
  color: white;
}


    </style>
	<link rel="stylesheet" href="div.css">
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">UserHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
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
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			
			</div>
			<div class=div-container>
				
				</div>



			<div class="grid-container">
        <a href="view.php" class="grid-item">
          <h3>View Bookings</h3>
          <p>Click To Go</p>
        </a>
        <a href="booking.php" class="grid-item">
          <h3>Book Resources</h3>
          <p>Click To Go</p>
        </a>
        <a href="userprofileupdate.php" class="grid-item">
          <h3>View Profile</h3>
          <p>Click To Go</p>
        </a>
        <a href="edit.php" class="grid-item">
          <h3>Edit My Bookings</h3>
          <p>Click To Go</p>
        </a>
       
      </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>