<?php namespace ProcessWire;
echo blockHeader($blockID);
echo "<div class='downloads mx-auto max-w-lg-60'>";
  echo fileDownloads($blockID->file_downloads);
echo "</div>";
echo blockFooter($blockID);