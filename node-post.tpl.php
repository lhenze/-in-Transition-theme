<?php
// $Id: node.tpl.php,v 1.4 2008/09/15 08:11:49 johnalbin Exp $

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>
<div class="node <?php print $classes ?>" id="node-<?php print $node->nid; ?>"><div class="node-inner">
<!--Teaser Only-->

 <?php if ($teaser): ?>
	<div class="content">
		<?php print $content; ?>
	</div>  
  		<h2 class="title">
      		<a href="<?php print $node_url; ?>" title="<?php print check_plain($title); ?>"><?php print truncate_utf8($title, 70, TRUE, TRUE); ?></a>
    	</h2>
	<?php if ($submitted): ?>
	    <div class="submitted">
			by <strong><?php print in_transition_realname_links($node); ?></strong>		
<?php
	if (user_access('access comments')) {
	 	$all = comment_num_all($node->nid);
	 	$links = $node->links;
	 	if ($all) {
	 		$links['comment_comments'] = 
				array(
					'title' => format_plural($all, '(1)', '(@count)'),
 					'href' => "node/$node->nid",
	 				'attributes' => array('title' => t('Jump to the first comment of this posting.')),					 						        										
					'fragment' => 'comments'
			      	);				 
      		$new = comment_num_new($node->nid);
    	if ($new) {
		$links['comment_new_comments'] = 
			array(
				'title' => format_plural($new, ' new', ' new'),
				'href' => "node/$node->nid",
				'attributes' => array('title' => t('Jump to the first new comment of this posting.')),															
				'fragment' => 'new'
				);
	 	    				}
	 	}
	}
	
	?>

	<?php print theme_links($links, $attributes = array('class' => 'links-inline')); ?>
	  	</div>
    <?php endif; ?>
<?php endif; ?>
<!--End Teaser Only-->

<!--Page Only -->
<?php if ($page): ?>
  <?php if ($unpublished) : ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>


  <?php if ($submitted): ?>
	    <div class="submitted-post">
			<p>
				by <strong><?php print in_transition_realname_links($node); ?></strong><?php print in_transition_university_affiliation($node); ?>
			<br />
			<?php print t('!date', array('!date' => format_date($node->created, 'custom', 'F d, Y – H:i'))); ?>
			</p>
	    </div>
    <?php endif; ?>
  <div class="content">
     		<?php print $content; ?>
  </div>

 <?php if (count($taxonomy)): ?>
	<div class="taxonomy">
    <?php print in_transition_taxonomy_links($node, 1); ?>
	</div>
  <?php endif; ?>

<?php endif; ?>
  <?php //endif; ?>
<!--End Page Only -->

</div></div> <!-- /node-inner, /node -->