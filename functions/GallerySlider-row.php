<?php
namespace ProcessWire;

function gallerySlider($thePage, $colClass="")
{
  $images = $thePage->images_gallery;
  $colClass = $colClass ?: "me-2 w-90 w-sm-50 w-lg-33";
  
  $out = "";

  if (isset($images) && !count($images)) {
    return "";
  }
  
    $out .= "<div class='gallerySlider mt-2 rounded' data-flickity='{
      \"cellAlign\": \"center\",
      \"groupCells\": true,
      \"contain\": true,
      \"freeScroll\": true,
      \"pageDots\": true,
      \"freeScroll\": true,
      \"freeScrollFriction\": 0.03,
      \"prevNextButtons\": true 
    }'>";

    foreach ($images as $image) {
      $out .= "<div class='image-container $colClass'>";
          $out .= image($image, 600, floor(600 * 0.75), null, null, "img-full rounded");
      $out .= "</div>";
    }
    
    $out .= "</div>";

  return $out;
}