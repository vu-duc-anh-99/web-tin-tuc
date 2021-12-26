<?php 
include '../db/class_admin.php';
$adminlib = new adminlib();

$comment_id = intval($_GET["comment_id"]);
$post_id = intval($_GET["id"]);
$data = array();
$data['flag'] = 1;
$where = "WHERE comment_id = $comment_id";

$post = $adminlib->update("comment",$data,$where);

header("Location: manage_comment.php?id=".$post_id);
?>