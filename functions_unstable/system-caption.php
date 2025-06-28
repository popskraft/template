<?php namespace ProcessWire;

/**
 *  Различные подписи на всем сайте
 *  Настраиваются на главной странице
 *  ========================================
*/
function caption($key=null, $src=null)
{
  $output = "";
  if ($src == null) {
    $src =  pages("/settings/")->site_texts;
    $captions = array();
    $srcArr = fieldExplode($src);

    foreach ($srcArr as $val) {
      $tmp = explode("=", $val);
      $captions[trim($tmp[0])] = trim($tmp[1]);
    }
    if (array_key_exists($key, $captions)) {
      $output .= $captions[$key];
    } else {
      $output .= "! $key";
    }
  } else {
    $src =  pages("/settings/")->$src;
    $output .= ($src->get($key) != FALSE) ? $src->get($key) : $src->label($key);
  }
  return $output;
}
