<?php
/*
================
PHP FileList 2.0
================

Copyright (c) 2006-2015 Gaijin.at <info@gaijin.at> (http://www.gaijin.at/)

*/

// #############################################################################

if (!defined('FILELIST_INTERN_CALL')) die ('<p><b>ACCESS DENIED!</b></p>');

// Zugriffsrechte parsen
if ($_gFL['IsProfessional']) {
	$_gFL['Intern.Permissions'] = FileList_ParsePermissions($_gFL['Config.Permissions']);
}

$_gFL['Param.Dir'] = FileList_GetSaveDirectory(FileList_GetParam('dir', 'G'));
$_gFL['Param.Sort'] = strtoupper(substr(trim(FileList_GetParam('sort', 'G', $_gFL['Config.DefaultSort'])), 0, 1));
$_gFL['Param.Order'] = strtoupper(substr(trim(FileList_GetParam('order', 'G', $_gFL['Config.DefaultOrder'])), 0, 1));

if ($_gFL['IsProfessional']) {
	$_gFL['Param.File'] = substr(trim(FileList_GetParam('file', 'G', '')), 0, 255);
	
	// Datei herunterladen
	if (($_gFL['Param.File'] != '') && ($_gFL['Param.Dir'] !== FALSE)) {
		if (!FileList_DownloadFile()) $ErrorMessage = FileList_GetLngStr('ErrFileDownloadFailed');
	}
}

// Gesamtwerte
$_gFL['Intern.TotalFolders'] = 0;
$_gFL['Intern.TotalFiles'] = 0;
$_gFL['Intern.TotalSize'] = 0;
$_gFL['Intern.TotalTime'] = 0;

// Kommentare
$_gFL['Intern.Comments'] = array();

// #############################################################################

