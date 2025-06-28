<?php namespace ProcessWire;

function blockFooter($pageID, $btnIsOff="", $btnClass="")
{
  $links = $pageID->blocks_links;

  $pageIdName = "block-{$pageID->blocks_type->value}-$pageID";
  $btnClass = $btnClass ?: "d-block text-center mt-4 mt-lg-5" ;
 
  $out = "";
    $out .= (!$btnIsOff) ? buttonGroup($links, $btnClass) : "" ;
    $out .= "</div>";
  $out .= "</div><!-- END $pageIdName -->";
  
  return $out;
}

