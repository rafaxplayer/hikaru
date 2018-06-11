<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hikaru
 */
if ( !defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		/* breadcrumbs*/
		do_action( 'hikaru_action_breadcrumbs');
		
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation( array(
				'prev_text'          => __( 'Previous <span>%title</span>' ,'hikaru' ) ,
				'next_text'          => __( 'Next <span>%title</span>' ,'hikaru' ),
				'screen_reader_text' => __( 'Continue Reading','hikaru' ),
			) );

			do_action('hikaru_action_related_posts');

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
