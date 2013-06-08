<!--THIS IS THE RANK PAGE DEFAULT SHOWED TO VIDEO
	http://anna.manazag.com/elezioni2013/rank.php?id=$id&label=$label'
	- $id rank ID it was taken from Database 
	- $label this label is associated to the rankID
-->
<?php

        /*load library*/
  require('library.php');
       require('current_data.php');
//create the table with the data that will be showed with HTML code
function create_table($data){
  aasort($data,"last_fb_fan");
  foreach ($data as $i => $v) {                  
    $fb_url = $data[$i]['fb_url']; 
    $label = $data[$i]['label'];
    $im_url =$data[$i]['im_url'];
    $pre_fb_fan = $data[$i]['previous_fb_fan'] ;
    $last_fb_fan = $data[$i]['last_fb_fan'];
    $diff = $data[$i]['last_fb_fan'] -$data[$i]['previous_fb_fan'] ;

    $arrow = create_arrow($diff);

    print("<tr><td><img src='$im_url'</></td><td> <A HREF='$fb_url'TARGET='_blank'> $label </A></td><td><b>$last_fb_fan</b></td><td><b>$pre_fb_fan</b></td><td><img src='$arrow'</>$diff</tr></td>");                  
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"  >
<?php
			$label = $_GET['label'];
                        $id = $_GET['id'];
    echo "<title>$label</title>";
    echo "<meta http-equiv='refresh' content='3000; url=http://anna.manazag.com/elezioni2013/rank.php?id=$id&label=$label'>";
 ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.png">
  </head>
  <div class="hero-unit">
<?php
			$label = $_GET['label'];
?>
        <h1 align = "center"><?php print($label) ?></h1>
      </div>
  <body>
   <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="http://www.tmci.me/elezioni2013">Elezione2013</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="http://www.tmci.me">Home</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
   <br></br>
    <table CLASS="table table-striped" border ="1">
      <P align = "center">
      <?php
      $id = $_GET['id'];
      $es = ".php";
      $req = "rank_list/$id$es";
      require($req);
      print("<TABLE CLASS='table table-striped' ALIGN = 'center'BORDER='3'><thead><tr><th><b>Immagine</b></th><th><b>Nome</b></th><th><b><img src='http://www.guerrillaair.com/fb/apps/assets/fb_icon.png'</> Fan</b><th><b><img src='http://www.guerrillaair.com/fb/apps/assets/fb_icon.png'</> Fan pre</b></th><th><b>Differenza</b></th></tr></thead></th>\n");
      create_table($data_source);
      print("<tfoot><tr><td></td><th><form action='write.php'  class='form-search'method='POST'><div class='input-append'>
    <input type='text' class='span3 search-query' placeholder='http://facebook.com/PartitoDellaGnocca' name='entity'>
    <button type='submit' class='btn'>Inserisci nuova entità</button>  </div>
    </form></th></tr></tfoot></TABLE>\n");
      echo "<br><br>";
      echo "<P align='center'> <b>Aggiornato a </b> $lastupdate</P>"
      ?>
      </P>
    </table>
  </body>
</html>
