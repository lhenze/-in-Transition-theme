<?php
// $Id: comment.tpl.php,v 1.3 2008/09/14 12:09:37 johnalbin Exp $

/**
 * @file comment.tpl.php
 * Default theme implementation for comments.
 *
 * Available variables:
 * - $author: Comment author. Can be link or plain text.
 * - $classes: A set of CSS classes for the DIV wrapping the comment.
 * -     Possible values are: comment, comment-new, comment-preview,
 * -     comment-unpublished, comment-published, odd, even, first, last,
 * -     comment-by-anon, comment-by-author, or comment-mine.
 * - $content: Body of the post.
 * - $date: Date and time of posting.
 * - $links: Various operational links.
 * - $new: New comment marker.
 * - $picture: Authors picture.
 * - $signature: Authors signature.
 * - $status: Comment status. Possible values are:
 *   comment-unpublished, comment-published or comment-preview.
 * - $submitted: By line with date and time.
 * - $title: Linked title.
 * - $unpublished: Is the comment unpublished?
 *
 * These two variables are provided for context.
 * - $comment: Full comment object.
 * - $node: Node object the comments are attached to.
 *
 * @see template_preprocess_comment()
 * @see theme_comment()
 */
?>
<div class="<?php print $classes; ?>"><div class="comment-inner clear-block">

  <?php if ($title): ?>
	 <?php if ($picture) print $picture; ?>
    <h3 class="title"><?php print $title; if (!empty($new)): ?> <span class="new"><?php print $new; ?></span><?php endif; ?></h3>
  <?php elseif ($comment->new): ?>
    <div class="new"><?php print $new; ?></div>
  <?php endif; ?>
  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

	<div class="submitted-post">
		<p>	
		by <strong><?php print in_transition_realname_links($comment); ?></strong><?php print in_transition_university_affiliation($comment); ?>
		<br />
		<?php print t('!date', array('!date' => format_date($comment->timestamp, 'custom', 'F d, Y – H:i'))); ?>
		</p>
	</div>

  <div class="content">
    <?php print $content; ?>
      <?php if ($signature && $comment->cid > 1156): // Change "1234" to the last comment ID used before upgrading to Drupal 6 ?>
<div class="user-signature clear-block">
<?php print $signature ?>
    </div>
    <?php endif; ?>
  </div>

  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

</div></div>