<?php namespace ProcessWire;

function rowFeatures (
  $pageID,
  $items="",
  $textLongtitle="", 
  $textSummary=""
) {
  $options = $pageID->blocks_options;
  $tilteClass = $options->has(1) ? "display-1" : "display-2";
  $items = $items ?: $pageID->blocks_items;
  $textLongtitle = $textLongtitle ?: $pageID->text_longtitle;
  $textSummary = $textSummary ?: $pageID->text_summary;
  
  $out = "";
  $out .= "<div class='features row'>";

    $out .= "<div class='col-lg-4'>";
      $out .= "<div class='sticky-top pb-4'>";
        $out .= image($pageID->images_main->first(), 600, null, null, null, "img-fluid");
        $out .= "<h2 class='$tilteClass'>$textLongtitle</h2>";
        if ($textSummary) {
        $out .= "<div class='lead'>";
          $out .= $textSummary;
        $out .= "</div>";
        }
      $out .= "</div>";
    $out .= "</div>";
    
    $out .= "<div class='col'>";
      $out .= "<div class='row'>";
      foreach ($items as $i => $item) {
        $images  = $item->images_main;
        $title  = $item->text_1;
        $summary = $item->text_summary;
        $color = $item->blocks_color->has(1) ? "primary" : $item->blocks_color->value;
        $colorBorder = $item->blocks_color->value;
        $link = $item->link;
        $buttonName = $item->text_2;
        
        $i = $i+1;
        $out .= "<div class='features-item col-sm-6 d-flex align-items-stretch' data-aos='zoom-in'>";
          $out .= "<div class='features-item-body pb-5 pb-md-6 ps-3 ps-lg-5 border-1 border-start border-$colorBorder'>";
            // Add Number
            $out .= "<div class='d-flex'>";
              // $out .= ($options->has(5)) ? "<div class='item-number display-3 mt-n2 mt-lg-n3 mb-2 pe-3 text-danger'>". $i ."</div>" : "" ;
              $out .= $link ? "<a class='features-item-link d-block' href='$link'>" : "" ;
                $out .= "<div class='content'>";
                $out .= count($images) ? image($images->first(), 600, 400, null, null, "img-fluid rounded mb-4") : "" ;
                $out .= $title ? "<h3 class='features-item-title display-4 mb-2 mb-lg-3 text-$color'>$title</h3>" : "" ;
                $out .= $summary ? "<div class='features-item-summary text-gray-dark'>$summary</div>" : "";
                $out .= $link && $buttonName ? "<span class='features-item-button btn btn-link mt-2'>$buttonName</span>" : "" ;
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
