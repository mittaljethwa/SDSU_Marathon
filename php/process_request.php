<?php
/*
    Jethwa, Mittal
    Class Account #jadrn020
    Project #3
    Fall 2017
*/
include('helpers.php');					//database connection 
include('process_form_data.php');		//process form fields and validate


$params = process_parameters();
validate_data($params);
store_data_in_db($params);

?>  