<?php 
include '../db/class_admin.php';
$adminlib = new adminlib();

$id = intval($_GET["id"]);
$sql = "DELETE FROM user WHERE id = $id";

$adminliblib->delete($sql);
header("Location: manage_user.php");

?>