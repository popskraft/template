<?php namespace ProcessWire;

function rowServices(
  $items, 
  $rowClass="", 
  $contentClass="",
  $w="", 
  $h=""
  ) 
{
  $out = "";
  $i = 0;
  foreach ($items as $item) {
    $title  = $item->text_longtitle;
    $summary = $item->text_body_light;
    $img = $item->images_main;
    $link = $item->link;
    $linkLabel = $item->text_1;
    $swap = $item->check_on;

    $rowClass = $rowClass ?: "gx-0 mb-4 mb-xl-6 border-bottom max-w-xl-80 mx-auto";
    $contentClass = $contentClass ?: "py-4 py-md-5";
    
    $colContentClass = $swap ? " ps-lg-6" : " pe-lg-5";
    $colImgClass = !$swap ? " order-md-last": "";
    
    $w = $w ?: 600;
    $h = 0; // $h ?: floor($w * .75);
    $i = $i+1;
  
  $out .= "<div class='rowServices-$i row $rowClass' edit='$item->id.text_longtitle,check_on,images_main,text_body_light,link,text_1' data-aos='zoom-in'>";

    $out .= "<div class='col-md text-end $colImgClass'>";
      $out .= $link ? "<a href='$item->url'>" : "" ;
        $out .= image($img->first(), $w, $h, null, null, "img-full rounded mb-n2 mb-xl-n3 sticky-top max-w-70 max-w-md-100", null, $item->text_longtitle);
      $out .= $link ? "</a>" : "" ;
    $out .= "</div>";
    
    $out .= "<div class='col-md-7 d-flex align-items-center $colContentClass'>";
      $out .= "<div class='content $contentClass'>";
        $out .= "<h2 class='display-3 mb-3 lh-sm'>";
          $out .= $link ? "<a href='$item->url' class='link text-gray-dark'>" : "" ;
            $out .= $title;
          $out .= $link ? "</a>" : "" ;
        $out .= "</h2>";
        $out .= "<div class='summmary fs-xxl-3'>$summary</div>";
        $out .= $link && $linkLabel ? button($link, $linkLabel, 'btn btn-link') : "" ;
      $out .= "</div>";
    $out .= "</div>";
  $out .= "</div>";
  }

  return $out;
}