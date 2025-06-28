<?php namespace ProcessWire;
echo blockHeader($blockId);
echo "<div class='downloads mx-auto max-w-lg-60'>";
  echo fileDownloads($blockId->file_downloads);
echo "</div>";
echo blockFooter($blockId);