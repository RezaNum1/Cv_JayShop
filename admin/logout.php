<?php
session_destroy();
echo "<script>alert('logout');</script>";
echo "<script>location='login.php';</script>";
?>