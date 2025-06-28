<?php namespace ProcessWire;
function fileDownloads($files="", $downloadTitle="", $itemClass="", $titleClass = "")
{
  $files = $files ?: page("file_downloads");
  $itemClass = $itemClass ?: "my-1 p-3 border rounded";
  $titleClass = $titleClass ?: "display-4 my-4";
  $downloadTitle = $downloadTitle ?: caption("downloadTitle");

  $out = "";
  if (isset($files) && count($files)) {
    $out .= "<div class='filedownloads-row-title $titleClass'>$downloadTitle</div>";
    
    foreach ($files as $file) {
      $fileInfo = pathinfo($file);
      $fileType = $fileInfo['extension'];
      $fileDescription = $file->description ? $file->description : $file->name;
      $out .= "<div class='filedownloads-row-item dowload-item $itemClass'>";
        $out .= " <a class='filedownloads-row-link d-flex align-items-center fs-6 fs-lg-4 text-dark' download='$fileDescription' href='$file->url'>" . icon("download", 24, "filedownloads-row-icon d-inline-flex text-secondary me-3") . "<span class='filedownloads-row-text link'>{$fileDescription} ({$fileType})</span></a>";
      $out .= "</div>";
    }
  }
  return $out;
}
