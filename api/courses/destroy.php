<?php
require_once './../../bootstrap.php';

$id = $_GET['id'];

$course = new Course();
$course->set_id($id);
echo $course->destroy();