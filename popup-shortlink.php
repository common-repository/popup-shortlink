<?php

/*
Plugin Name: PopUP Shortlink
Plugin URI: http://www.maxence-blog.fr/2011/05/04/plugin-wordpress-popup-shortlink/
Description: <strong>PopUP Shortlink</strong> to display a small window displaying the URL with the API <strong>Bit.ly</strong>, the API <strong>TinyURL.com</strong> or the API <strong>0Ab.fr</strong> when the visitor clicks on a link in an article. Visitor can continue his visit to the site if he clicks on close or continue.
Author: Maxence Rose
Version: 1.3.1
Author URI: http://www.maxence-blog.fr/
*/

// Load translates
load_plugin_textdomain('popup-shortlink', false, dirname(plugin_basename( __FILE__ )) . '/languages/');

// Plugin Path
function popup_shortlink_path()
{
	$plugin_path = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "", plugin_basename(__FILE__));
	return $plugin_path;
}

function popup_shortlink_path_server_blog()
{
	$popup_shortlink_path = popup_shortlink_path();
	$popup_shortlink_path = trim($popup_shortlink_path);
	$popup_shortlink_path = str_replace('http://', '', $popup_shortlink_path);
	$popup_shortlink_path = str_replace('https://', '', $popup_shortlink_path);
	$explode_popup_shortlink_path = explode('/', $popup_shortlink_path);
	$new_popup_shortlink_path = popup_shortlink_path();
	$new_popup_shortlink_path = str_replace('http://' . $explode_popup_shortlink_path[0], '', $new_popup_shortlink_path);
	$new_popup_shortlink_path = str_replace('https://' . $explode_popup_shortlink_path[0], '', $new_popup_shortlink_path);

	return $new_popup_shortlink_path;
}

function popup_shortlink_plugins_link($links, $file)
{
    if($file == plugin_basename(__FILE__))
	{
        $popup_shortlink_link = '<a href="http://www.devence.com/" target="_blank">' . __("Make a donation", "popup-shortlink") . '</a>';
        $links[] = $popup_shortlink_link;
        $popup_shortlink_link = '<a href="http://pirmax.fr/2011/06/03/traductions-pour-le-plugin-popup-shortlink/" target="_blank">' . __("More translations", "popup-shortlink") . '</a>';
        $links[] = $popup_shortlink_link;
    }
    return $links;
}

add_filter('plugin_row_meta', 'popup_shortlink_plugins_link', 10, 2);

function popup_shortlink_wp_head()
{
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . popup_shortlink_path() . "ps_style.css\" />\n";
	echo "<script type=\"text/javascript\" src=\"" . popup_shortlink_path() . "ps_functions.js\"></script>\n";
	echo "<script type=\"text/javascript\"> document.write(popup_shortlink_content('" . popup_shortlink_path_server_blog() . "')); </script>\n";
}

function popup_shortlink_change_link($content = '')
{
	$new_content = str_replace('<a href=', '<a onclick="popup_shortlink_display(this.href, \'open\', \'' . popup_shortlink_path_server_blog() . '\'); return false;" href=', $content);
	return $new_content;
}

function popup_shortlink_options()
{
	add_options_page('PopUP Shortlink', 'PopUP Shortlink', 'manage_options', basename(__FILE__), 'popup_shortlink_admin_page');
}

function popup_shortlink_admin_page()
{
	include('ps_pages.php');
}

function popup_shortlink_uninstall()
{
	delete_option('ps_bitly_user');
	delete_option('ps_bitly_api');
	delete_option('ps_url_shortner');
}

function popup_shortlink_init()
{
	if(function_exists('register_setting'))
	{
		register_setting('ps-options', 'ps_bitly_user');
		register_setting('ps-options', 'ps_bitly_api');
		register_setting('ps-options', 'ps_url_shortner');
	}

	add_option('ps_bitly_user', '');
	add_option('ps_bitly_api', '');
	add_option('ps_url_shortner', '0abfr');
}

if(is_admin())
{
    add_action('admin_menu', 'popup_shortlink_options');
	add_action('admin_init', 'popup_shortlink_init');
}

add_action('wp_head', 'popup_shortlink_wp_head');
add_filter('the_content', 'popup_shortlink_change_link');

register_activation_hook(__FILE__, 'popup_shortlink_activate');
register_uninstall_hook(__FILE__, 'popup_shortlink_uninstall');

function popup_shortlink_plugin_action_links($links, $file)
{

	static $this_plugin;

	if(!$this_plugin)
	{
		$this_plugin = plugin_basename(__FILE__);
	}

	if($file == $this_plugin)
	{
		$settings_link = '<a href="options-general.php?page=popup-shortlink.php">' . __("Settings", "popup-shortlink") . '</a>';
		array_unshift($links, $settings_link);
	}

	return $links;

}

add_filter('plugin_action_links', 'popup_shortlink_plugin_action_links', 10, 2 );

?>
