<?php

namespace ProcessWire;

function calendar($headlineClass = "")
{
  // Fetch all child pages/events
  $events = page()->children();

  // Initialize an empty array to hold grouped events
  $groupedEvents = [];

  // Current timestamp
  $today = time();

  // Loop through each event to group them by 'Year-Month'
  foreach ($events as $event) {
    // Ensure the event has a start date
    if (!$event->date_start) continue;

    $eventDate = $event->date_start;

    // Filter out events that are older than yesterday
    if ($eventDate < ($today - 86400)) continue;

    // Get Year-Month in 'YYYY-MM' format using the actual event date
    $date = new \DateTime();
    $date->setTimestamp($eventDate);
    $yearMonth = $date->format('Y-m');

    // Initialize the array for this month-year if not already
    if (!isset($groupedEvents[$yearMonth])) {
      $groupedEvents[$yearMonth] = [];
    }

    // Add the event to the respective month-year group
    $groupedEvents[$yearMonth][] = $event;
  }

  // Sort the grouped events by Year-Month in ascending order
  ksort($groupedEvents);

  // Initialize the output variable
  $out = "";

  // Russian month names mapping
  $monthsRus = [
    "January" => "Январь",
    "February" => "Февраль",
    "March" => "Март",
    "April" => "Апрель",
    "May" => "Май",
    "June" => "Июнь",
    "July" => "Июль",
    "August" => "Август",
    "September" => "Сентябрь",
    "October" => "Октябрь",
    "November" => "Ноябрь",
    "December" => "Декабрь"
  ];

  // Function to determine the season class based on month number
  function getSeasonClass($monthNumber)
  {
    switch ($monthNumber) {
      case 9:
      case 10:
      case 11:
        return 'text-secondary'; // Autumn
      case 12:
      case 1:
      case 2:
        return 'text-info'; // Winter
      case 3:
      case 4:
      case 5:
        return 'text-success'; // Spring
      case 6:
      case 7:
      case 8:
        return 'text-primary'; // Summer
      default:
        return '';
    }
  }

  // Loop through each grouped month-year to generate HTML
  foreach ($groupedEvents as $yearMonth => $eventsInGroup) {
    // Reverse the events array to show newest first
    $eventsInGroup = array_reverse($eventsInGroup);

    // Create a DateTime object from 'YYYY-MM' using the actual event date
    $date = \DateTime::createFromFormat('!Y-m', $yearMonth);
    if (!$date) continue; // Skip if date creation fails

    // Get English month name
    $monthNameEn = $date->format('F');
    // Get Russian month name from mapping
    $monthRus = isset($monthsRus[$monthNameEn]) ? $monthsRus[$monthNameEn] : $monthNameEn;
    // Get year
    $year = $date->format('Y');

    // Determine the season class
    $monthNumber = (int)$date->format('n'); // 1 (for January) through 12 (for December)
    $seasonClass = getSeasonClass($monthNumber);

    // Combine month name and year
    $monthRusWithYear = "$monthRus <span class='fw-normal text-gray-light'>$year</span>";

    // Start building the HTML for this month-year group
    $out .= "<div class='divider border-top'></div>";
    $out .= "<div class='calendar-row row $headlineClass'>";
      $out .= "<div class='col-lg-5 pt-4'>";
        // Apply the season class dynamically
        $out .= "<div class='month-year display-4 text-lg-end $seasonClass'>$monthRusWithYear</div>";
      $out .= "</div>";

      $out .= "<div class='col-lg-7 py-4 border-start-lg'>";

      foreach ($eventsInGroup as $event) {
        // Sanitize event data to prevent XSS
        $eventUrl = htmlspecialchars($event->url, ENT_QUOTES, 'UTF-8');
        $eventName = htmlspecialchars($event->title, ENT_QUOTES, 'UTF-8');
        $eventTextSummary = htmlspecialchars($event->text_summary, ENT_QUOTES, 'UTF-8');
        $eventText = htmlspecialchars($event->text_body_light, ENT_QUOTES, 'UTF-8');
        $eventDate = $event->date_start;

        // Format the event date using dateNorm
        $formattedDate = dateNorm($eventDate, 0, "", 1, "fs-xl-2 lh-1", "fs-xl-3 text-gray-light", "fs-xl-3");

        // Append the event HTML
        $out .= "<div class='calendar-data-item d-flex flex-column flex-sm-row flex-wrap align-items-start mb-2 ps-3'>";
        $out .= $formattedDate;
        if ($eventTextSummary || $eventText) {
          $out .= "<a class='link fw-bold fs-xl-3' href='$eventUrl'>$eventName</a>";
        } else {
          $out .= "<span class='fs-xl-3 fw-bold text-dark'>$eventName</span>";
        }
        $out .= "</div>";
      }

      $out .= "</div>";
    $out .= "</div>";
  }

  return $out;
}
