<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage 
 * @since 
 */

get_header(); ?>
<?php 	$category = $wp_query->get_queried_object();
	$cid = $category->cat_ID;
	$cat_name1 = $category->name;
	$num = $category->count;
	$post = $wp_query->post; 
?>

<div id="category_content">
  <div id="category_content-main">
  <h1>Archive for: <?php the_time('F') ?>, <?php the_time('Y') ?></h1><br />
    <?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
     	<div class="date-formating"><span class="month"><?php the_time('M') ?></span><br /><span class="day"><?php the_time('d') ?></span><br /><span class="year"><?php the_time('Y') ?></span><br /><div class="time"><?php the_time('g:i a') ?></div></div>
        <div class="cat-excerpt"><h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?></div><br clear="all" /><br />
     <?php endwhile; ?>
    <div class="alignleft"><?php next_posts_link('Previous Entries'); ?></div>
 	<div class="alignright"><?php previous_posts_link('Next Entries'); ?></div>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?><div class="clear"></div>
</div>
<?php get_footer(); ?>