function FileList_Show()
{
	global $_gFL, $ErrorMessage;

	if ($_gFL['Param.Dir'] === FALSE) {
		if (strlen($ErrorMessage > 0)) $ErrorMessage .= '<br />';
		$ErrorMessage .= FileList_GetLngStr('ErrWrongDirName') . "\n";
		$_gFL['Param.Dir'] = '';
	}
	
	$sLocalDir = $_gFL['Config.BasePath'] . $_gFL['Param.Dir'];
	$sParentDir = FileList_GetParentDir($_gFL['Param.Dir']);
	
	// Kommentare einlesen
	$_gFL['Intern.Comments'] = FileList_GetComments($sLocalDir);
	
	// Fehlermeldungen anzeigen
	if (strlen($ErrorMessage) > 0) {
		echo '<p class="FileListErrorMessage">' . $ErrorMessage . "</p>\n";
	}

	// Dateiliste erstellen
	$aFiles = FileList_ReadDirectory($sLocalDir);
	if (!is_array($aFiles)) return FALSE;

	// Navigationsleiste anzeigen
	if ($_gFL['Config.ShowNavigationBar']) {
		FileList_Show_NavigationBar($_gFL['Param.Dir']);
  }

	echo '<table class="FileListTable">'."\n";
	
	// Header mit Links für Sortierung
	$sLinkUrlDir = htmlspecialchars(FileList_GetParam('PHP_SELF', 'S')) . '?dir=' . htmlspecialchars(urlencode($_gFL['Param.Dir']));
	
	echo '<tr>';

	echo '<td class="FileListCell FileListCellTitle">';
	if ($_gFL['Param.Sort'] == 'N') {
		echo '<a href="' . $sLinkUrlDir;
		echo '&amp;sort=N&amp;order=' . ($_gFL['Param.Order'] == 'A' ? 'D' : 'A') . '">'.FileList_GetLngStr('FileName').'</a> ';
		echo '<span class="FileListSortChar">' . ($_gFL['Param.Order'] == 'A' ? FileList_GetLngStr('SortCharA') : FileList_GetLngStr('SortCharD')) . '</span>';
	} else {
		echo '<a href="' . $sLinkUrlDir . '&amp;sort=N&amp;order=A">' . FileList_GetLngStr('FileName') . '</a>';
	}
	echo '</td>';

	echo '<td class="FileListCell FileListCellTitle">';
	if ($_gFL['Param.Sort'] == 'S') {
		echo '<a href="' . $sLinkUrlDir;
		echo '&amp;sort=S&amp;order=' . ($_gFL['Param.Order'] == 'A' ? 'D' : 'A') . '">'.FileList_GetLngStr('FileSize').'</a> ';
		echo '<span class="FileListSortChar">' . ($_gFL['Param.Order'] == 'A' ? FileList_GetLngStr('SortCharA') : FileList_GetLngStr('SortCharD')) . '</span>';
	} else {
		echo '<a href="' . $sLinkUrlDir . '&amp;sort=S&amp;order=A">' . FileList_GetLngStr('FileSize') . '</a>';
	}
	echo '</td>';

	echo '<td class="FileListCell FileListCellTitle">';
	if ($_gFL['Param.Sort'] == 'T') {
		echo '<a href="' . $sLinkUrlDir;
		echo '&amp;sort=T&amp;order=' . ($_gFL['Param.Order'] == 'A' ? 'D' : 'A') . '">'.FileList_GetLngStr('FileModTime').'</a> ';
		echo '<span class="FileListSortChar">' . ($_gFL['Param.Order'] == 'A' ? FileList_GetLngStr('SortCharA') : FileList_GetLngStr('SortCharD')) . '</span>';
	} else {
		echo '<a href="' . $sLinkUrlDir . '&amp;sort=T&amp;order=D">' . FileList_GetLngStr('FileModTime') . '</a>';
	}
	echo '</td>';

	echo '<td class="FileListCell FileListCellTitle">';
	if ($_gFL['Param.Sort'] == 'C') {
		echo '<a href="' . $sLinkUrlDir;
		echo '&amp;sort=C&amp;order=' . ($_gFL['Param.Order'] == 'A' ? 'D' : 'A') . '">'.FileList_GetLngStr('FileComment').'</a> ';
		echo '<span class="FileListSortChar">' . ($_gFL['Param.Order'] == 'A' ? FileList_GetLngStr('SortCharA') : FileList_GetLngStr('SortCharD')) . '</span>';
	} else {
		echo '<a href="' . $sLinkUrlDir . '&amp;sort=C&amp;order=A">' . FileList_GetLngStr('FileComment') . '</a>';
	}
	echo '</td>';

	echo "</tr>\n";

	// Link zu Elternverzeichnis
	if ($_gFL['Param.Dir'] != '') {
		echo '<tr>';
		echo '<td class="FileListCell">';
		echo '<a href="' . htmlspecialchars(FileList_GetParam('PHP_SELF', 'S')) . '?dir=' . htmlspecialchars(urlencode($sParentDir)) . '&amp;sort=' . $_gFL['Param.Sort'] . '&amp;order=' . $_gFL['Param.Order'] . '"><div>';
		if ($_gFL['Config.ShowIcons'])	echo '<img src="' . $_gFL['Config.ImagePath'] . 'ico_parent.png" alt="-" class="FileListIcon" />';
		echo FileList_GetLngStr('BackToParentDir');
		echo '</div></a>';
		echo '</td>';
		echo '<td class="FileListCell FileListCellSizeDir"></td>';
		echo '<td class="FileListCell FileListCellTime"></td>';
		echo '<td class="FileListCell FileListCellComment"></td>';
		echo "</tr>\n";
	}

	// Dateiliste ausgeben
	foreach($aFiles as $aFile) {
		
		echo '<tr>';
		echo '<td class="FileListCell FileListCellName">';
		
		if ($aFile['IsDir']) {
			
			$sFN = $aFile['Name'];
			if ($_gFL['Config.ShowFolderBrackets']) $sFN = '[ ' . $sFN . ' ]';
			echo '<a href="' . $sLinkUrlDir . htmlspecialchars($aFile['Name']) . '&amp;sort=' . $_gFL['Param.Sort'] . '&amp;order=' . $_gFL['Param.Order'] . '"><div>';
			if ($_gFL['Config.ShowIcons'])	echo '<img src="' . $_gFL['Config.ImagePath'] . 'ico_folder.png" alt="-" class="FileListIcon" />';
			echo htmlspecialchars($sFN);
			echo '</div></a>';
			echo '</td>';
			echo '<td class="FileListCell FileListCellSizeDir">' . FileList_GetLngStr('Folder') . '</td>';
			
		} else {
			
			$sTarget = ($_gFL['Config.DownloadNewTab'] ? ' target="_blank"' : '');
			
			if ($_gFL['IsProfessional'] && !$_gFL['Config.DownloadDirect']) {
				echo '<a href="' . $sLinkUrlDir . '&amp;file=' . urlencode($aFile['Name']) . '"' . $sTarget . '><div>';
			} else {
				echo '<a href="' . htmlspecialchars($sLocalDir . $aFile['Name']) . '"' . $sTarget . '><div>';
			}
			
			if ($_gFL['Config.ShowIcons'])	echo '<img src="' . $_gFL['Config.ImagePath'] . FileList_GetFileIcon($aFile['Name']) . '" alt="-" class="FileListIcon" />';
			echo htmlspecialchars($aFile['Name']);
			echo '</div></a>';
			echo '</td>';
			echo '<td class="FileListCell FileListCellSize">' . FileList_FormatFileSize($aFile['Size']) . '</td>';
			
		}
		
		echo '<td class="FileListCell FileListCellTime">' . date('d.m.Y H:i:s', $aFile['Time']) . '</td>';
		echo '<td class="FileListCell FileListCellComment">' . $aFile['Comment'] . '</td>';
		echo "</tr>\n";
		
	}
	
	// Keine Ordner oder Dateien gefunden
	if (count($aFiles) == 0) {
		echo '<td class="FileListCell FileListCellInfo FileListCellInfoCenter" colspan="4">' . FileList_GetLngStr('TextNoFiles') . "</td>\n";
	}
	
	// Gesamtwerte
  if ($_gFL['Config.ShowTotals'] && (count($aFiles) > 0)) {
		echo '<tr>';
		
		$sTotalFoldersString = ($_gFL['Intern.TotalFolders'] == 1 ? FileList_GetLngStr('TotalFoldersString1', $_gFL['Intern.TotalFolders']) : FileList_GetLngStr('TotalFoldersString', $_gFL['Intern.TotalFolders']));
		$sTotalFilesString = ($_gFL['Intern.TotalFiles'] == 1 ? FileList_GetLngStr('TotalFilesString1', $_gFL['Intern.TotalFiles']) : FileList_GetLngStr('TotalFilesString', $_gFL['Intern.TotalFiles']));
		echo '<td class="FileListCell FileListCellInfo">' . FileList_GetLngStr('TotalFolderFileString', $sTotalFoldersString . "\t" . $sTotalFilesString) . '</td>';
		
		$sTotalSizeString = FileList_GetLngStr('TotalSizeString', FileList_FormatFileSize($_gFL['Intern.TotalSize']));
		echo '<td class="FileListCell FileListCellInfo FileListCellSize" title="' . FileList_GetLngStr('TotalSizeToolTip') . '">' . $sTotalSizeString . '</td>';
		
		if ($_gFL['Config.ShowTotalTime'] && ($_gFL['Intern.TotalTime'] > 0)) {
      $sLastUpdateTime = FileList_GetLngStr('TotalLastUpdateTimeString', date('d.m.Y H:i:s', $_gFL['Intern.TotalTime']));
			echo '<td class="FileListCell FileListCellInfo" title="' . FileList_GetLngStr('TotalLastUpdateTimeToolTip'). '">' . $sLastUpdateTime . '</td>';
		} else {
			echo '<td class="FileListCell FileListCellInfo"></td>';
		}
		
		echo '<td class="FileListCell FileListCellInfo">' . ($_gFL['Config.ShowTotalComment'] ? FileList_GetLngStr('TotalComment') : '') . '</td>';
		echo "</tr>\n";
	}
	
	/*
  Das Entfernen oder Unkenntlichmachen des Links zu www.gaijin.at ist ein
  Verstoß gegen das Urheberrecht und die Lizenzbestimmungen.
  
  Für eine Genehmigung zum Entfernen des Links zu www.gaijin.at wenden Sie sich
  bitte an <info@gaijin.at>
	
	Removing or defacing of the link to www.gaijin.at is a violation of the
	copyright and the license terms.
	
	If you want to remove the link to	www.gaijin.at please contact <info@gaijin.at>
	*/
	if (!FileList_GetArrayValue($_gFL, 'Intern.HidePoweredByLink', FALSE)) {
		echo '<tr><td class="FileListCell" colspan="4" style="text-align:center; font-weight:bold; color:#fff ;background-color:#135194"> FILES/TÀI LIỆU BAN HÀNH </td></tr>'."\n";
	}
	
	echo "</table>\n";
	
	return TRUE;
}

