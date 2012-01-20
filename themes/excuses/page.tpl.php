<?php
?>
  <div id="branding" class="clearfix">
  </div>

  <div id="page">
    <?php if (isset($secondary_local_tasks)): ?>
      <div class="tabs-secondary clearfix"><ul class="tabs secondary"><?php print render($secondary_local_tasks); ?></ul></div>
    <?php endif; ?>


    <div id="content" class="clearfix">
    <?php print $breadcrumb; ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h1 class="page-title"><?php print $title; ?></h1>
    <?php endif; ?>
    <?php if ($subtitle): ?>
      <div id="subtitle"><?php print $subtitle; ?></div>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php print render($primary_local_tasks); ?>
    <?php if ($instructions): ?>
      <div id="instructions"><?php print $instructions; ?></div>
    <?php endif; ?>

      <div class="element-invisible"><a id="main-content"></a></div>
      <?php if ($messages): ?>
        <div id="console" class="clearfix"><?php print $messages; ?></div>
      <?php endif; ?>
      <?php if ($page['help']): ?>
        <div id="help">
          <?php print render($page['help']); ?>
        </div>
      <?php endif; ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php print render($page['content']); ?>
    </div>

    <div id="footer">
      <?php print $feed_icons; ?>
    </div>

  </div>