<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  
  <style>
 body {
  font-family: 'Helvetica Neue', Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-image: url('images/backg2.png');
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  
}

.container {
  display: flex;
  justify-content: space-around;
  width: 80%;
  max-width: 800px;
}

.user-div,
.admin-div {
  background-color: #fff;
  padding: 2rem;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: transform 0.3s ease;
  width: 40%;
}

.user-div:hover,
.admin-div:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.user-div h2,
.admin-div h2 {
  color: #1877f2;
  font-size: 1.8rem;
  margin-bottom: 1rem;
}

.user-div p,
.admin-div p {
  color: #65676b;
  font-size: 1.1rem;
}
  </style>
</head>
<body>
<h1 style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%); color: white;">Deans Block Booking and Equipment System</h1>
  <div class="container">
    <div class="user-div" onclick="redirectToUserLogin()">
      <h2>User</h2>
      <p>Click here to login as a CUT staff</p>
    </div>
    <div class="admin-div" onclick="redirectToAdminLogin()">
      <h2>Admin</h2>
      <p>Click here to login as an ICT CUT staff</p>
    </div>
  </div>

  <script>
    function redirectToUserLogin() {
  window.location.href = "login.php";
}

function redirectToAdminLogin() {
  window.location.href = "adminlogin.php";
}
  </script>
</body>
</html>