// ############################################################################

function FileList_GetFileIcon($sFileName)
{
	global $_gFL;
	
  $sExt = strtolower(FileList_GetFileExtension($sFileName));
	
	foreach ($_gFL['Config.FileTypeInfo'] as $aItem) {
		if (strlen($aItem['ext']) < 1) continue;
		
		if ($aItem['ext'] == $sExt) return $aItem['icon'];
		
		if (substr($aItem['ext'], 0, 1) == '/') {
			if (preg_match($aItem['ext'], $sExt) == 1) {
				return $aItem['icon'];
			}
		}
	}
	
	return 'ico_file.png';
}

// #############################################################################

function FileList_ReadDirectory($sDirectory)
{
	global $_gFL;

	if (!is_dir($sDirectory)) return FALSE;
	
	$hDir = @opendir($sDirectory);
	if (!$hDir) return FALSE;
	
	$aFiles = array();
	
	$_gFL['Intern.TotalFolders'] = 0;
	$_gFL['Intern.TotalFiles'] = 0;
	$_gFL['Intern.TotalSize'] = 0;
  $_gFL['Intern.TotalTime'] = 0;

	while (FALSE !== ($sFile = readdir($hDir))) {
		if (empty($sFile)) continue;
		if (($sFile == '.') || ($sFile == '..')) continue;
		
		$bIsDir = is_dir($sDirectory . $sFile);
		
		if ($_gFL['IsProfessional']) {
			// Prüfen, ob die Datei oder das Verzeichnis ausgenommen sind.
			if (FileList_IsFileExcluded($sDirectory . $sFile . ($bIsDir ? '/' : ''))) continue;
			// Berechtigungen für die Datei oder das Verzeichnis prüfen.
			if (!FileList_IsFileAllowed($sDirectory , $sFile . ($bIsDir ? '/' : ''))) continue;
		} else {
			// In der Standard-Version alle versteckten Dateien und Ordner ausblenden
			if (substr($sFile, 0, 1) == '.') continue;
		}
		
		if ($bIsDir) {
			$iSize = 0;
			$_gFL['Intern.TotalFolders']++;
		} else {
			$iSize = filesize($sDirectory . $sFile);
			$_gFL['Intern.TotalFiles']++;
			$_gFL['Intern.TotalSize'] += $iSize;
		}
		
		$dtModTime = @filemtime($sDirectory . $sFile);
		if ($dtModTime > $_gFL['Intern.TotalTime']) $_gFL['Intern.TotalTime'] = $dtModTime;
		
		if ($bIsDir) {
			$sComment = FileList_GetComment('' . $sFile . '/');
		} else {
			$sComment = FileList_GetComment($sFile);
		}
		
		array_push($aFiles, array(
			'Name' => $sFile,
			'IsDir' => $bIsDir,
			'Size' => $iSize,
			'Time' => $dtModTime,
			'Comment' => $sComment
		));
	}
	
	closedir($hDir);

  // Dateiliste sortieren
  if ($_gFL['Param.Order'] == 'D') {
    if ($_gFL['Param.Sort'] == 'N') usort($aFiles, 'FileList_CompareDesc_FileName');
    if ($_gFL['Param.Sort'] == 'S') usort($aFiles, 'FileList_CompareDesc_FileSize');
    if ($_gFL['Param.Sort'] == 'T') usort($aFiles, 'FileList_CompareDesc_FileTime');
    if ($_gFL['Param.Sort'] == 'C') usort($aFiles, 'FileList_CompareDesc_FileComment');
  } else {
    if ($_gFL['Param.Sort'] == 'N') usort($aFiles, 'FileList_CompareAsc_FileName');
    if ($_gFL['Param.Sort'] == 'S') usort($aFiles, 'FileList_CompareAsc_FileSize');
    if ($_gFL['Param.Sort'] == 'T') usort($aFiles, 'FileList_CompareAsc_FileTime');
    if ($_gFL['Param.Sort'] == 'C') usort($aFiles, 'FileList_CompareAsc_FileComment');
  }

	return $aFiles;
}

