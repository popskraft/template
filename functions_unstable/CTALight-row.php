<?php namespace ProcessWire;
function rowCTALight() {

  
  $settings = pages("/settings/")->fieldset_cta;
  $settingsPage = page()->fieldset_cta;

  if (isset($settingsPage) && !$settingsPage->check_off) {
    $images = count($settingsPage->images_main) ? $settingsPage->images_main : $settings->images_main;
    $title = $settingsPage->text_1 ?: $settings->text_1;
    $summary = $settingsPage->text_summary ?: $settings->text_summary;
    $link = $settingsPage->link ?: $settings->link;
    $linkCaption = $settingsPage->text_2 ?: $settings->text_2;

    $edit = page()->fieldset_cta;

  $out = "<div class='CTAlight-row ctalight-row container-xxl mb-5 mb-lg-7'>";
    $out .= "<div class='ctalight-row-content sectionContent mx-auto max-w-lg-80 max-w-xxl-60 shadow bg-white border rounded' data-aos='zoom-in' edit='$edit.images_main,text_1,text_summary,link,text_2,check_off'>";
      $out .= "<div class='ctalight-row-container row align-items-center'>";
      
        $out .= "<div class='ctalight-row-image-col col-lg d-flex align-items-end' data-aos='zoom-in' data-aos-delay='400'>";
          $out .= image($images->first, null, 500,);
        $out .= "</div>";
        
        $out .= "<div class='ctalight-row-content-col col-12 col-lg-8 text-center text-lg-start'>";
          $out .= "<div class='ctalight-row-inner content max-w-md-80 px-3 py-5 px-lg-4'>";
            $out .= "<div class='ctalight-row-title display-5 mb-3 text-primary-dark' data-aos='zoom-in' data-aos-delay='600'>$title</div>";
            $out .= "<div class='ctalight-row-summary summary' data-aos='zoom-in' data-aos-delay='800'>";
              $out .= $summary;
            $out .= "</div>";
            $out .= "<a class='ctalight-row-button btn btn-lg btn-link mt-3' href='$link' data-aos='zoom-in' data-aos-delay='800'>$linkCaption</a>";
          $out .= "</div>";
        $out .= "</div>";

      $out .= "</div>";
    $out .= "</div>";
  $out .= "</div>";

    return $out;
  }
}