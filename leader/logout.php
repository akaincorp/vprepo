<?php
$response = array();

session_start();
session_destroy();

$response['success'] = true;
?>