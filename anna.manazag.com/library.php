<!--Complete class with Project library-->
<?php

/*DEBUG function*/
function echo_data($data) {
	echo $data."\n";
}

function fb_source_read($data_source) {
	/*load facebook SDK*/
	require('facebook.php');
	$facebook = new Facebook(array(
		'appId' => '222861337799622',
		'secret' => '57dedb15bf4c3f91e3dba4d08f832da1',
	));

	$stack = array();
	foreach ($data_source as $i => $v) {
/*		echo "$i $v\n";*/
/*		$fb_url = $data_source[$i]['fb_url'];			*/
		$label = $v['label'];
		$fb_url = $v['fb_url'];
		
		$parts = explode('/', $fb_url);
		$fb_id = "/".array_pop($parts);

		$ref=$facebook->api("$fb_id");
		$fb_fan=$ref['likes'];
	
		$data = "\tarray(\"label\" => \"$label\", \"fb_url\" => \"$fb_url\", \"fb_fan\" => \"$fb_fan\"),\n";

		array_push($stack, $data);
	}
	return $stack;
}
/*Read from DB the last number fan update and insert into Array ready to be showed*/
function fb_db_read($data_source) {
	/*load facebook SDK*/
	require('facebook.php');
	$facebook = new Facebook(array(
		'appId' => '222861337799622',
		'secret' => '57dedb15bf4c3f91e3dba4d08f832da1',
	));

	$stack = array();
	foreach ($data_source as $i => $v) {
/*		echo "$i $v\n";*/
/*		$fb_url = $data_source[$i]['fb_url'];			*/
		$id = $v['id'];
		$fb_url = $v['fb_url'];
		
		$parts = explode('/', $fb_url);
		$fb_id = "/".array_pop($parts);

		$ref=$facebook->api("$fb_id");
		$fb_fan=$ref['likes'];
	
//		$data = "\tarray(\"label\" => \"$id\", \"fb_url\" => \"$fb_url\", \"fb_fan\" => \"$fb_fan\"),\n";
		$data = array("id" => "$id", "fb_fan" => "$fb_fan");

		array_push($stack, $data);
	}
	return $stack;
}
/*Read from DB the old number fo fan and insert into Array*/
function fb_history_read($data_source) { // WIP
	$stack = array();
	foreach ($data_source as $i => $v) {
/*		echo "$i $v\n";*/
/*		$fb_url = $data_source[$i]['fb_url'];			*/
		$id = $v['id'];
		$fb_url = $v['fb_url'];
		
		$parts = explode('/', $fb_url);
		$fb_id = "/".array_pop($parts);

		$ref=$facebook->api("$fb_id");
		$fb_fan=$ref['likes'];
	
//		$data = "\tarray(\"label\" => \"$id\", \"fb_url\" => \"$fb_url\", \"fb_fan\" => \"$fb_fan\"),\n";
		$data = array("id" => "$id", "fb_fan" => "$fb_fan");

		array_push($stack, $data);
	}
	return $stack;
}
/*Sort for Order by the ranking from highest to lowest numeber of fan*/
function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    arsort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}
/*This function choose the kind of arrow to show, from the difference between last update fan and the old one*/
function create_arrow($diff){
  if($diff > 0)
  {$im_diff = "http://www.netanimations.net/Up-02-june.gif";}
  elseif($diff == 0){
			$im_diff = "http://www.myspinedoctors.com/images/redesign/equalSign.png";$diff="";
		    }
  else{
         $im_diff = "http://www.ddmortara.it/wordpress/wp-content/uploads/2011/01/freccia_animata_giu.gif";
      }
  return $im_diff;
}
?>


