<?php namespace ProcessWire;
$tilteClass = $blockID->blocks_options->has(1) ? "display-1" : "display-2";

$out = blockHeader($blockID, "", "", 1);

$out .= "<div class='gallery row g-2 mb-2'>";

  $out .= "<div class='col-lg' data-aos='zoom-in'>";
    $out .= image($blockID->images_main->first(), 900, 900, null, null, "gallery-image img-full rounded");
  $out .= "</div>";
  
  $out .= "<div class='col-lg order-first order-lg-last'>";
    $out .= "<div class='bg-lighter d-flex align-items-center py-5 px-3 px-lg-4 p-xl-6 h-100 rounded'>";
      $out .= "<div data-aos='fade-up'>";
        $out .= "<h2 class='$tilteClass'>$blockID->text_longtitle</h2>";
        $out .= "<div class='lead'>$blockID->text_summary</div>";
      $out .= "</div>";
    $out .= "</div>";
  $out .= "</div>";
  
$out .= "</div>";

$out .= galleryImage($blockID);

$out .= gallerySlider($blockID);

$out .= blockFooter($blockID);

echo $out;