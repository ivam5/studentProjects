<?php

include("Vrijeme.php");
include("VrijemeNew.php");

$vrijeme_zd  = new VrijemeNew("Zadar");
$tlak        = $vrijeme_zd->getTlak();
$vlaga       = $vrijeme_zd->getVlaga();
$vrijeme     = $vrijeme_zd->getVrijeme();
$coordinates = $vrijeme_zd->getCoordinates();

echo $tlak;
echo '<br>';
echo $vlaga;
echo '<br>';
echo $vrijeme;
echo '<br>';

foreach($coordinates as $_GradoviVrijeme) {
	
  echo $_GradoviVrijeme;
  echo '<br>';
  
}


