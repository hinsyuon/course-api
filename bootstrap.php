<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/model/Database.php';
require_once __DIR__ . '/model/Course.php';