
<?php


$url= "https://maps.googleapis.com/maps/api/directions/json?origin=aveiro&destination=Oliveirinha&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";



$res= file_get_contents($url);



$json=json_decode($res);


echo $json->routes[0]->legs[0]->distance->text;
/*
  foreach ($json->routes as $percurso){
          
    $distancia= $percurso->legs->distance;

    echo $distancia;
  }
*/
?>