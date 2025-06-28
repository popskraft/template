<?php namespace ProcessWire;

function rowFeatures (
  $pageID,
  $items="",
  $textLongtitle="", 
  $textSummary=""
) {
  $options = $pageID->blocks_options;
  $titleClass = $options->has(1) ? "display-1" : "display-2";
  $items = $items ?: $pageID->blocks_items;
  $textLongtitle = $textLongtitle ?: $pageID->text_longtitle;
  $textSummary = $textSummary ?: $pageID->text_summary;
  
  $out = "";
  $out .= "<div class='features features-row row'>";

    $out .= "<div class='features-row-sidebar col-lg-4'>";
      $out .= "<div class='features-row-sticky sticky-top pb-4'>";
        $out .= image($pageID->images_main->first(), 600, null, null, null, "features-row-image img-fluid");
        $out .= "<h2 class='features-row-title $titleClass'>$textLongtitle</h2>";
        if ($textSummary) {
        $out .= "<div class='features-row-summary lead'>";
          $out .= $textSummary;
        $out .= "</div>";
        }
      $out .= "</div>";
    $out .= "</div>";
    
    $out .= "<div class='features-row-content col'>";
      $out .= "<div class='features-row-items row'>";
      foreach ($items as $i => $item) {
        $images  = $item->images_main;
        $title  = $item->text_1;
        $summary = $item->text_summary;
        $color = $item->blocks_color->has(1) ? "primary" : $item->blocks_color->value;
        $colorBorder = $item->blocks_color->value;
        $link = $item->link;
        $buttonName = $item->text_2;
        
        $i = $i+1;
        $out .= "<div class='features-item features-row-item col-sm-6 d-flex align-items-stretch' data-aos='zoom-in'>";
          $out .= "<div class='features-item-body features-row-item-body pb-5 pb-md-6 ps-3 ps-lg-5 border-1 border-start border-$colorBorder'>";
            // Add Number
            $out .= "<div class='d-flex'>";
              // $out .= ($options->has(5)) ? "<div class='item-number display-3 mt-n2 mt-lg-n3 mb-2 pe-3 text-danger'>". $i ."</div>" : "" ;
              $out .= $link ? "<a class='features-row-link d-block' href='$link'>" : "" ;
                $out .= "<div class='features-row-content content'>";
                $out .= count($images) ? image($images->first(), 600, 400, null, null, "features-row-item-image img-fluid rounded mb-4 mb-lg-5 ") : "" ;
                $out .= $title ? "<h3 class='features-row-item-title item-title display-4 mb-2 mb-lg-3 text-$color'>$title</h3>" : "" ;
                $out .= $summary ? "<div class='features-row-item-summary item-summary text-gray-dark'>$summary</div>" : "";
                $out .= $link && $buttonName ? "<span class='features-row-button btn btn-link mt-2'>$buttonName</span>" : "" ;
                $out .= "</div>";
              $out .= $link ? "</a>" : "" ;
            $out .= "</div>";
          $out .= "</div>";
        $out .= "</div>";
        }
      $out .= "</div>";
    $out .= "</div>";

  $out .= "</div>";
  
  return $out;
}
