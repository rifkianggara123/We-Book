<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
    <style>
/* General Styles */
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  background: linear-gradient(135deg, #A52A2A, #4C3228);
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  text-align: center;
}

h2 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

/* Button Container */
.btn-back {
  background-color: rgba(255, 255, 255, 0.1);
  border-radius: 15px;
  padding: 30px;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
  max-width: 400px;
  text-align: center;
}

/* Buttons */
.btn-back a {
  display: block;
  text-decoration: none;
  font-size: 1.2rem;
  font-weight: bold;
  color: #fff;
  background: linear-gradient(90deg, #A52A2A, #765341);
  padding: 10px 20px;
  border-radius: 8px;
  margin: 10px 0;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.btn-back a:hover {
  background: linear-gradient(90deg, #A52A2A, #765341);
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
  transform: translateY(-3px);
}

.btn-back a:active {
  transform: translateY(0);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Mobile Responsiveness */
@media (max-width: 600px) {
  h2 {
    font-size: 2rem;
  }

  .btn-back {
    padding: 20px;
  }

  .btn-back a {
    font-size: 1rem;
    padding: 8px 15px;
  }
}
</style>
</head>
<div class="btn-back">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="indexlogin.html"class="btn-back">Lanjut ke halaman</a>
    <a href="logout.php"class="btn-back">Logout</a>
</div>
</body>
</html>
