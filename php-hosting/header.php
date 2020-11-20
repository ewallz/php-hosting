<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WordPress
 * @subpackage PHP Hosting
 * @since PHP Hosting 1.0
 */
 $custom_meta = get_post_custom();
global $theme_options;
foreach ($theme_options as $value) {
	${$value['id']} = get_option($value['id']) === false ? $value['std'] : get_option($value['id']);
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
if(empty($custom_meta['rpwp_meta_title'][0])){
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
}else{
	echo apply_filters('the_title', strip_tags(do_shortcode($custom_meta['rpwp_meta_title'][0])));
}
	?></title>
<?php if(isset($custom_meta['rpwp_meta_description'][0])){ ?><meta name="description" content="<?php echo apply_filters('the_title', strip_tags(do_shortcode($custom_meta['rpwp_meta_description'][0])));?>" /><?php } ?>
<?php if(isset($custom_meta['rpwp_meta_keywords'][0])){ ?><meta name="keywords" content="<?php echo apply_filters('the_title', strip_tags(do_shortcode($custom_meta['rpwp_meta_keywords'][0])));?>" /><?php } ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if(!empty($_GET['color'])) $csscolor = $_GET['color']; elseif(!empty($rpwp_theme_color_scheme) and in_array($rpwp_theme_color_scheme, $GLOBALS['theme_colors'])) $csscolor = $rpwp_theme_color_scheme;  else $csscolor = $GLOBALS['theme_color_default']; ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/style.<?php echo $csscolor?>.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href='//fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Squada+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
var template_directory = "<?php bloginfo('template_directory') ?>";
</script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style-ie-8.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/colorbox.css" />
</head>

<body <?php body_class(); ?>>
<div id="wrapper_fixed">
	<div id="mobile-menu"><span class="menu-icon"></span></div>

	<div id="header_title">
		<h1 id="header_logo"><a href="<?php echo home_url()?>"><?php bloginfo('name')?></a></h1>
		<h5 id="header_logo"><?php bloginfo('description')?></h5>
	</div>
	<div id="header_top">
		<div id="rpwp-login-wrapper">
			<a title="client login" href="http://cloudlogin.co/login/">user login</a>
		</div>
		<div id="rpwp-login-form-text"><a title="sign up" href="<?php echo get_permalink(get_option('rp_order_form')); ?>">sign up</a></div>
	</div>
	<div id="header_right">
		<div id="header_phone">
			 CALL NOW!<span class="small">(ID:<?php echo $GLOBALS['rp_info']['store_id'];?>)</span><br />
			 <span class="number">+<?php if (function_exists('rp_support_phone')) echo substr(rp_support_phone(), 1); ?></span>
		</div>
		<div id="live_chat"><?php if (function_exists('rp_support_img')) echo rp_support_img()?></div>
	</div>
	<div id="menu">
	<?php
	if(is_active_nav_menu('primary')){
		  wp_nav_menu( array(
			'theme_location' => 'primary', // Setting up the location for the main-menu, Main Navigation.
			'menu_class' => 'dropdown', //Adding the class for dropdowns
			'container_id' => 'navwrap', //Add CSS ID to the containter that wraps the menu.
			'fallback_cb' => 'wp_page_menu', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
			)
		  );
	}else{
		$curr_menu_class = ' current-menu-item current_page_item';
		$curr_menu_parent_class = ' current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor';
	?>
	<div id="navwrap" class="menu-topmenu-container">
	<ul id="menu-topmenu" class="dropdown">
		<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if(is_home() or is_front_page()) echo $curr_menu_class;?>"><a href="<?php echo bloginfo('url');?>">Home</a></li>
		<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"shared")))) echo $curr_menu_class;?><?php if($wp_query->post->ID == get_option('rp_hosting_uk') or $wp_query->post->ID == get_option('rp_hosting_us') or $wp_query->post->ID == get_option('rp_hosting_au')) echo $curr_menu_parent_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"shared"));?>">Shared Plans</a>
			<ul class="sub-menu">
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_hosting_uk')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_hosting_uk'));?>">Web Hosting in UK</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_hosting_us')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_hosting_us'));?>">Web Hosting in US</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_hosting_au')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_hosting_au'));?>">Web Hosting in Australia</a></li>
			</ul>
		</li>
		<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"domains")))) echo $curr_menu_class;?><?php if($wp_query->post->ID == get_option('rp_domain_names_only') or $wp_query->post->ID == get_option('rp_domain_names_tld_info') or $wp_query->post->ID == get_option('rp_whois_id_protection') or $wp_query->post->ID == get_option('rp_ssl_certificates')) echo $curr_menu_parent_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"domains"))?>">Domain Names</a>
			<ul class="sub-menu">
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_domain_names_only')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_domain_names_only'));?>">Domain Registration</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_domain_names_tld_info')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_domain_names_tld_info'));?>">TLD Information</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_whois_id_protection')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_whois_id_protection'));?>">WHOIS ID Protection</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_ssl_certificates')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_ssl_certificates'));?>">SSL Certificates</a></li>
			</ul>
		</li>
		<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"vps")))) echo $curr_menu_class;?><?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"vps_openvz"))) or $wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"vps_kvm"))) or $wp_query->post->ID == get_option('rp_vps_hosting_au') or $wp_query->post->ID == get_option('rp_vps_hosting_uk') or $wp_query->post->ID == get_option('rp_vps_hosting_us')) echo $curr_menu_parent_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"vps"));?>">VPS Hosting</a>
			<ul class="sub-menu">
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"vps_openvz")))) echo $curr_menu_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"vps_openvz"));?>">OpenVZ VPS Hosting</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"vps_kvm")))) echo $curr_menu_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"vps_kvm"));?>">KVM VPS Hosting</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_vps_hosting_au')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_vps_hosting_au'));?>">VPS Hosting in Australia</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_vps_hosting_uk')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_vps_hosting_uk'));?>">VPS Hosting in UK</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_vps_hosting_us')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_vps_hosting_us'));?>">VPS Hosting in US</a></li>
			</ul>
		</li>
		<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"dedicated")))) echo $curr_menu_class;?><?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"semi_dedicated"))) or $wp_query->post->ID == get_option('rp_dedicated_hosting_us')) echo $curr_menu_parent_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"dedicated"));?>">Dedicated Hosting</a>
			<ul class="sub-menu">
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"semi_dedicated")))) echo $curr_menu_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"semi_dedicated"))?>">Semi-dedicated Hosting</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_dedicated_hosting_us')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_dedicated_hosting_us'));?>">Dedicated Hosting in US</a></li>
			</ul>
		</li>
		<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_data_centers')) echo $curr_menu_class;?><?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_steadfast"))) or $wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_sydney"))) or $wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_berkshire"))) or $wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_ficolo"))) or $wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_sofia")))) echo $curr_menu_parent_class;?>"><a href="<?php echo get_permalink(get_option('rp_data_centers'));?>">Data Centers</a>
			<ul class="sub-menu">
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_steadfast")))) echo $curr_menu_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"datacenter_rp_data_centers_steadfast"));?>">US Data Center</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_sydney")))) echo $curr_menu_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"datacenter_rp_data_centers_sydney"));?>">AU Data Center</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_berkshire")))) echo $curr_menu_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"datacenter_rp_data_centers_berkshire"));?>">UK Data Center</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_ficolo")))) echo $curr_menu_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"datacenter_rp_data_centers_ficolo"));?>">FI Data Center</a></li>
				<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option(rp_default_page_id(array('key'=>"datacenter_rp_data_centers_sofia")))) echo $curr_menu_class;?>"><a href="<?php echo rp_default_page_link(array('key'=>"datacenter_rp_data_centers_sofia"));?>">BG Data Center</a></li>
			</ul>
		</li>
		<li class="menu-item menu-item-type-post_type menu-item-object-page<?php if($wp_query->post->ID == get_option('rp_order_form')) echo $curr_menu_class;?>"><a href="<?php echo get_permalink(get_option('rp_order_form'));?>">Order</a></li>
	</ul></div>
	<?php }?></div>
	<?php if(function_exists('is_rp_page')){ if(!is_front_page() and is_rp_page($wp_query->post->ID) and function_exists('rp_breadcrumbs')) rp_breadcrumbs($wp_query->post->ID); elseif(function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); } ?>
	<div id="content" class="position">
