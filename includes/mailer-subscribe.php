<?php namespace ProcessWire; ?>
<div class="mailer-subscribe container-xxl my-5 mt-xl-6">
  <div class="text-center py-lg-3">
    <div class="display-4 text-dark mb-3 mb-lg-4"><?= caption("mailer_subscribe_title") ?></div>
    <div class="summary mb-4">
     <?= caption("mailer_subscribe_summary") ?>
    </div>
    <div class="form-email-subscribe max-w-lg-30 mx-auto">
      <form>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Your email" aria-label="Your email"
            aria-describedby="emailSubscribe">
          <button class="btn btn-primary" type="button" id="emailSubscribe"><?= caption("subscribe") ?></button>
        </div>
      </form>
    </div>
  </div>
</div>