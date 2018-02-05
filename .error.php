<?php

$status=$_SERVER['REDIRECT_STATUS'];
$codes=array(
       400 => array('400 Bad Request', 'The request cannot be fulfilled due to bad syntax.'),
       401 => array('401 Login Error', 'It appears that the password and/or user-name you entered was incorrect. <a href="#" onclick="window.location.reload()">Click here</a> to return to the login page.'),
       403 => array('403 Forbidden', 'The server has refused to fulfill your request.'),
       404 => array('404 Not Found', 'Whoops, sorry, but the document you requested was not found on this server.'),
       405 => array('405 Method Not Allowed', 'The method specified in the Request-Line is not allowed for the specified resource.'),
       408 => array('408 Request Timeout', 'Your browser failed to send a request in the time allowed by the server.'),
       414 => array('414 URL To Long', 'The URL you entered is longer than the maximum length.'),
       500 => array('500 Internal Server Error', 'The request was unsuccessful due to an unexpected condition encountered by the server.'),
       502 => array('502 Bad Gateway', 'The server received an invalid response from the upstream server while trying to fulfill the request.'),
       504 => array('504 Gateway Timeout', 'The upstream server failed to send a request in the time allowed by the server.'),
);
 
$errortitle = $codes[$status][0];
$message = $codes[$status][1];

?>

<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href=".css/bootstrap.min.css">
	<link rel="stylesheet" href=".css/sticky-footer.css">

	<title><?php echo(basename(__DIR__)); ?> Videos</title>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="#"><?php echo(basename(__DIR__)); ?> Videos</a>
			</div>
		</nav>
	</header>
	
	<main role="main" class="container">
		<div class='container'>
			<h2 class='mt-4'>Sorry, but that's an error!</h2>
			<h2><?php echo $errortitle; ?></h2>
			<p><?php echo $message;?></p>
		</div>

	</main>
	<footer class="footer">
		<center class="text-muted">Simple Video Listing &bullet; Jonas Höchst &copy; 2018</center>
	</footer>
</body>
</html>
