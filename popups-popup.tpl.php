<?php
// $Id: popups-popup.tpl.php,v 1.1.2.7 2009/03/05 20:05:44 starbow Exp $
/**
 * @file
 */
?>
<script type="text/javascript">
	<!--
 
if (Drupal.jsEnabled) {
	$(document).ready(function() {
		
		// Hide the Preview Button, Tips, and Formatiing options 
		//$("#edit-preview").hide();
		//$(".tips").hide();
		//$("#popups-body p").hide();
		$(".textarea-identifier").hide();
		
		// Set the default text for the five axes 
		$("#edit-reviews-1-review").DefaultValue("What are you working on");
		$("#edit-reviews-2-review").DefaultValue("Citation");
		$("#edit-reviews-3-review").DefaultValue("Please provide the course title, level (ie., undergraduate or graduate), and give details on how you integrated the post");
		//$("#edit-reviews-4-review").DefaultValue("Feel free to add your thoughts in the comment field at the bottom of the page on the right side");
		$("#edit-reviews-5-review").DefaultValue("How might this post be improved upon (this is a place for comments about structure and format, not content. If you want to engage with the curator's arguments, please do so in the comment field at the bottom of the page on the right side)");

		$(".node-type-nodereview span").click(function(){
			$(this).next().slideToggle("slow");
			$(this).toggleClass("active"); return false;
			}
		);
		
		/*
			First check box Research
		*/
	     $("#edit-reviews-1-checked").click(function() {
	     	        if ($("#edit-reviews-1-checked").is(":checked")) {
	     	            //alert('#edit-reviews-1-checked is checked');
	     	            $("#edit-reviews-1-review-wrapper").show("slow");
	     	        }
	     	        else {
	     				$("#edit-reviews-1-review-wrapper").hide("slow");
	     			}
	     	    });
	     
	     		if (!$("#edit-reviews-1-checked").is(":checked")) {
	     			$("#edit-reviews-1-review-wrapper").hide();
	     		}
		/*
			Second check box Publicatiom
		*/

		$("#edit-reviews-2-checked").click(function() {
	        if ($("#edit-reviews-2-checked").is(":checked")) {
	            $("#edit-reviews-2-review-wrapper").show("slow");
	        }
	        else {
				$("#edit-reviews-2-review-wrapper").hide("slow");
			}
	    });

		if (!$("#edit-reviews-2-checked").is(":checked")) {
			$("#edit-reviews-2-review-wrapper").hide();
		}
		/*
			Third check box Teaching
		*/

		$("#edit-reviews-3-checked").click(function() {
	        if ($("#edit-reviews-3-checked").is(":checked")) {
	            $("#edit-reviews-3-review-wrapper").show("slow");
	        }
	        else {
				$("#edit-reviews-3-review-wrapper").hide("slow");
			}
	    });

		if (!$("#edit-reviews-3-checked").is(":checked")) {
			$("#edit-reviews-3-review-wrapper").hide();
		}

		/*
			Fourth check box Interesting
		*/

		$("#edit-reviews-4-checked").click(function() {
	        if ($("#edit-reviews-4-checked").is(":checked")) {
	            
				$("#edit-reviews-4-checked-wrapper").append($("<p id='edit-reviews-4-checked-message'>Feel free to add your thoughts in the comment field at the bottom of the page on the right side</p>").hide());
				$("#edit-reviews-4-checked-message").fadeIn('slow');
	        }
	        else {
				$("#edit-reviews-4-checked-message").fadeOut("slow");
				$("#edit-reviews-4-checked-message").remove();
			}
	    });

		if (!$("#edit-reviews-4-checked").is(":checked")) {
			$("#edit-reviews-4-review-wrapper").remove();
		}

		/*
			Fifth check box Recommendations
		*/

		$("#edit-reviews-5-checked").click(function() {
	        if ($("#edit-reviews-5-checked").is(":checked")) {
	            $("#edit-reviews-5-review-wrapper").show("slow");
	        }
	        else {
				$("#edit-reviews-5-review-wrapper").hide("slow");
			}
	    });

		if (!$("#edit-reviews-5-checked").is(":checked")) {
			$("#edit-reviews-5-review-wrapper").hide();
		}


	});
}
-->
</script>
<div id="popups">
  <div id="popups-title">
    <div id="popups-close"><a href="#"><?php print t('Close [x]') ?></a></div>
    <div class="title">%title</div>
    <div class="clear-block"></div>
  </div>
  <div id="popups-body">%body</div>

  <div id="popups-buttons">%buttons</div>
  <div id="popups-footer"></div>
</div>
