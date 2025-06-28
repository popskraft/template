<?php namespace ProcessWire;
function pageHeader() {
  $headerImages = page("page_header_group.images_main|images_main");
  $headerTitle = page("page_header_group.title|title|text_longtitle|title");
  $headerSummary = page("page_header_group.text_summary|text_summary");

  $out = "";

  if (isset($headerImages) && count($headerImages)) {
    $out .= imageSlider($headerImages, "min-vh-30 min-vh-lg-70", 1800, 700);
  }

  $out .= "<div class='pageHeader header-page container-xxl position-relative' edit='page_header_group'>";
    $out .= "<div class='header-page-container bg-lighter rounded px-3 py-4 p-sm-5 px-xl-6 mb-4 mb-lg-6'>";
      $out .= "<div class='header-page-row row align-items-end'>";

        $out .= "<div class='header-page-col-title col-lg'>";
          $out .= breadcrumb();
          $out .= "<h1 class='header-page-title display-2 text-uppercase my-2 my-lg-3'>$headerTitle</h1>";
        $out .= "</div>";

        $out .= "<div class='header-page-col-summary col-lg'>";
          $out .= "<div class='header-page-summary lead mb-lg-3'>";
            $out .= $headerSummary;
          $out .= "</div>";
        $out .= "</div>";
        
      $out .= "</div>";
    $out .= "</div>";
  $out .= "</div>";

  return $out;
}