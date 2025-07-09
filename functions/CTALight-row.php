<?php namespace ProcessWire;
function rowCTALight(
  $blockID=null,
  $containerClass="", 
  $contentClass="", 
  $headerClass="",
  $rowClass="", 
  $imageClass=""
  ) {

  $settingsGlobal = pages("/settings/")->fieldset_cta;
  $settingsPage = page()->fieldset_cta;

  $containerClass = $containerClass ?: "mb-5 mb-lg-7";
  $contentClass = $contentClass ?: "max-w-lg-80 max-w-xxl-60 shadow bg-white border rounded overflow-hidden";
  $headerClass = $headerClass ?: "display-4 mb-3 text-primary";
  $rowClass = $rowClass ?: "align-items-end";
  
  $imageClass = $imageClass ?: "img-fluid";
  $images = $blockID ? $blockID->images_main : ($settingsPage && $settingsPage->images_main && count($settingsPage->images_main) ? $settingsPage->images_main : $settingsGlobal->images_main);
  $title = $blockID ? $blockID->text_longtitle : ($settingsPage && $settingsPage->text_1 ? $settingsPage->text_1 : $settingsGlobal->text_1);
  $summary = $blockID ? $blockID->text_summary : ($settingsPage && $settingsPage->text_summary ? $settingsPage->text_summary : $settingsGlobal->text_summary);
  $link = $settingsPage && $settingsPage->link ? $settingsPage->link : $settingsGlobal->link;
  $linkCaption = $settingsPage && $settingsPage->text_2 ? $settingsPage->text_2 : $settingsGlobal->text_2;

  // Определяем ссылку для изображения
  $imageLink = $blockID && $blockID->blocks_links && count($blockID->blocks_links) ? $blockID->blocks_links->first()->link : $link;

  $edit = $settingsPage ?: $settingsGlobal;
  $editBlock = $blockID ? "" :  "edit = '$edit.images_main,text_1,text_summary,link,text_2,check_off'";
  
  if ($blockID || ($settingsPage && !$settingsPage->check_off)) {

    $out = "<div class='CTAlight-row container-xxl $containerClass'>";
      $out .= "<div class='sectionContent mx-auto $contentClass' data-aos='zoom-in' $editBlock>";
        $out .= "<div class='row $rowClass'>";
        
          $out .= "<div class='col-lg d-flex align-items-end text-center' data-aos='fade-up' data-aos-delay='200'>";
            $out .= $imageLink ? "<a href='$imageLink'>" : "";
              $out .= image($images->first, null, 500, null, null, $imageClass);
            $out .= $imageLink ? "</a>" : "";
          $out .= "</div>";
          
          $out .= "<div class='col-12 col-lg-8 text-center text-lg-start'>";
            $out .= "<div class='content max-w-md-80 px-3 py-4 px-lg-4'>";
              
              // Output the title if available.
              $out .= $title ? "<div class='$headerClass' data-aos='zoom-in' data-aos-delay='400'>$title</div>" : "";

              // Output the summary if available.
              if ($summary) {
                $out .= "<div class='summary' data-aos='zoom-in' data-aos-delay='400'>";
                  $out .= $summary;
                $out .= "</div>";
              }

              // Output the links if available.
              if ($blockID) {
                foreach ($blockID->blocks_links as $link) {
                  $out .= "<a class='btn btn-lg btn-link mt-2 me-3' href='$link->link' data-aos='zoom-in' data-aos-delay='800'>$link->label</a>";
                }
              } else {
                // Output the link if available.
                $out .= $link ? "<a class='btn btn-lg btn-link mt-2' href='$link' data-aos='zoom-in' data-aos-delay='800'>$linkCaption</a>" : "";
              }
              
            $out .= "</div>";
          $out .= "</div>";

        $out .= "</div>";
      $out .= "</div>";
    $out .= "</div>";

    return $out;
  }
}