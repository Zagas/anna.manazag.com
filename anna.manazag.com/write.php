<html>
<head>
<title>TMCIEngine</title>
</head>

<body>
<?php
 $entity = $_POST["entity"];
 //$sub_pages = substr($entity[$i], 0 , 7);

 //  if($sub_pages == 'http://' || $sub_pages == 'https:/' ){
     $write_file = fopen("logfile.txt","a");
        fwrite($write_file,"\r\n");
	fwrite($write_file,$entity);
	fclose($write_file);
//}

?>
<script language="JavaScript1.2">
alert("Grazie per aver contribuito");
</script> 
<meta http-equiv="refresh" content="0; url=http://tmci.me/elezioni2013">
</body>
</html>
