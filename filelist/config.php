<?php
if (!defined('FILELIST_INTERN_CALL')) die ('<p><b>ACCESS DENIED!</b></p>');

/*

=============================
DEFAULT SETTINGS FOR FILELIST
=============================

Do not change anything in this file!

*/

$_gFL = array();

// Standard version
$_gFL['IsProfessional'] = FALSE;

// Directory that contains the files and folders.
$_gFL['Config.BasePath'] = '';

// Relative path to image files.
$_gFL['Config.ImagePath'] = 'images/';

// Show icons for files and folders.
$_gFL['Config.ShowIcons'] = TRUE;

// Show total folder and file count, as well as total file size.
$_gFL['Config.ShowTotals'] = TRUE;

// Show date and time of the last updated file or folder.
$_gFL['Config.ShowTotalTime'] = TRUE;

// Show comment for total row.
$_gFL['Config.ShowTotalComment'] = TRUE;

// Show navigation bar.
$_gFL['Config.ShowNavigationBar'] = FALSE;

// Show square brackets for folders.
$_gFL['Config.ShowFolderBrackets'] = FALSE;

// Filename of the comment definition file.
// The file should be hidden (name starts with a point).
// (If the name is changed, the pattern in $_gFL['Config.ExcludeFiles'] needs to be modified too!)
$_gFL['Config.CommentsFilename'] = '.comments.csv';

// Always add comment definition file located in the base directory.
// (If FALSE, then the file is used only when no definition file exists for the current directory.)
$_gFL['Config.CommentsAddBaseFile'] = TRUE;

// If "$_gFL['Config.CommentsAddBaseFile']" is TRUE, then only global comments
// will be added. Global comments must be marked with a leading exclamation mark ("!").
$_gFL['Config.CommentsAddBaseFile.GlobalsOnly'] = TRUE;

// Can display the file size as Bytes (if "false", the lowest format is KB).
$_gFL['Config.FileSizeShowBytes'] = TRUE;

// Number of digits after the comma.
$_gFL['Config.FileSizeDigitsKB'] = 2;
$_gFL['Config.FileSizeDigitsMB'] = 2;
$_gFL['Config.FileSizeDigitsGB'] = 2;

// Default column for sorting.
// Possible values are:
//   'N' for the filename (ascending)
//   'S' for file size (ascending)
//   'T' for the modification time (descending)
//   'C' for the comment (ascending)
$_gFL['Config.DefaultSort'] = 'T';

// Sort order for the default column.
// Possible values are:
//   'A' for ascending
//   'D' for descending
$_gFL['Config.DefaultOrder'] = 'A';

// Compare files and directories case sensitive (for file sorting, Permissions or file excluding).
$_gFL['Config.CaseSensitiveFileNames'] = TRUE;

// Enable direct file download.
$_gFL['Config.DownloadDirect'] = TRUE;

// Show the file in a new tab (e.g. for plain text files or pictures).
$_gFL['Config.DownloadNewTab'] = TRUE;

// File type information (ext, icon, type).
$_gFL['Config.FileTypeInfo'] = array(
	array('ext' => '7z', 'icon' => 'ico_7z.png', 'type' => 'application/x-7z-compressed'),
	array('ext' => 'avi', 'icon' => 'ico_movie.png', 'type' => 'video/avi'),
	array('ext' => 'flv', 'icon' => 'ico_movie.png', 'type' => 'video/x-flv'),
	array('ext' => '/^(jpg|jpe|jpeg)$/', 'icon' => 'ico_picture.png', 'type' => 'image/jpeg'),
	array('ext' => 'gif', 'icon' => 'ico_picture.png', 'type' => 'image/gif'),
	array('ext' => 'gz', 'icon' => 'ico_compress.png', 'type' => 'application/gzip'),
	array('ext' => '/^(mov|qt)$/', 'icon' => 'ico_movie.png', 'type' => 'video/quicktime'),
	array('ext' => 'mp3', 'icon' => 'ico_audio.png', 'type' => 'audio/mp3'),
	array('ext' => 'mp4', 'icon' => 'ico_movie.png', 'type' => 'video/mp4'),
	array('ext' => '/^(mpg|mpe|mpeg)$/', 'icon' => 'ico_movie.png', 'type' => 'video/mpeg'),
	array('ext' => 'ogg', 'icon' => 'ico_movie.png', 'type' => 'video/ogg'),
	array('ext' => 'pdf', 'icon' => 'ico_doc2.png', 'type' => 'application/pdf'),
	array('ext' => 'png', 'icon' => 'ico_picture.png', 'type' => 'image/png'),
	array('ext' => 'rar', 'icon' => 'ico_rar.png', 'type' => 'application/x-rar-compressed'),
	array('ext' => 'rtf', 'icon' => 'ico_doc1.png', 'type' => 'text/rtf'),
	array('ext' => 'txt', 'icon' => 'ico_txt.png', 'type' => 'text/plain'),
	array('ext' => 'wma', 'icon' => 'ico_audio.png', 'type' => 'audio/x-ms-wma'),
	array('ext' => 'wmv', 'icon' => 'ico_movie.png', 'type' => 'video/x-ms-wmv'),
	array('ext' => 'zip', 'icon' => 'ico_compress.png', 'type' => 'application/zip'),
);

?>