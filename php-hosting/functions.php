<?php
// Theme color variations
$GLOBALS['theme_colors'] = array("default");
$GLOBALS['theme_color_default'] = 'default';

// This theme uses wp_nav_menu()
register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'rpwp' ),
) );
register_nav_menus( array(
	'footer1' => __( 'Footer Navigation 1', 'rpwp' ),
) );
register_nav_menus( array(
	'footer2' => __( 'Footer Navigation 2', 'rpwp' ),
) );
register_nav_menus( array(
	'footer3' => __( 'Footer Navigation 3', 'rpwp' ),
) );
register_nav_menus( array(
	'footer4' => __( 'Footer Navigation 4', 'rpwp' ),
) );


function theme_activation_function(){
	if(get_option('rp_home_php_hosting')) update_option('page_on_front', get_option('rp_home_php_hosting'));
}
add_action('after_switch_theme', 'theme_activation_function');

function rpwp_theme_scripts() {
	// js files
	$arrOrders = array();
	if(get_option('rp_order_form')) $arrOrders[] = get_option('rp_order_form');
	if(get_option('rp_shared_order_form')) $arrOrders[] = get_option('rp_shared_order_form');
	if(get_option('rp_vps_virtuozzo_order_form')) $arrOrders[] = get_option('rp_vps_virtuozzo_order_form');
	if(get_option('rp_vps_openvz_order_form')) $arrOrders[] = get_option('rp_vps_openvz_order_form');
	if(get_option('rp_vps_kvm_order_form')) $arrOrders[] = get_option('rp_vps_kvm_order_form');
	if(get_option('rp_semi_dedicated_order_form')) $arrOrders[] = get_option('rp_semi_dedicated_order_form');
	if(get_option('rp_dedicated_order_form')) $arrOrders[] = get_option('rp_dedicated_order_form');
	if(in_array($GLOBALS['wp_query']->post->ID,$arrOrders)){
		if(version_compare(get_bloginfo('version'), '3.5', '>=')){
			wp_deregister_script('jquery');
			wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
			wp_deregister_script('jquery-ui-core');
			wp_register_script('jquery-ui-core', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
			
			wp_enqueue_script("jquery");
			wp_enqueue_script("jquery-ui-core"); 
		}else{
			wp_enqueue_script("jquery-1.7.2", 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
			wp_enqueue_script("jquery-ui-1.8.21",'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js'); 
		}
		//wp_enqueue_script("jquery-1.8.3", 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
		//wp_enqueue_script("jquery-ui-1.9.2",'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		wp_enqueue_script("order-form-msg", get_permalink(get_option('rp_order_form')).'js/ui.achtung-min.js');
		wp_enqueue_script("order-form-common", get_permalink(get_option('rp_order_form')).'js/common.js');
		wp_enqueue_style("order-form", get_permalink(get_option('rp_order_form')).'css/style.css');
		wp_enqueue_style("order-form-achtung", get_permalink(get_option('rp_order_form')).'css/ui.achtung.css');
	}
	wp_enqueue_script("jquery-ui-accordion");
	wp_enqueue_script("jquery-effects-core");
	wp_enqueue_script("jquery-effects-blind");
	wp_enqueue_script("jquery-ui-effects-bounce");
    wp_enqueue_script("jquery-migrate", get_bloginfo('template_url').'/js/jquery-migrate.min.js');
	wp_enqueue_script("jquery-tools", get_bloginfo('template_url').'/js/jquery.tools.min.js');
	wp_enqueue_script("quovolver", get_bloginfo('template_url').'/js/jquery.quovolver.js');
	wp_enqueue_script("flowplayer", get_bloginfo('template_url').'/js/flowplayer-3.2.6.min.js');  
	wp_enqueue_script('colorbox', get_bloginfo('template_url').'/js/jquery.colorbox-min.js');
	wp_enqueue_script('modernizr', get_bloginfo('template_url').'/js/modernizr-1.7.min.js');
	wp_enqueue_script('st-tabs', get_bloginfo('template_url').'/js/init.js');  
    wp_enqueue_script('wrap-table', get_bloginfo('template_url').'/js/wrap-table.js');  
    wp_enqueue_script('mobile-menu', get_bloginfo('template_url').'/js/mobile-menu.js');
	// css files
	wp_enqueue_style("jquery-ui-theme", get_bloginfo('template_url').'/css/style.jquery-ui.css');
}

function rpwp_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}
 
function rpwp_admin_styles() {
	wp_enqueue_style('thickbox');
}
 
if (isset($_GET['page']) && $_GET['page'] == 'functions.php') {
	add_action('admin_print_scripts', 'rpwp_admin_scripts');
	add_action('admin_print_styles', 'rpwp_admin_styles');
}     
 
add_action('wp_enqueue_scripts', 'rpwp_theme_scripts');


if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-1'));

// check if nav menu exists
function is_active_nav_menu($location){

	if(has_nav_menu($location)){

		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_items($locations[$location]);

		if(!empty($menu)){
			return true;
		}

	}

	return false;

}
// get nav menu title
function wp_nav_menu_title( $theme_location ) {
	$title = '';
	if ( $theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $theme_location ] );
			
		if( $menu && $menu->name ) {
			$title = $menu->name;
		}
	}

	return apply_filters( 'wp_nav_menu_title', $title, $theme_location );
}

