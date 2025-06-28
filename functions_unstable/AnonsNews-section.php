<?php namespace ProcessWire;

function anonsNews($newsCategory, $anonsPage) 
{
  $news = $newsCategory->children();

  // Anons custom page data
  $anonsOn = $anonsPage->check_on;
  $anonsImages = $anonsPage->images_main ?: "";
  $anonsSectionTitle = $anonsPage->text_longtitle ?: "";
  $anonsTitle = $anonsPage->title ?: "";
  $anonsSummary = $anonsPage->text_summary ?: "";
  $anonsLink = $anonsPage->link ?: "";
  $anonsLinkLabel = $anonsPage->text_1 ?: caption("more");
  $anonsEdit = "edit='$anonsPage.check_on,images_main,title,text_longtitle,date_end,text_summary,link,text_1'";
  $anonsDate = ($anonsOn && $anonsPage->date_end) ? $anonsPage->date_end : $news->first()->date_start;

  // First news data fetched
  $firstNews = $news->first();
  $title = ($anonsOn && $anonsTitle) ? truncate($anonsTitle, 48) : $firstNews->get("title|text_longtitle|title");
  $images = ($anonsOn && count($anonsImages)) ? $anonsImages : $firstNews->images_main;
  $summary = ($anonsOn && $anonsSummary) ? truncate($anonsSummary, 240) : $firstNews->summarize('text_summary|text_body_light|text_body', 240);
  
  $sectionTitle = $newsCategory->title;
  if ($anonsOn && $anonsSectionTitle) {
     $sectionTitle = $anonsSectionTitle;
  } else if ($anonsOn && !$anonsSectionTitle) {
    $sectionTitle = "";
  }
  $sectionTitleClass = ($anonsOn && $anonsSectionTitle) ? "display-3" : "display-2";

  $anonsUrl = ($anonsOn && $anonsLink) ? $anonsLink : $firstNews->url;

  $out = "";
  $out .= "<div class='anonsNews-section container-xxl mt-n5 mt-lg-n7 pb-5' data-aos='fade-up' $anonsEdit>";
    $out .= "<div class='anonsNews-section-bg bg-lighter rounded-4'>";
      $out .= "<div class='anonsNews-section-row row'>";
      
        $out .= "<div class='anonsNews-section-col col-lg'>";
          $out .= "<a href='$anonsUrl'>";
            $out .= image($images->first(), 768, floor(768 * .8), null, null, "anonsNews-section-img img-full rounded-4");
          $out .= "</a>";
        $out .= "</div>";
        
        $out .= "<div class='anonsNews-section-content col-lg d-flex flex-column justify-content-between'>";
          
          $out .= "<div class='anonsNews-section-header'>";
            $out .= "<div class='anonsNews-section-title $sectionTitleClass p-4 pt-lg-5 pb-3 px-lg-0 text-primary-dark'>$sectionTitle</div>";
            $out .= $anonsDate ? dateNorm($anonsDate, "", "anonsNews-section-date d-block px-4 pb-3 px-lg-0 text-secondary", "", "display-1", "fs-2", "text-primary-dark ms-2") : "" ;
          $out .= "</div>";

          $out .= "<div class='anonsNews-section-body header-content rotate-ccw-1 mb-n4 mt-lg-5 ms-lg-n7 ms-xl-n8 me-xl-6' data-aos='zoom-in'>";
              $out .= "<h2 class='anonsNews-section-heading display-3 mb-n1'><a href='$anonsUrl' class='d-inline-block bg-secondary text-white p-3 py-lg-4 px-lg-5 rounded mb-n2'>$title</a></h2>";
              $out .= "<div class='anonsNews-section-card p-4 p-lg-5 bg-white rounded shadow'>";
                $out .= "<div class='anonsNews-section-summary lead'>$summary</div>";
                if ($anonsOn && $anonsLink) {
                  $out .= button($anonsLink, $anonsLinkLabel, "btn btn-link fs-3 my-2");
                } else if ($anonsOn && !$anonsLink) {
                  $out .= "";
                } else {
                  $out .= button($anonsUrl, caption("read_news"), "btn btn-link fs-3 my-2");
                }
              $out .= "</div>";
          $out .= "</div>";
        $out .= "</div>";

      $out .= "</div>";
    $out .= "</div>";
  $out .= "</div>";
  
  return $out;
}