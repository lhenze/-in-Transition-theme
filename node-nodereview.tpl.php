<div class="node <?php print $classes ?>" id="node-<?php print $node->nid; ?>">
  <div class="node-inner">
  
    <?php if ($teaser) : ?>
      <?php if ($picture) print $picture; ?>
	  <?php if ($submitted) : ?>
	    <div class="submitted">
	      <strong>Feedback from <?php print in_transition_realname_links($node); ?></strong><?php print in_transition_university_affiliation($node); ?>
	    </div>
		<div class="content"><?php print $content; ?></div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($page) : ?>
      <?php if ($unpublished) : ?>
        <div class="unpublished"><?php print t('Unpublished'); ?></div>
      <?php endif; ?>
	  <?php if ($submitted) : ?>
        <div class="submitted-post">
          <p>by <strong><?php print in_transition_realname_links($node); ?></strong><?php print in_transition_university_affiliation($node); ?><br /><?php print t('!date', array('!date' => format_date($node->created, 'custom', 'F d, Y – H:i'))); ?></p>
	    </div>
      <?php endif; ?>
      <div class="content"><?php print $content; ?></div>
    <?php endif; ?>
    
  </div>
</div>