<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Frida_Zinema
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if(!is_front_page()) { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    <?php } ?>

	<?php frida_zinema_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'frida-zinema' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'frida-zinema' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
    <?php if(is_front_page()) : ?>
        <script>
            function processInstagramPosts(root = document) {
                let ig_posts = document.getElementById('sbi_images');
                if (!ig_posts) return;

                let items = ig_posts.getElementsByClassName('sbi_item');

                for (let i = 0; i < items.length; i++) {
                    let post = items[i];

                    // Prevent running twice on the same post
                    if (post.dataset.processed === "true") continue;
                    post.dataset.processed = "true";

                    let img = post.getElementsByTagName('img')[0];
                    if (!img) continue;

                    let timestamp = post.dataset.date;
                    let date = new Date(timestamp * 1000);

                    let date_header = document.createElement('h2');
                    date_header.innerHTML = date.toLocaleDateString(undefined, {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    let text_div = document.createElement('div');
                    text_div.classList.add('sbi_text_force');

                    let content = document.createElement('div');
                    content.innerHTML = img.alt;
                    text_div.append(content);

                    let new_container = document.createElement('div');
                    new_container.classList.add('flex-row');

                    let photoWrap = post.getElementsByClassName('sbi_photo_wrap')[0];
                    if (photoWrap) {
                        new_container.append(photoWrap);
                        new_container.append(text_div);
                        post.prepend(new_container);
                        post.prepend(date_header);
                    }
                }
            }

            // Run once on initial load
            processInstagramPosts();

            // Observe future additions
            const observer = new MutationObserver((mutations) => {
                for (const mutation of mutations) {
                    if (mutation.addedNodes.length) {
                        processInstagramPosts();
                    }
                }
            });

            const target = document.getElementById('sbi_images');
            if (target) {
                observer.observe(target, {
                    childList: true,
                    subtree: true
                });
            }
        </script>
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
