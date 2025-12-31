<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Frida_Zinema
 */
get_header();
?>

	<main id="primary" class="site-main">
		<?php if ( have_posts() ) : ?>

        <div id="single-page-header">
            <div id="single-page-header__image">
                <img alt="Decorative background image for the page header" src="/wp-content/themes/frida-zinema/img/issues.jpg" />
            </div>
            <h1><?php echo get_queried_object()->name; ?></h1>
        </div>
        <div id="single-page-content" class="page-tear">
            <svg viewBox="0 0 1408 44" class="page-tear-effect page-tear__top" style="fill: white;" aria-hidden="true" focusable="false">
                <use href="#shape-rip-2" xlink:href="#shape-rip-2"></use>
            </svg>
            <div class="archive-contents">
                <?php
                get_sidebar();
                ?>
                <div id="archive__filter-results" class="filter-results">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_type() );

                    endwhile;

                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '« Previous',
                        'next_text' => 'Next »',
                    ) );

                    else :

                        get_template_part( 'template-parts/content', 'none' );

                    endif; ?>
                </div>
            </div>
        </div>
        <svg viewBox="0 0 1408 44" class="page-tear-effect page-tear__bottom" style="fill: white;" aria-hidden="true" focusable="false">
            <use href="#shape-rip-3" xlink:href="#shape-rip-3"></use>
        </svg>
	</main><!-- #main -->
<?php
get_footer();
