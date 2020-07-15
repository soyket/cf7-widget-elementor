<?php 

if ( ! function_exists( 'get_contact_form_7_posts' ) ) :

  function get_contact_form_7_posts(){

  $args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);

    $catlist=[];
    
    if( $categories = get_posts($args)){
    	foreach ( $categories as $category ) {
    		(int)$catlist[$category->ID] = $category->post_title;
    	}
    }
    else{
        (int)$catlist['0'] = esc_html__('No contect From 7 form found', 'void');
    }
    //if AJAX action
	  if( current_filter() == 'wp_ajax_void_cf7_data' ){
		  echo json_encode( $catlist );
		  wp_die();
	  }
  return $catlist;
  }

endif;

if ( ! function_exists( 'void_get_all_pages' ) ) :

  function void_get_all_pages(){

  $args = array('post_type' => 'page', 'posts_per_page' => -1);

    $catlist=[];
    
    if( $categories = get_posts($args)){
      foreach ( $categories as $category ) {
        (int)$catlist[$category->ID] = $category->post_title;
      }
    }
    else{
        (int)$catlist['0'] = esc_html__('No Pages Found!', 'void');
    }
  return $catlist;
  }

endif;

//ajax action
add_action( 'wp_ajax_void_cf7_data', 'get_contact_form_7_posts' );