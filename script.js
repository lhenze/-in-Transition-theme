/**
 * Implementation of Drupal behavior.
 */

Drupal.behaviors.in_transition = function( context ) {
  
  $('form').submit( function() {
    var prevent, li = '';
    $(this).find('.required').each( function( index ) {
      if ( $(this).val().trim() === '' ) {
        prevent = true;
    	li += '<li>' + $(this).attr('name') +  ' field is required.</li>';
      };
    });
    
    if ( prevent === true ) {   	
    	$('#content-header h1.title').after( '<div class="messages error"><ul>' + li + '</ul></div>' );
    	$('html, body').animate({
          scrollTop: 5
        }, 'slow');
    	return false;   	
    } else { }
	
  });

} 
