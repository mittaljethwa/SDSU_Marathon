<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>A Login Example</title>
	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />                 
    <style type="text/css">
    h1, h2 { text-align: center; }
    input { margin: 5px; }
    #message_line { color: red; }
    </style>             	
    </head>
    <body>

        <h1>Roster Login</h1>

        <form type="post" action="validate_login.php">
            <label>Password : </label>
            <input type="password" name="pass" size="20">
            <button type="submit">Register</button>
        </form>
    
</body>
</html>