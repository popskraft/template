<?php namespace ProcessWire;

function imageSlider(
  $imagesMain="",
  $class="",
  $w=1800,
  $h=840,
  $imgClass=""
) 
{
  $imagesMain = $imagesMain ?: page("images_main");
  $class = $class ?: "min-vh-60 min-vh-sm-80 min-vh-xl-90";
  $imgClass = $imgClass ?: "position-absolute w-100 h-100 top-0 left-0 object-fit-cover";
  
  if (isset($imagesMain) && !count($imagesMain)) {
    return "";
  }

  $out = "";

  $out .= "<div class='imageSlider position-relative overflow-hidden $class'>";
    $i = 0;
    foreach ($imagesMain as $image) {
      $active = ($i == 0) ? "active" : "";
      $lazyOn = ($i > 2) ? 1 : "";
      $out .= "<div class='imageSlider-item $active'>";
        $out .= image($image, $w, $h, null, null, "imageSlider-item-image $imgClass", $lazyOn, null, 1);
      $out .= "</div>";
      $i += 1;
    }
  $out .= "</div>";

  return $out;
}
