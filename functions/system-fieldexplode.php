<?php namespace ProcessWire;

// Field data explode delimited with <br> <hr /> <p>
function fieldExplode($fieldData, $delimiter = "br")
{
  $output = "";

  if ($fieldData && $delimiter == "br") {
    $output = preg_split("/<br[^>]*>/i", preg_replace('/(?:\s*<br[^>]*>\s*){2,}/s', "<br>", $fieldData));
  } elseif ($fieldData && $delimiter == "hr") {
    $output = preg_split("/<hr[^>]*>/", preg_replace('/(?:\s*<hr[^>]*>\s*){2,}/s', "<hr>", $fieldData));
  } elseif ($fieldData && $delimiter == "p") {
    $fieldData = str_replace("</p>", "", $fieldData);
    $output = explode("<p>", $fieldData);
  }

  return $output;
}
