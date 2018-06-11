<?php
/**
 * Template part for displaying related posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package solido
 */
if ( !defined( 'ABSPATH' ) ) { exit; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php  
    $image_url = get_theme_mod('hikaru_fallback_image',"") == "" ? get_template_directory_uri().'/assets/images/placeholder.jpg' : get_theme_mod('hikaru_fallback_image');
    if(has_post_thumbnail()):

        $image_url = get_the_post_thumbnail_url();

    endif;?>
    <div class="img_post" style="background-image:url('<?php echo $image_url ?>');" ></div>
    <div class="info">
        <?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" >', '</a></h2>' ); ?>
        <?php the_date('F j Y', '<span>', '</span>');?>
    </div>
	<!-- .post-thumbnail -->
</article>