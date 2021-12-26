<?php 
include '../db/class_admin.php';
$adminlib = new adminlib();

$comment_id = intval($_GET["comment_id"]);
$post_id = intval($_GET["post_id"]);
$sql = "DELETE FROM comment WHERE comment_id = $comment_id";

$post = $adminlib->delete($sql);

header("Location: manage_comment.php?id=".$post_id);
?>