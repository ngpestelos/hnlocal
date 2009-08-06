<?php>

require_once("couchdb.php");
$db = new CouchDB('hn');
$result = $db->get_item('_design/entries/_view/all');
$rows = $result->getBody(true)->rows;



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
    <!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <title>Hacker News (local)</title>
  </head>
  <body>
    <div class="container">
      <div id="header" class="span-18 push-3 last">
        <h2 class="site_id"><a href=".">news.ycombinator.local</a></h2>
      </div>
      <div id="stuff" class="span-18 push-3 last main_content">
        <div class="pad_24">
          <ol>
          <?php
            foreach($rows as $r) {
              echo "<li>";
              echo $r->value->title;      
              echo "</li>";
            }
          ?>
          </ol>
        </div>
      </div>
    </div>
  </body>
</html>
