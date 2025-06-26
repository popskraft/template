<?php namespace ProcessWire;

function infoblock(
  $pageID,
  $summaryClass = "",
  $imagesMain="", 
  $textLongtitle="", 
  $textBody="",
  $links="",
  $interval=5000
) {
  $summaryClass = $summaryClass ?: "px-3 py-5 bg-light text-center";
  $imagesMain = $imagesMain ?: $pageID->images_main;
  $textLongtitle = $textLongtitle ?: $pageID->get("text_longtitle|title");
  $textBody = $textBody ?: $pageID->text_summary;
  $links = $links ?: $pageID->blocks_links;

  $colFirstClass = "order-first";
  $colLastClass = "order-last";
  
  // Mirroring content on desktop
  if ( $pageID->blocks_options->has(1)) {
    $colFirstClass = "order-lg-last";
    $colLastClass = "order-lg-first";
  }
  
  $out = "";
  $out .= "<div class='infoblock row gx-xl-5 align-items-center'>";
  
    $out .= "<div class='col-lg-4 d-flex align-items-center justify-content-start {$colFirstClass}'>";
      $out .= "<div class='py-5 py-lg-6' data-aos='zoom-in'>";
        $out .= "<h2 class='display-2'>{$textLongtitle}</h2>";
        $out .= "<div class='fs-4 fs-lg-6 fs-xl-3 mb-2'>{$textBody}</div>";
        $out .= $links ? buttonGroup($links, "d-block") : "";
      $out .= "</div>";
    $out .= "</div>";

    $out .= "<div class='col {$colLastClass}'>";
      $out .= imageSlider($imagesMain, "min-vh-50 min-vh-sm-80", 1200, 900);
    $out .= "</div>";
  $out .= "</div>";

  return $out;
}
