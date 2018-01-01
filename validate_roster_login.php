<?php
/*
    Jethwa, Mittal
    Class Account #jadrn020
    Project #3
    Fall 2017
*/
    $pass = $_POST['pass'];
    $valid = false;

    $raw = file_get_contents('passwords.dat');
    $data = explode("\n",$raw);
    foreach($data as $item) {
        if( crypt($pass,$item) == trim($item)) 
                $valid = true;            
        }  #end foreach
        
    if($valid)
        echo "OK";
    else
        echo "Mismatch";     
?>