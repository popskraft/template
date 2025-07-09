<?php namespace ProcessWire;
function blockHeader($pageID, $classSection="", $class="", $headerOFF="")
{
  $title = $pageID->text_longtitle;
  $summary = $pageID->text_summary;
  
  $tilteClass = $pageID->blocks_options->has(1) ? "display-1" : "display-2";
  $classSection = $classSection ?: "" ;
  $titleColClass = "col-lg";
  $summaryColClass = "col-lg";
  $class = $class ?: "container-xxl" ;
  $class .= $pageID->blocks_options->has(2) ? "" : " mb-6" ; // Indent bottom Big

  if ($pageID->blocks_options->has(5)) { // Center align title and summary
    $titleColClass = "col-8 mx-auto text-center";
    $summaryColClass = "col-8 mx-auto text-center";
  }

  $editBlock = ($pageID->blocks_type->value !== "cover") ? 
  "blocks_type,title,text_longtitle,text_1,text_summary,images_main,images_gallery,file_downloads,timeline,pageref_testimonials,pageref_pages,video,images_logos,blocks_items,text_body_light,faq,blocks_links,blocks_options,blocks_selectblock" : "" ;

  $out = "<div id='block-{$pageID->blocks_type->value}-$pageID' class='blockHeader position-relative $classSection' edit='$pageID.$editBlock'>";
  
    $out .= "<div class='blockHeader-container $class'>";

    if (!$headerOFF && $title) {
      $out .= "<div class='blockHeader-header-row row align-items-end mb-3'>";
        $out .= "<div class='blockHeader-header-title $titleColClass'>";
          $out .= $title ? "<h2 class='$tilteClass mb-4 mb-lg-5'>$title</h2>" : "" ;
        $out .= "</div>";
        if ($summary) {
        $out .= "<div class='blockHeader-header-summary $summaryColClass'>";
          $out .= $summary ? "<div class='lead mb-4 mb-5'>$summary</div>" : "";
        $out .= "</div>";
        }
      $out .= "</div>";
    }
  
  return $out;
}
