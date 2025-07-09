<?php namespace ProcessWire;
echo blockHeader($blockID, null, "baner", true);
echo rowCTALight(
  $blockID, 
  "mb-1 mt-n3", 
  "max-w-lg-80 max-w-xxl-60 shadow bg-white border border-2 border-primary rounded overflow-hidden mt-lg-n3", 
  "display-3 mb-2 text-primary", 
  "align-items-center",
  "img-fluid max-w-70 max-w-md-100"
);
echo blockFooter($blockID, true);