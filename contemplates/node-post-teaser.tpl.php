<?php

if (isset($node->field_tease_image)) {
 $image = $node->field_tease_image[0]['view'];
}

if (isset($node->field_image_embed)) {
  $emImage = $node->field_image_embed[0]['view'];
}

if ($image) {
  print '<div class="teaser-image">';
  print  $node->field_tease_image[0]['view'];
  print '</div>';
}

if ($emImage) {
  print '<div class="embed-image">';
  print  $node->field_image_embed[0]['view'];
  print '</div>';
}

