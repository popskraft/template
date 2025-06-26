<?php namespace ProcessWire;
function galleryImage($pageID="", $class="", $sliceStart=1, $sliceEnd=20, $images_main = "") {
  $pageID = $pageID ?: page();
  $images_main = $images_main ?: "images_main";
  $bodyImages = $pageID->$images_main->slice($sliceStart, $sliceEnd);
  $class = $class ?: "";

  if (!count($bodyImages)) {
    return "";
  }

  $out = "";  
  $out .= "<div class='galleryImage row g-2 $class'>";

    $counter = 0;
    foreach ($bodyImages as $bodyImage) {
      // Every 3 image has full size
      if ($counter++ % 3 == 0) {
        $bodyImageClass = "col-12";
        $bodyImageW = 1584;
        $bodyImageH = 900;
      } else {
        $bodyImageClass = "col-md-6";
        $bodyImageW = 788;
        $bodyImageH = floor(788 * .75);
      }
    
      $out .= "<div class='gallery-item $bodyImageClass'>";
        $out .= "<div class='position-relative' data-aos='zoom-in'>";
          $out .= image($bodyImage, $bodyImageW, $bodyImageH, null, null, "img-full rounded position-relative");
          $out .= imageCaption($bodyImage, "d-inline-block fs-6 fs-sm-5 rounded-top rounded-end pe-3 pt-2 position-absolute start-0 bottom-0 bg-white zindex-min");
        $out .= "</div>";
      $out .= "</div>";
    }
  $out .= "</div>";

  return $out;
}
