<?php
/**
 * Template Name: Internal Page 2
 *
 * A custom page template with unique header.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 */
get_header(); 
remove_filter ('the_content', 'wpautop');
?>
<div id="internal_page_2">
			<?php
			/* Run the loop to output the post.
			 * If you want to overload this in a child theme then include a file
			 * called loop-single.php and that will be used instead.
			 */
			get_template_part( 'loop', 'single' );
			?>
</div>
<?php get_footer(); ?>