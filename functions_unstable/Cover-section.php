<?php namespace ProcessWire;

function sectionCover(
  $pageID,
  $imagesMain="",
  $videoFile="",
  $textLongtitle="", 
  $textSummary="",
  $links=""
) {
  global $config;
  $imagesMain = $imagesMain ?: $pageID->images_main;
  $videoFile = $videoFile ?: $pageID->video;
  $textLongtitle = $textLongtitle ?: $pageID->get("text_longtitle|title");
  $textSummary = $textSummary ?: $pageID->text_summary;
  $links = $links ?: $pageID->blocks_links;
  
  $out = "";

  if ($videoFile) {
    // Video
    $poster = (count($imagesMain)) ? $imagesMain->first->size(1600,900,60)->url : "" ;
    $poster = $poster ? "poster='$poster'" : "" ; // Corrected the poster attribute syntax
    $out .= "<div class='sectionCover-video cover-section-video position-relative overflow-hidden min-vh-40 min-vh-sm-90 bg-lighter rounded-4' data-aos='fade-up' data-aos-duration='1600'>";
      $out .= "<video class='cover-section-video-element position-absolute w-100 h-100 top-0 left-0 object-fit-cover' width='1920' height='1080' playsinline autoplay muted loop $poster><source src='{$videoFile->url}' type='video/mp4'></video>";
    $out .= "</div>";
  } else {
    // Images
    if (in_array('filipok.koriphey.ru', $config->httpHosts)) {
      // Filipok site specific parameters
      $out .= imageSlider($imagesMain, "sectionCover-image cover-section-image min-vh-40 min-vh-sm-60 rounded-4", null, 900, "cover-section-image-element position-absolute w-100 h-100 top-0 left-0 object-fit-scale");
    } else {
      // Default parameters for other sites
      $out .= imageSlider($imagesMain, "sectionCover-image cover-section-image min-vh-60 min-vh-sm-80 overflow-hidden rounded-4");
    }
  }

  // News anons
  if ($textLongtitle || $textSummary) {
    $out .= anonsNews(pages("/news/"), pages("/anons-home/"));
  }

  // News listing
  $newsSlice = (pages("/anons-home/")->check_on) ? 0 : 1 ; // if anons on, add first news, else skip first news
  $newsLimit = (pages("/anons-home/")->check_on) ? 3 : 4 ; // if anons on, add first 3 news, else add first 4 news : 3 + 1 more for anons news
  if (!pages("/settings/")->options_site->has(3)) {
    $out .= "<div class='sectionCover-news cover-section-news container-xxl mt-4 mt-lg-6'>";
      $out .=  rowNews(pages("/news/")->children("limit=$newsLimit")->slice($newsSlice));
    $out .= "</div>";
  }

  return $out;
}
