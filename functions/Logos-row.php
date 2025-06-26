<?php namespace ProcessWire;

function rowLogos($pageID, $imgHeight = "", $rowClass="", $imgClass="")
{
  $logos = $pageID->images_logos;
  $rowClass = $rowClass ?: "row-cols-3 row-cols-md-4 row-cols-xl-6 gx-0 mx-auto justify-content-center" ;
  $imgHeight = $imgHeight ?: 200 ;
  $imgClass = $imgClass ?: "img-fluid max-w-100 max-w-lg-80";

  $out = "";

  if (isset($logos) && count($logos)) {
  $out .= "<div class='block-logos row $rowClass' edit='$pageID.images_logos'>";
    foreach ($logos as $item) {
      $title = $item->description;
      $out .= "<div class='col d-flex align-items-stretch'>";
        $out .= "<div class='content px-2 w-100 border-1 border-bottom'>";
          $out .= "<div class='content-logo min-vh-10 min-vh-lg-15 d-flex align-items-center justify-content-center'>";
          $out .= image($item, null, $imgHeight, null, null, $imgClass, 1);
          $out .= "</div>";
          $out .= ($title) ? "<div class='fs-6 pt-3 text-center text-gray'>$title</div>" : "" ;
        $out .= "</div>";
      $out .= "</div>";
    }
    $out .= "</div>";
  }

  return $out;
}