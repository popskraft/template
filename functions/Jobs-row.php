<?php
namespace ProcessWire;

function rowJobs($items)
{
  $out = "";
  $out .= "<div class='rowJobs mb-6'>";

  foreach ($items as $item) {
    $title = $item->title;
    $date = $item->date_start;
    $summary = $item->text_summary;
    $jobs = $item->jobs_form;
      $jobsPrice = str_replace(['<p>', '</p>'], '', $jobs->price);
      $jobsPriceLabel = $jobs->label('price');
      $jobsOcupation = str_replace(['<p>', '</p>'], '', $jobs->ocupation);
      $jobsOcupationLabel = $jobs->label('ocupation');
      $jobsExperience = str_replace(['<p>', '</p>'], '', $jobs->experience);
      $jobsExperienceLabel = $jobs->label('experience');
    $url = $item->url;

    $out .= "<div class='rowJobs-item mb-4 rounded border border-primary bg-white shadow p-3 py-4 p-md-5 mx-auto max-w-lg-80 max-w-xxl-60' edit='$item.title,text_summary,jobs_form>";
      $out .= "<div class='row'>";
        
        $out .= "<div class='col-md-9 order-last'>";
          $out .= "<h2 class='display-4 mb-2'><a class='link text-dark' href='$url'>$title</a></h2>";
          $out .= "<div class='summary pb-3 mb-3 border-bottom'>";
            $out .= $summary;
          $out .= "</div>";
          $out .= "<div class='options'>";
            $out .= $jobsPrice ? "<div class='mb-1'><span class='fw-bold text-dark'>$jobsPriceLabel:</span> $jobsPrice</div>" : "";
            $out .= $jobsOcupation ? "<div class='mb-1'><span class='fw-bold text-dark'>$jobsOcupationLabel:</span> $jobsOcupation</div>" : "";
            $out .= $jobsExperience ? "<div class='mb-1'><span class='fw-bold text-dark'>$jobsExperienceLabel:</span> $jobsExperience</div>" : "";
          $out .= "</div>";
          $out .= button($url, caption('see_job'), "btn btn-link my-2");
        $out .= "</div>";

        $out .= "<div class='col-md'>";
          $out .= "<div class='ps-sm-4 ps-md-0 pb-3'>";
            $out .= "<div class='mb-2 fs-3 text-primary'>" . dateNorm($date). "</div>"; 
          $out .= "</div>";
        $out .= "</div>";
        
      $out .= "</div>";
    $out .= "</div>";
  }
  $out .= "</div>";

  return $out;
}