// #############################################################################

function FileList_Compare($a, $b, $sField, $bDesc)
{
	global $_gFL;
	
	if (($a['IsDir']) && (!$b['IsDir'])) {
		return -1;
	} else if ((!$a['IsDir']) && ($b['IsDir'])) {
		return 1;
	} else {
		
		if ($_gFL['Config.CaseSensitiveFileNames']) {
			$sA = $a[$sField];
			$sB = $b[$sField];
		} else {
			$sA = strtolower($a[$sField]);
			$sB = strtolower($b[$sField]);
		}
		
		if ($sA == $sB) return 0;
		
		if ($bDesc) {
			return ($sA > $sB) ? -1 : 1;
		} else {
			return ($sA < $sB) ? -1 : 1;
		}
		
	}
}

function FileList_CompareDesc_FileName($a, $b) {
	return FileList_Compare($a, $b, 'Name', TRUE);
}

function FileList_CompareAsc_FileName($a, $b) {
	return FileList_Compare($a, $b, 'Name', FALSE);
}

function FileList_CompareDesc_FileSize($a, $b) {
	return FileList_Compare($a, $b, 'Size', TRUE);
}

function FileList_CompareAsc_FileSize($a, $b) {
	return FileList_Compare($a, $b, 'Size', FALSE);
}

