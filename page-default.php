<?php

namespace ProcessWire; ?>
<region pw-prepend="main">
  <?php
  /**
   *  Page Header
   *  ========================================
   */

  // Color headline depends of settings of the paren category page
  $headlineColor = (isset(page()->blocks_color) && !page()->blocks_color->has(1)) ? page()->blocks_color : page()->parent->blocks_color;
  $headlineClass = (isset($headlineColor) && !$headlineColor->has(1)) ? "bg-{$headlineColor->value} text-white" : "";
  $sectionCaptionLinkClass = (isset($headlineColor) && !$headlineColor->has(1)) ? "text-{$headlineColor->value}" : "text-secondary";
  $leadClass = (isset($headlineColor) && !$headlineColor->has(1)) ? "text-{$headlineColor->value}" : "";

  $templatesForAlternate = [
    "page-jobs"
  ];
  if (in_array($page->template, $templatesForAlternate)) {
    echo pageHeader();
  } else if ($page->template == "page-person") {
    echo pageHeaderPerson();
  } else {
    echo pageHeaderSecondary("", $headlineClass, $sectionCaptionLinkClass, $leadClass);
  }
  ?>
</region>

<region pw-prepend="pageContent">
  <?php 
    /**
     *  Contacts
     *  ========================================
     */
    if (page()->template == "page-contacts") {
      echo sectionContactsFilipok();
    }
    /**
     *  Jobs
     *  ========================================
     */
    if (page()->template == "page-jobs") {
      echo sectionJobs();
    }

    /**
     *  Persones
     *  ========================================
     */
    if (page()->template == "page-person") {
      echo sectionPerson();
    }

    /**
     *  Search
     *  ========================================
     *  Check if the current page is named "search" If it is, include the search page template
     */
    if (page()->name == "search") {
      include "includes/search-page.php";
    }
  ?>
</region>

<region pw-append="mainContainer">
  <?php
  /**
   *  Downloads
   *  ========================================
   */
  $fileDownloads = page("file_downloads");
  if (isset($fileDownloads) && count($fileDownloads)) {
    echo "<div class='downloads pt-4 fs-3 mx-auto max-w-lg-80 max-w-xxl-60' edit='file_downloads'>";
      echo fileDownloads();
    echo "</div>";
  }

  /**
   *  Prev Next Links
   *  ========================================
   */
  $templatesForPrevnext = [
    "page-news",
  ];
  echo in_array($page->template, $templatesForPrevnext) ? prevNext() : "";
  ?>
</region>

<region pw-after="main">
  <?= rowCTALight() ?>
</region>