<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Frida_Zinema
 */

?>

	<footer id="colophon" class="site-footer">
        <div class="site-footer__overlay"></div>
        <div class="site-footer__content-container">
            <div class="site-footer__content-container__left">
                <div>Follow Us</div>
                <div class="site-footer__content-container__left__socials">
                    <div>zine@thefridacinema.org</div>
                    <div>@thefridazinema</div>
                    <div>discord.gg/fridazinema</div>
                </div>
            </div>
            <div class="site-footer__content-container__right">
                <img src="<?php echo get_template_directory_uri() . '/img/frida-logo.png'; ?>" />
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
