<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Frida_Zinema
 */
get_header();
if (get_post_type() !== 'issues') :

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
    while ( have_posts() ) :
        the_post();

        $file = get_field('pdf');
        $pdf_url = $file['url'];
    endwhile;
    ?>
    <div id="pdf-reader">
        <div id="pdf-reader__controls">
            <button id="pdf-reader__controls__button__next">Next</button>
            <button id="pdf-reader__controls__button__prev">Previous</button>
        </div>
        <canvas id="pdf-reader__canvas"
                data-pdf="<?php echo esc_url( $pdf_url );?>"></canvas>
    </div>
    <link href="
https://cdn.jsdelivr.net/npm/pdfjs-dist@5.4.530/web/pdf_viewer.min.css
" rel="stylesheet">
<!--    <script type="module" src="http://localhost:8888/wp-content/themes/frida-zinema/js/pdf-reader.js"></script>-->
<?php
endif;
get_sidebar();
get_footer();
?>
