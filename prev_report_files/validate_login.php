<?php

    $pass = $_POST['pass'];
    $valid = false;

    $raw = file_get_contents('passwords.dat');
    $data = explode("\n",$raw);
    foreach($data as $item) {
        if( crypt($pass,$item) == trim($item)) 
                $valid = true;            
        }  #end foreach
        
    if($valid)
        //echo "Login Successful.";
        include('report.php');
    else
        echo "Login Unsuccessful.";     
?>