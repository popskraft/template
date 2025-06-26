<?php namespace ProcessWire; ?>
<?php 
  /**
   *  Шаблон страницы второго уровня
   *  ========================================
   */
  if (page()->template() == "page-documents") { ?>
    <main id="main" class="category-documents container-xxl pb-5 pb-xl-7">
      <div class="mx-auto max-w-lg-80 max-w-xxl-60">
        
        <?= breadcrumb("mb-4") ?>
        
        <h1 class="display-2 text-uppercase"><?= page()->title ?></h1>
        
        <ol class="numlist">
          <?php foreach (page()->children() as $child) { ?>
          <li>
            <a class="link" href="<?= $child->url ?>"><?= $child->title ?></a>
          </li>
          <?php } //END foreach $child ?>
        </ol>
        
        <?php if (page("text_body")) { ?>
          <div class="txt markerlist pt-3">
            <?= page("text_body") ?>
          </div>
        <?php } // END if text body ?>
        
        <?php
          $fileDownloads = page("file_downloads");
          if ($fileDownloads != null && count($fileDownloads)) { ?>
          <div class="display-5 mt-4 mt-lg-5 mb-3"><?= caption("downloadTitle") ?></div>
          <?php 
            foreach ($fileDownloads as $file) { ?>
            <div class="dowload-item d-flex align-items-center py-2 border-bottom">
              <?= icon("download", 18) ?> <a class="ms-3 fs-xs-sm" download="<?= $file->description; ?>" href="<?= $file->url; ?>"><?= $file->description; ?></a>
            </div>
          <?php } ?>
        <?php } // END file downloads ?>

    </div>
  </main>
  
  <?php } else {
    /**
     *  Шаблон страницы первого уровня
     *  ========================================
     */
  ?>

  <main id="main" class="category-documents container-xxl t py-5 pb-xl-7">
    <?= breadcrumb("mb-4") ?>
    <div class="mx-auto max-w-lg-60">
      
      <h1 class="display-2 text-uppercase"><?= page()->title ?></h1>
      
      <ol class="numlist">
      <?php foreach (page()->children() as $child) { ?>
        <li>
          <a class="link text-primary" href="<?= $child->url ?>"><?= $child->title ?></a>
          <?php $subChildren = $child->children();
          if (count($subChildren)) { ?>
            <ul class="markerlist">
              <?php foreach ($subChildren as $subChild) { ?>
                <li>
                  <a class="link text-primary" href="<?= $subChild->url ?>"><?= $subChild->title ?></a>
                </li>
              <?php } // END foreach $subChildren ?>
            </ul>
          <?php } // END if $subChildren ?>
        </li>
      <?php } //END foreach ?>
      </ol>
      
    </div>
    
    <?php if (page("text_body_light")) { ?>
    <div class="txt markerlist pt-3">
      <?= page("text_body_light") ?>
    </div>
    <?php } // END if ?>

  </main>
<?php } // END if ?>