// Theme short tags
//  Right
function rpwp_rightcolumn($atts, $content = null) {
    return '<div class="rpwp-right-column">' . do_shortcode($content) . '</div><div class="rpwp-column-clear"></div>';
}
add_shortcode("rightcolumn", "rpwp_rightcolumn");
 
//  Left
function rpwp_leftcolumn($atts, $content = null) {
    return '<div class="rpwp-column-clear"></div><div class="rpwp-left-column">' . do_shortcode($content) . '</div>';
}
add_shortcode("leftcolumn", "rpwp_leftcolumn");

function rpwp_order_btn($atts){
	return '<div class="rpwp-orderbtn">'
	.'<span class="rpwp-orderbtn-strip">'.$atts['text'].'</span>'
	.'<span class="rpwp-orderbtn-float"><span class="arrow"></span><a class="rpwp-button'.(@$atts['color']?' '.$atts['color']:'').'" href="'.$atts['href'].'">'
	.$atts['label'].'<span class="gloss"></span></a></span>'
	.'</div>';
}
add_shortcode('order_btn', 'rpwp_order_btn');


function rpwp_sep(){
	return '<div class="rpwp-sep"></div>';
}

add_shortcode('sep', 'rpwp_sep');

// Add extra fields for pages
$prefix = 'rpwp_';

$meta_box = array(
    'id' => 'rpwp-meta-box',
    'title' => 'Pages Header content',
    'page' => 'page',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Select Header type',
            'id' => $prefix . 'header_type',
            'type' => 'select',
            'options' => array( 'none' => '---------', 'web_hosting' => 'Web Hosting', 'vps_compare' => 'VPS Compare', 'vps_virtuozzo' => 'Virtuozzo VPS', 'vps_openvz' => 'OpenVZ VPS', 'semi-dedicated' => 'Semi-Dedicated Servers', 'dedicated' => 'Dedicated Servers', 'domains' => 'Domains')
        ),
        array(
            'name' => 'Title',
            'desc' => 'Content of this filed would be used as a Title of the page.',
            'id' => $prefix . 'title',
            'type' => 'text',
        ),
        array(
            'name' => 'Content',
            'desc' => 'Content of this filed would be used as main Content.',
            'id' => $prefix . 'content',
            'type' => 'textarea'
        ),
        array(
            'name' => 'Meta Title',
            'desc' => 'Content of this filed would be used as main Meta Title (Leave empty for default).',
            'id' => $prefix . 'meta_title',
            'type' => 'text',
			'meta_type' => 'meta_tags'
        ),
        array(
            'name' => 'Meta Description',
            'desc' => 'Content of this filed would be used as main Meta Description.',
            'id' => $prefix . 'meta_description',
            'type' => 'textarea',
			'meta_type' => 'meta_tags'
        ),
        array(
            'name' => 'Meta Keywords',
            'desc' => 'Content of this filed would be used as main Meta Keywords.',
            'id' => $prefix . 'meta_keywords',
            'type' => 'textarea',
			'meta_type' => 'meta_tags'
        )
    )
);



