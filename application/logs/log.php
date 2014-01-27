<?php
/**
 *	Logfile viewer
 *	log.php
 *	@author	Chris Petermann	chris@pps-ltd.eu
 * @purpose	display the log file of the current day for debugging purpose.
 * @param	boolean	truncate	whether or not to truncate todays file
 *	@param	string	filter	filters file for lines containing <string>
 **/

//	the output array containing lines of output per item
$fileoutput = array();

//	the name of the logfile to be handling
if($_REQUEST['logfile'])	{
//	echo $_REQUEST['logfile'];
	if(!preg_match("/(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})/", $_REQUEST['logfile'], $matches))	{
		unset($_REQUEST['logfile']);
	}else{
		$logfilename = 'log-'.$matches[0].'.php';
	}
}

//	class definitions
$debug	=	"style=\"color: green\"";
$info		=	"style=\"color: gray\"";
$error	=	"style=\"color: red\"";
$lnno		=	"style=\"background-color: lightgray\"";
$hghlght	=	"style=\"background-color:	yellow;font-weight:bold;text-transform: uppercase;\"";

$g_filter 		= trim(urldecode($_GET['filter']));
$g_truncate 	= trim(urldecode($_GET['truncate']));
$g_goto			= trim(urldecode($_GET['goto']));
$g_delete		= trim(urldecode($_GET['delete']));

//	checking for truncate command and if there, truncate file
if($g_truncate=='1') {
	if($fh = fopen($logfilename, 'w+'))	{
		fwrite($fh, "");
		fclose($fh);
	}
	exit("<script>window.location.href = document.referrer</script>");
}

//	checking for truncate command and if there, truncate file
if($g_delete=='1') {
	if(file_exists($logfilename) && is_writable($logfilename))	{
		unlink($logfilename);
	}
	header("Location: ?");
}


//	LITTLE HANDLER TO DO LEFT PADDING FOR THE LINE NUMBER
function	lpad($subject, $char=" ", $maxsize=4)	{
	while(strlen($subject)<$maxsize)
		$subject = $char.$subject;

	return $subject;
}

function	rpad($subject, $char=" ", $maxsize=4)	{
	while(strlen($subject)<$maxsize)
		$subject = $subject.$char;

	return $subject;
}

function formatBytes($bytes, $precision = 2) {
	$units = array('B', 'KB', 'MB', 'GB', 'TB');

	$bytes = max($bytes, 0);
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	$pow = min($pow, count($units) - 1);

	$bytes /= pow(1024, $pow);

	return round($bytes, $precision) . ' ' . $units[$pow];
}

function _parse_file($file)	{
	$filelines = explode("\n", $file);
	$fileoutput = array();
	global	$g_filter, $g_truncate, $g_goto;
	global	$lnno, $hghlght, $error, $info, $debug;
	//var_dump($filelines);

	foreach($filelines as $linenumber=>$line)	{
		if(!empty($g_filter)) {
			if(stripos(" ".$line, urldecode($g_filter))!==false	)	{

				switch(substr($line,0,strpos($line," - "))) {
					case 'DEBUG':
						$fileoutput[] = "<span $lnno>".lpad($linenumber)."</span> <font $debug>".str_ireplace($g_filter, "<span $hghlght>".$g_filter."</span>", $line)."</font>";
					break;
					case 'ERROR':
						$fileoutput[] = "<span $lnno>".lpad($linenumber)."</span> <font $error>".str_ireplace($g_filter, "<span $hghlght>".$g_filter."</span>", $line)."</font>";
					break;
					case 'INFO ':
					default:
						$fileoutput[] = "<span $lnno>".lpad($linenumber)."</span> <font $info>".str_ireplace($g_filter, "<span $hghlght>".$g_filter."</span>", $line)."</font>";
					break;
				}
			}
		}else{
			switch(substr($line,0,strpos($line," - "))) {
				case 'DEBUG':
					$fileoutput[] = "<span $lnno>".lpad($linenumber)."</span> <font $debug>".$line."</font>";
				break;
				case 'ERROR':
					$fileoutput[] = "<span $lnno>".lpad($linenumber)."</span> <font $error>".$line."</font>";
				break;
				case 'INFO ':
				default:
					$fileoutput[] = "<span $lnno>".lpad($linenumber)."</span> <font $info>".$line."</font>";
				break;
			}
		}
	}

	return $fileoutput;
}

