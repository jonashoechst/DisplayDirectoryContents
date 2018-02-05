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
	<?php
	
	$video_extensions = array('m4v', 'mp4', 'webm', 'ogv', 'mpg', 'mpeg', 'mov');

	function pretty_filesize($file) {
		$size=filesize($file);
		if($size<1024){$size=$size." Bytes";}
		elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
		elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
		else{$size=round($size/1073741824, 1)." GB";}
		return $size;
	}

	$myDirectory=opendir(".");

	while($entryName=readdir($myDirectory)) {
	   $dirArray[]=$entryName;
	}

	closedir($myDirectory);
	$indexCount=count($dirArray);
	sort($dirArray);

	for($index=0; $index < $indexCount; $index++) {

	    if(substr("$dirArray[$index]", 0, 1) == ".") {
			continue;
		}

		// Get file properties
		$name = pathinfo($dirArray[$index], PATHINFO_FILENAME);
		$extension = pathinfo($dirArray[$index], PATHINFO_EXTENSION);
		$href = $dirArray[$index];
		$date = date("d. M. Y H:i", filectime($dirArray[$index]));
		$size = pretty_filesize($dirArray[$index]);
		
		if ( ! in_array($extension, $video_extensions) )
			continue;
		
		
		// Output
		
		echo ("
    	<div class='container'>
			<h2 class='mt-4'>$name</h2>
			<video src='./$href' controls preload='auto' width='100%'></video>
			<strong>$date Uhr</strong> &bullet; $size &bullet; $extension Video
		</div>
		<hr />");
	}
	?>
	</main>
	<footer class="footer">
		<center class="text-muted">Simple Video Listing &bullet; Jonas Höchst &copy; 2018</center>
	</footer>
</body>
</html>
