<?php
namespace ProcessWire;

function rowFAQ($items) {
  $out = "<div class='category-FAQ faq-row row'>";
  
    // Navigation Sidebar
    $out .= "<div class='category-FAQ-navs faq-row-navs col-12 col-lg-3'>";
      $out .= "<nav id='navbar-main' class='faq-row-nav h-100 flex-column align-items-stretch'>";
        $out .= "<div class='faq-row-nav-pills nav nav-pills flex-column sticky-top py-3'>";
        foreach ($items as $i => $item) {
          $out .= "<a class='faq-row-nav-link nav-link' href='#item-$i'>$item->title</a>";
        }
        $out .= "</div>";
      $out .= "</nav>";
    $out .= "</div>";

    // Main Content Area
    $out .= "<div class='category-FAQ-body faq-row-body col-12 col-lg-9'>";
      $out .= "<div data-bs-spy='scroll' data-bs-target='#navbar-main' data-bs-smooth-scroll='true' class='faq-row-scrollspy scrollspy-example-2' tabindex='0'>";
      foreach ($items as $i => $item) {
        $out .= "<div id='item-$i' class='faq-row-item mb-5 mb-lg-6'>";
          $out .= "<h2 class='faq-row-title display-3 px-3'>$item->title</h2>";
          $out .= FAQListing($item);
        $out .= "</div>";
      }
      $out .= "</div>";
    $out .= "</div>";

  $out .= "</div>";

  return $out;
}