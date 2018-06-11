<?php
/**
 *Hooks for theme
 *
 * @package hikaru
 */
if ( !defined( 'ABSPATH' ) ) { exit; }
/**
 * Header social network menu
 */
if( !function_exists('hikaru_social_menu') ):

    function hikaru_social_menu(){
        if(get_theme_mod('hikaru_show_menu_social',false)):?>
			<div class="menu-social">
				<?php if(get_theme_mod('hikaru_facebook_url')):?>
					<a href="<?php esc_url(get_theme_mod('hikaru_facebook_url')); ?>"><i class="fab fa-facebook-square"></i></a>
				<?php endif;?>
				<?php if(get_theme_mod('hikaru_twitter_url')):?>
					<a href="<?php esc_url(get_theme_mod('hikaru_twitter_url')); ?>"><i class="fab fa-twitter-square"></i></a>
				<?php endif;?>
				<?php if(get_theme_mod('hikaru_instagram_url')):?>
					<a href="<?php esc_url(get_theme_mod('hikaru_instagram_url')); ?>" ><i class="fab fa-instagram"></i></a>
				<?php endif;?>
				<?php if(get_theme_mod('hikaru_pinterest_url')):?>
					<a href="<?php esc_url(get_theme_mod('hikaru_pinterest_url')); ?>"><i class="fab fa-pinterest-square"></i></a>
				<?php endif;?>
				<?php if(get_theme_mod('hikaru_linkedin_url')):?>
					<a href="<?php esc_url(get_theme_mod('hikaru_linkedin_url')); ?>"><i class="fab fa-linkedin"></i></a>
				<?php endif;?>
				<?php if(get_theme_mod('hikaru_whatsapp_number')):?>
					<a href="<?php esc_url(get_theme_mod('hikaru_whatsapp_number')); ?>"><i class="fab fa-whatsapp"></i></a>
				<?php endif;?>
				<?php if(get_theme_mod('hikaru_google+_url')):?>
					<a href="<?php esc_url(get_theme_mod('hikaru_google+_url')); ?>"><i class="fab fa-google-plus-square"></i></a>
				<?php endif;?>
			</div><!-- #social menu -->
		<?php endif;
    }
add_action( 'hikaru_action_social_menu', 'hikaru_social_menu');

endif;

/**
 * Add related post to single post
 */
if( !function_exists( 'hikaru_related_posts' ) ) :

	function hikaru_related_posts(){

		if(!is_singular() || !get_theme_mod('hikaru_related_posts',false)){ return; }
		
		// get the user taxonomy select
		$taxonomy = get_theme_mod('hikaru_taxonomy_related_posts','category');
		
		$terms = get_the_terms( get_the_ID(), $taxonomy);
		$terms_ids = array();
		
		if( $terms ):
			foreach ($terms as $term): 
				$terms_ids[] = $term->term_id;
			endforeach;
		else:
			return;
		endif;

		// set query 
		$taxonomyQuery = $taxonomy =='category' ? array('category__in'=> $terms_ids) : array('tag__in'=> $terms_ids);
		
		$args = array(
            'posts_per_page'	=> 2,
            'post_type'         => 'post',
			'post__not_in'		=>array(get_the_ID()),
			'orderby'			=>'rand'
		);
		array_unshift($args,$taxonomyQuery);
				
		$loop	= new WP_QUERY($args);

		if ( $loop->have_posts() ): ?>
			<h2 class="entry-title"><?php esc_html_e('Related Posts','hikaru');?></h2>
			<div class="related-posts">
				
				<?php while ( $loop->have_posts() ):
					$loop->the_post();
					get_template_part( '/template-parts/content', 'related-posts'); 
									
				endwhile;?>
			</div>

    	<?php endif;
   		wp_reset_query();

    }
    add_action( 'hikaru_action_related_posts','hikaru_related_posts');
endif;

if( !function_exists('hikaru_breadcrumbs') ):

    function hikaru_breadcrumbs(){
        if(get_theme_mod('hikaru_breadcrumbs',true)):
           
            $separator= ' / ';
            $blogname = get_option( 'page_for_posts' ) == 0 ? 'Blog': get_the_title(get_option( 'page_for_posts' ));
            $bloglink = get_option( 'page_for_posts' ) == 0 ? esc_url( home_url( '/' ) ) : get_permalink( get_option( 'page_for_posts' ) );
            echo '<div id="h_breadcrumbs">';
            printf('<a href="%1$s" >%2$s</a>%3$s', esc_url(home_url()), bloginfo('name'), $separator);
            if (!is_home()){
                /* no es el blog index.php*/
               
                if (is_category() || is_single()) {
                    /* Es category.php o es single.php por lo tanto estan dentro del blog */
					$categories = get_the_category('');

					/* Blog name */
					printf('<a href="%1$s">%2$s</a>%3$s',$bloglink, $blogname,$separator);

                    if($categories){
						/* category name */
                    	printf('<a href="%1$s" >%2$s</a>%3$s',esc_url(get_category_link($categories[0]->term_id)), esc_html($categories[0]->cat_name),$separator);
					}
                    
                    if (is_single()) {

                        /* Es solo single.php , imprimimos el titulo del post y el separador*/
                        the_title();
                    }
                } elseif (is_page()) {
                    /* Es page.php , imprimimos el nombre de la pagina*/
                    the_title();
                }
            }else{
                /* Es el blog index.php, imprimimos el inicio con el nombre del blog*/
               
                printf('<a href="%1$s" >%2$s</a>',$bloglink,$blogname);
            }
            echo '</div>';
        endif;
    }

    add_action( 'hikaru_action_breadcrumbs','hikaru_breadcrumbs');
endif;