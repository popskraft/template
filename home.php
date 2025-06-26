<?php

namespace ProcessWire;

// Add a class to the home page if the site is on the main domain
$homeClass = "py-5 mb-5 mb-xl-6 min-vh-20";
if (in_array('filipok.koriphey.ru', $config->httpHosts)) {
  $homeClass = "py-5 min-vh-20";
}
?>

<region pw-before="navbar">
  <?= image($siteImgs->getTag("home_background"), 2000, 700, null, null, "home-background img-full position-fixed min-vh-60 object-fit-cover object-position-left"); ?>
</region>

<div pw-prepend="main" class="home-site-header container-xxl d-flex align-items-center <?= $homeClass ?>">
  <div class="x-auto mx-auto max-w-lg-80 text-center" edit="<?= pages('/settings/') ?>.site_data">
    <h1 class="display-1 mb-4 mb-xl-5" data-aos='fade-up'><?= $siteData->siteName ?></h1>
    <div class="lead" data-aos='fade-up'><?= $siteData->description ?></div>
  </div>
</div>