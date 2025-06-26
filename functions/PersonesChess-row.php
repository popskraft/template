<?php namespace ProcessWire;

function rowPersonesChess($items)
{
  
  $out = "";
  $out .= "<div class='persones row'>";

  foreach ($items as $i => $item) {
    $persnURL = $item->url;
    $persnAnketa = $item->person_anketa;
    $persnName = "{$item->title}<br>{$item->text_longtitle} {$item->text_1}";
    $persnPosition = $persnAnketa->position;
    $persnImages = $item->images_main;

    $i = ++$i + 1;
    $contentClass = ($i % 4 == 0 || $i % 4 - 1 == 0) ?
      "order-lg-first align-items-lg-end text-lg-end" :
      "align-items-start";

    $out .= "<a class='persones-item d-block col-lg-6 pb-2 pb-lg-4' href='$persnURL'>";
      $out .= "<div class='row gx-4'>";

        $out .= "<div class='col'>";
          $out .= "<div class='border border-5 border-white rounded shadow bg-lighter'>";
            $out .= image($persnImages->first(),300, 300, null, null, 'img-full');
          $out .= "</div>";
        $out .= "</div>";

        $out .= "<div class='col-8 d-flex flex-column justify-content-end $contentClass'>";
          $out .= "<div class='py-4 max-w-xl-80'>";
            $out .= "<div class='display-6 mb-3'><span class='link'>$persnName</span></div>";
            if ($persnPosition) {
              $out .= "<div class='fs-6 fs-lg-4 text-gray'>";
                $out .= $persnPosition;
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
