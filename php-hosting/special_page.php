<?php
/**
 * Template Name: Special-Page
 *
 * A custom page template with unique header.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 */
get_header(); 

$custom_meta = get_post_custom();
?>
<?php if(isset($custom_meta['rpwp_header_type'][0]) and $custom_meta['rpwp_header_type'][0] != 'none'){ ?>
<div id="content_header" class="<?php echo (isset($custom_meta['rpwp_header_type'][0])?'header_'.$custom_meta['rpwp_header_type'][0]:'');?>">
	<?php if(isset($custom_meta['rpwp_title'][0])){ ?><h1 id="content_title" class="<?php echo (isset($custom_meta['rpwp_header_type'][0])?'title_'.$custom_meta['rpwp_header_type'][0]:'');?>"><?php echo apply_filters('the_title', $custom_meta['rpwp_title'][0]);?></h1><?php } ?>
    <div id="content_text" class="<?php echo (isset($custom_meta['rpwp_header_type'][0])?'text_'.$custom_meta['rpwp_header_type'][0]:'');?>"><?php echo (isset($custom_meta['rpwp_content'][0])?apply_filters('the_content', $custom_meta['rpwp_content'][0]):'');?></div>
</div><br class="clear" />
<?php }else{ ?>
<div id="content_header">
<h1 class="special_page_default_title"><?php echo get_the_title(); ?></h1></div>
<?php } ?>
<div id="default_content" class="<?php echo (isset($custom_meta['rpwp_header_type'][0])&&$custom_meta['rpwp_header_type'][0]=='web_hosting'?'rpwp_header_right':'rpwp_header_left')?> <?php echo (isset($custom_meta['rpwp_header_type'][0])?'content_'.$custom_meta['rpwp_header_type'][0]:'');?>">
	
			<?php
			/* Run the loop to output the post.
			 * If you want to overload this in a child theme then include a file
			 * called loop-single.php and that will be used instead.
			 */
			get_template_part( 'loop', 'single' );
			?>
</div>
<?php get_footer(); ?>