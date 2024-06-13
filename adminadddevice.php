<?php

include 'config.php';

// Start the session
session_start();

// Get the user ID from the session
// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Check if the user is logged in
if (!isset($user_id)) {
    // If the user is not logged in, redirect them to the admin login page
    header('location:adminlogin.php');
    exit;
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $device_type = mysqli_real_escape_string($conn, $_POST['device_type']);
    $device_name = mysqli_real_escape_string($conn, $_POST['device_name']);
    $serial_number = mysqli_real_escape_string($conn, $_POST['serial_number']);
    $hdd_storage = mysqli_real_escape_string($conn, $_POST['hdd_storage']);
    $ram_storage = mysqli_real_escape_string($conn, $_POST['ram_storage']);

    // Prepare the SQL query using a prepared statement
    $stmt = mysqli_prepare($conn, "INSERT INTO devices (name, surname, email, department, device_type, device_name, serial_number, hdd_storage, ram_storage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssssssss", $name, $surname, $email, $department, $device_type, $device_name, $serial_number, $hdd_storage, $ram_storage);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // If the query was successful, display an alert and redirect the user to the adminedit page
        echo "<script>
                alert('Device added successfully!');
                window.location.href = 'adminedit.php';
              </script>";
        exit;
    } else {
        // If the query failed, display an error message
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
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
	<link rel="stylesheet" href="adminadddevice.css">
	<link rel="stylesheet" href="div.css">
	<title>Add a Device</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
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
			<li>
				<a href="adminviewuser.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">User Bookings</span>
				</a>
			</li>
			<li class="active">
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
							<a class="active" href="#">Register</a>
						</li>
					</ul>
				</div>
				<a href="adminedit.php" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">View</span>
				</a>
			</div>
			<div class=div-container>
				
			</div>
		


            <div>
            <h1>Add Device</h1>
			<form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name"><br>
    Surname: <input type="text" name="surname"><br>
    Email: <input type="email" name="email"><br>
    Department: <input type="text" name="department"><br>
    Device Type:
    <select name="device_type">
        <option value="laptop">Laptop</option>
        <option value="desktop">Desktop</option>
        <option value="printer">Printer</option>
    </select><br>
    Device Name: <input type="text" name="device_name"><br>
    Serial Number: <input type="text" name="serial_number"><br>
    HDD Storage: <input type="text" name="hdd_storage"><br>
    RAM Storage: <input type="text" name="ram_storage"><br>
    <input type="submit" name="submit" value="Submit">
</form>
            </div>
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	<script>
// Function to validate the form before submission
function validateForm() {
    // Get all the form input fields
    var name = document.forms["myForm"]["name"].value;
    var surname = document.forms["myForm"]["surname"].value;
    var email = document.forms["myForm"]["email"].value;
    var department = document.forms["myForm"]["department"].value;
    var deviceName = document.forms["myForm"]["device_name"].value;
    var serialNumber = document.forms["myForm"]["serial_number"].value;
    var hddStorage = document.forms["myForm"]["hdd_storage"].value;
    var ramStorage = document.forms["myForm"]["ram_storage"].value;

    // Check if any of the fields are empty
    if (name == "" || surname == "" || email == "" || department == "" || deviceName == "" || serialNumber == "" || hddStorage == "" || ramStorage == "") {
        alert("Please fill in all the required fields.");
        return false;
    }
}

// Attach the validateForm() function to the form's onsubmit event
document.getElementById("myForm").onsubmit = validateForm;
</script>
	<script src="script.js"></script>
</body>
</html>