<?php
include 'db_connect.php';
$id = intval($_GET['id']);
$conn->query("DELETE FROM orders WHERE id=$id");
header("Location: index.php");
exit;
?>