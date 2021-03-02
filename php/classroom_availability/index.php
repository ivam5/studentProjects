<?php

include("Dvorane.php");

echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
  </head>

  <body>';

  $dvorana = new Dvorane();
  $dvorane_html = $dvorana->showTermini();
  echo $dvorane_html;

  echo '
  </body>
</html>';




 ?>
