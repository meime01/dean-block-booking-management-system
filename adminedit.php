<?php
// Include the database connection file
include 'config.php';

// Start the session
session_start();

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Check if the user is logged in
if (!isset($user_id)) {
    // If the user is not logged in, redirect them to the admin login page
    header('location:adminlogin.php');
    exit;
}

// Check if the edit form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_device'])) {
    // Get the form data
    $device_id = mysqli_real_escape_string($conn, $_POST['device_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $device_type = mysqli_real_escape_string($conn, $_POST['device_type']);
    $device_name = mysqli_real_escape_string($conn, $_POST['device_name']);
    $serial_number = mysqli_real_escape_string($conn, $_POST['serial_number']);
    $hdd_storage = mysqli_real_escape_string($conn, $_POST['hdd_storage']);
    $ram_storage = mysqli_real_escape_string($conn, $_POST['ram_storage']);

    // Prepare the SQL query to update the device using a prepared statement
    $stmt = mysqli_prepare($conn, "UPDATE devices
                                  SET name = ?, surname = ?, email = ?, department = ?, device_type = ?, device_name = ?, serial_number = ?, hdd_storage = ?, ram_storage = ?, id = ?
                                  WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssssssisi", $name, $surname, $email, $department, $device_type, $device_name, $serial_number, $hdd_storage, $ram_storage, $device_id, $device_id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // If the query was successful, display a success message and refresh the page
        echo "<script>
                alert('Device updated successfully!');
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

// Check if the delete form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_device'])) {
    // Get the device ID from the form
    $device_id = mysqli_real_escape_string($conn, $_POST['device_id']);

    // Prepare the SQL query to delete the device using a prepared statement
    $stmt = mysqli_prepare($conn, "DELETE FROM devices WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $device_id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // If the query was successful, display a success message and refresh the page
        echo "<script>
                alert('Device deleted successfully!');
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

// Prepare the SQL query to fetch all devices
$sql = "SELECT * FROM devices";

// Execute the query
$result = mysqli_query($conn, $sql);
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
        /* Same as before */
   :root {
  --facebook-blue: #1877F2;
  --facebook-grey: #F0F2F5;
  --facebook-text: #1C1E21;
}

table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: var(--facebook-text);
}

th, td {
  padding: 12px 16px;
  text-align: left;
  border-bottom: 1px solid #e4e6eb;
}

th {
  background-color: var(--facebook-grey);
  font-weight: bold;
}

td {
  background-color: #fff;
}

tr:hover td {
  background-color: var(--facebook-grey);
}

th a, td a {
  color: var(--facebook-blue);
  text-decoration: none;
}

th a:hover, td a:hover {
  text-decoration: underline;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: #1c1e21;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f0f2f5;
}

form {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  margin: 0 auto;
}

label {
  display: block;
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 5px;
  color: #1c1e21;
}
.editbutton{
  background-color: #1877f2;
  color: #fff;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
  font-size: 16px;
}
input[type="text"],
input[type="email"] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 16px;
}

select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 16px;
}

input[type="submit"] {
  background-color: #1877f2;
  color: #fff;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
  font-size: 16px;
}

input[type="submit"]:hover {
  background-color: #1866c2;
}

		.div-container {
  background-color:#1877F2;
  border-radius:5px;
  height: 10px;
}
.div-container1 {
  background-color:#e91e63;
  border-radius:10px;
  height: 20px;
  width:75%;
}
.div-container2 {
  background-color:#FFCE26;
  border-radius:12.5px;
  height: 25px;
  width:50%;
}
	
    </style>

	<title>View Devices</title>
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
				<a href="#">
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
							<a class="active" href="#">View Devices</a>
						</li>
					</ul>
				</div>
			
			</div>
      <div class=div-container>
				
        </div>
			

            <div>
            <h1>View Devices</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Department</th>
            <th>Device Type</th>
            <th>Device Name</th>
            <th>Serial Number</th>
            <th>HDD Storage</th>
            <th>RAM Storage</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        // Loop through the results and display the devices
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['surname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['device_type'] . "</td>";
            echo "<td>" . $row['device_name'] . "</td>";
            echo "<td>" . $row['serial_number'] . "</td>";
            echo "<td>" . $row['hdd_storage'] . "</td>";
            echo "<td>" . $row['ram_storage'] . "</td>";
            echo "<td>
                    <button class='editbutton' onclick=\"showEditForm(
                        '" . $row['id'] . "',
                        '" . $row['name'] . "',
                        '" . $row['surname'] . "',
                        '" . $row['email'] . "',
                        '" . $row['department'] . "',
                        '" . $row['device_type'] . "',
                        '" . $row['device_name'] . "',
                        '" . $row['serial_number'] . "',
                        '" . $row['hdd_storage'] . "',
                        '" . $row['ram_storage'] . "'
                    )\">Edit</button>
                </td>";
            echo "<td>
                    <form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                        <input type='hidden' name='device_id' value='" . $row['id'] . "'>
                        <input class='deletebutton' type='submit' name='delete_device' value='Delete' onclick=\"return confirm('Are you sure you want to delete this device?')\">
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>

            </div>

            
    <div id="editModal" class="modal">
        <!-- Same as before -->
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <input type="hidden" name="device_id" id="device_id">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name"><br>
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname"><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br>
                <label for="department">Department:</label>
                <input type="text" id="department" name="department"><br>
                <label for="device_type">Device Type:</label>
                <select id="device_type" name="device_type">
                    <option value="laptop">Laptop</option>
                    <option value="desktop">Desktop</option>
                    <option value="printer">Printer</option>
                </select><br>
                <label for="hdd_storage">Device Name:</label>
                <input type="text" id="device_name" name="device_name"><br>
                <label for="hdd_storage">Serial Number:</label>
                <input type="text" id="serial_number" name="serial_number"><br>
                <label for="hdd_storage">HDD Storage:</label>
                <input type="text" id="hdd_storage" name="hdd_storage"><br>
                <label for="ram_storage">RAM Storage:</label>
                <input type="text" id="ram_storage" name="ram_storage"><br>
                <input type="submit" name="edit_device" value="Save">
            </form>
        </div>
    </div>
        <script>
    function showEditForm(id, name, surname, email, department, deviceType, deviceName, serialNumber, hddStorage, ramStorage) {
    let modal = document.getElementById("editModal");
    let closeButton = document.getElementsByClassName("close-button")[0];

    document.getElementById("device_id").value = id;
    document.getElementById("name").value = name;
    document.getElementById("surname").value = surname;
    document.getElementById("email").value = email;
    document.getElementById("department").value = department;
    document.getElementById("device_type").value = deviceType;
    document.getElementById("device_name").value = deviceName;
    document.getElementById("serial_number").value = serialNumber;
    document.getElementById("hdd_storage").value = hddStorage;
    document.getElementById("ram_storage").value = ramStorage;

    modal.style.display = "block";

    closeButton.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
</script>
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>