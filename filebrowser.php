<?php
/*
============
PHP FileList
============

Copyright (c) 2006-2015 Gaijin.at <info@gaijin.at> (http://www.gaijin.at/)

*/

define('FILELIST_INTERN_CALL', '1');

// Include default configuration settings
require_once('filelist/config.php');

// Include Professional features
// require_once('filelist/professional.php');

// #############################################################################

// SETTINGS

// Directory that contains the files and folders
$_gFL['Config.BasePath'] = 'upload/';

// Relative path to image files
$_gFL['Config.ImagePath'] = 'filelist/images/';

// Language
require_once('filelist/language/english.php');

// #############################################################################

require_once('filelist/filelist.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>PHP FileList</title>
<meta http-equiv="content-type" content="text/html; charset=<?php echo FileList_GetLngStr("Charset"); ?>" />
<meta name="author" content="Gaijin.at (http://www.gaijin.at/)" />
<meta name="copyright" content="Gaijin.at (http://www.gaijin.at/)" />
<link rel="stylesheet" type="text/css" href="filelist/filelist.css" />
<link rel="stylesheet" type="text/css" href="filebrowser.css" />
</head>
<body>
<br>



<?php
if (!FileList_Show()) {
	echo '<p class="FileListErrorMessage">' . FileList_GetLngStr('ErrDirAccessFailed') . "</p>\n";
}
?>



</body>
</html>
