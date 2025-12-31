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
                <div>Follow Us:</div>
                <div class="site-footer__content-container__left__socials">
                    <div><a href="mailto:zine@thefridacinema.org" target="_blank"><i class="fa-regular fa-envelope"></i> zine@thefridacinema.org</a></div>
                    <div><a href="https://instagram.com/thefridazinema" target="_blank"><i class="fa-brands fa-instagram"></i>  @thefridazinema</a></div>
                    <div><a href="https://discord.gg/q38duFbjqm" target="_blank"><i class="fa-brands fa-discord"></i> discord.gg/fridazinema</a></div>
                </div>
            </div>
            <div class="site-footer__content-container__right">
                <a href="https://thefridacinema.org" target="_blank"><img src="<?php echo get_template_directory_uri() . '/img/frida-logo.png'; ?>" /></a>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
