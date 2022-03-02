<?php
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$birthplace = $_POST['birthplace'];
	$birthdate = $_POST['birthdate'];
	$nik = $_POST['nik'];
	$gender = $_POST['gender'];
	$status = $_POST['status'];
	$npwp = $_POST['npwp'];
	$kelurahan = $_POST['kelurahan'];
	$kecamatan = $_POST['kecamatan'];
	$kota = $_POST['kota'];
	$provinsi = $_POST['provinsi'];
	$salary = $_POST['salary'];


	if($firstname == ""){
		echo 'empty <br>';
	}else if(strlen($firstname)>50){
		echo 'Maximum lenght 50 <br>';
	}
	if($lastname == ""){
		echo 'empty <br>';
	}else if(strlen($lastname)>50){
		echo 'Maximum lenght 50 <br>';
	}
	if($birthplace == ""){
		echo 'empty <br>';
	}else if(strlen($birthplace)>50){
		echo 'Maximum lenght 50 <br>';
	}
    
	$birthdate = $_POST['birthdate'];
	
	if($nik == ""){
		echo 'empty <br>';
	}else if(preg_match('/[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/', $nik)==0){
		echo 'NIK should be 16 numbers <br>';
	}
	if($gender == ""){
		echo 'empty <br>';
	}else if($gender == "male"){
		echo 'Not the choice <br>';
	}else if($gender == "female"){
		echo 'Not the choice <br>';
	}
	if($status == ""){
		echo 'empty <br>';
	}else if($status == "yes"){
		echo 'Not the choice <br>';
	}else if($status == "no"){
		echo 'Not the choice <br>';
	}
	if($npwp == ""){
		echo 'empty <br>';
	}else if(preg_match('/[0-9][0-9].[0-9][0-9][0-9].[0-9][0-9][0-9].[0-9]-[0-9][0-9][0-9].[0-9][0-9][0-9]/', $npwp)==0){
		echo 'NPWP should be XX.XXX.XXX.X-XXX.XXX <br>';
	}
	if($kelurahan == ""){
		echo 'empty <br>';
	}else if(strlen($kelurahan)>50){
		echo 'Maximum lenght 50 <br>';
	}
	if($kecamatan == ""){
		echo 'empty <br>';
	}else if(strlen($kecamatan)>50){
		echo 'Maximum lenght 50 <br>';
	}
	if($kota == ""){
		echo 'empty <br>';
	}else if($kota == "jember"){
		echo 'Not the choice <br>';
	}else if($kota == "sidoarjo"){
		echo 'Not the choice <br>';
	}else if($kota == "malang"){
		echo 'Not the choice <br>';
	}else if($kota == "surabaya"){
		echo 'Not the choice <br>';
	}
	if($provinsi == ""){
		echo 'empty <br>';
	}else if($provinsi == "jawa_timur"){
		echo 'Not the choice <br>';
	}
	if($salary == ""){
		echo 'empty <br>';
	}else if($salary < 54000000){
		echo 'salary is low, minimal 54 million <br>';
	}else if($salary > 50000000000){
		echo 'salary is high, maximal 50 billion <br>';
	}

	if(($salary - 54000000) < 50000000){
		$taxpercent = 5;
	}else if((($salary - 54000000) >= 50000000) || (($salary - 54000000) < 250000000)){
		$taxpercent = 15;
	}else if((($salary - 54000000) >= 250000000 || ($salary - 54000000) < 500000000)){
		$taxpercent = 25;
	}else if(($salary - 54000000) >= 500000000){
		$taxpercent = 30;
	}

	$pph = ($salary - 54000000) * $taxpercent / 100;	

	// Database connection
	$conn = new mysqli('localhost','root','','pajak');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->query("insert into pph_jatim(firstname, lastname, birthplace, birthdate, gender, nik, status, npwp, kelurahan, kecamatan, kota, provinsi, salary, pph) 
		values('" . $firstname . "','" . $lastname . "','" . $birthplace . "','" . $birthdate . "','" . $gender . "','" . $nik . "','" . $status . "','" . $npwp . "','" . $kelurahan . "','" . $kecamatan . "','" . $kota . "','" . $provinsi . "','" . $salary . "','" . $pph . "')");
	}
?>