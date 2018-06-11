<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hikaru
 */
if ( !defined( 'ABSPATH' ) ) { exit; }
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="button-up">&uarr;</i></div>

		<div class="footer-widgets">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="widgets-wrap">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div class="widgets-wrap">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="widgets-wrap">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
			<?php endif; ?>
			
		</div>
		<div class="site-info">
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( '&copy; %1$s Theme: %2$s by %3$s.', 'hikaru' ),date('Y'), 'hikaru', '<a href="https://juanrafaelsimarro.com/">J.Rafael Simarro</a>' );
				?> 
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
