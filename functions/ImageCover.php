<?php namespace ProcessWire;

function imageCover(
  $image="",
  $class="",
  $w=1800,
  $h=700
) 
{
  $image = $image ?: page("images_main")->first();
  $class = $class ?: "min-vh-40 min-vh-sm-80";
  
  $out = "";
  $out .= "<div class='imageCover position-relative $class'>";
    $out .= image($image, $w, $h, null, 70, "imageCover-img img-full position-absolute h-100 object-fit-cover", null, 1, 1);
  $out .= "</div>";
  
  return $out;
}
