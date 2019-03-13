<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hikaru
 */
if ( !defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<!-- This sets the $curauth variable -->

        <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>
    <div class="author-avatar"><?php echo get_avatar($curauth->ID) ?></div>

    <h2 class="entry-title"><?php echo sprintf(esc_html('About: %s','hikaru'), esc_html($curauth->nickname)); ?></h2>


    <dl>
        <dt>Website</dt>
        <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
        <dt>Profile</dt>
        <dd><?php echo $curauth->user_description; ?></dd>
    </dl>

    <h2>Posts by <?php echo $curauth->nickname; ?>:</h2>

    <ul>
<!-- The Loop -->

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
            <?php the_title(); ?></a>,
            <?php the_time('d M Y'); ?> in <?php the_category('&');?>
        </li>

    <?php endwhile; else: ?>
        <p><?php _e('No posts by this author.','hikaru'); ?></p>

    <?php endif; ?>

<!-- End Loop -->

    </ul>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
