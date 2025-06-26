<?php namespace ProcessWire; ?>
<div class="modal fade" id="contact" tabindex="-1"
  aria-labelledby="contactLabel" aria-hidden="true">
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