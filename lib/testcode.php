<html>
<head>
	<title>html form with php captcha</title>
</head>
<body>
	<form method="post" action="write.php">
		<input class="input" type="text" name="norobot" />
		<img src="captcha.php" />
		<input type="submit" value="Submit" />
	</form>
</body>
</html>