<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage PHP Hosting
 * @since PHP Hosting 1.0
 */
?>
<div id="sidebar">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
<?php endif; ?>
</ul>
</div>
