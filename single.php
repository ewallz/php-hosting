<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage 
 * @since 
 */

get_header(); ?>

<div id="category_content">
  <div id="category_content-main">
   	<?php while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <br /><br />
	 <?php the_tags('<strong>Tags:</strong> ', ', ', '<br />'); ?> 
	<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop. ?>
    <br clear="all" />
  </div>
  <?php get_sidebar(); ?><div class="clear"></div>
</div>
<?php get_footer(); ?>
