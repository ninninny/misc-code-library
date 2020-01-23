<?php
// load child theme textdomain
/*
function presscore_load_text_domain() {
	load_child_theme_textdomain( 'presscore', get_stylesheet_directory() . '/languages' );
}
*/

/**
 * Your code here.
 *
 */

function tour_list_price_box(){

	$adult_price = get_field('adult_price');
	$children_price = get_field('children_price');
	$half_adult_price = get_field('half_adult_price');
	$half_children_price = get_field('half_children_price'); 

		$string .='<div class="priceBox">';
		$string .='<div class="head dayHead">１日</div>';
		$string .='<div class="head halfHead">半日</div>';
		$string .='<div class="body">';
		$string .='<span>大人<br /><span class="big">'.$adult_price.'</span>B</span>';
		$string .='<span>子供 <span>(4~11歳)</span><br /><span class="big">'.$children_price.'</span>B</span>';
		$string .='<span>大人<br /><span class="big">'.$half_adult_price.'</span>B</span>';
		$string .='<span>子供 <span>(4~11歳)</span><br /><span class="big">'.$half_children_price.'</span>B</span>';

		$string .='</div></div>';

		return $string;
    }

add_shortcode( 'price_box', 'tour_list_price_box' );

function footerWidget1($atts = array(), $content = null, $tag){
	
	$footer_btn_atts = shortcode_atts( array(
        'payment' => '#',
        'fb' => '#'
    ), $atts );

	$string .='<p><a href="'.$footer_btn_atts[ 'payment' ].'" target="_blank"><img src="'.get_site_url().'/wp-content/themes/jnr-the7/images/btn-payment.png" alt="payment method"></a></p>';
	$string .='<p><a href="'.$footer_btn_atts[ 'fb' ].'" target="_blank"><img src="'.get_site_url().'/wp-content/themes/jnr-the7/images/btn-fb.png" alt=""></a></p>';
	return $string;
}
add_shortcode( 'footer_btn', 'footerWidget1' );

/*
*
Shortcode for Tour Listing 
*
*/

 function tour_listing($atts = array(), $content = null, $tag){
        $args = shortcode_atts( array(
            'post_type' => 'dt_portfolio',
			'dt_portfolio_category' => 'island',
            'post_status' => 'publish',
			'posts_per_page' => -1
        ), $atts );
	
        $string = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '<div class="tourListing">';
            while( $query->have_posts() ){
                $query->the_post();
                $string .= '<div class="item clearfix"><div class="thumb">';
				$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
				$string .= '<a href="' . get_permalink() . '"><img src="' . $image_src[0]  . '" /></a></div>';

				$tour_time = get_field('tour_time');
				$tour_anno = get_field('tour_annotation');

				$string .= '<div class="detail"><a href="' . get_permalink() . '" class="title">' . get_the_title() . '</a><div>'.get_the_excerpt().'</div><div class="tourTime">'.$tour_time.'</div><div class="tourAnno">'.$tour_anno.'</div></div><div class="price"><a href="' . get_permalink() . '" class="btn"><i class="fa fa-info-circle"></i> 詳細</a><div class="priceBox"><div class="head hiraMincho">ツアー料金</div><div class="body">';

	$price_note = get_field('price_note');
	$adult_price = get_field('adult_price');
	$children_price = get_field('children_price'); 

		$string .='<span>大人<br /><span class="big">'.$adult_price.'</span>B</span><span>子供 <span>(4~11歳)</span><br /><span class="big">'.$children_price.'</span>B</span><div class="note">'.$price_note.'</div></div></div></div></div>';
			}
            $string .= '</div>';
		}
        wp_reset_query();
        return $string;
    }
	add_shortcode( 'tour_listing', 'tour_listing' );

	/*
*
Shortcode for Ticket listing 
*
*/

/*add_action('init','register_ticket_tax');
function register_ticket_tax(){
register_taxonomy('airways',array('ticket'), array(
    'hierarchical' => false,
    'labels' => 'airways',
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'airways' ),
  ));
}*/

