<!DOCTYPE HTML>
<!--this class read from facebook and submit into DB-->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"  >
    <title></title>
    <meta http-equiv="Refresh" content="100;URL=">
  </head>
  <body>
</body>
</html>
<?php
  /*load library*/
  require('library.php');
  require('simple_mysql.php');

  $query = "SELECT id, fb_url FROM entity WHERE fb_url IS NOT NULL";
  $data_source = FBtoCheck($query);
  $stack = fb_db_read($data_source);
  $time = time(); // move under foreach cycle when DB grows
  $network = "fb";
  foreach ($stack as $i => $v) {
    $id = $v['id'];
    $fb_fan = $v['fb_fan'];
    $table = $id."_fan";
    $query = "insert into `$table` (timestamp, network, fan) values ($time, \"$network\", $fb_fan)";
//    echo "$query\n";
                $jfb = json_encode($twit);
    insertDB($query);
  }
?>
