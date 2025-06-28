<?php namespace ProcessWire;
function rowCTA() {

  
  $settings = pages("/settings/")->fieldset_cta;
  $settingsPage = page()->fieldset_cta;

  if (isset($settingsPage) && !$settingsPage->check_off) {
    $images = count($settingsPage->images_main) ? $settingsPage->images_main : $settings->images_main;
    $title = $settingsPage->text_1 ?: $settings->text_1;
    $summary = $settingsPage->text_summary ?: $settings->text_summary;
    $link = $settingsPage->link ?: $settings->link;
    $linkCaption = $settingsPage->text_2 ?: $settings->text_2;

    $edit = page()->fieldset_cta;

    $out = "<div class='CTA-row cta-row sectionContent shadow bg-white border rounded mt-7' data-aos='zoom-in' edit='$edit.images_main,text_1,text_summary,link,text_2,check_off'>";
      $out .= "<div class='cta-row-container row align-items-center'>";
        $out .= "<div class='cta-row-image-col col-lg d-flex align-items-center' data-aos='zoom-in' data-aos-delay='400'>";
          $out .= image($images->first, null, 500);
        $out .= "</div>";
        $out .= "<div class='cta-row-content-col col-12 col-lg-7 text-center text-lg-start pb-4 pb-lg-0'>";
          $out .= "<div class='cta-row-inner px-3 px-lg-4 py-4 py-lg-7 max-w-xxl-80'>";
            $out .= "<h2 class='cta-row-title display-2 text-primary-dark' data-aos='zoom-in' data-aos-delay='600'>$title</h2>";
            $out .= "<div class='cta-row-summary bg-chevron fs-lg-3 txt markerlist-icon' data-aos='zoom-in' data-aos-delay='800'>";
              $out .= $summary;
            $out .= "</div>";
            $out .= "<span class='cta-row-button-group button-group d-block py-2'><a class='cta-row-button btn btn-lg btn-secondary my-3 mt-lg-4' href='$link'>$linkCaption</a></span>";
          $out .= "</div>";
        $out .= "</div>";
      $out .= "</div>";
    $out .= "</div>";

    return $out;
  }
}