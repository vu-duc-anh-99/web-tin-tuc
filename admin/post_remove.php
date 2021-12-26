<?php 
include '../db/class_admin.php';
$adminlib = new adminlib();

$post_id = intval($_GET["id"]);
$sql = "DELETE FROM posts WHERE post_id = $post_id";

$post = $adminlib->delete($sql);

header("Location: manage_post.php");
?>
