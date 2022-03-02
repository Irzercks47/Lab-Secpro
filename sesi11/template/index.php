<?php 
require_once('helpers/session.php'); 
require_once('helpers/function.php'); 

if(!isset($_SESSION['username'])){
	include('register.php');
}
else{
	include('home.php');
}