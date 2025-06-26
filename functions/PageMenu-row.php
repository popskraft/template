<?php namespace ProcessWire;
function pageMenu($menuSource, $class="", $itemClass="") {
  $class = $class ?: "text-center";
  $itemClass = $itemClass ?: "btn btn btn-outline-primary-light shadow mx-1 my-2 m-lg-2 py-lg-3";
  
  if (isset($menuSource) && !count($menuSource)) {
    return "";
  }

  $out = "";
  $out .= "<nav class='pageMenu $class'>";
    foreach ($menuSource as $item) {
      $out .= "<a class='$itemClass' href='$item->url'>$item->title</a>";
    }
  $out .= "</nav>";
  return $out;
}