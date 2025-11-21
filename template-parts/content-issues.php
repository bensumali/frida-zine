<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Frida_Zinema
 */
if ( !is_singular() ) :
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" target="_blank">
            <?php the_post_thumbnail(); ?>
        </a>
    <?php endif; ?>
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h3 class="entry-title">', '</h3>' );
        else :
            the_title( '<h3 class="entry-title"><a target="_blank" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                frida_zinema_posted_on();
                frida_zinema_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->


    <div class="entry-content">
        <div class="entry-content__publish-date"><?php the_field('publish_date'); ?></div>
        <div class="entry-content__issue-number">Issue #<?php the_field('issue_number') ?></div>
        <?php

        the_content(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'frida-zinema' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'frida-zinema' ),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php frida_zinema_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php
else :
    echo "here";
endif;
?>
