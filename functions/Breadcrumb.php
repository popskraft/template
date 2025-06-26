<?php namespace ProcessWire;
function breadcrumb ( $class="" ) 
{
  $class = $class ?: "text-uppercase d-inline-flex align-items-center";
  $pageParents = page()->parents();
  $out = "";
  if (isset($pageParents) && count($pageParents) > 1) {
    $out .= "<div class='breadcrumb $class'>";
    foreach ($pageParents as $key => $parent) {
      if ($key > 0 && !$parent->is('unpublished')) { // exclude first (home) page
        $out .= "<a class='link' href='$parent->url'>$parent->title</a>&emsp;";
      }
    }
    $out .= "</div>";
  }
  return $out;
}