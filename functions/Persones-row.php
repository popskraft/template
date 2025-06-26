<?php namespace ProcessWire;

function rowPersones($items, $rowClass="", $w=229)
{
  $rowClass = $rowClass ?: "g-2 row-cols-2 ";
  $out = "";
  $out .= "<div class='rowPersones row mb-4 mb-lg-6 $rowClass'>";

  foreach ($items as $item) {
    $persnURL = $item->url;
    $persnAnketa = $item->person_anketa;
    // Проверяем, активен ли английский язык
    $persnOtchectvo = user()->language->name == "en" ? "" : $item->text_1;
    $persnName = "{$item->title}<br>{$item->text_longtitle} $persnOtchectvo";
    $persnPosition = $persnAnketa->position;
    $persnImages = $item->images_main;

    if (count($persnImages)) {
      $out .= "<div class='persones-item col mb-3 mb-lg-5' edit='$item.title,text_longtitle,text_1,images_main,people_whois,person_anketa'>";
        $out .= "<div class='row gx-3 gx-lg-4 align-items-end'>";

          $out .= "<div class='col'>";
            $out .= "<a class='d-block' href='$persnURL' data-aos='zoom-in' data-aos-delay='200'>";
              $out .= image($persnImages->first(),$w, $w, 1, null, "img-fluid rounded bg-lighter");
            $out .= "</a>";
          $out .= "</div>";

          $out .= "<div class='col-lg-7'>";
            $out .= "<div class='max-w-xl-80' data-aos='fade-up' data-aos-delay='400'>";
              $out .= "<div class='fs-5 fw-bold lh-sm mt-3 mb-2'><a class='link' href='$persnURL'>$persnName</a></div>";
              if ($persnPosition) {
                $out .= "<div class='fs-6 text-gray lh-sm'>";
                  $out .= $persnPosition;
                $out .= "</div>";
              }
            $out .= "</div>";
          $out .= "</div>";
          
        $out .= "</div>";
      $out .= "</div>";
    }
  }

  $out .= "</div>";

  return $out;
}
