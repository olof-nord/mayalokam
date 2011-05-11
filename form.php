<?php include("data/variables.php"); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles-smaller.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'/>
</head>
<body>

<?php
$urlvar = $_GET['err'];
if($urlvar==1)
{
echo '<p>You have uploaded the maximum number of files</p>';
$urlvar=0;
}
elseif ($urlvar==2)
{
echo '<p>wrong extension</p>';
$urlvar=0;
}
elseif ($urlvar==3)
{
echo '<p>file to large</p>';
$urlvar=0;
}
elseif ($urlvar==4)
{
echo '<p>file already exist</p>';
$urlvar=0;
}
elseif ($urlvar==5)
{
echo '<p>filetransfer failed</p>';
$urlvar=0;
}
elseif ($urlvar==6)
{
$c=$_GET['c'];
echo '<p>transfer sucessful: '. $c .' of '. $maxuploads .' files</p>';
$urlvar=0;
}
 ?>
<p>Här kan du ladda upp låtar till spellistan.</p>
<p>Filformat som stöds: <?php for ($i=0; ($extvars[$i])!=null; $i++)
{
echo ' .';
echo $extvars[$i];
} ?>.</p>
<p>Max filstorlek är <?php echo $maxsize; print_r ($e[0]); ?> Mb.</p>
<form name="newad" method="post" enctype="multipart/form-data"  action="localhost/musicupload/hidden_files/upload.php">
<table>
     <tr><td><input type="file" name="file"></td></tr>
     <tr><td><div class="bigbutton"><input name="Submit" type="submit" value="Submit"></td></tr></div> 
</table>   
</form>
</body>
</html>
