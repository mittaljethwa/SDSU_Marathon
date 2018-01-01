<?php
/*
    Jethwa, Mittal
    Class Account #jadrn020
    Project #3
    Fall 2017
*/
function validate_data($params) {
    $msg = "";

    $size = $_FILES['uploadFile'][size];
    $ext = strrchr($_FILES['uploadFile'][name],".");
    $valid_ext = array(".jpeg",".jpg",".gif",".bmp",".png");
    

    if($size == 0)
        $msg .= "Please upload an image<br />";
    elseif(!in_array(strtolower($ext),$valid_ext)) 
        $msg .= "Invalid File type! Please select files with extensions .jpeg/.gif/.bmp/.png' only</br>";
    elseif($size > 1048576) 
        $msg .= "Please upload an image of size less than 1MB<br />";
    if(strlen($params[0]) == 0)
        $msg .= "Please enter your First name<br />";  
    if(strlen($params[2]) == 0)
        $msg .= "Please enter your Last name<br />";  
    if(strlen($params[3]) == 0)
        $msg .= "Please enter your Address line 1<br />"; 
    if(strlen($params[5]) == 0)
        $msg .= "Please enter your City<br />"; 
    elseif(!ctype_alpha(str_replace(" ", "", $params[5]))) //Check if city contains non alphabetic characters
        $msg .= "Please enter valid city name<br />";
    if(strlen($params[6]) == 0)
        $msg .= "Please enter your State<br />"; 
    elseif(!is_valid_state($params[6])) //Check for valid USA state codes
        $msg .= "Invalid state code. Please input USA state codes only </br>";                       
    if(strlen($params[7]) == 0)
        $msg .= "Please enter your Zip Code<br />";
    elseif(!(is_numeric($params[7])) || strlen($params[7])!=5) 
        $msg .= "Invalid zip code. Please enter 5-digit numeric value<br />";
    if(strlen($params[8]) == 0)
        $msg .= "Please enter your Email<br />";
    elseif(!filter_var($params[8], FILTER_VALIDATE_EMAIL))
        $msg .= "Please enter valid email address<br/>"; 
    if(strlen($params[9]) == 0)
        $msg .= "Please enter your Phone<br />";
    elseif(!(is_numeric($params[9])) || strlen($params[9])!=10) 
        $msg .= "Invalid phone number. Please enter 10-digit numeric value only<br />";  
    if(strlen($params[10]) == 0)
        $msg .= "Please enter your Date of birth<br />";
    else {
        if(!validate_date($params[10]))
            $msg .= "Invalid date. Please check again </br>";
        elseif( get_age($params[10]) < 13  || get_age($params[10]) > 80)
            $msg .= get_age($params[10]) . "Only participants of age 13 to 80 are allowed </br>";
        elseif (strlen($params[12]) != 0 && 
                (
                    (get_age($params[10]) < 20 && $params[12]!='Teen') ||
                    (get_age($params[10]) >= 60 && $params[12]!='Senior') ||
                    (get_age($params[10]) >= 20 && get_age($params[10]) < 60 && $params[12]!='Adult') 
                )
            ) {
            $msg .= "Category selected is inconsistent with the age of the applicant </br>";
        }
    }
    if(strlen($params[11]) == 0)
        $msg .= "Please select your Gender<br />";
    if(strlen($params[12]) == 0)
        $msg .= "Please select your Category<br />";
    if(strlen($params[14]) == 0)
        $msg .= "Please select your Experience Level<br />";
    
    if($msg) {
        //write_form_error_page($msg);
        echo "Error! Please resolve below errors before submitting : </br> ".$msg;
        exit;
    }
}

function is_valid_state($state) {                                
        $stateList = array("AK","AL","AR","AZ","CA","CO","CT","DC",
        "DE","FL","GA","GU","HI","IA","ID","IL","IN","KS","KY","LA","MA",
        "MD","ME","MH","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ",
        "NM","NV","NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX",
        "UT","VA","VT","WA","WI","WV","WY");
        if(in_array(strtoupper($state), $stateList))
            return true;
        return false;
}

