<!DOCTYPE html>
<html>

<head>
	<title>A Login Example</title>
	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />  
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>     
    <script type="text/javascript" src="js/report.js"></script>
    <link rel="stylesheet" type="text/css" href="css/report.css" />               
    
    </head>
    <body>

        <div id="roster-content">
            <h1>Roster Login</h1>

            <form METHOD="post">
                <label>Password : </label>
                <input type="password" name="pass" size="20">
                <button type="submit">Login</button>
                <p id="#status">&nbsp;</p>
            </form>
        </div>
    
</body>
</html>