function FileList_CompareDesc_FileTime($a, $b) {
	return FileList_Compare($a, $b, 'Time', TRUE);
}

function FileList_CompareAsc_FileTime($a, $b) {
	return FileList_Compare($a, $b, 'Time', FALSE);
}

function FileList_CompareDesc_FileComment($a, $b) {
	return FileList_Compare($a, $b, 'Comment', TRUE);
}

function FileList_CompareAsc_FileComment($a, $b) {
	return FileList_Compare($a, $b, 'Comment', FALSE);
}

// #############################################################################

function FileList_GetSaveDirectory($sDirectory)
{
	global $_gFL;

	// Parameter holen
	$sDir = trim(substr($sDirectory, 0, 255));
	

	// Pfad aufteilen
	$aParts = explode('/', $sDir);

	$sCurrentDir = '';
	
	// Einzelne Verzeichnisse prüfen und Pfad wieder zusammensetzen
	foreach ($aParts as $sPart) {
		$sFmtPart = trim($sPart);
		
		// Leere Verzeichnisnamen überspringen (z.B. "dir1//dir2/")
		if ($sFmtPart == '') continue;
		
		// Aktuelles Verzeichnis ignorieren
		if ($sFmtPart == '.') continue;
		
		// Relatives Elternverzeichnis nicht zulassen
		if ($sFmtPart == '..') {
			$sCurrentDir = '';
			break;
		}
		
		$sCurrentDir .= $sPart . '/';
	}
	
	// Lokales Verzeichnis muss existieren
	$sLocalDir = $_gFL['Config.BasePath'] . $sCurrentDir;
	if (!is_dir($sLocalDir)) return FALSE;
	
	// Berechtigungen für das Verzeichnis prüfen
	if ( ($_gFL['IsProfessional']) && ($sCurrentDir != '') ) {
		$aParts = pathinfo($sCurrentDir);
		$sDirName = FileList_GetArrayValue($aParts, 'dirname') . '/';
		if ($sDirName == './') $sDirName = '';
		$sBaseName = FileList_GetArrayValue($aParts, 'basename') . '/';
		if (!FileList_IsFileAllowed($sDirName, $sBaseName)) return FALSE;
	}
	
	return $sCurrentDir;
}

// ############################################################################

function FileList_GetComment($sFileName)
{
	global $_gFL;
	
	foreach ($_gFL['Intern.Comments'] as $aCommentItem) {
		if (preg_match($aCommentItem[0], $sFileName) == 1) return $aCommentItem[1];
	}
	
	return '';
}

// ############################################################################

function FileList_GetComments($sDirectory)
{
	global $_gFL;
	
	$bAddBaseDirCommentFile = $_gFL['Config.CommentsAddBaseFile'];
	$aComments = array();
	
	if (!FileList_ReadCommentFile($aComments, $sDirectory . $_gFL['Config.CommentsFilename'], FALSE)) $bAddBaseDirCommentFile = TRUE;

	if ($sDirectory == $_gFL['Config.BasePath']) $bAddBaseDirCommentFile = FALSE;
	
	if ($bAddBaseDirCommentFile) FileList_ReadCommentFile($aComments, $_gFL['Config.BasePath'] . $_gFL['Config.CommentsFilename'], TRUE);
  
  return $aComments;
}

// ############################################################################