// Add meta box
function rpwp_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'rpwp_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}
add_action('admin_menu', 'rpwp_add_box');

/**
 * Add Tiny MCE editor to textareas used by custom_field_gui
 */

function change_mode_cf( $init ) {
    $edmode = 'specific_textareas';
	$init['mode'] = $edmode;
    return $init;
}

add_filter('tiny_mce_before_init', 'change_mode_cf');

function change_select_cf( $init2 ) {
    $edselect = 'theEditor';
	$init2['editor_selector'] = $edselect;
    return $init2;
}
add_filter('tiny_mce_before_init', 'change_select_cf');

// Callback function to show fields in meta box
function rpwp_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="rpwp_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<h3>The fields below would be used only for pages of type special</h3>
    <table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
		if($field['meta_type']=='meta_tags') continue;
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                    '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea class="theEditor" name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', wp_richedit_pre($meta), '</textarea>',
                    '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $key=>$option) {
                    echo '<option value="'.$key.'"', $meta == $key ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '<td>',
            '</tr>';
    }

    echo '</table><br /><br />';

    echo '<h3>The fields below would be used for META tags</h3>
    <table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
		if($field['meta_type']!='meta_tags') continue;
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                    '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">',  $meta ? $meta : $field['std'], '</textarea>',
                    '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $key=>$option) {
                    echo '<option value="'.$key.'"', $meta == $key ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '<td>',
            '</tr>';
    }

    echo '</table>';
}

add_action('save_post', 'rpwp_save_data');

// Save data from meta box
function rpwp_save_data($post_id) {
    global $meta_box;

    // verify nonce
    $nonce = !empty($_POST['rpwp_meta_box_nonce']) ? $_POST['rpwp_meta_box_nonce'] : null;
	if(!wp_verify_nonce($nonce, basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id']);
        }
    }
}

function rpwp_notice($atts , $content = null){
	return '<p class="header_notice'.($attr['class']?' '.$attr['class']:'').'">'.do_shortcode($content).'</p>';
}

add_shortcode('notice', 'rpwp_notice');


function rpwp_button($atts, $content = null){
	switch ($atts['color']){
		case 'lightblue':
		case 'green':
			break;
		default:
			$atts['color']='';
			break;
	}
	switch ($atts['align']){
		case 'left':
		case 'right':
			break;
		default:
			$atts['align']='';
			break;
	}
	return '<a '.($atts['title']?'title="'.$atts['title'].'"':'').' '.($atts['target']?'target="'.$atts['target'].'"':'').' class="rpwp-button'.($atts['color']?' '.$atts['color']:'').($atts['align']?' '.$atts['align']:'').'" href="'.$atts['href'].'"><span class="gloss"></span>'.(isset($atts['icon'])?'<span class="ico-hosting"></span>':'').do_shortcode($content).'</a>';
}

add_shortcode('button', 'rpwp_button');

function rpwp_link($atts , $content = null){
	switch ($atts['color']){
		case 'lightblue':
		case 'darkblue':
			break;
		default:
			$atts['color']='';
			break;
	}
	switch ($atts['align']){
		case 'left':
		case 'right':
			break;
		default:
			$atts['align']='';
			break;
	}
	return '<a class="'.@$atts['class'].' rpwp_link'.($atts['color']?' '.$atts['color']:'').($atts['align']?' '.$atts['align']:'').(isset($atts['max_width'])?' max_width':'').'" href="'.$atts['href'].'">'.do_shortcode($content).'</a>';
}

add_shortcode('link', 'rpwp_link');

function rpwp_clear_float(){
	return '<br class="clear" />';
}

add_shortcode('clear_float', 'rpwp_clear_float');

function rpwp_resizable_tab($atts, $content = null){
	switch ($atts['size']) {
		case 'big':
		case 'small':
			break;
		default:
			$atts['size']='';
			break;
	}
	switch ($atts['float']) {
		case 'left':
		case 'right':
			break;
		default:
			$atts['position']='';
			break;
	}
	return '<div class="rpwp_resizable_tab '.($atts['size']?' '.$atts['size']:'').($atts['float']?' '.$atts['float']:'').'">'.do_shortcode($content).'</div>';
}

