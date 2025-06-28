<?php namespace ProcessWire;
function pagenavMenu($menuSource="", $class="", $itemClass="") {
  $menuSource = $menuSource ? $menuSource : page()->children();
  $class = $class ?: "";
  $itemClass = $itemClass ?: "btn btn-sm btn-outline-primary mx-1";
  
  if (isset($menuSource) && !count($menuSource)) {
    return "";
  }

  $out = "";
  $out .= "<nav class='pagenav-menu childPagesMenu $class'>";
    foreach ($menuSource as $item) {
      $out .= "<a class='pagenav-menu-item $itemClass' href='$item->url'>$item->title</a>";
    }
  $out .= "</nav>";
  return $out;
}