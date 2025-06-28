<?php namespace ProcessWire;
function timeline($pageId) {
  $out = "";
  
  foreach ($pageId->timeline as $item) {
    $time = $item->time;
    $title = $item->title;
    $text = $item->text;

    $out .= "<div class='timeline-row-item timeline-item row g-0 max-w-lg-80 mx-auto pt-3overflow-hidden'>";
      $out .= "<div class='timeline-row-time-col col-1 col-md-2 text-end'>";
        $out .= "<span class='timeline-row-time badge rounded-pill text-nowrap px-3 px-lg-4 py-1 py-md-2 me-n4 bg-white text-primary-light border border-2 border-primary-light fw-bold position-relative'>$time</span>";
      $out .= "</div>";
      $out .= "<div class='timeline-row-content-col col-11 col-md-10 border-start border-2 border-primary-light'>";
        $out .= "<div class='timeline-row-content ps-4 ps-lg-6 py-4 fs-xl-3 mt-2 border-top'>";
          $out .= $title ? "<h2 class='timeline-row-title display-5 mb-2'>$title</h2>" : "";
          $out .= "<div class='timeline-row-text'>$text</div>";
        $out .= "</div>";
      $out .= "</div>";
    $out .= "</div>";
  }
  
  return $out;
}