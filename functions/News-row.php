<?php
namespace ProcessWire;

function rowNews($items, $colClass = "")
{

  $out = "";
  $out .= "<div class='row g-4'>";

  foreach ($items as $i => $item) {
    $title = $item->title;
    $summary = $item->summarize('text_summary|text_body_light|text_body', 200);

    (int) $i++;

    $out .= "<div class='col-12 col-md-4 mb-3 $colClass' edit='$item->id.title,images_main' data-aos='zoom-in'>";
      $out .= "<a class='text-dark' href='$item->url' title='$item->title'>";
          $out .= image($item->images_main->first, 560, 560, null, null, "img-fluid rounded ms-n2 ms-lg-0 max-w-70", 1);
          $out .= "<div class='position-relative p-3 p-lg-4 p-xl-5 mt-n4 mt-xl-n6 mb-n2 mb-lg-4 ms-md-2 ms-xxl-5 bg-white rounded shadow'>";
            $out .= "<h2 class='display-5 mb-2 mb-sm-4'>";
              $out .= "<span class='link'>$title</span>";
            $out .= "</h2>";
            $out .= "<div class='summary fs-5 fs-lg-4  text-gray'>";
              $out .= dateNorm($item->date_start, "", "text-secondary");
              $out .= $summary;
            $out .= "</div>";
          $out .= "</div>";
      $out .= "</a>";
    $out .= "</div>";
  }

  $out .= "</div>";

  return $out;
}
