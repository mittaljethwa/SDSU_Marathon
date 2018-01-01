<?php 
/*
    Jethwa, Mittal
    Class Account #jadrn020
    Project #3
    Fall 2017
*/
if(!isset($_POST["valid"]))
{
    echo '<!DOCTYPE html>
    <html>

    <head>
    	<title>Marathon Roster</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SDSU Marathon | Home</title>

        <!-- CHANGE THIS BEFORE SUBMISSION
        <link rel="stylesheet" href="/bootstrap/js/bootstrap.min.js">
        <script type="text/javascript" src="/jquery/jquery.js"></script>        
        -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>     
        
        <link rel="stylesheet" type="text/css" href="css/runners_home.css" />     
        <link rel="stylesheet" type="text/css" href="css/report.css" />    
        <script type="text/javascript" src="js/timer.js"></script>
        <script type="text/javascript" src="js/report.js"></script>
                   
        
        </head>
        <body>

            <nav class="header navbar-fixed-top">
                    <a href="index.html"><img src="images/mylogo.PNG" class="logo" alt="Logo"></a>
                    <div class="wrapper">
                        <ul class="right-content">
                            <li>
                                <table id="countdown-timer" class="countdown">
                                    <tr class="time">
                                        <td><div id="countdown-days">--</div></td>
                                        <td><div id="countdown-hrs">--</div></td>
                                        <td><div id="countdown-mins">--</div></td>
                                        <td><div id="countdown-secs">--</div></td>
                                    </tr>
                                    <tr class="labels">
                                        <td>Days</td><td>Hours</td><td>Min</td><td>Sec</td>
                                    </tr>
                                </table>
                            </li>
                            
                        </ul>
                    </div>
            </nav>

            <div id="roster-content">
                <h1>Roster Login</h1>

                <form METHOD="post">
                    
                    <div class="form-group col-md-4 col-md-offset-4">
                        <label for="pass" class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="pass" placeholder="Password">
                    </div>
                    <div class="buttons col-md-12 text-center">
                        <button type="reset" class="btn btn-md btn-default btn-clear">Reset</button>
                        <button type="submit" class="btn btn-md btn-primary btn-submit">Submit</button>
                    </div>
                    <p id="status">&nbsp;</p>
                </form>
            </div>
        
    </body>
    </html>';
}
else
{
    //include('roster.php');
    echo "<h1>Runner Report</h1>";
    include('php/helpers.php');                 //database connection 
    $db = get_db_handle();

    //Get "Teen" records 
    $sql_teen = "SELECT CONCAT(lname , ', ' , fname , ' ' , ifNull(mname,'')), CONCAT('<img src=\"',img_path,'\" class=\"roster_pic\">'), FLOOR(DATEDIFF(now(),dob)/365.25) age, exp_level FROM runner WHERE category='teen' order by lname;";    
    $result = mysqli_query($db, $sql_teen);
    if(!result)
        echo "ERROR in teen query :".mysqli_error($db);

    //Display "Teen" records
    echo "<table class='table table-bordered'>\n<caption>Teen Runners</caption>\n";
    echo
        "<thead class='thead-light'><tr><td>Name</td><td>Photo</td><td>Age</td><td>Experience</td></tr></thead>";
    while($row=mysqli_fetch_row($result)) {
        echo "<tr>";
        foreach(array_slice($row,0) as $item) 
            echo "<td>$item</td>";
        echo "</tr>\n";
        }
    echo "</table></br></br>\n";

    //Get "Adult" records 
    $sql_adult = "SELECT CONCAT(lname , ', ' , fname , ' ' , ifNull(mname,'')), CONCAT('<img src=\"',img_path,'\" class=\"roster_pic\">'), FLOOR(DATEDIFF(now(),dob)/365.25) age, exp_level FROM runner WHERE category='adult' order by lname;";    
    $result = mysqli_query($db, $sql_adult);
    if(!result)
        echo "ERROR in adult query :".mysqli_error($db);

    //Display "Adult" records
    echo "<table class='table table-bordered'>\n<caption>Adult Runners</caption>\n";
    echo
        "<thead class='thead-light'><tr><td>Name</td><td>Photo</td><td>Age</td><td>Experience</td></tr></thead>";
    while($row=mysqli_fetch_row($result)) {
        echo "<tr>";
        foreach(array_slice($row,0) as $item) 
            echo "<td>$item</td>";
        echo "</tr>\n";
        }
    echo "</table></br></br>\n";

    //Get "Senior " records 
    $sql_senior = "SELECT CONCAT(lname , ', ' , fname , ' ' , ifNull(mname,'')), CONCAT('<img src=\"',img_path,'\" class=\"roster_pic\">'), FLOOR(DATEDIFF(now(),dob)/365.25) age, exp_level FROM runner WHERE category='senior' order by lname;";    
    $result = mysqli_query($db, $sql_senior);
    if(!result)
        echo "ERROR in adult query :".mysqli_error($db);

    //Display "Senior" records
    echo "<table class='table table-bordered'>\n<caption>Senior Runners</caption>\n";
    echo
        "<thead class='thead-light'><tr><td>Name</td><td>Photo</td><td>Age</td><td>Experience</td></tr></thead>";
    while($row=mysqli_fetch_row($result)) {
        echo "<tr>";
        foreach(array_slice($row,0) as $item) 
            echo "<td>$item</td>";
        echo "</tr>\n";
        }
    echo "</table>\n";
       
    mysqli_close($db);
}
?>