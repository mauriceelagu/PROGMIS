<?php
include('config/include.php');
unset($_SESSION['admin_id']);
unset($_SESSION['admin_name']);
header('Location:index.php');
exit();
?>