function _list_files()	{
	$dir = dirname(__FILE__);

	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while ((($file = readdir($dh)) !== false)) {
				if(	substr($file,0,1) != "." &&
					($file != basename(__FILE__)) &&
					(filetype($file)!='dir')	&&
					($file != 'index.html')		)	{
					$ext = substr($file, strrpos($file,".")+1);
					preg_match("/(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})/", $file, $matches);
					$link = (($matches[0] && filesize($file)>0) ? ("<a href='?logfile=".$matches[0]."'>".$file."</a>") : ($file));
					$fileoutput[] = "<img src='/images/icons/".$ext.".gif' width='20' height='20' >&nbsp;".
						$link . rpad(" "," ", 24-strlen($file))."\t\t ".
						lpad(formatBytes(filesize($file),0)," ", 16)."\t " .
						date('Y-m-d H:i:s', filemtime($file)) ;
				}
			}
			closedir($dh);
		}
	}

	if(count($fileoutput))	{
		$header = "<img src='' width=20 height=20>&nbsp;";
		$header.= rpad("  <b>Filename</b> ", " ", 50);
		$header.= rpad("  <b>Filesize</b> ", " ", 24);
		$header.= " <b>last modified</b>";

		$toprow[] = $header;
	}

	return array_merge($toprow,$fileoutput);
}

if(file_exists($logfilename) && is_readable($logfilename))	{
	$file = file_get_contents($logfilename);
	$fileoutput = _parse_file($file);
}else{
	$fileoutput = _list_files();
}




/*
\t<b>Filter:</b></form></span>
*/

?>
<html><head><TITLE>Log File viewer:</TITLE>
<style>
#filter	{
	border:0px solid darkgray;
	margin: 2px;
	position: fixed;
	width: 98%;
	height: 50px;
	background-color: ghostwhite;
	filter:			alpha(opacity=80);
	-moz-opacity:	0.8;
	-khtml-opacity:	0.8;
	opacity: 0.8;

}
fieldset, input	{
	font-family:	courier,system,terminal;
	font-size:	11px;
	color:	black;
}
fieldset	{
	background-color: white;
/*	filter:			alpha(opacity=70);
	-moz-opacity:	0.7;
	-khtml-opacity:	0.7;
	opacity: 0.7;*/

}
</style>
</head>
<body>
<table id="filter"><form id="formfilter" action="" method="GET">
			<? echo ($_REQUEST['logfile']) ? ("<input type=\"hidden\" name=\"logfile\" value=\"".$_REQUEST['logfile']."\" >") : ('') ?>
	<TR><TD>
			<fieldset><legend><a href="?">File(s)</a></legend>
				<b>File size:</b><?= formatBytes((int)@filesize($logfilename)) ?>	<b>modified:</b
				><input type="button" accesskey="d" type="button" value="<?= date("H:i:s",@filemtime($logfilename)) ?>" onclick="window.location.href=('?filter='+this.value)"
				><input accesskey="t" type="button" name="truncate" value="Truncate" onclick="window.location.href=('?truncate=1&logfile=<?= $logfilename ?>');"
				><input accesskey="e" type="button" name="delete" value="Delete" onclick="window.location.href=('?delete=1&logfile=<?= $logfilename ?>');"
				>
			</fieldset>
		</TD>
		<TD>
			<fieldset><legend>Filter</legend>
			<b>Search:</b
			><input accesskey="f" type="text" name="filter" value="<?= $g_filter ?>"
			><input type="submit" value="Apply"
			><input accesskey="c" type="button" value="Clear" onclick="window.location.href=('?logfile=<?= $_REQUEST['logfile'] ?>');"
			>
			</fieldset>
		</TD>
		<TD>
<!--			<fieldset><legend>Navigation</legend>
			<b>Go to:</b
			><input accesskey="g" type="text" name="goto" value="<?= $g_goto ?>"
			><input type="submit" value="Go"
			>&nbsp;<input type="button" name="gototop" onclick="document.body.scrollTop" value="Top" disabled="true"
			><input type="button" name="gotobottom" onclick="document.body.scrollTop" value="Bottom" disabled=true>
			</fieldset>
//-->
		</TD></form>
	</TR>
</table>

<?
echo "<br><br><br><br><pre>".implode("\n", $fileoutput)."</pre>";
echo "<hr>";
?>
</body>
</html>

