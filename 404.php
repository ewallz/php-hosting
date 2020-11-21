<?php 
get_header();

remove_filter ('the_content', 'wpautop');
?>

<div id="default_content" <?php if(isset($left_menu) && $left_menu) echo 'class="rpwp_content_with_left_menu"'?>>

  <div id="aboutus-content-main">
    <h1>Error 404: Page Not Found!</h1><br />
    <br/>
    <img src="<?php bloginfo( 'template_url' ); ?>/images/404-img.png" width="252" height="258" style="float:left; margin-right:40px;" />
    <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please try the following:</p>
    <ul>
        <li>If you typed the page address in the Address bar, make sure that it is spelled correctly;</li>
        <li>Open the www.your-site.com home page, and then look for links to the information you want;</li>
        <li>Click the &laquo; Back button to try another link;</li>
    </ul>
    <br clear="all" />
    <br /><br />
    <h2>Quick Links:</h2>
    <ul>
        <li><a href="<?php echo bloginfo('url');?>">Home Page</a></li>
        <li><a href="<?php echo rp_default_page_link(array('key'=>"shared"));?>">Web hosting</a></li>
		<li><a href="<?php echo rp_default_page_link(array('key'=>"domains"));?>">Domain Names</a></li>
        <li><a href="<?php echo rp_default_page_link(array('key'=>"application_installer"));?>">1 Click Scripts Installer</a></li>
        <li><a href="<?php echo get_permalink(get_option('rp_order_form'));?>">Order</a></li>
    </ul>
 </div>
 <div id="aboutus-sidebar">
 <?php echo rp_customer_support_sidebar_box()?>
  <div class="line"></div>
 <?php echo rp_datacenters_1_sidebar_box()?>
  <div class="line"></div>
 <?php echo rp_datacenters_2_sidebar_box()?>
  <div class="line"></div>
 <?php echo rp_hepsia_cp_sidebar_box()?>
  <div class="line"></div>
 <?php echo rp_email_manager_sidebar_box()?>
  <div class="line"></div>
 <?php echo rp_web_accelerators_sidebar_box()?>
  <div class="line"></div>
 <?php echo rp_click_installer_sidebar_box()?>
  <div class="line"></div>
 <?php echo rp_domain_manager_sidebar_box()?>
 </div> 
  <br clear="all" /><br/>
 
</div>
<?php get_footer(); ?>
