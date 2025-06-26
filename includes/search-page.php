<?php  namespace ProcessWire;
  function renderList(PageArray $items) {

    // $out is where we store the markup we are creating in this function
    $output = "";

    // cycle through all the items
    if (isset($items) && count($items)) {
      foreach($items as $item) {
        
        $output .= "
          <a class='d-block py-1 border-bottom' href='{$item->url}'>
            <span class='link'>{$item->text_longtitle_OR_title}</span>&emsp;
            <span class='text-primary fs-xsm text-uppercase'>{$item->parent()->text_longtitle_OR_title}</span>
          </a>
        ";
      }
    }
    return $output;
  } 

  // look for a GET variable named 'q' and sanitize it
  $q = $sanitizer->text($input->get->q); 

  // did $q have anything in it?
  if($q) { 
    // Send our sanitized query 'q' variable to the whitelist where it will be
    // picked up and echoed in the search box by _main.php file. Now we could just use
    // another variable initialized in _init.php for this, but it's a best practice
    // to use this whitelist s ince it can be read by other modules. That becomes 
    // valuable when it comes to things like pagination. 
    $input->whitelist("q", $q); 

    // Sanitize for placement within a selector string. This is important for any 
    // values that you plan to bundle in a selector string like we are doing here.
    $q = $sanitizer->selectorValue($q); 

    $limit = 90;
    $selectorAll = "template=page-news|page-articles|page-default|page-review|page-product|page-testimonial|page-case|page-event, title|text_longtitle|text_summary|text_body|text_body_light~|%=$q, sort=-sort, limit=$limit"; 

    // If user has access to admin pages, lets exclude them from the search results.
    // Note that 2 is the ID of the admin page, so this excludes all results that have
    // that page as one of the parents/ancestors. This isn't necessary if the user 
    // doesn't have access to view admin pages. So it's not technically necessary to
    // have this here, but we thought it might be a good way to introduce has_parent.
    if($user->isLoggedin()) {
      $selectorAll .= ", has_parent!=2";  
    }

    // Find pages that match the selector
    $items = $pages->findMany($selectorAll); 

    // did we find any matches?
    $content = "";

    if($items->count) {
      $content .= "<h3 class='mt-4'>" . caption("search_result") . "</h3>";
      $content .= renderList($items);
    } else {
      // we didn't find any
      $content = "<h3>" . caption("search_notfind") . "</h3>";
    }

  } else {
    // no search terms provided
    $content = "<h4>" . caption("search_wright") . "</h4>";
  }
?>
<?php include "includes/search-form.php" ?>
<div class="search-result pt-3">
  <?= $content ?>
</div>