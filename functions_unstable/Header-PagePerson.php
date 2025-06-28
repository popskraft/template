<?php namespace ProcessWire;
function pageHeaderPerson($pageID="") {
  $pageID = $pageID ?: page();
  $images =  $pageID->images_main;
  $firstName =  $pageID->title;
  $secondName =  $pageID->text_longtitle;
  $thirdName =  $pageID->text_1;
  $position =  $pageID->person_anketa->position;

  $edit = "$pageID.images_main,title,text_longtitle,text_1";

  $out = "";

    $out .= "<div class='page-header-person header-pageperson pb-5 pb-lg-6' edit='$edit'>";
      $out .= "<div class='header-pageperson-container container-xxl'>";
        $out .= "<div class='header-pageperson-wrap row-wrap bg-lighter rounded'>";
          $out .= "<div class='header-pageperson-row row align-items-between'>";
          
            $out .= "<div class='header-pageperson-image-col col-lg text-end' data-aos='fade-up'>";
            if (isset($images) && count($images)) {
              $out .= image($images->first(), 500, 500, 1, null, "header-pageperson-image bg-white img-fluid rounded shadow rotate-cw-1 mb-n3 mt-3 max-w-90");
            }
            $out .= "</div>";
            
            $out .= "<div class='header-pageperson-content col-lg-6 d-flex flex-column justify-content-end'>";
              $out .= "<div class='header-pageperson-inner px-4 py-5 pb-lg-6' data-aos='fade-up' data-aos-delay='200'>";
                if (page()->parent()->id !== 1) {
                  $out .= "<a class='header-pageperson-category category-link d-inline-block my-3 text-uppercase' href='{$pageID->parent->url}'>{$pageID->parent->title}</a>";
                }
                $out .= "<h1 class='header-pageperson-title display-3 mb-4 mb-lg-5'>$firstName<br>$secondName $thirdName</h1>";
                $out .= "<div class='header-pageperson-position fs-4'>$position</div>";
              $out .= "</div>";
            $out .= "</div>";

          $out .= "</div>";
        $out .= "</div>";
      $out .= "</div>";
    $out .= "</div>";

  return $out;
}