$airways = get_field('airways');

 function ticket_listing($atts = array(), $content = null, $tag){
        $args = shortcode_atts( array(
            'post_type' => 'ticket',
			'ticket_category' => 'domestic',
			'airways_ticket' => 'thai-airways',
            'post_status' => 'publish',
			'posts_per_page' => -1
        ), $atts );
	
        $string = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '<div class="ticketListing">';
			$string .= '<div class="tabletop clearfix"><div class="destination">目的地</div><div class="type">種類</div><div class="remark">備考</div><div class="price">料金</div><div class="btn"></div></div>';
            while( $query->have_posts() ){
                $query->the_post();
                $string .= '<div class="item clearfix">';
				
				
				$destination = get_field('destination');
				$ticket_type = get_field('ticket_type');
				$ticket_remark = get_field('ticket_remark'); 
				$ticket_price = get_field('ticket_price'); 

				 $string .= '<div class="destination">'.$destination.'</div>';
				 $string .= '<div class="type">'.$ticket_type.'</div>';
				 $string .= '<div class="remark">'.$ticket_remark.'</div>';
				 $string .= '<div class="price">'.$ticket_price.'</div>';
				 $string .= '<div class="btn"><a href="'.get_site_url().'/contact/" class="btn"><i class="fa fa-info-circle"></i> ご予約リクエスト</a></div>';
				
				$string .='</div>';
			}
            $string .= '</div>';
		}
        wp_reset_query();
        return $string;
    }
	add_shortcode( 'ticket_listing', 'ticket_listing' );


	/////// Custom post type

add_action( 'init', 'create_post_type' );
function create_post_type() {

  register_post_type( 'hotels',array(
		'labels' => array(
        'name' => __( 'Hotels' ),
        'singular_name' => __( 'Hotel' )
      ),
      'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true,
	  'show_in_menu' => true, 
	  'query_var' => true,
      'has_archive' => true,
	  'hierarchical' => false,
	  'rewrite' => array('slug' => 'hotels'),
	  'capability_type'       => 'post',
	  'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt'),
	  'menu_position' => 7,
    )
  ); 

    register_post_type( 'ticket',array(
		'labels' => array(
        'name' => __( 'Tickets' ),
        'singular_name' => __( 'Ticket' )
      ),
      'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true,
	  'show_in_menu' => true, 
	  'query_var' => true,
      'has_archive' => true,
	  'hierarchical' => false,
	  'rewrite' => array('slug' => 'ticket'),
	  'capability_type'       => 'post',
	  'supports' => array( 'title'),
	  'menu_position' => 8,
    )
  ); 


};/// END function create_post_type()

/////// Custom post type taxonomy

function my_taxonomies_ticket() {
  $labels = array(
    'name'              => _x( 'Ticket Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Ticket Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Ticket Categories' ),
    'all_items'         => __( 'All Ticket Categories' ),
    'parent_item'       => __( 'Parent Ticket Category' ),
    'parent_item_colon' => __( 'Parent Ticket Category:' ),
    'edit_item'         => __( 'Edit Ticket Category' ), 
    'update_item'       => __( 'Update Ticket Category' ),
    'add_new_item'      => __( 'Add New Ticket Category' ),
    'new_item_name'     => __( 'New Ticket Category' ),
    'menu_name'         => __( 'Ticket Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'ticket_category', 'ticket', $args );
}
add_action( 'init', 'my_taxonomies_ticket', 0 );

function airways_ticket() {
	$labels = array(
    'name'              => _x( 'Ticket Airways', 'taxonomy general name' ),
    'singular_name'     => _x( 'Ticket Airways', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Ticket Airways' ),
    'all_items'         => __( 'All Ticket Airways' ),
    'parent_item'       => __( 'Parent Ticket Airways' ),
    'parent_item_colon' => __( 'Parent Ticket Airways:' ),
    'edit_item'         => __( 'Edit Ticket Airways' ), 
    'update_item'       => __( 'Update Ticket Airways' ),
    'add_new_item'      => __( 'Add New Ticket Airways' ),
    'new_item_name'     => __( 'New Ticket Airways' ),
    'menu_name'         => __( 'Ticket Airways' ),
  );
  $args = array(
	  'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'airways_ticket', 'ticket', $args );
}
add_action( 'init', 'airways_ticket', 0 );

/////// map ///////
/*add_filter('wpgmp_geotags_content','wpgmp_geotags_content',1,2);
function wpgmp_geotags_content($content,$post_id,$map_id) {
 
    $content = ''; //reset the $content
        //retrieve featured image of the post
         if (has_post_thumbnail( $post_id ) ) {
  
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); 
         $content .= '<div class="clearfix:><div class="fl"><img src='".$image[0]."' /></div>';
		          //retrieve post title
         $content = '<div class="fl">'.get_the_title($post_id);
  
         }
         //retrieve custom fields value of the post. 
         $content .="<br />".get_post_meta($post_id, "hotel_location", true);
         //return your modified infowindow message. 
         return $content;
}*/

