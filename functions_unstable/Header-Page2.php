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

    $out .= "<div id='pageHeader' class='page-header-secondary header-page2 pb-2 mb-6 mb-md-7' edit='$edit'>";
      $out .= "<div class='header-page2-container container-xxl'>";
        $out .= "<div class='header-page2-wrap $rowWrapClass'>";
          $out .= "<div class='header-page2-row row align-items-between'>";
          
            $out .= "<div class='header-page2-image-col col-lg text-end' data-aos='fade-up'>";
            if (isset($images) && count($images)) {
              $out .= image($images->first(), null, 550, null, null, "header-page2-image img-fluid rounded");
            }
            $out .= "</div>";
            
            $out .= "<div class='header-page2-content $contentClass d-flex flex-column justify-content-end'>";

              $out .= "<div class='header-page2-bottom-content bottom-content' data-aos='fade-up' data-aos-delay='400'>";

                $out .= $dateStart ? dateNorm($dateStart, "", "header-page2-date d-block px-4 pb-3 px-lg-0 mb-n5", "", "display-1", "fs-2", "text-gray ms-2") : "";
                
                $out .= "<div class='header-page2-content-inner header-content rotate-ccw-1 mb-n5 ms-lg-n7 ms-xl-n8 me-lg-5 me-xxl-6 $headerContentClass'>";

                  $out .= "<div class='header-page2-section-caption section-caption d-inline-flex flex-column align-items-end pt-4 pt-lg-5 $sectionCaptionClass'>";
                    // Link to parent category page
                    if (page()->parent()->id !== 1) {
                      // Possible to turn off the link in the Settings page
                      if (pages('/settings/')->options_site->has(2) && page()->template == "page-default") {
                        $out .= "<span class='header-page2-category category-link bg-lighter rounded-2 p-2 px-3 fs-5 fs-lg-4 mb-2 me-n3 text-uppercase $sectionCaptionLinkClass'>{$pageID->parent->title}</span>";
                      } else {
                        $out .= "<a class='header-page2-category-link category-link bg-lighter rounded-2 p-2 px-3 fs-5 fs-lg-4 mb-2 me-n3 text-uppercase $sectionCaptionLinkClass' href='{$pageID->parent->url}'>{$pageID->parent->title}</a>";
                      }
                    }
                    $out .= "<h1 class='header-page2-title display-2 mb-n1'><span class='header-page2-title-inner d-inline-block p-3 px-5 rounded mb-n2 $headlineClass'>$title</span></h1>";
                  $out .= "</div>";
                  
                  if  ($summary) {
                    $out .= "<div class='header-page2-summary lead p-4 p-lg-5 bg-white rounded shadow $leadClass'>";
                      $out .= "<div class='header-page2-summary-text'>$summary</div>";
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