function validate_date($date)
{
    $d = DateTime::createFromFormat('Ymd', $date);
    return $d && $d->format('Ymd') == $date;
}

function get_age($dob)
{
    return date_diff(date_create($dob), date_create('today'))->y;
}

function write_form_error_page($msg) {
    write_header();
    echo "<h2>Sorry, an error occurred<br />",
    $msg,"</h2>";
    write_form();
    write_footer();
    }  
    
function write_form() {
    print <<<ENDBLOCK
	<fieldset>
	<legend>Personal Information</legend>
        <form  
        name="customer"
        method="post" 
        action="process_request.php">
            <label for="name">Name:</label>
            <label for="address">Address:</label>
            <label for="city">City:</label>
            <label for="state">State:</label>
            <label for="zip">Zipcode:</label>                                                
            <label for="email">Email:</label> 

            <input type="text" name="name" value="$_POST[name]" size="30" id="name" /><br />
            <input type="text" name="address" value="$_POST[address]"  size="50" id="address" /><br />
            <input type="text" name="city" value="$_POST[city]"  size="20" id="city"/><br />
            <input type="text" name="state" value="$_POST[state]"  size="5" id="state"/><br />
            <input type="text" name="zip" value="$_POST[zip]"  size="10" id="zip"/><br />
            <input type="text" name="email" value="$_POST[email]"  size="20" id="email"/><br />            
            <div class="buttons">
            <input type="reset" />
            <input type="submit" value="Submit" />
            </div>        
        </form>   
	</fieldset> 
ENDBLOCK;
}                        

function process_parameters($params) {
    global $bad_chars;

    $params = array();
    
    $params[] = trim(str_replace($bad_chars, "", $_POST['fname']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['mname']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['lname']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['address1']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['address2']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['city']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['state']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['zip']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['email']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['phone1'])) .
                trim(str_replace($bad_chars, "", $_POST['phone2'])) .
                trim(str_replace($bad_chars, "", $_POST['phone3'])) ;
    $params[] = trim(str_replace($bad_chars, "", $_POST['dob_y'])) .
                trim(str_replace($bad_chars, "", $_POST['dob_m'])) . 
                trim(str_replace($bad_chars, "", $_POST['dob_d']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['gender']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['category']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['conditions']));
    $params[] = trim(str_replace($bad_chars, "", $_POST['expLevel']));


    $params[] = "uploaded_images/" . $_POST['image_name'];
    
    return $params;
    }
    
    function store_data_in_db($params) {
        # get a database connection
        $db = get_db_handle();  ## method in helpers.php
   
    ##OK, duplicate check passed, now insert
        $sql =  "INSERT INTO runner(fname,mname,lname,address1,address2,city,state,zip,email,phone,dob,gender,category,med_conditions,exp_level,img_path) ".
                "VALUES('$params[0]',IF('$params[1]'='',NULL,'$params[1]'),'$params[2]','$params[3]',IF('$params[4]'='',NULL,'$params[4]'),'$params[5]','$params[6]','$params[7]','$params[8]','$params[9]','$params[10]','$params[11]','$params[12]',IF('$params[13]'='',NULL,'$params[13]'),'$params[14]','$params[15]');";
    ##echo "The SQL statement is ",$sql;   

        mysqli_query($db,$sql);
        $how_many = mysqli_affected_rows($db);
        close_connector($db);

        if ($how_many > 0)
            echo 'Success! User added';
        else {
            echo 'Error! User data not recorded'; 
            exit;
        }
        
    }

    function check_dup($email,$phone) {
        $db = get_db_handle();  ## method in helpers.php

        $sql = "SELECT 1 FROM runner WHERE ".
        "email = '$email' AND ".
        "phone = '$phone'" .
        "LIMIT 1;";
        
        mysqli_query($db,$sql);
        $how_many = mysqli_affected_rows($db);
        if($how_many > 0) {
            echo "dup";
        }
        else if ($how_many == 0)
            echo "OK";
        else
            echo "Error! Number of Rows ". $how_many;

        close_connector($db);
    }
?>   





