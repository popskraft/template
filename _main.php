<?php
// Optional main output file, called after rendering page’s template file. 
// This is defined by $config->appendTemplateFile in /site/config.php, and
// is typically used to define and output markup common among most pages.
// 	
// When the Markup Regions feature is used, template files can prepend, append,
// replace or delete any element defined here that has an "id" attribute. 
// https://processwire.com/docs/front-end/output/markup-regions/

namespace ProcessWire;

?>
<!DOCTYPE html>
<html class="smooth-scroll" lang="<?= $locale ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php

  echo $alternateLinks;

  /**
   *  Prefetched pages
   *  ========================================
   */
  $prefPages = [];
  foreach ($prefPages as $prefPage) {
    $prefPage = pages('/' . $prefPage . '/')->httpUrl;
    if (count($prefPages) && $prefPage) {
      echo "<link rel='prefetch' href='$prefPage' as='document'>";
    }
  }

  /**
   *  METADATA
   *  ========================================
   */
  echo $seoMaestro;
  echo $shortIcon;
  echo $appleIcon;

  include_once "includes/schemaOrg.JSON.php";

  ?>
  <link rel="stylesheet" type="text/css" href="<?= urls("templates") ?>dist/css/bootstrap.css?v=<?= time() ?>" media="all">
  <link rel="stylesheet" type="text/css" href="<?= urls("templates") ?>dist/css/bootstrap-nopurge.css?v=<?= time() ?>" media="all">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;700&display=swap" rel="stylesheet">
  <?= $siteCodeHeader ?>
</head>