function FileList_ReadCommentFile(&$aComments, $sFileName, $bAddGlobalsOnly = FALSE)
{
	global $_gFL;
	
	if (!file_exists($sFileName)) return FALSE;
	
	$hFile = @fopen($sFileName, 'r');
  if (!$hFile) return FALSE;
  
  // Einstellung für globale Kommentare nur bei Datei im BasePath beachten
  if ($bAddGlobalsOnly) {
		$bAddGlobalsOnly = $_gFL['Config.CommentsAddBaseFile.GlobalsOnly'];
  }
  
  while (($aLine = fgetcsv($hFile, 10240, ';')) !== FALSE) {
		if (count($aLine) < 2) continue;
		
		// Globale Kommentare verarbeiten
		if (strlen($aLine[0]) < 1) continue;
		if (substr($aLine[0], 0, 1) == '!') {
			$aLine[0] = substr($aLine[0], 1);
		} else {
			// Überspringen, wenn es kein globaler Kommentar ist
			if ($bAddGlobalsOnly) continue;
		}
		
		if ($_gFL['Config.CaseSensitiveFileNames']) {
			array_push($aComments, array('/' . $aLine[0] . '/', $aLine[1]));
		} else {
			array_push($aComments, array('/' . $aLine[0] . '/i', $aLine[1]));
		}
  }
  
  fclose($hFile);
  
  return TRUE;
}

// ############################################################################

function FileList_GetLngStr($sId, $sParams = '') {
	global $Lang;
    
	if (isset($Lang[$sId])) {
		$sResult = $Lang[$sId];
	} else {
		$sResult = '{Missing string "' . $sId . '"}';
	}
	
  $aParams = explode("\t", $sParams);
  for ($i = 0; $i < count($aParams); $i++) {
    $sResult = str_replace('%s' . ($i + 1) . '%', $aParams[$i], $sResult);
  }
  
  return $sResult; 
}

// #############################################################################

function FileList_GetParam($ParamName, $Method = 'P', $DefaultValue = '') {
  if ($Method == 'P') {
    if (isset($_POST[$ParamName])) return $_POST[$ParamName]; else return $DefaultValue;
  } else if ($Method == 'G') {
    if (isset($_GET[$ParamName])) return $_GET[$ParamName]; else return $DefaultValue;
  } else if ($Method == 'S') {
    if (isset($_SERVER[$ParamName])) return $_SERVER[$ParamName]; else return $DefaultValue;
  }
}

// #############################################################################

function FileList_GetArrayValue($aArray, $sKeyName, $sDefaultValue = '')
{
	if (isset($aArray[$sKeyName])) {
		return $aArray[$sKeyName];
	} else {
		return $sDefaultValue;
	}	
}

// ############################################################################

function FileList_AddPathSlash($sPath, $bForEmptyPathToo = FALSE)
{
	if (strlen($sPath) == 0) return ($bForEmptyPathToo ? '/' : '');
	if (substr($sPath, -1, 1) != '/') $sPath .= '/';
	return $sPath;
}

// ############################################################################

function FileList_GetParentDir($sPath)
{
	$aParts = pathinfo($sPath);
	$sParentDir = FileList_GetArrayValue($aParts, 'dirname');
	if ($sParentDir == '.') $sParentDir = '';
	return $sParentDir;
}

// ############################################################################

function FileList_FormatFileSize($iSize) {
	global $_gFL;
	
	if ($iSize > (1024 * 1024 * 1024)) {
		return number_format($iSize / 1024 / 1024 / 1024, $_gFL['Config.FileSizeDigitsGB'], ',', '.').' GB';
	} else if ($iSize > (1024 * 1024)) {
		return number_format($iSize / 1024 / 1024, $_gFL['Config.FileSizeDigitsMB'], ',', '.').' MB';
	} else if (($iSize > 1024) || (!$_gFL['Config.FileSizeShowBytes'])) {
		return number_format($iSize / 1024, $_gFL['Config.FileSizeDigitsKB'], ',', '.').' KB';
	} else {
		return number_format($iSize, 0, ',', '.').' B';
	}
}

// ############################################################################

function FileList_GetFileExtension($sFileName)
{
	$sExt = '';
	
	$aParts = pathinfo(trim($sFileName));
	if (is_array($aParts)) {
		$sExt = strtolower(FileList_GetArrayValue($aParts, 'extension'));
	}
	
	return $sExt;
}

// ############################################################################

?>
