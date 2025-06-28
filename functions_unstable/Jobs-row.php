<?php
namespace ProcessWire;

function rowJobs($items)
{
  $out = "";
  $out .= "<div class='jobs-row rowJobs mb-6'>";

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

    $out .= "<div class='jobs-row-item rowJobs-item mb-4 rounded border border-primary bg-white shadow p-3 py-4 p-md-5 mx-auto max-w-lg-80 max-w-xxl-60' edit='$item.title,text_summary,jobs_form>";
      $out .= "<div class='jobs-row-inner row'>";
        
        $out .= "<div class='jobs-row-content col-md-9 order-last'>";
          $out .= "<h2 class='jobs-row-title display-4 mb-2'><a class='jobs-row-title-link link text-dark' href='$url'>$title</a></h2>";
          $out .= "<div class='jobs-row-summary summary pb-3 mb-3 border-bottom'>";
            $out .= $summary;
          $out .= "</div>";
          $out .= "<div class='jobs-row-options options'>";
            $out .= $jobsPrice ? "<div class='jobs-row-price mb-1'><span class='fw-bold text-dark'>$jobsPriceLabel:</span> $jobsPrice</div>" : "";
            $out .= $jobsOcupation ? "<div class='jobs-row-occupation mb-1'><span class='fw-bold text-dark'>$jobsOcupationLabel:</span> $jobsOcupation</div>" : "";
            $out .= $jobsExperience ? "<div class='jobs-row-experience mb-1'><span class='fw-bold text-dark'>$jobsExperienceLabel:</span> $jobsExperience</div>" : "";
          $out .= "</div>";
          $out .= button($url, caption('see_job'), "jobs-row-button btn btn-link my-2");
        $out .= "</div>";

        $out .= "<div class='jobs-row-date-col col-md'>";
          $out .= "<div class='jobs-row-date-wrapper ps-sm-4 ps-md-0 pb-3'>";
            $out .= "<div class='jobs-row-date mb-2 fs-3 text-primary'>" . dateNorm($date). "</div>"; 
          $out .= "</div>";
        $out .= "</div>";
        
      $out .= "</div>";
    $out .= "</div>";
  }
  $out .= "</div>";

  return $out;
}