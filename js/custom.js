/*
	Jethwa, Mittal
	Class Account #jadrn020
	Project #3
	Fall 2017
*/
var msg = [ 'Please select an image to upload',
            'Please enter your First name',
            'Please enter your Last name',
            'Please enter your Address line 1',
            'Please enter your City',
            'Please enter your State',
            'Please enter your Zip',
            'Please enter your Email',
            'Please enter your Phone area code',
            'Please enter your Phone prefix number',
            'Please enter your Phone line number',
            'Please enter your birth month',
            'Please enter your birth day',
            'Please enter your birth year'];
var dup = true;
var file_exists = false;
var image_uploaded=false;
var form_validated=false;


$(document).ready(function() {

    $(':reset').click();
    $('#fname').focus();
    
    var h = new Array(16);
    h[0] = $('input[name="uploadFile"]');
    h[1] = $('input[name="fname"]');       
    h[2] = $('input[name="lname"]');
    h[3] = $('input[name="address1"]');
    h[4] = $('input[name="city"]');            
    h[5] = $('input[name="state"]');
    h[6] = $('input[name="zip"]');
    h[7] = $('input[name="email"]');
    h[8] = $('input[name="phone1"]');
    h[9] = $('input[name="phone2"]');
    h[10] =$('input[name="phone3"]');
    h[11] = $('input[name="dob_m"]');
    h[12] = $('input[name="dob_d"]');
    h[13] = $('input[name="dob_y"]');

    $(':reset').on('click',function() {
        $('#fname').focus();
        $('#fileName').html('&nbsp;');
        $('#alert-msg').html('&nbsp;');
        $('#alert-msg').removeClass('alert-danger');
    });

    h[0] = $('input[name="uploadFile"]');
    var size=0;
    var fileName;

    function isEmpty(fieldValue) {
        return $.trim(fieldValue).length == 0;    
    } 

    $('input[name="uploadFile"]').on('change',function(e) {
        if(isValidImage(this.files[0]))
            return true;
        else
            return false;
    });
        
    $('#imageUploadBtn').on('click', function() {
        $('#uploadFile').click();
    });


     $(':submit').bind('click', function(e) {
            e.preventDefault();
            
            
            if(is_form_valid())
            {
                file_exists = (typeof $("#uploadFile")[0].files[0] != "undefined");
            
                if(file_exists) {
                    var file_name = $("#uploadFile")[0].files[0].name;
                    var where = file_name.lastIndexOf('.');
                    var file_ext = file_name.substring(where);
                
                    //Create image file name dynamically to make it unique
                    var image_name = $('#phone1').val() + $('#phone2').val() + $('#phone3').val() + "_" +
                                 Date.now() + file_ext;

                    $('#hidden_image_name').val(image_name);
                    uploadImage(image_name);
                }
                check_dup();
            }
        }
    );
    

    function uploadImage(image_name) {    
        var form_data = new FormData($('form')[0]);
        
        //Call image validation here and execute below code only if it validates
        
        //var in_progress_img = "<img src='/~jadrn000/ajax_file_upload/busywait.gif' width='50px' height='auto' />";               
        var in_progress_img = "<img src='../images/busy.gif' id='loader' />";               
        $('#busy_wait').html(in_progress_img);
        form_data.append("image", $("#uploadFile")[0].files[0] );
        form_data.append("image_name", image_name);

        console.log(form_data);  
        
        $.ajax( {
            url: "php/upload_file.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#busy_wait').html("&nbsp;");   
                if(response.startsWith("Success")) {
                    image_uploaded = true;
                }
               else {
                    //$('#alert-msg').addClass('alert-danger');
                    //$('#alert-msg').html(response);    
                    image_uploaded = false;           
                }
            },
            error: function(response) {
                   //$('#alert-msg').css('color','red');
                   //$('#alert-msg').addClass('alert-danger');
                   //$('#alert-msg').html("Sorry, an upload error occurred");
                   $('#busy_wait').html("&nbsp;");   
                   image_uploaded = false;
                }
            });
    }


    function uploadForm() {
        var form_data = new FormData($('form')[0]);
        form_data.append("fname",h[1].val());
        form_data.append("mname",$.trim($('input[name="mname"]').val()));
        form_data.append("lname",h[2].val());
        form_data.append("address1",h[3].val());
        form_data.append("address2",$.trim($('input[name="address2"]').val()));
        form_data.append("city",h[4].val());
        form_data.append("state",h[5].val());
        form_data.append("zip",h[6].val());
        form_data.append("email",h[7].val());
        form_data.append("phone1",h[8].val());
        form_data.append("phone2",h[9].val());
        form_data.append("phone3",h[10].val());
        form_data.append("dob_m",h[11].val());
        form_data.append("dob_d",h[12].val());
        form_data.append("dob_y",h[13].val());
        form_data.append("gender",$('input[name="gender"]:checked').val());
        form_data.append("category",$('#category').val());
        form_data.append("conditions",$.trim($('input[name="conditions"').val()));
        form_data.append("expLevel",$('input[name="expLevel"]:checked').val());
        form_data.append("image_name",$('#hidden_image_name').val());

        $.ajax( {
            url: "/~jadrn020/proj3/php/process_request.php",
            type: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                if($.trim(response).startsWith("Success")) {
                    $(':reset').click();
                    $('#myModal').modal('show');
                    console.log("Form submitted");
                }
               else {
                    $('#alert-msg').css('color','red');
                    $('#alert-msg').addClass('alert-danger');
                    $('#alert-msg').html(response);    
                    $('#busy_wait').html("&nbsp;");              
                }
                
            },
            error: function(response) {
               $('#alert-msg').css('color','red');
               $('#alert-msg').addClass('alert-danger');
               $('#alert-msg').html("Sorry, error occurred in sending form data");
                }
            });
    }

    function check_dup() {
        var email = $('input[name="email"]').val();
        var phone = $('#phone1').val() + 
                    $('#phone2').val() +
                    $('#phone3').val();
        var params = "email=" + email +
                     "&phone=" + phone ;
        var url = "php/check_dup.php?"+params;
        $.get(url, dup_handler);
    }

    function dup_handler(response) {
        if($.trim(response) == "dup") {
            $('#alert-msg').addClass('alert-danger');
            $('#alert-msg').html("ERROR! Record already exist for this user.");
            dup = true;
        }
        else if($.trim(response) == "OK") {
            dup = false;
            console.log("dup value : " + dup);
            if(!dup) {
                console.log("No duplicates! Form being submitted");
                uploadForm(); //Perform server-side validations and register user if validated
            }
        }
        else {
            $('#alert-msg').addClass('alert-danger');
            $('#alert-msg').html($.trim(response));
            console.log($.trim(response));
            dup = true;
        }
    }

    $('input').on('blur',function(e) {
        if($.trim(e.target.value)) 
        {
            $('#alert-msg').html('&nbsp;');
            $('#alert-msg').removeClass('alert-danger');
        }
    });
    
    function upperCase(text) {
        return text.toUpperCase();
    }
    
    function is_form_valid() {

        //Upload Image validations 
        if(!isValidImage($('input[name="uploadFile"]')[0].files[0]))
            return false;
        
        //Validate for all empty elements
        for(var i=1; i<14; i++) {
            if(isEmpty(h[i].val())) {
                $('#alert-msg').text(msg[i]);
                $('#alert-msg').addClass('alert-danger');
                h[i].focus();
                return false;
            }
        }  

        if(!isSelectedGender($('input[name="gender"]:checked').val())) {
            console.log('in gender false');
            $('#alert-msg').text('Please select your gender');
            $('#alert-msg').addClass('alert-danger');
            return false;
        }

        //Validate Category
        if(!isSelectedCategory()) {
            $('#alert-msg').text('Please select one category');
            $('#alert-msg').addClass('alert-danger');
            $('#category').focus();
            return false;
        }

        //Validate Experience Level
        if(!isSelectedExpLevel($('input[name="expLevel"]:checked').val())) {
            $('#alert-msg').text('Please select your experience level');
            $('#alert-msg').addClass('alert-danger');
            return false;
        }

        if(!isValidCity($('#inputCity').val())) {
            $('#alert-msg').text('Invalid city name');
            $('#alert-msg').addClass('alert-danger');
            $('#inputCity').focus();
            return false;
        }

        //Validate State
        if(!isValidState($('#inputState').val()))
        {
            $('#alert-msg').text('Invalid state code. Please input USA state codes only');
            $('#alert-msg').addClass('alert-danger');
            $('#inputState').focus();
            return false;
        }

        if(!isValidZip($('#inputZip').val())) {
            $('#alert-msg').text('Invalid zip code. Please enter 5-digit numeric value');
            $('#alert-msg').addClass('alert-danger');
            $('#inputZip').focus();
            return false;
        }

        //Validate Email
        if(!isValidEmail($('#inputEmail').val()))
        {
            $('#alert-msg').text('Invalid email address');
            $('#alert-msg').addClass('alert-danger');
            $('#inputEmail').focus();
            return false;
        }
        
        //Validate Phone Number
        if(!isValidPhone($('#phone1').val(),$('#phone2').val(),$('#phone3').val())) {
            return false;
        }

        if(!isValidDate()) {
            $('#alert-msg').text('Invalid date. Please check again');
            $('#alert-msg').addClass('alert-danger');
            $('#dob_m').focus();
            return false;
        }
        
        //Validate Age
        if(isValidDate()) {
            if(!isValidAge()) {
                console.log(isValidAge());
                console.log(getAge());
                $('#alert-msg').text('Only participants of age 13 to 80 are allowed');
                $('#alert-msg').addClass('alert-danger');
                return false;
            }
        }

        //Validate Category and Age combination
        if(isSelectedCategory() && isValidAge()) {
            if(!isValidCategory()) {
                console.log('in Valid category');
                $('#alert-msg').text('Category selected is inconsistent with the age of the applicant');
                $('#alert-msg').addClass('alert-danger');
                $('#category').focus();
                return false;
            }
        }
        //Return true if all validations pass
        return true;
    }

    //Validate image
    function isValidImage(file) {
        
        if(!$.isEmptyObject(file)) {
            size = file.size;
            fileName = file.name;
            $('#fileName').text(fileName);
        }
        var validExtensions = new Array('jpeg','jpg','gif','bmp','png');
        if(size == 0) {
            console.log('in size 0');
            $('#alert-msg').text(msg[0]);
            $('#alert-msg').addClass('alert-danger');
            return false; 
        }
        if(size/1000 > 1000) {
            console.log('in big file');
            $('#alert-msg').text("Image is too big, 1 MB max");
            $('#alert-msg').addClass('alert-danger');
            return false; 
        }
        if(($.inArray((fileName.substr(fileName.lastIndexOf('.')+1)).toLowerCase(),validExtensions)) == -1) {
            console.log('in Invalid');
            $('#alert-msg').text("Invalid File type. Please select files with extensions .jpeg/.gif/.bmp/.png' only ");
            $('#alert-msg').addClass('alert-danger');
            $('#alert-msg').focus();
            return false;
        }

        return true;
    }

    //Validate City
    function isValidCity(city) {
        return /^[a-zA-Z\s]+$/.test(city);
    }
    //Make the state code upper case when user inputs in the textfield
    document.getElementById("inputState").oninput =  function() {
        $('#inputState').val(this.value.toUpperCase());
    };

    function isValidState(state) {                                
        var stateList = new Array("AK","AL","AR","AZ","CA","CO","CT","DC",
        "DE","FL","GA","GU","HI","IA","ID","IL","IN","KS","KY","LA","MA",
        "MD","ME","MH","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ",
        "NM","NV","NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX",
        "UT","VA","VT","WA","WI","WV","WY");
        for(var i=0; i < stateList.length; i++) 
            if(stateList[i] == $.trim(state).toUpperCase())
                return true;
        return false;
    }
    
    function isValidZip(zip) {
        return $.isNumeric(zip) && zip.length==5;
    }

    function isValidEmail(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }   

    function isValidPhone(area,prefix,line) {
        
        if (!($.isNumeric(area) && $.isNumeric(prefix) && $.isNumeric(line)))
        {
        	$('#alert-msg').text('Invalid phone number. Must contain numeric values only');
            $('#alert-msg').addClass('alert-danger');
            $('#phone1').focus();
            return false;
        }
        var num=area+''+ prefix +''+ line;
        if ($.trim(num).length != 10)
        {
        	$('#alert-msg').text('Invalid phone number. Must contain 10 digits');
            $('#alert-msg').addClass('alert-danger');
            $('#phone1').focus();
            return false;
        }
        return true;
    }

    function isSelectedCategory() {
        var category= $('#category').val();
        if (category=="--------")
            return false;
        return true;
    }

    function isValidDate() {
        var day=$('#dob_d').val();
        var month=$('#dob_m').val();
        var year=$('#dob_y').val();
        if(!($.isNumeric(month) && $.isNumeric(day) && $.isNumeric(year)))
            return false;
        // now turn the three values into a Date object and check them
        var checkDate = new Date(year, month-1, day);    
        var checkDay = checkDate.getDate();
        var checkMonth = checkDate.getMonth()+1;
        var checkYear = checkDate.getFullYear();
        
        if(day == checkDay && month == checkMonth && year == checkYear)
            return true;
        else
            return false;
    }

    function isSelectedGender(gender) {
        if (gender==null)
            return false;
        return true;
    }

    function isSelectedExpLevel(expLevel) {
        if (expLevel==null)
            return false;
        return true;  
    }

    function getAge() {
        var day=$('#dob_d').val();
        var month=$('#dob_m').val();
        var year=$('#dob_y').val();
        var dob = new Date(year,month,day);
        var today = new Date();
        return Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000)); 
    }

    function isValidAge() {
        if(getAge()<13 || getAge()>80)
                return false;
        return true;  
    }

    function isValidCategory() {
        var category= $('#category').val();
            var age = getAge();
            if( (age < 20 && category!='Teen') ||
                (age >= 60 && category!='Senior') ||
                (age >= 20 && age <60 && category!='Adult') )
                return false;
            else
                return true;
    }
});
