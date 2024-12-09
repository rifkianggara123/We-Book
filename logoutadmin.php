<?php
session_start();
session_unset(); // Menghapus semua session variables
session_destroy(); // Menghancurkan sesi
header("Location: loginadmin.php"); // Redirect ke halaman login
exit;