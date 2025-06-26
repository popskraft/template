<?php

namespace ProcessWire;

function sectionJobs($pageID = "")
{
  // Set default page ID
  $pageID = $pageID ?: page();

  // Fetch job details
  $jobs = $pageID->jobs_form;
  $jobsForm = pages("/settings/")->codes->form_jobs;
  $jobsFormOff = $pageID->check_off;

  // Helper function to clean up content
  $clean = fn($content) => str_replace(['<p>', '</p>'], '', $content);

  // Prepare job data
  $jobData = [
    'date' => dateNorm($pageID->date_start, "", "fs-3 text-dark"),
    'price' => ['label' => $jobs->label('price'), 'value' => $clean($jobs->price)],
    'ocupation' => ['label' => $jobs->label('ocupation'), 'value' => $clean($jobs->ocupation)],
    'experience' => ['label' => $jobs->label('experience'), 'value' => $clean($jobs->experience)],
    'responsibilities' => ['label' => $jobs->label('responsibilities'), 'value' => $jobs->responsibilities],
    'requirements' => ['label' => $jobs->label('requirements'), 'value' => $jobs->requirements],
    'conditions' => ['label' => $jobs->label('conditions'), 'value' => $jobs->conditions],
  ];

  // Start output buffer
  $out = "<div class='sectionJobs row fs-4' edit='check_off,title,text_summary,jobs_form'>";

    // Left column (sticky job details)
    $out .= "<div class='col-lg'>";
      $out .= "<div class='pb-4 sticky-top'>";
      $out .= "<div class='mb-4 mb-lg-5'>{$jobData['date']}</div>";

      foreach (['price', 'ocupation', 'experience'] as $key) {
        if ($jobData[$key]['value']) {
          $out .= "<div class='display-6 mb-1 text-dark'>{$jobData[$key]['label']}:</div>";
          $out .= "<div class='mb-3 pb-2 border-bottom'>{$jobData[$key]['value']}</div>";
        }
      }
      $out .= "</div>";
    $out .= "</div>";

    // Right column (job description)
    $out .= "<div class='col-lg-9'>";
    $out .= "<div class='txt markerlist'>";

    foreach (['responsibilities', 'requirements', 'conditions'] as $key) {
      if ($jobData[$key]['value']) {
        $out .= "<h2 class='display-5 mb-2 mb-lg-3'>{$jobData[$key]['label']}</h2>";
        $out .= "<div class='mb-4'>{$jobData[$key]['value']}</div>";
      }
    }

  $out .= "</div>";

  // Job form section
  if ($jobsForm && !$jobsFormOff) {
    $out .= "<div class='display-3 mt-6 mb-3'>" . caption('job_order_title') . "</div>";
    $out .= "<div class='sectionJobs-form overflow-hidden rounded shadow border border-teal bg-white'>";
    $out .= $jobsForm;
    $out .= "</div>";
  }

  $out .= "</div></div>"; // Close right column and main container

  return $out;
}
