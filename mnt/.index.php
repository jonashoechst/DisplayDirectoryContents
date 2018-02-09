<?php
    $video_extensions = array('m4v', 'mp4', 'webm', 'ogv', 'mpg', 'mpeg', 'mov');

    function pretty_filesize($file) {
    	$size = filesize($file);
    	if      ( $size < 1024 )        { $size = $size." Bytes"; }
    	elseif  ( $size < 1048576 )     { $size = round( $size/1024, 1)      ." KB"; }
    	elseif  ( $size < 1073741824 )  { $size = round( $size/1048576, 1)   ." MB"; }
    	else                            { $size = round( $size/1073741824, 1)." GB"; }
    	return $size;
    }

    $path = urldecode($_SERVER['REQUEST_URI']);
    $global_path = $_SERVER['DOCUMENT_ROOT'].$path;

    $videos = array();
    $dirs = array();

    $directory = opendir($global_path);
    
    while($filename = readdir($directory)) {
        $filepath = $global_path.$filename;

        // ignore hidden files
        if ( substr("$filename", 0, 1) == "." )
    		continue;

    	// Get file properties
        $file["filename"] = $filename;
    	$file["name"] = pathinfo($filepath, PATHINFO_FILENAME);
    	$file["extension"] = pathinfo($filename, PATHINFO_EXTENSION);
    	$file["date"] = date("d. M. Y H:i", filectime($filepath));
    	$file["size"] = pretty_filesize($filepath);
    
    	if ( in_array($file["extension"], $video_extensions) )
    		$videos[] = $file;
    
        if ( is_dir($filepath) )
            $dirs[] = $file;
    
    }

    closedir($directory);
?>

<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="/.bootstrap.min.css">
	<link rel="stylesheet" href="/.sticky-footer.css">

	<title>VideoBox</title>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="/">VideoBox</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav">
<?php
	echo ("         <a class='nav-item nav-link active' href='{$path}'>{$path}</a>");

    foreach ($dirs as $dir) {
    	echo ("     <a class='nav-item nav-link' href='./{$dir["filename"]}''>{$dir["filename"]}</a>");
    }            
?>
                </div>
            </div>
		</nav>
	</header>

	<main role="main" class="container">

    
<?php 
    foreach ($videos as $video) {
    	echo ("
       	<div class='container'>
    		<h2 class='mt-4'>{$video["name"]}</h2>
    		<video src='./{$video["filename"]}' controls preload='auto' width='100%'></video>
    		<strong>{$video["date"]} Uhr</strong> &bullet; {$video["size"]} &bullet; {$video["extension"]} Video
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
