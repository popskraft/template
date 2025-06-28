<?php namespace ProcessWire;

function rowPersonesChess($items)
{
  
  $out = "";
  $out .= "<div class='personeschess-row persones row'>";

  foreach ($items as $i => $item) {
    $personUrl = $item->url;
    $personAnketa = $item->person_anketa;
    $personName = "{$item->title}<br>{$item->text_longtitle} {$item->text_1}";
    $personPosition = $personAnketa->position;
    $personImages = $item->images_main;

    $i = ++$i + 1;
    $contentClass = ($i % 4 == 0 || $i % 4 - 1 == 0) ?
      "order-lg-first align-items-lg-end text-lg-end" :
      "align-items-start";

    $out .= "<a class='personeschess-row-item persones-item d-block col-lg-6 pb-2 pb-lg-4' href='$personUrl'>";
      $out .= "<div class='row gx-4'>";

        $out .= "<div class='personeschess-row-image-col col'>";
          $out .= "<div class='personeschess-row-image-wrapper border border-5 border-white rounded shadow bg-lighter'>";
            $out .= image($personImages->first(),300, 300, null, null, 'personeschess-row-image img-full');
          $out .= "</div>";
        $out .= "</div>";

        $out .= "<div class='personeschess-row-content-col col-8 d-flex flex-column justify-content-end $contentClass'>";
          $out .= "<div class='personeschess-row-content py-4 max-w-xl-80'>";
            $out .= "<div class='personeschess-row-name display-6 mb-3'><span class='personeschess-row-link link'>$personName</span></div>";
            if ($personPosition) {
              $out .= "<div class='personeschess-row-position fs-6 fs-lg-4 text-gray'>";
                $out .= $personPosition;
              $out .= "</div>";
            }
          $out .= "</div>";
        $out .= "</div>";
        
      $out .= "</div>";
    $out .= "</a>";
  }

  $out .= "</div>";

  return $out;
}
