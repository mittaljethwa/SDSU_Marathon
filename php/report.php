<!-- 
	Jethwa, Mittal
	Class Account #jadrn020
	Project #3
	Fall 2017
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Runner Report</title>
    <link rel="stylesheet" href="css/report.css">

</head>
<body>
    <h1>Runner Report</h1>
	<?php
		
		include('helpers.php');					//database connection 
		$db = get_db_handle();

		//Get "Teen" records 
		$sql_teen = "SELECT CONCAT(lname , ', ' , fname , ' ' , ifNull(mname,'')), CONCAT('<img src=\"',img_path,'\">'), dob, exp_level FROM runner WHERE category='teen' order by lname;";    
	    $result = mysqli_query($db, $sql_teen);
	    if(!result)
	        echo "ERROR in teen query :".mysqli_error($db);
	    
	    //Display "Teen" records
	    echo "<table>\n<caption>Teen Runners</caption>\n";
	    echo
	  	"<tr><td>Name</td><td>Photo</td><td>Age</td><td>Experience</td></tr>";
	    while($row=mysqli_fetch_row($result)) {
	        echo "<tr>";
	        foreach(array_slice($row,0) as $item) 
	            echo "<td>$item</td>";
	        echo "</tr>\n";
	        }
	    echo "</table>\n";

	    //Get "Adult" records 
		$sql_adult = "SELECT CONCAT(lname , ', ' , fname , ' ' , ifNull(mname,'')), CONCAT('<img src=\"',img_path,'\">'), dob, exp_level FROM runner WHERE category='adult' order by lname;";    
	    $result = mysqli_query($db, $sql_adult);
	    if(!result)
	        echo "ERROR in adult query :".mysqli_error($db);
	    
	    //Display "Adult" records
	    echo "<table>\n<caption>Adult Runners</caption>\n";
	    echo
	  	"<tr><td>Name</td><td>Photo</td><td>Age</td><td>Experience</td></tr>";
	    while($row=mysqli_fetch_row($result)) {
	        echo "<tr>";
	        foreach(array_slice($row,0) as $item) 
	            echo "<td>$item</td>";
	        echo "</tr>\n";
	        }
	    echo "</table>\n";

	    //Get "Senior " records 
		$sql_senior = "SELECT CONCAT(lname , ', ' , fname , ' ' , ifNull(mname,'')), CONCAT('<img src=\"',img_path,'\">'), dob, exp_level FROM runner WHERE category='senior' order by lname;";    
	    $result = mysqli_query($db, $sql_senior);
	    if(!result)
	        echo "ERROR in adult query :".mysqli_error($db);
	    
	    //Display "Senior" records
	    echo "<table>\n<caption>Senior Runners</caption>\n";
	    echo
	  	"<tr><td>Name</td><td>Photo</td><td>Age</td><td>Experience</td></tr>";
	    while($row=mysqli_fetch_row($result)) {
	        echo "<tr>";
	        foreach(array_slice($row,0) as $item) 
	            echo "<td>$item</td>";
	        echo "</tr>\n";
	        }
	    echo "</table>\n";
	       
	    mysqli_close($db);
	  ?>
</table>
</body>
</html>
