<?php
	/**
	 * engage functions and definitions v1
	 *
	 */


/*   ====================================================================================================================
	
	UTILITIES
	 
=========================================================================================================================


	
// dequeue responsive css

	function engage_remove_scripts() {
		wp_dequeue_style( 'responsive' );
		wp_deregister_style( 'responsive' );
		
		// Now register your styles and scripts here
	}
	add_action( 'wp_enqueue_scripts', 'engage_remove_scripts', 20 );*/





// changing default wordpres email settings 
 
		add_filter('wp_mail_from', 'new_mail_from');
		add_filter('wp_mail_from_name', 'new_mail_from_name');
		 
		function new_mail_from($old) {
			 return 'info@engage-online.com';
		}
		
		function new_mail_from_name($old) {
			 return 'Engage Demo';
		}    
    







//Remove tags metabox from Posts


function engage_remove_tags_metabox() {
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' ); 
}
add_action( 'admin_menu' , 'engage_remove_tags_metabox' );



// remove aim, jabber and yim
add_filter( 'user_contactmethods', 'update_contact_methods',10,1);

function update_contact_methods( $contactmethods ) {

unset($contactmethods['aim']);  
unset($contactmethods['jabber']);  
unset($contactmethods['yim']);  


return $contactmethods;
}




/*   ====================================================================================================================
	
	IMAGES
	 
=========================================================================================================================
*/


	//Revise these for individual project image sizes
	
   add_image_size( 'small-thumb', 200, 132, true );
	add_image_size( 'medium-thumb', 280, 180, true );
	add_image_size( 'small-main', 600, 340, true );
	add_image_size( 'medium-main', 680, 420, true );
	add_image_size( 'full-main', 940, 420, true );
	add_image_size( 'half-main', 440, 276, true ); 	






/*   ====================================================================================================================
	
	SIDEBARS
	 
=========================================================================================================================
*/

// http://codex.wordpress.org/Function_Reference/register_sidebar

function engage_register_sidebars() {
  $sidebars = array( 'Page', 'Search');

  foreach($sidebars as $sidebar) {
    register_sidebar(
      array(
        'id'            => 'engage-' . sanitize_title($sidebar),
        'name'          => __($sidebar, 'engage'),
        'description'   => __($sidebar, 'engage'),
        'before_widget' => '<article id="%1$s" class="widget %2$s"><div class="widget-inner">',
        'after_widget'  => '</div></article>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
      )
    );
  }
}

add_action('widgets_init', 'engage_register_sidebars');