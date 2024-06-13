<!DOCTYPE html>
<html>
<head>
    <title>Booking Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Booking Details</h1>

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
</body>
</html>