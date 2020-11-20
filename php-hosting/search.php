<?php
/**
 * The template for displaying Search pages.
 *
 * @package WordPress
 * @subpackage 
 * @since 
 */

get_header(); ?>

<div id="category_content">
  <div id="category_content-main">
    <?php if (have_posts()) : ?>
	<h2>Search Results</h2>
            <?php while (have_posts()) : the_post(); ?>
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="tittle"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
				<?php edit_post_link(); ?>
			<?php endwhile; ?>
<?php else : ?>
	<h2>No results found</h2>
<?php endif; ?>
  </div>
  <?php get_sidebar(); ?><div class="clear"></div>
</div>
<?php get_footer(); ?>