<body class="template-<?= page("template") ?>">
  <?= $siteCodeBody ?>
  <nav id="navbar" class="navbar navbar-expand-lg trans py-lg-3 py-xl-4">
    <div class="container-xxl flex-wrap justify-content-center">

      <div class="mobile-top-nav d-flex d-lg-none justify-content-between w-100 mb-lg-4">
        <div class="mobile-left d-flex align-items-center">
          <?php
            // Преобразуем строку с телефонами в массив и используем только первый номер
            $phonesArray = fieldExplode($siteData->phone_main, "br");
            $firstPhone = trim($phonesArray[0] ?? '');
            if ($firstPhone) {
              echo icon('phone', 20, 'd-inline-flex rounded-circle border border-primary p-2 me-3', 'tel:' . preg_replace('/[^0-9,+]/', '', $firstPhone));
            }
          ?>
        </div>
        <div class="mobile-right d-flex align-items-center">
          <?php if ($siteData->ctaLink) echo button($siteData->ctaLink, $siteData->ctaCaption, 'text-uppercase btn btn-outline-secondary my-2 me-3', 'target=_blank') ?>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger">
              <i class="bg-secondary"></i>
              <i class="bg-secondary"></i>
              <i class="bg-secondary"></i>
            </span>
          </button>
        </div>
      </div>

      <?= logo("logo_main", "", "logo-menu img-fluid trans", "mt-3 mt-sm-0"); ?>

      <div class="collapse navbar-collapse flex-column justify-content-xl-end align-items-xl-end" id="navbarMain" edit="1043.menu_header">
        <ul class="navbar-nav py-5 py-lg-0 mb-lg-0 text-uppercase text-center text-lg-start order-last">
          <?= menuHeader($menuHeaderStructure, $menuHeader) ?>
        </ul>
        <div class="laptop-contacts d-flex flex-column flex-lg-row align-items-center py-2">
          <?= langSwitcher() ?>
          <div class="d-none d-lg-flex align-items-center">
            <?php if ($siteWhatsApp) echo icon('whatsapp', 20, 'd-none d-lg-inline-flex rounded-circle border text-success border-success p-2 mx-3', 'https://wa.me/' . $siteWhatsApp, "", "", caption('contactWhatsapp')); ?>
            <?php
              // Преобразуем строку с телефонами в массив и выводим только первый номер
              $phonesArray = fieldExplode($siteData->phone_main, "br");
              $firstPhone = trim($phonesArray[0] ?? '');
              if ($firstPhone) {
                echo phone($firstPhone, "text-secondary", 1, "border border-secondary rounded-circle p-2 me-2", 20);
              }
            ?>
            <?php if ($siteData->ctaLink) echo button($siteData->ctaLink, $siteData->ctaCaption, 'text-uppercase btn btn-outline-secondary my-2 ms-2', 'target=_blank') ?>
          </div>
          <div class="d-lg-none">
            <div class="mb-2">
              <?= iconCaption("mailto:" . $siteEmail, $siteEmail, "envelope-at", "", "rounded-circle text-dark me-2 p-2 border", 22) ?>
            </div>
            <?php if ($siteWhatsApp) { ?>
              <div class="mb-2">
                <?= iconCaption("https://wa.me/" . $siteWhatsApp, caption("contactWhatsapp"), "whatsapp", "", "rounded-circle me-2 p-2 border", 22) ?>
              </div>
            <?php } // END if siteWhatsApp 
            ?>
          </div>
        </div>
      </div>

    </div>
  </nav>


  <main id="main" class="<?= $page->template ?> mb-5 mb-xl-7">
    <div id="mainContainer" class='container-xxl pt-2 mb-4 mb-lg-6' pw-optional>
      <div id="pageContent" class="mx-auto max-w-lg-80" pw-optional></div>
      <div id="pageBody" class="txt markerlist fs-3 mx-auto max-w-lg-80 max-w-xxl-60" pw-optional>
        <?= page("text_body|text_body_light") ?>
      </div>
    </div>
    <div id="blocks">
      <?php
        echo blocks();
        echo blocks(page("blocks_selectblocks"));
      ?>
    </div>
  </main>

  <footer id="footer" class="footer position-relative overflow-hidden" edit="<?= pages('settings')->id ?>.menu_footer,menu_footer2,menu_footer3,site_data,site_texts">
    <div class="container-xxl">
      <div class="rounded-top-4 bg-primary inverse px-3 px-lg-5 px-xxl-6 pt-5 pt-xl-6 pb-5">
        <div class="row">

          <div class="footer-first-col col-12 col-lg pb-4">
            <div class="logoggroup ms-n2 mt-xl-n4 mb-3">
              <?= logo("logo_white", 0, 0, "logogroup-footer ms-lg-n3") ?>
            </div>
            
            <?php
              $sitePhones = $siteData->phone_main;
              if ($sitePhones) {
                // Преобразуем строку с телефонами в массив
                $phonesArray = fieldExplode($sitePhones, "br");
                
                echo "<div class='site-phones'>";
                  // Выводим каждый телефон через цикл foreach
                  foreach ($phonesArray as $phoneNumber) {
                    $phoneNumber = trim($phoneNumber); // Убираем лишние пробелы
                    if ($phoneNumber) { // Проверяем что номер не пустой
                      echo phone($phoneNumber, 'd-block text-primary mb-2 me-lg-3 fs-1 fs-sm-3', 1, 'rounded-circle me-2 p-2 border border-primary text-primary', 12);
                    }
                  }
                echo "</div>";
              }
            ?>

            <?php
              // if filipok.koriphey.ru, show branches
              if (in_array('filipok.koriphey.ru', $config->httpHosts)) {
                // If filipok.koriphey.ru
                $footerSecondColumnClass = "col-lg";
              } else {
                // default
                $footerSecondColumnClass = "col-lg-8";
              }

              if (page("template") != "page-contacts") {

                echo  "<div class='address-row row'>";

                // if filipok.koriphey.ru, show branches
                if (in_array('filipok.koriphey.ru', $config->httpHosts)) {  
                  echo sectionAddress(
                    null,
                    "col-12 col-lg", 
                    $siteData->branch_1_name,
                    $siteData->branch_1_email,
                    $siteData->branch_1_phone,
                    $siteData->branch_1_streetAddress,
                    $siteData->branch_1_address_map,
                  );
                    
                  echo sectionAddress(
                    null, 
                    "col-12 col-lg",
                    $siteData->branch_2_name,
                    $siteData->branch_2_email,
                    $siteData->branch_2_phone,
                    $siteData->branch_2_streetAddress,
                    $siteData->branch_2_address_map,
                  );
                }

                // show office address
                $mainOfficeTitle = $siteData->main_office_name ?: caption("address");
                echo sectionAddress(
                  null,
                  null,
                  $mainOfficeTitle
                );

                echo  "</div>";

              } // END if ?>
          </div>

          <div class="footer-second-col fs-5 <?= $footerSecondColumnClass ?>">
            <div class="row">

              <?php if ($menuFooter && count($menuFooter)) { ?>
              <div class="col pb-4">
                <nav>
                  <div class="display-5 mb-3"><?= caption("footer_col1_title") ?></div>
                  <?= menuFooter($menuFooterStructure, $menuFooter) ?>
                </nav>
              </div>
              <?php } ?>

              <?php if ($menuFooter2 && count($menuFooter2)) { ?>
              <div class="col">
                <nav>
                  <div class="display-5 mb-3"><?= caption("footer_col2_title") ?></div>
                  <?= menuFooter($menuFooterStructure2, $menuFooter2) ?>
                </nav>
              </div>
              <?php } ?>

              <?php if ($menuFooter3 && count($menuFooter3)) { ?>
              <div class="col">
                <div class="display-5 mb-3"><?= caption("footer_col3_title") ?></div>
                <?= menuFooter($menuFooterStructure3, $menuFooter3) ?>
                <?= socials($siteSettings->socials) ?>
              </div>
              <?php } ?>

              <div class="col-12 pb-5">

                <div class="divider border-top w-100 my-4"></div>

                <div class="footer-data fs-5">
                  © <?= date("Y"), " ", caption("copyright") ?><br>
                  <?= caption("privacy_policy") ?>&nbsp;<a class="fw-bold link text-nowrap" href="<?= pages("/privacy/")->url ?>"><?= pages("/privacy/")->title ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div id="mobileFooterNav" class="d-flex position-fixed zindex-min bottom-0 end-0 p-3 pb-4 trans">
    <?php
    // Преобразуем строку с телефонами в массив и используем только первый номер
    $phonesArray = fieldExplode($siteData->phone_main, "br");
    $firstPhone = trim($phonesArray[0] ?? '');
    if ($firstPhone) {
      echo icon("telephone", 20, "d-flex bg-light border border-primary rounded-circle p-3 text-primary m-1", 'tel:' . preg_replace('/[^0-9,+]/', '', $firstPhone));
    }
    echo icon("chat-dots", 20, "d-flex bg-light border border-primary rounded-circle p-3 text-primary m-1", 0, "data-bs-toggle='modal' data-bs-target='#contact'");
    echo icon("chevron-up", 20, "d-flex bg-light border border-primary rounded-circle p-3 text-primary m-1", 0, "id='scroll-to-top'");
    ?>
  </div>

  <?php if (page("template") !== "page-form") { ?>
    <div id="contact" class="modal fade" tabindex="-1" aria-labelledby="contactLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <div class="display-5" id="contactLabel"><?= caption("contact_title") ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="px-lg-6">
              <?php
              $contactForm = pages('/settings/')->codes->form_contact;
              echo $contactForm;
              ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link" data-bs-dismiss="modal"><?= caption("close") ?></button>
          </div>
        </div>
      </div>
    </div>
  <?php } // END if 
  ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>

  <script src="<?= urls("templates") ?>plugins/flickity/flickity.pkgd.min.js"></script>
  <script async src="<?= urls("templates") ?>plugins/spotlight/dist/spotlight.bundle.js"></script>
  <script src="<?= urls("templates") ?>plugins/aos/dist/aos.js"></script>
  <script src="<?= urls("templates") ?>dist/js/main-min.js?v=<?= time() ?>"></script>

  <script>
    // Initialize AOS after it's loaded
    document.addEventListener('DOMContentLoaded', function() {
      // Check if AOS is defined in the global scope
      if (typeof window.AOS !== 'undefined') {
        window.AOS.init({
          duration: 800,
          once: true,
          offset: 60
        });
      }
    });
  </script>

  <?php

  // Jquery For admin fronend editor + editor code
  if (page()->editable()) {
    include_once "includes/editor-code.php";
    echo "<script src='https://code.jquery.com/jquery-2.2.4.min.js' integrity='sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=' crossorigin='anonymous'></script>";
  }

  echo $siteCodeFooter;

  ?>

</body>

</html>