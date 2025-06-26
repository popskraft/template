<?php namespace ProcessWire;
function sectionNewsHeader($pageID="") {
  $pageID = $pageID ?: page();
  $title = $pageID->get("title|text_longtitle|title");
  $images = $pageID->get("images_main");
  $summary = $pageID->summarize('text_summary|text_body_light|text_body', 240);
  $sectionTitle = page()->title;

  $out = "";

    $out .= "<div class='sectionNews mb-6 mb-lg-7'>";
      $out .= "<div class='container-xxl' edit='title,text_longtitle'>";
        $out .= "<div class='bg-lighter rounded'>";
          $out .= "<div class='row'>";
            $out .= "<div class='col-lg'>";
              $out .= "<a href='$pageID->url'>";
                $out .= image($images->first(), 768, floor(768 * .8), null, null, "anonsNews-img img-full rounded");
              $out .= "</a>";
            $out .= "</div>";
            $out .= "<div class='col-lg d-flex flex-column justify-content-end'>";

                $out .= "<div class='display-1 pt-4 pt-lg-5 pb-3 px-lg-0'>$sectionTitle</div>";
                
                $out .= "<div class='header-content rotate-ccw-1 mb-n4 mt-lg-5 ms-lg-n7 ms-xl-n8 me-4 me-xl-6'>";
                  $out .= "<h1 class='display-3 mb-n1'><a href='$pageID->url' class='d-inline-block bg-secondary text-white p-3 px-5 rounded mb-n2'>$title</a></h1>";
                  $out .= "<div class='fs-4 fs-xxl-3 p-5 px-xl-6 bg-white rounded shadow'>";
                    $out .= "<div>" . dateNorm($pageID->date_start, "", "text-secondary") . $summary . "</div>";
                    $out .= button($pageID->url, caption("read_news"), "btn btn-link fs-3 my-2");
                  $out .= "</div>";
                $out .= "</div>";
                
            $out .= "</div>";
          $out .= "</div>";
        $out .= "</div>";
      $out .= "</div>";
    $out .= "</div>";

  return $out;
}