<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Frida_Zinema
 */
if (get_post_type() !== 'issues') :
    get_header();

?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'frida-zinema' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'frida-zinema' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php


else :
    get_template_part( 'template-parts/head' );
    while ( have_posts() ) :
        the_post();

        $file = get_field('pdf');
        $pdf_url = $file['url'];
    endwhile;
    ?>
    <div id="pdf-reader">
        <button id="pdf-reader__controls__button__prev" class="pdf-reader__control"><i class="fa-solid fa-angle-left"></i> PREV</button>
        <canvas id="pdf-reader__canvas" data-pdf="<?php echo esc_url( $pdf_url );?>"></canvas>
        <button id="pdf-reader__controls__button__next" class="pdf-reader__control">NEXT <i class="fa-solid fa-angle-right"></i> </button>
    </div>
    <link href="
https://cdn.jsdelivr.net/npm/pdfjs-dist@5.4.530/web/pdf_viewer.min.css
" rel="stylesheet">
<?php
    get_sidebar();
    get_footer();
endif;
?>
