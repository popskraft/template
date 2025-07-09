<?php namespace ProcessWire;

function anonsNews($newsCategory, $anonsPage) 
{
  $news = $newsCategory->children();

  // Anons custom page data
  $anonsON =  $anonsPage->check_on;
  $anonsimages =  $anonsPage->images_main ?: "";
  $anonssectionTitle = $anonsPage->text_longtitle ?: "";
  $anonstitle =  $anonsPage->title ?: "";
  $anonssummary =  $anonsPage->text_summary ?: "";
  $anonslink =  $anonsPage->link ?: "";
  $anonslinkLabel =  $anonsPage->text_1 ?: caption("more");
  $anonsEdit = "edit='$anonsPage.check_on,images_main,title,text_longtitle,date_end,text_summary,link,text_1'";
  $anonsDate = ($anonsON && $anonsPage->date_end) ? $anonsPage->date_end  : $news->first()->date_start;
  
  $anonsClass = "mt-n5 mt-lg-n7 pb-5";
  if (in_array('filipok.koriphey.ru', wire('config')->httpHosts)) {
    $anonsClass = "pb-5";
  }

  // First news data fetched
  $firstNews = $news->first();
  $title = ($anonsON && $anonstitle) ? truncate($anonstitle, 48) : $firstNews->get("title|text_longtitle|title");
  $images = ($anonsON && count($anonsimages)) ? $anonsimages : $firstNews->images_main;
  $summary = ($anonsON && $anonssummary) ? truncate($anonssummary, 240) : $firstNews->summarize('text_summary|text_body_light|text_body', 240);
  
  $sectionTitle = $newsCategory->title;
  if ($anonsON && $anonssectionTitle) {
     $sectionTitle = $anonssectionTitle;
  } else if ($anonsON && $anonsPage->title) {
    $sectionTitle = $anonsPage->title;
  } else if
  ($anonsON && !$anonssectionTitle) {
    $sectionTitle = "";
  }
  $sectionTitleClass = ($anonsON && $anonssectionTitle) ? "display-3" : "display-2";

  $anonsURL = ($anonsON && $anonslink) ? $anonslink : $firstNews->url;

  $out = "";
  $out .= "<div class='anonsNews container-xxl $anonsClass' data-aos='fade-up' $anonsEdit>";
    $out .= "<div class='bg-lighter rounded-4'>";
      $out .= "<div class='row'>";
      
        $out .= "<div class='col-lg'>";
          $out .= "<a href='$anonsURL'>";
            $out .= image($images->first(), 768, floor(768 * .8), null, null, "anonsNews-img img-full rounded-4");
          $out .= "</a>";
        $out .= "</div>";
        
        $out .= "<div class='col-lg d-flex flex-column justify-content-between'>";
          
          $out .= "<div>";
            $out .= "<div class='$sectionTitleClass p-4 pt-lg-5 pb-3 px-lg-0 text-primary-dark'>$sectionTitle</div>";
            $out .= $anonsDate ? dateNorm($anonsDate, "", "d-block px-4 pb-3 px-lg-0 text-secondary", "", "display-1", "fs-2", "text-primary-dark ms-2") : "" ;
          $out .= "</div>";

          $out .= "<div class='header-content rotate-ccw-1 mb-n4 mt-lg-5 ms-lg-n7 ms-xl-n8 me-xl-6' data-aos='zoom-in'>";
              $out .= "<h2 class='display-3 mb-n1'><a href='$anonsURL' class='d-inline-block bg-secondary text-white p-3 py-lg-4 px-lg-5 rounded mb-n2'>$title</a></h2>";
              $out .= "<div class='p-4 p-lg-5 bg-white rounded shadow'>";
                $out .= "<div class='lead'>$summary</div>";
                if ($anonsON && $anonslink) {
                  $out .= button($anonslink, $anonslinkLabel, "btn btn-link fs-3 my-2");
                } else if ($anonsON && !$anonslink) {
                  $out .= "";
                } else {
                  $out .= button($anonsURL, caption("read_news"), "btn btn-link fs-3 my-2");
                }
              $out .= "</div>";
          $out .= "</div>";
        $out .= "</div>";

      $out .= "</div>";
    $out .= "</div>";
  $out .= "</div>";
  
  return $out;
}