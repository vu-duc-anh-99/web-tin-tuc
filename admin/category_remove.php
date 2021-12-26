<?php 
include '../db/class_admin.php';
$adminlib = new adminlib();

$id = intval($_GET["id"]);
$sql = "DELETE FROM category WHERE category_id = $id";

$adminlib->delete($sql);
header("Location: manage_category.php");

?>