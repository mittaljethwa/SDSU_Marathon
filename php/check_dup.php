<?php
/*
    Jethwa, Mittal
    Class Account #jadrn020
    Project #3
    Fall 2017
*/
	include('helpers.php');
	include('process_form_data.php');

	$email =$_GET['email'];
	$phone =$_GET['phone'];

	check_dup($email,$phone);	
?>