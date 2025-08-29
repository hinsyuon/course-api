<?php
require_once './../../bootstrap.php';

$course_name = $_POST['course_name'];
$schedule_days = $_POST['schedule_days'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$description = $_POST['description'];

$course = new Course();
$course->set_course_name($course_name);
$course->set_schedule_days($schedule_days);
$course->set_start_time($start_time);
$course->set_end_time($end_time);
$course->set_start_date($start_date);
$course->set_end_date($end_date);
$course->set_description($description);

echo $course->store();