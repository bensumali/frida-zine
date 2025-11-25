<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Frida_Zinema
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'frida-zinema' ); ?></h1>
			</header><!-- .page-header -->
        <svg viewBox="0 0 1408 44" class="page-tear-effect page-tear__bottom" style="fill: white;" aria-hidden="true" focusable="false">
            <use href="#shape-rip-3" xlink:href="#shape-rip-3"></use>
        </svg>
	</main><!-- #main -->

<?php
get_footer();
