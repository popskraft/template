<?php namespace ProcessWire;
function pageHeaderSecondary($pageID="", $headlineClass="", $sectionCaptionLinkClass="", $leadClass="", $title="", $images="", $summary="") {
  $pageID = $pageID ?: page();
  $headlineClass = $headlineClass ?: "bg-secondary text-white";
  $sectionCaptionLinkClass = $sectionCaptionLinkClass ?: "text-gray-light";
  $leadClass = $leadClass ?: "";
  $title = $title ?: $pageID->get("text_longtitle|title");
  $images = $images ?: $pageID->get("images_main");
  $summary = $summary ?: $pageID->summarize('text_summary', 700);
  $dateStart = $pageID->date_start;
  $contentClass = (page("template") == "page-news") ? "col-lg-7" : "col-lg";

  $headerContentClass = (isset($images) && count($images) && !$dateStart) ? "mt-n7 mt-lg-0" : "";
  $sectionCaptionClass = (isset($images) && count($images) && !$dateStart) ? "" : "";
  $rowWrapClass = (isset($images) && count($images)) ? "row-wrap bg-lighter rounded" : "";

  $edit = "$pageID.title";
    $edit .= isset($pageID->date_start) ? ",date_start" : "";
    $edit .= isset($pageID->text_longtitle) ? ",text_longtitle" : "";
    $edit .= isset($pageID->text_summary) ? ",text_summary" : "";
    $edit .= isset($pageID->images_main) ? ",images_main" : "";
    $edit .= isset($pageID->blocks_color) ? ",blocks_color" : "";

  $out = "";

    $out .= "<div id='pageHeaderSecondary' class='page-header-secondary pb-2 mb-6 mb-md-7' edit='$edit'>";
      $out .= "<div class='container-xxl'>";
        $out .= "<div class='$rowWrapClass'>";
          $out .= "<div class='row align-items-between'>";
          
            $out .= "<div class='col-lg text-end' data-aos='fade-up'>";
            if (isset($images) && count($images)) {
              $out .= image($images->first(), null, 800, null, null, "img-fluid rounded");
            }
            $out .= "</div>";
            
            $out .= "<div class='$contentClass d-flex flex-column justify-content-end'>";

              $out .= "<div class='bottom-content' data-aos='fade-up' data-aos-delay='400'>";

                $out .= $dateStart ? dateNorm($dateStart, "", "d-block px-4 pb-3 px-lg-0 mb-n5", "", "display-1", "fs-2", "text-gray ms-2") : "";
                
                $out .= "<div class='header-content rotate-ccw-1 mb-n5 ms-lg-n7 ms-xl-n8 me-lg-5 me-xxl-6 $headerContentClass'>";

                  $out .= "<div class='section-caption d-inline-flex flex-column align-items-end pt-4 pt-lg-5 $sectionCaptionClass'>";
                    // Link to parent category page
                    if (page()->parent()->id !== 1) {
                      // Possible to turn off the link in the Settings page
                      if (pages('/settings/')->options_site->has(2) && page()->template == "page-default") {
                        $out .= "<span class='category-link bg-lighter rounded-2 p-2 px-3 fs-5 fs-lg-4 mb-2 me-n3 text-uppercase $sectionCaptionLinkClass'>{$pageID->parent->title}</span>";
                      } else {
                        $out .= "<a class='category-link bg-lighter rounded-2 p-2 px-3 fs-5 fs-lg-4 mb-2 me-n3 text-uppercase $sectionCaptionLinkClass' href='{$pageID->parent->url}'>{$pageID->parent->title}</a>";
                      }
                    }
                    $out .= "<h1 class='display-2 mb-n1'><span class='d-inline-block p-3 px-5 rounded mb-n2 $headlineClass'>$title</span></h1>";
                  $out .= "</div>";
                  
                  if  ($summary) {
                    $out .= "<div class='lead p-4 p-lg-5 bg-white rounded shadow $leadClass'>";
                      $out .= "<div>$summary</div>";
                    $out .= "</div>";
                  }
                $out .= "</div>";
              $out .= "</div>";
                
            $out .= "</div>";

          $out .= "</div>";
        $out .= "</div>";
      $out .= "</div>";
    $out .= "</div>";

  return $out;
}