<?php 

date_default_timezone_set("Asia/Jakarta");

$config = config('database');
$connection = new mysqli($config['server'], $config['username'], $config['password'], $config['database']);

if($connection->connect_error){
	die('Connection failed: ' . $connection->connect_error);
}
