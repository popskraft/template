<?php namespace ProcessWire;
function timeline($pageID) {
  $out = "";
  
  foreach ($pageID->timeline as $item) {
    $time = $item->time;
    $title = $item->title;
    $text = $item->text;

    $out .= "<div class='timeline-item row g-0 max-w-lg-80 mx-auto pt-3overflow-hidden'>";
      $out .= "<div class='col-1 col-md-2 text-end'>";
        $out .= "<span class='badge rounded-pill text-nowrap px-3 px-lg-4 py-1 py-md-2 me-n4 bg-white text-primary-light border border-2 border-primary-light fw-bold position-relative'>$time</span>";
      $out .= "</div>";
      $out .= "<div class='col-11 col-md-10 border-start border-2 border-primary-light'>";
        $out .= "<div class='ps-4 ps-lg-6 py-4 fs-xl-3 mt-2 border-top'>";
          $out .= $title ? "<h2 class='display-5 mb-2'>$title</h2>" : "";
          $out .= $text;
        $out .= "</div>";
      $out .= "</div>";
    $out .= "</div>";
  }
  
  return $out;
}