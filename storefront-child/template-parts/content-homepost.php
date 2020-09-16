<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $query = new WP_Query( array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DSC',
        // 'tax_query' => array(
        //   array(
        //     'taxonomy' => 'category',
        //     'field'    => 'slug',
        //     'terms'    => array('news-press')
        //   ),
        // ),
        'posts_per_page' => 4,
        //'offset' => $offsetddd,
        'paged' => $paged
    ) );
?>

<?php if ( $query->have_posts() ) : ?>
  <?php
     while ( $query->have_posts() ) : $query->the_post(); ?>

      <?php $categories = get_the_category(); $category_id = $categories[0]->cat_ID; ?>
      <?php $terms = get_the_terms( get_the_ID(), 'category'); ?>
      <?php $term = array_pop($terms); ?>
        <div class="col">
          <a href="<?php the_permalink();?>" class="newsimg">
            <?php echo get_the_post_thumbnail(get_the_ID()); ?>
          </a>
          <div class="newscontent">
            <!--<span class="newscat"><?php //echo get_cat_name($category_id);?></span>-->
            <h5 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
            <div class="date"><?php echo get_the_date();?></div>
            <!--<div class="newsexcerpt"><?php //the_excerpt();?></div>-->
            
          </div>
        </div>
  <?php endwhile; ?>
<!-- end loop -->

<!--<div class="pagination col-xl-12 mt-2 pt-3 text-center mb-5 pb-4">
    <?php 
      //echo paginate_links( array(
        //'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        //'total'        => $query->max_num_pages,
        //'current'      => max( 1, get_query_var( 'paged' ) ),
        //'format'       => '?paged=%#%',
        //'show_all'     => false,
        //'type'         => 'plain',
        //'end_size'     => 2,
        //'mid_size'     => 1,
        //'prev_next'    => true,
        //'prev_text'    => sprintf( '<i></i> %1$s', __( '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 fa-2x"><path fill="currentColor" d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z" class=""></path></svg>', 'text-domain' ) ),
        //'next_text'    => sprintf( '%1$s <i></i>', __( '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-right fa-w-8 fa-2x"><path fill="currentColor" d="M24.707 38.101L4.908 57.899c-4.686 4.686-4.686 12.284 0 16.971L185.607 256 4.908 437.13c-4.686 4.686-4.686 12.284 0 16.971L24.707 473.9c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L41.678 38.101c-4.687-4.687-12.285-4.687-16.971 0z" class=""></path></svg>', 'text-domain' ) ),
        //'add_args'     => false,
        //'add_fragment' => '',
      //) );
    ?>
</div>-->


<?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>



 <?php
   wp_reset_postdata();
?>