add_shortcode('resizable_tab', 'rpwp_resizable_tab');

function rpwp_category_header($atts, $content = null){
	return '<h2 class="rpwp_category_header">'.do_shortcode($content).'</h2>';
}

add_shortcode('header', 'rpwp_category_header');

function rpwp_doormat($atts, $content){
	return '<div class="rpwp-doormat">'.do_shortcode($content).'</div>';
}

// modify the excerpt "more" appearance an make it clickable
function new_excerpt_more($more) {
	return '<span class="excerpt_more"><a href="'.get_permalink().'">'.__('[continue...]').'</a></span>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function getCustomField($theField) {
	global $post;
	$block = get_post_meta($post->ID, $theField);
	if($block){
		foreach(($block) as $blocks) {
			echo $blocks;
		}
	}
}

// Add meta box
function rpwp_add_box_plans() {
    global $meta_box;

    add_meta_box('rpwp-meta-box-plans', 'Hosting Plans', 'rpwp_show_plans', 'page', 'side', 'low');
}
add_action('admin_menu', 'rpwp_add_box_plans');

function rpwp_show_plans() {
    // Use nonce for verification
    echo '<input type="hidden" name="rpwp_meta_box_plans_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
    if($GLOBALS['rp_info']['shared_plans']){
	echo '<h3>Shared Hosting Plans</h3>
	<table class="form-table" border="0" cellpadding="4" cellspacing="1" bgcolor="#F2F2C7">
		<tr>
			<th align="left" width="300"><strong>Plan Name</strong></th>
			<th><strong>Plan ID</strong></th>
		</tr>';
	foreach ($GLOBALS['rp_info']['shared_plans'] as $plan_id=>$value) {
        echo '<tr valign="top">
			<td bgcolor="#FFFFFF">'.$value['name'].'</th>
			<td bgcolor="#FFFFFF" align="center">'.$plan_id.'</td>
        </tr>';
	}
	echo '</table>
    <br/>';
    }
    if($GLOBALS['rp_info']['vps_plans']){
	echo '<h3>Virtuozzo VPS Plans</h3>
	<table class="form-table" border="0" cellpadding="4" cellspacing="1" bgcolor="#F2F2C7">
		<tr>
			<th align="left" width="300"><strong>Plan Name</strong></th>
			<th><strong>Plan ID</strong></th>
		</tr>';
	foreach ($GLOBALS['rp_info']['vps_plans'] as $plan_id=>$value) {
        echo '<tr valign="top">
			<td bgcolor="#FFFFFF">'.$value['name'].'</th>
			<td bgcolor="#FFFFFF" align="center">'.$plan_id.'</td>
        </tr>';
	}
	echo '</table>
    <br/>';
    }
    if($GLOBALS['rp_info']['vps_kvm_plans']){
	echo '<h3>KVM VPS Plans</h3>
	<table class="form-table" border="0" cellpadding="4" cellspacing="1" bgcolor="#F2F2C7">
		<tr>
			<th align="left" width="300"><strong>Plan Name</strong></th>
			<th><strong>Plan ID</strong></th>
		</tr>';
	foreach ($GLOBALS['rp_info']['vps_kvm_plans'] as $plan_id=>$value) {
        echo '<tr valign="top">
			<td bgcolor="#FFFFFF">'.$value['name'].'</th>
			<td bgcolor="#FFFFFF" align="center">'.$plan_id.'</td>
        </tr>';
	}
	echo '</table>
    <br/>';
    }
    if($GLOBALS['rp_info']['vps_openvz_plans']){
	echo '<h3>OpenVZ VPS Plans</h3>
	<table class="form-table" border="0" cellpadding="4" cellspacing="1" bgcolor="#F2F2C7">
		<tr>
			<th align="left" width="300"><strong>Plan Name</strong></th>
			<th><strong>Plan ID</strong></th>
		</tr>';
	foreach ($GLOBALS['rp_info']['vps_openvz_plans'] as $plan_id=>$value) {
        echo '<tr valign="top">
			<td bgcolor="#FFFFFF">'.$value['name'].'</th>
			<td bgcolor="#FFFFFF" align="center">'.$plan_id.'</td>
        </tr>';
	}
	echo '</table>
    <br/>';
    }
    if($GLOBALS['rp_info']['semi_dedicated_plans']){
	echo '<h3>Semi-Dedicated Plans</h3>
	<table class="form-table" border="0" cellpadding="4" cellspacing="1" bgcolor="#F2F2C7">
		<tr>
			<th align="left" width="300"><strong>Plan Name</strong></th>
			<th><strong>Plan ID</strong></th>
		</tr>';
	foreach ($GLOBALS['rp_info']['semi_dedicated_plans'] as $plan_id=>$value) {
        echo '<tr valign="top">
			<td bgcolor="#FFFFFF">'.$value['name'].'</th>
			<td bgcolor="#FFFFFF" align="center">'.$plan_id.'</td>
        </tr>';
	}
	echo '</table>
    <br/>';
    }
    if($GLOBALS['rp_info']['dedicated_plans']){
	echo '<h3>Dedicated Plans</h3>
	<table class="form-table" border="0" cellpadding="4" cellspacing="1" bgcolor="#F2F2C7">
		<tr>
			<th align="left" width="300"><strong>Plan Name</strong></th>
			<th><strong>Plan ID</strong></th>
		</tr>';
	foreach ($GLOBALS['rp_info']['dedicated_plans'] as $plan_id=>$value) {
        echo '<tr valign="top">
			<td bgcolor="#FFFFFF">'.$value['name'].'</th>
			<td bgcolor="#FFFFFF" align="center">'.$plan_id.'</td>
        </tr>';
	}
	echo '</table>
    <br/>';
    }
}

