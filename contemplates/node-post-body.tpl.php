<div class="curators-note">
  <?php if (isset($node->picture) && !empty($node->picture)) : ?>
    <div class="picture"><img src="<?php print base_path() . $node->picture ?>"/></div>
  <?php else: ?>
    <?php 
      if (function_exists('_gravatar_get_gravatar')) {
        $content_creator =  user_load($node->uid);
        $picture = _gravatar_get_gravatar(array('mail' => $content_creator->mail));    
      }
    ?>
    <div class="picture"><img src="<?php print $picture;?>" /></div>
  <?php endif; ?> 
   <h2>Curator's Note</h2>
   <?php print $node->content['body']['#value']; ?>
</div>
<div class="video-embed-link">
  <?php print $node->field_video_embed_link[0]['view']; ?>
</div>
