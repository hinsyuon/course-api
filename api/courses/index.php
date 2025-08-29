<?php
require_once './../../bootstrap.php';

$course = new Course();
$search = isset($_GET['search'])? $_GET['search'] : null;
echo $course->index($search );