<?php
function template(){
?>
<head><style type="text/css">
TD {
FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: Verdana
}
A:link        {text-decoration: none; color: #2E26CD;}
A:visited     {text-decoration: none; color: #2E26CD;}
A:hover       {text-decoration: none; color: #990000; font-style: normal; background-color: transparent; text-decoration: underline position: relative; top: 1.5px; left: 1.5px;}
</style>
</head>
<?php
}
extract($HTTP_GET_VARS);
extract($HTTP_POST_VARS);
$password = "benidegistir";  // L�tfen giri� �ifrenizi de�i�tirin
//Egenet Bilisim Php Haz�r Site.
?>
<?php
$action=$HTTP_GET_VARS['action'];
if ($action == "" ){
?><center><table align=middle><td align=left width=20%>
<tr><td height="27" colspan="2"><FONT SIZE="4" COLOR="#000000">Egenet Bilisim - Php Haz�r Site ::</FONT></td><tr><td>�ifrenizi giriniz (Ge�ici �ifre: benidegistir)</td></tr><tr><form method=post action="?action=login"><td>�ifre:</td><td><input type=password name=pass>&nbsp;<input type=submit value=Giri�></td></tr></form></table></center>
<?php
}
if ($action=="download"){
$n=base64_decode($m);	
if ($n==$password){
$filedata = stat("$dir/$p");
$filesize = $filedata[7];
//$ft = getfiletype("$filename");
//header("Content-Type: $ft[1]");
header("Content-Length: $filesize");
header("Content-Disposition: attachment; filename=$p");
readfile("$dir/$p");
exit;
}else{
	echo "Please Login";
}}
if ($action=="login"){
if ($pass==$password){
$l=base64_encode($pass);
header("Location:?action=templates&m=$l");
}else{
echo "<FONT SIZE=2 COLOR=red>hatal� �ifre</FONT>";
}
}
$max="9999999";	//Maksimum dosya boyutu - bytes
if ($action=="view"){
$n=base64_decode($m);	
if ($n==$password){
template();
echo"<center><FONT SIZE=2 face=arial>G�steriliyor $p</FONT><table width=94% border=1 bordercolor=#AFC6DB cellspacing=0><tr><td>";
$po=show_source("$dir/$p");
echo "</td></tr></table><table><form method=post action=\"?action=templates&dir=$dir\"><tr><td align=middle><input type=hidden name=m value=$m><input type=submit value=Back></form></td></tr></table></center>";
}else{echo "Please Login";}
}
if ($action=="see"){
$n=base64_decode($m);	
if ($n==$password){
template();
$image_info = getimagesize("$dir/$p");
$image_stat = stat("$dir/$p");
echo"<center><FONT SIZE=2 face=arial>G�steriliyor $p</FONT><table width=$image_info[0] height=$image_info[1] border=1 bordercolor=#AFC6DB cellspacing=0 valign=middle bgcolor=#fffff><tr><td align=middle valign=middle>";
$po="<img src='$dir/$p'>";
echo "$po</td></tr></table><table width=80% align=middle><td align=middle>$image_info[3]</td></tr></table><table><form method=post action=\"?action=templates&dir=$dir\"><tr><td align=middle><input type=hidden name=m value=$m><input type=submit value=Back></form></td></tr></table></center>";
}else{echo "Please Login";}}
if ($action=="changeattrib") {
$n=base64_decode($m);	
if ($n==$password){
template();
echo"<form method=post action=?action=permission><FONT SIZE=2 COLOR=#00000> $te Chmod Ayar�n� De�i�tir</FONT><BR><input type=hidden name=u value='$te'><input type=hidden name=m value='$m'><input type=hidden name=path value='$dir'><input type=radio name=no value=555>Chmod 555<BR><input type=radio name=no value=666>Chmod 666<BR><input type=radio name=no value=777>Chmod 777<BR><input type=submit vlaue=Change></form>";
}else{echo "Please Login";}
}
if ($action=="permission") {
$n=base64_decode($m);
if ($n==$password){
template();
$v=chmod("$path/$te",$no);
echo "$te Chmod ayar� de�i�tirildi$v<BR><A HREF=?action=templates&m=$m&dir=$path>Back</A>";
}else{echo "Please Login";}
}
if ($action=="tempedit") {
$n=base64_decode($m);	
if ($n==$password){
template();
$te=$HTTP_GET_VARS['te'];
$dir=$HTTP_GET_VARS['dir'];
$filename = "$dir/$te"; 
$fd = fopen ($filename, "r"); 
$stuff = fread ($fd, filesize ($filename)); 
fclose ($fd);
?>
<td height="399" bgcolor="" width="81%" valign="top">
<center>
<form method="post" action="?action=temp2&dir=<?php echo $dir ?>&te=<?php echo $te ?>">
<table width="100%" border="1" bgcolor="D6D5D4" bordercolor="#778899" cellpadding="0" cellspacing="0">
<tr> 
<td><font size="1">Dosya Edit�r� <?php echo "<b>$dir/$te</b>"; ?></font></td>
</tr>
<tr> 
<td width="86%" align=middle> 
<textarea name="cont" cols="80" rows="25"><?php echo $stuff ?></textarea>
</td>
</tr>
<tr> 
<td width="86%" align=middle><input type=hidden name=m value=<?php echo $m;?>>&nbsp; 
<input type="submit" name="Submit" value="��lemi Sonland�r">&nbsp;<input type="button" name="Cancel" value="Vazge�" onclick="javascript: history.back(1)">
</td>
</tr>
<tr> 
</tr>
</table></center>
</form>
<?php
}else{
echo "Please Login";
}}
if ($action=="temp2") {
$n=base64_decode($m);	
if ($n==$password){
template();
$cont=stripslashes($cont);
$fil = "$dir/$te"; 
$fp = fopen($fil, "w");
fputs($fp, $cont);
fclose($fp);
?>
<td height="399" bgcolor="<?php echo $color1 ?>" width="81%" valign="top"> 
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr> 
<td align=middle><font size="2">Dosya Kay�t edildi<BR><?php echo "<a href='?action=templates&dir=$dir&m=$m'>Geri D�n</a>"; ?></font></td>
</tr>
</table>
<?php
}else {echo"Please Login";}}

if ($action=="templates") {
$n=base64_decode($m);
if($n==$password){ 
	template();
?>
<td height="399" bgcolor="<?php echo $color1 ?>" width="81%" valign="top"> 
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr> 
<td><font size="1">Dosyalar:</font>
</td>
</tr>
<tr valign="top"> 
</td>
</tr>
<tr> 
<td width="86%">
<?php
if ($dir==""){
$dir=".";
}
if ($do=="delete") {
$fd = unlink("$dir/$te"); 
echo "<center>Dosya ba�ar�yla silindi.<BR>";
}
if($do=="doupload") {
$picture = "fileupload"."_name";
$file1 = $$picture;
$file2 = "fileupload";
$file3 = $$file2;
if($file3 != "none"){
$filesizebtyes = filesize($file3);
if(file_exists("$file3")&& $filesizebtyes <= "$max") {
copy ($file3, "$dir/$file1");
echo "File $file1 dosyas� y�klendi.<BR>";
} elseif($filesizebtyes <= "$max") {
copy ($file3, "$dir/$file1");
echo "File $file1 has been uploaded<BR>";
}else{
echo "Filesize is greater than $max bytes.";
}
}
}
echo"<table align=center BORDER=\"1\" CELLSPACING=\"1\" CELLPADDING=\"0\" align=middle bordercolor=#AFC6DB><td><form  ENCTYPE=multipart/form-data method=post action=?action=templates&do=doupload&m=$m>Dosya Y�kle: <input type=file name=fileupload><input type=hidden name=dir value=$dir><input type=hidden name=m value=$m><input type=submit value=Upload> </td></table></form>";
echo "<center><TABLE WIDTH=\"85%\" BORDER=\"1\" CELLSPACING=\"1\" CELLPADDING=\"0\" align=middle bordercolor=#AFC6DB><TR><td></td><TD COLSPAN=\"2\" BGCOLOR=\"#ffffff\" width=55%><FONT COLOR=\"#000000\" SIZE=\"-1\" FACE=\"Verdana\">Dosya Ad�</td><td width=5% align=center>De�i�tir</td><td width=10% align=middle>Dosya Boyutu</td><td width=10% align=middle>Yazma �zni</td><td width=10% align=middle>Dosyay� �ndir</td><td align=middle>Delete</td></FONT></TR>";

$handle = @opendir($dir); 
while (false !== ($file = readdir($handle))) {
	$attrib=fileperms("$dir/$file");
	$filesize=filesize("$dir/$file");
	$file_size_now = round($filesize / 1024 * 100) / 100 . "Kb";
	$n= explode(".",$file);
	if ($n[1] == ""){
	$img="img/dir.gif";
	}elseif($n[1]=="php"){
	$img="img/php.jpg";
	}elseif($n[1]=="zip"){
	$img="img/zip.gif";
	}elseif($n[1]=="gif"){
	$img="img/gif.gif";
	}elseif($n[1]=="html"){
	$img="img/html.gif";
	}elseif($n[1]=="ini"){
	$img="img/ini.gif";
	}elseif($n[1]=="jpg"){
	$img="img/jpg.gif";
	}elseif($n[1]=="txt"){
	$img="img/txt.gif";
	}elseif($n[1]=="exe"){
	$img="img/exe.gif";
	}else{
	$img="img/no.gif";
	}
	if ($n[1] == ""){
	$link="?action=templates&m=$m&dir=$dir/$file";
	$link1="-";
	}elseif ($n[1] == "gif"){
	$link="?action=see&m=$m&p=$file&dir=$dir";
	$link1="-";
	}
	elseif ($n[1] == "jpg"){
	$link="?action=see&m=$m&p=$file&dir=$dir";
	$link1="-";
	}
	elseif ($n[1] == "zip"){
	$link="?action=download&m=$m&p=$file&dir=$dir";
	$link1="-";
	}
	elseif ($n[1] == "exe"){
	$link="?action=download&m=$m&p=$file&dir=$dir";
	$link1="-";
	}
	else{
	$link="?action=view&p=$file&dir=$dir&m=$m";
	$link1="<a href='?action=tempedit&m=$m&te=$file&dir=$dir'>D�zenle</a>";
	}
	if($dir!="."){
	$uplink="<tr><td></td><td align=middle><a href='?action=templates&m=$m'><img src=img/up.gif border=0>Home</a></td></tr></table></center>";
	}else{
	$uplink="</table>";
	}
if ($file != "." && $file != ".." &&  $file != "editor.php"  ) {
echo "<TR><TD align=middle><IMG SRC=\"$img\"  BORDER=0 ></td><TD COLSPAN=\"2\" BGCOLOR=\"#ffffff\" width=30%>&nbsp;<FONT COLOR=\"#000000\" SIZE=\"-1\" FACE=\"Verdana\"><a href=\"$link\">$file</a></td><td width=10% align=middle>$link1</td><td width=10% align=middle>$file_size_now</td><td width=10% align=middle><a href='?action=changeattrib&m=$m&te=$file&dir=$dir'>$attrib</a></td><td align=middle><a href='?action=download&m=$m&p=$file&dir=$dir'>Download</a></td><td align=middle><a href=\"?action=templates&do=delete&m=$m&te=$file&dir=$dir\" alt=Delete><img src=\"img/del.gif\" border=0></img></a></td></FONT></TR>";
    } 
}
echo "</table><table><BR>$uplink";
closedir($handle); 
?>
</td>
</tr>
</table>
</form>
<?php
}else{
echo "L�tfen yeniden giri� yap�n";
}
}
echo "<BR><CENTER><FONT SIZE=2 face=arial><A HREF=http://www.egenetbilisim.com/scripts target='_new'>Egenet Bilisim - Php Haz�r Site</A></font></CENTER>";
?>