// Theme Options
$theme_options = array (
    array( "name" => "Theme Options",
           "type" => "title"),
    array( "type" => "open"),
    array( "name" => "Color Scheme",
           "desc" => "Select the color scheme for the theme",
           "id" => $prefix."theme_color_scheme",
           "type" => "select",
           "options" => $GLOBALS['theme_colors'],
           "std" => $GLOBALS['theme_color_default']),
/*	array( "name" => "Logo URL",
           "desc" => "Enter the link to your logo image",
           "id" => $prefix."logo_url",
           "type" => "logo",
           "std" => ""), */
	array( "name" => "Copyright Text",
           "desc" => "Enter the bottom copyright text",
           "id" => $prefix."copyright_text",
           "type" => "text",
           "std" => ""),
	array( "name" => "Analytics/Tracking Code",
		   "desc" => "You can paste your Google Analytics or other website tracking code in this box. This will be automatically added to the footer.",
		   "id" => $prefix."analytics_code",
		   "type" => "textarea",
		   "std" => ""),
    array( "type" => "close")
	);

function mytheme_add_admin() {
	global $theme_options;
	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($theme_options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
			foreach ($theme_options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} else { 
					delete_option( $value['id'] ); 
				} 
			}
			header("Location: themes.php?page=functions.php&saved=true");
			die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($theme_options as $value) {
				delete_option( $value['id'] ); 
			}
			header("Location: themes.php?page=functions.php&reset=true");
			die;
		}
	}
	add_theme_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
	global $theme_options;
	if ( $_REQUEST['saved'] ) echo '<div id="message"><p><strong>Theme settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message"><p><strong>Theme settings reset.</strong></p></div>';
?>
<div class="wrap">
<h2>Theme Settings</h2>

<form method="post">

<?php foreach ($theme_options as $value) {
switch ( $value['type'] ) {

case "open":
?>
<table width="100%" border="0" style="background-color:#FBFBEC; padding:5px;">

<?php break;

case "close":
?>

</table><br />

<?php break;

case "title":
?>
<table width="100%" border="0" style="background-color:#F2F2C7; padding:5px 10px;"><tr>
<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
</tr>
<?php break;

case 'text':
?>

<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr>

<tr>
<td><em><?php echo $value['desc']; ?></em></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php break;

case 'logo':
?>

<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<input id="upload_image_button" type="button" value="Upload Image" />
<script language="javascript">
jQuery(document).ready(function() {
 
jQuery('#upload_image_button').click(function() {
 formfield = jQuery('#<?php echo $value['id']; ?>').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});
 
window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#<?php echo $value['id']; ?>').val(imgurl);
 tb_remove();
}
 
});
</script>
</td>
</tr>

<tr>
<td><em><?php echo $value['desc']; ?></em></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'textarea':
?>

<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?></textarea></td>

</tr>

<tr>
<td><em><?php echo $value['desc']; ?></em></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'select':
?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_option( $value['id'], $value['std'] ) == $option) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>

