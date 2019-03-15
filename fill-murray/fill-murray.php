<?php
/**
 * This will be a simple plugin to display a picture of Bill Murray at the end of every post.
 *
 * @package Fill Murray
 * @author Anthony Klyza
 * @license GPL-2.0+
 * @link https://klyza.design
 * @copyright 2019 Klyza Design. All rights reserved.
 *            @wordpress-plugin
 *            Plugin Name: Fill Murray
 *            Plugin URI:
 *            Description: A simple plugin to display a picture of Bill Murray at the end of every post..
 *            Version: 1.0
 *            Author: Anthony Klyza
 *            Author URI: https://klyza.design
 *            Text Domain: fill-murray
 *            Contributors: Anthony Klyza
 *            License: GPL-2.0+
 *            License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Adding Submenu under Settings Tab
 *
 * @since 1.0
 */
function add_menu() {
	add_submenu_page ( "options-general.php", "Fill Murray", "Fill Murray", "manage_options", "fill-murray", "fill_murray_page" );
}
add_action ( "admin_menu", "add_menu" );

/**
 * Setting Page Options
 *
 * @since 1.0
 */
function fill_murray_page() {
	?>
<div class="wrap">
	<h1>
		Fill Murrary By <a
			href="https://klyza.design" target="_blank">Anthony Klyza</a>
	</h1>

	<form method="post" action="options.php">
            <?php
	settings_fields ( "fill_murray_config" );
	do_settings_sections ( "fill-murray" );
	submit_button ();
	?>
         </form>
</div>

<?php
}

/**
 * Init setting section
 *
 * @since 1.0
 */
function fill_murray_settings() {
	add_settings_section ( "fill_murray_config", "", null, "fill-murray" );
	add_settings_field ( "fill-murray-width", "", "fill_murray_options", "fill-murray", "fill_murray_config" );
	register_setting ( "fill_murray_config", "fill-murray-width" );
    register_setting ( "fill_murray_config", "fill-murray-height" );
}
add_action ( "admin_init", "fill_murray_settings" );

/**
 * Add number field value to setting page
 *
 * @since 1.0
 */
function fill_murray_options() {
	?>
<div class="postbox" style="padding: 30px;">
    <label for="fill-murray-width">Width (400-600px):</label>
	<input type="number" name="fill-murray-width" min="400" max="600" value="<?php echo get_option ( 'fill-murray-width' ); ?>" />
</div>
<div class="postbox" style="padding: 30px;">
    <label for="fill-murray-height">Height (400-600px):</label>
	<input type="number" name="fill-murray-height" min="400" max="600" value="<?php echo get_option ( 'fill-murray-height' ); ?>" />
</div>
<?php
}

/**
 * Append image to each post
 *
 * @since 1.0
 */
add_filter ( 'the_content', 'fill_murray_content' );

function fill_murray_content($content) {
    if(get_option('fill-murray-width') && get_option('fill-murray-height')){
        return $content . '<img src="https://www.fillmurray.com/' . get_option ( 'fill-murray-width' ) . '/' . get_option ( 'fill-murray-height' ) . ' "/>';
    } else {
        return $content;
    }
}
