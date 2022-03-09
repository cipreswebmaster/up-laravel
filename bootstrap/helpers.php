<?php

/**
 * Le quita todas las tildes a las letras
 * 
 * @param string $string The string to be cleaned
 * 
 * @return string The string cleaned
 */
function clean_string(string $string) {
  return trim(str_replace(
    ["á","é","í","ó","ú","ü","ñ","Á","É","Í","Ó","Ú","Ü","Ñ"],
    ["a","e","i","o","u","u","n","A","E","I","O","U","U","N"],
    $string
  ));
}

/**
 * Convierte los precios de una forma que sea legible monetaria mente. Por ejemplo: 1000000 => $1000000
 * 
 * @param string $price El precio que debe ser convertido
 * 
 * @return string El precio legible monetariamente
 */
function getPrice(string $price) {
  $_price = "$";
  $priceWithoutDots = str_replace(".", "", $price);
  if (!is_numeric($priceWithoutDots))
    return $price;
  for ($i = 0; $i < strlen($priceWithoutDots); $i++) {
    $_price .= $priceWithoutDots[$i];
    $dotContinue = (strlen($priceWithoutDots) - ($i + 1)) % 3 == 0;
    if ($dotContinue && $i + 1 < strlen($priceWithoutDots))
      $_price .= ".";
  }
  return $_price;
}
