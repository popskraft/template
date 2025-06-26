<?php
namespace ProcessWire; ?>
<region pw-prepend="main">
  <?php
    $headlineColor = page("blocks_color");
    $headlineClass = (isset($headlineColor) && !$headlineColor->has(1)) ? "bg-{$headlineColor->value} text-white" : "";
    
    // Set the source for the page header. If the page template is "category-news", use the first child of the page as the header source.
    if ($page->template == "category-news") {
      echo sectionNewsHeader($page->children()->first());
    } else {
      echo pageHeaderSecondary("", $headlineClass);
    }
  ?>
</region>
<region pw-prepend="mainContainer">
  <?php
  /**
   *  Calendar
   *  ========================================
   */
  if (page()->template == "category-calendar") {
    echo calendar("", $headlineClass);
  }

  /**
   *  FAQ
   *  ========================================
   */
  if (page()->template == "category-faq") {
    echo rowFAQ($page->faq_section);
  }

  /**
   *  Jobs
   *  ========================================
   */
  if (page()->template == "category-jobs") {
    echo rowJobs(page()->children());
  }

  /**
   *  Infoblocks
   *  ========================================
   */
  // $categoryListing = page()->children();
  $categoryListing = page("page_infoblocks");
  if (page("template") == "category-default") {
    echo rowServices($categoryListing);
  }

  /**
   *  News
   *  ========================================
   */
  if (page()->template == "category-news") {
    echo rowNews(page()->children("limit=24")->slice(1));
  }

  /**
   *  Persons / Staff
   *  ========================================
   */
  $positionID = $fields->get('people_whois');
  $positions = $positionID->type->getOptions($positionID);

  if (page()->template == "category-persones") {
    echo sectionStaff(pages("team")->children(), $positions);
  }
?>
</region>