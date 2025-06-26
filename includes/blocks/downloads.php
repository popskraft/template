<?php namespace ProcessWire;
echo blockHeader($bID);
echo "<div class='downloads mx-auto max-w-lg-60'>";
  echo fileDownloads($bID->file_downloads);
echo "</div>";
echo blockFooter($bID);