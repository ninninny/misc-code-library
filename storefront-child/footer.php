<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div> <!-- .col-full -->
	</div> <!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<!--<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">
			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			//do_action( 'storefront_footer' );
			?>

		</div>--><!-- .col-full -->
	<!--</footer>--><!-- #colophon -->

	<footer>
		<div class="container">
			<div class="row">
			<?php if ( is_active_sidebar( 'custom_footer' ) ) : dynamic_sidebar( 'custom_footer' ); endif; ?>
				<!--<div class="col"></div>-->
			</div>
		</div>

	</footer>

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/182320c866.js" crossorigin="anonymous"></script>
<script async
  type="text/javascript"
  src="<?php echo esc_url( get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js' ); ?>">
</script>
<script async
  type="text/javascript"
  src="<?php echo esc_url( get_stylesheet_directory_uri() . '/script.js' ); ?>">
</script>

</body>
</html>
