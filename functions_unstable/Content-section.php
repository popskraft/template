<?php namespace ProcessWire;

function sectionContent($pageID="") 
{
  $title = $pageID->text_longtitle;
  $titleClass = $pageID->blocks_options->has(1) ? "display-2" : "display-3";
  $sectionClass = $pageID->blocks_options->has(3) ? "shadow bg-white border rounded p-3 py-lg-5 px-lg-6" : "";
  $colBodyClass = $pageID->blocks_options->has(4) ? "order-lg-first" : "";
  $links = $pageID->blocks_links;

  $body = $pageID->text_body_light;
  $images = $pageID->images_main;
  
  $out = "<div class='sectionContent content-section $sectionClass' data-aos='zoom-in'>";
    $out .= "<div class='content-section-row row align-items-center'>";
    
      $out .= "<div class='content-section-image-col col-lg text-center' data-aos='zoom-in' data-aos-delay='400'>";
        $out .= image($images->first(), 768, null, null, null, "content-section-image img-fluid rounded");
      $out .= "</div>";
      
      $out .= "<div class='content-section-content-col col-12 col-lg-6 text-center text-lg-start pb-3 pt-4 $colBodyClass'>";
        $out .= "<h2 class='content-section-title $titleClass text-primary-dark' data-aos='zoom-in' data-aos-delay='600'>$title</h2>";
        $out .= "<div class='content-section-body bg-chevron fs-lg-3 txt markerlist-icon' data-aos='zoom-in' data-aos-delay='800'>";
          $out .= $body;
        $out .= "</div>";
        $out .= buttonGroup($links);
      $out .= "</div>";

    $out .= "</div>";
  $out .= "</div>";
  
  return $out;
}
