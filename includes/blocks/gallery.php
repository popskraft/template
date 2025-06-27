<?php namespace ProcessWire;
$tilteClass = $bID->blocks_options->has(1) ? "display-1" : "display-2";

$out = blockHeader($bID, "", "", 1);

$out .= "<div class='gallery row g-2 mb-2'>";

  $out .= "<div class='col-lg' data-aos='zoom-in'>";
    $out .= image($bID->images_main->first(), 900, 900, null, null, "gallery-image img-full rounded");
  $out .= "</div>";
  
  $out .= "<div class='col-lg order-first order-lg-last'>";
    $out .= "<div class='bg-lighter d-flex align-items-center py-5 px-3 px-lg-4 p-xl-6 h-100 rounded'>";
      $out .= "<div data-aos='fade-up'>";
        $out .= "<h2 class='$tilteClass'>$bID->text_longtitle</h2>";
        $out .= "<div class='lead'>$bID->text_summary</div>";
      $out .= "</div>";
    $out .= "</div>";
  $out .= "</div>";
  
$out .= "</div>";

$out .= galleryImage($bID);

$out .= gallerySlider($bID);

$out .= blockFooter($bID);

echo $out;