<?php
/*
    Jethwa, Mittal
    Class Account #jadrn020
    Project #3
    Fall 2017
*/
    $UPLOAD_DIR = '/home/jadrn020/public_html/proj3/uploaded_images/';
    $COMPUTER_DIR = '/home/jadrn020/public_html/proj3/uploaded_images/';
    $fname = $_FILES['uploadFile']['name'];
    
    $name = $_POST['image_name']; 
    
    $message = "";

    if($_FILES['uploadFile']['error'] > 0) {
    	$err = $_FILES['uploadFile']['error'];	
        $message .= "Error Code: $err ";
        }     
             
    else {
        if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], "$COMPUTER_DIR".$name))
            $message = "Success! Your file has been uploaded to the server</br >\n $name" ;
        else
            $message = "Error! File did not upload";
    }         
    
    echo $message;
    
?>  