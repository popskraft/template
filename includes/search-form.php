<?php  namespace ProcessWire; ?>
<form class="search-form" action="<?= pages("/search/")->url ?>" method="get">
  <div class="input-group">
    <input class="form-control"
      id="searchForm"
      type="search"
      name="q"
      placeholder="<?= caption("search_what") ?>"
      value="<?= $sanitizer->entities($input->whitelist('q')); ?>">
    <button class="btn btn-primary d-flex align-items-center" type="submit" name="submit">
      <?= icon('search', 24) ?>
    </button>
  </div>
</form>