<tr>
<td><em><?php echo $value['desc']; ?></em></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case "checkbox":
?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
</td>
</tr>

<tr>
<td><em><?php echo $value['desc']; ?></em></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php break;

}
}
?>

<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');

// Admin footer modification

function remove_footer_admin ()
{
	echo '<span id="footer-thankyou">Developed by <a href="http://www.resellerspanel.com" target="_blank">ResellersPanel.com</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Custom callback to list comments in the your-theme style
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-author vcard"><?php commenter_link() ?></div>
        <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'your-theme'),
                    get_comment_date(),
                    get_comment_time(),
                    '#comment-' . get_comment_ID() );
                    edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'your-theme'); ?>
          <div class="comment-content">
            <?php comment_text() ?>
        </div>
        <?php // echo the comment reply link
            if($args['type'] == 'all' || get_comment_type() == 'comment') :
                comment_reply_link(array_merge($args, array(
                    'reply_text' => __('Reply','your-theme'),
                    'login_text' => __('Log in to reply.','your-theme'),
                    'depth' => $depth,
                    'before' => '<div class="comment-reply-link">',
                    'after' => '</div>'
                )));
            endif;
} // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'your-theme'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'your-theme') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
<?php } // end custom_pings

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
    $commenter = get_comment_author_link();
    if ( preg_match('|<a[^>]* class=[^>]+>|', $commenter ) ) {
        $commenter = preg_replace('|(<a[^>]* class=[\'"]?)|', '$1url ' , $commenter );
    } else {
        $commenter = preg_replace('|(<a )/|', '$1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link



//************** BEGIN THEME UPDATER **********************	
/******************Change this*******************/
$api_url = 'http://duoservers.com/plugin/';
/************************************************/

/***********************Parent Theme**************/
if(function_exists('wp_get_theme')){
    $theme_data = wp_get_theme(get_option('template'));
    $theme_version = $theme_data->Version;  
} else {
    $theme_data = get_theme_data( TEMPLATEPATH . '/style.css');
    $theme_version = $theme_data['Version'];
}    
$theme_base = get_option('template');
/**************************************************/

add_filter('pre_set_site_transient_update_themes', 'check_for_update');

function check_for_update($checked_data) {
	global $wp_version, $theme_version, $theme_base, $api_url;

	$request = array(
		'slug' => $theme_base,
		'version' => $theme_version 
	);
	// Start checking for an update
	$send_for_check = array(
		'body' => array(
			'action' => 'theme_update', 
			'request' => serialize($request),
			'api-key' => md5(get_bloginfo('url'))
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
	);
	$raw_response = wp_remote_post($api_url, $send_for_check);
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);

	// Feed the update data into WP updater
	if (!empty($response)) 
		$checked_data->response[$theme_base] = $response;

	return $checked_data;
}

// Take over the Theme info screen on WP multisite
add_filter('themes_api', 'my_theme_api_call', 10, 3);

function my_theme_api_call($def, $action, $args) {
	global $theme_base, $api_url, $theme_version, $api_url;
	
	if ($args->slug != $theme_base)
		return false;
	
	// Get the current version

	$args->version = $theme_version;
	$request_string = prepare_request($action, $args);
	$request = wp_remote_post($api_url, $request_string);

	if (is_wp_error($request)) {
		$res = new WP_Error('themes_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('themes_api_failed', __('An unknown error occurred'), $request['body']);
	}
	
	return $res;
}

if (is_admin())
	$current = get_transient('update_themes');
//************** END THEME UPDATER **********************	

//--------breadcrumbs-----------//
function dimox_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&frasl;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}
//--------breadcrumbs-----------//

?>