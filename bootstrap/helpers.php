<?php

/**
 * Take a string and replace all letters with tildes with the letter without it
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
