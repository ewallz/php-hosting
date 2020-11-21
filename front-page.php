<?php 
get_header();

remove_filter ('the_content', 'wpautop');
?>

<div id="front_page_content">
  <?php
			/* Run the loop to output the post.
			 * If you want to overload this in a child theme then include a file
			 * called loop-single.php and that will be used instead.
			 */
			get_template_part( 'loop', 'single' );
			?>
			</div>
<?php get_footer(); ?>