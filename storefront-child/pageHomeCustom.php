<?php
/** template name: Test WISH homepage
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

<?php 
$images = get_field('home_slider');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
if( $images ): ?>
<div class="flexslider">
    <ul class="slides">
        <?php foreach( $images as $image_id ): ?>
            <li>
                <?php echo wp_get_attachment_image( $image_id, $size ); ?>
            </li>
        <?php endforeach; ?>
	</ul>
	</div>
<?php endif; ?>



	<div class="container">

    <?php if( have_rows('layout-builder') ): 
        while( have_rows('layout-builder') ): the_row(); ?>

    <!-- CATALOGUE ROW -->        
    <?php if( get_row_layout() == 'catalogue' ): 
        $catalogueImg = get_sub_field('catalogue_image');
        $catalogueSize = 'full'; // (thumbnail, medium, large, full or custom size)  
        $catalogueDetail = get_sub_field('catalogue_detail');
    ?>
        <div class="row rowCatalogue">
            <div class="col">
            <?php if($catalogueImg){ echo wp_get_attachment_image( $catalogueImg, $catalogueSize );} ?>
            </div>
            <div class="col">
                <?php if($catalogueDetail): ?>
                    <h3><?php echo $catalogueDetail['catalogue_title'] ?></h3>
                    <p><?php echo $catalogueDetail['catalogue_description'] ?></p>
                    <a class="button" href="<?php echo $catalogueDetail['catalogue_url'] ?>">VIEW CATALOGUE</a>
                <?php endif; ?>
            </div>
        </div> <!-- END row -->

        <!-- ARTICLES ROW --> 
        <div class="row rowArticles">
        <?php elseif( get_row_layout() == 'articles' ): ?>

        <?php get_template_part( 'template-parts/content', 'homepost' );?>

        </div><!-- END row -->

        <!-- BENEFITS ROW --> 
    <?php elseif( get_row_layout() == 'benefits' ): 
    $benefit1 = get_sub_field('benefit1');
    $benefit2 = get_sub_field('benefit2');
    $benefit3 = get_sub_field('benefit3');
    $benefit4 = get_sub_field('benefit4');
        ?>
        <div class="row rowBenefits">
            <div class="col">
                <?php echo wp_get_attachment_image( $benefit1['benefit_image'], $size ); ?>
                <h3><?php echo $benefit1['benefit_title'] ?></h3>
                <p><?php echo $benefit1['benefit_description'] ?></p>
            </div>
            <div class="col">
                <?php echo wp_get_attachment_image( $benefit2['benefit_image'], $size ); ?>
                <h3><?php echo $benefit2['benefit_title'] ?></h3>
                <p><?php echo $benefit2['benefit_description'] ?></p>
            </div>
            <div class="col">
                <?php echo wp_get_attachment_image( $benefit3['benefit_image'], $size ); ?>
                <h3><?php echo $benefit3['benefit_title'] ?></h3>
                <p><?php echo $benefit3['benefit_description'] ?></p>
            </div>
            <div class="col">
                <?php echo wp_get_attachment_image( $benefit4['benefit_image'], $size ); ?>
                <h3><?php echo $benefit4['benefit_title'] ?></h3>
                <p><?php echo $benefit4['benefit_description'] ?></p>
            </div>
        </div><!-- END row -->
            
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<!--<div>
    <?php //while(have_posts()) : the_post();
    //the_content();
    //endwhile; ?>
</div>-->

	</div><!-- END container -->


<?php
get_footer();
