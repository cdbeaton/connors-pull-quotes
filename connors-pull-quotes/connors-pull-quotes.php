<?php
/*
Plugin Name:  Connor's Pull Quotes
Description:  Easy and attractive pull quotes for WordPress posts
Version:      1.0.0
Author:       Connor Beaton
License:      GPL3
License URI:  https://www.gnu.org/licenses/gpl-3.0.txt

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

defined('ABSPATH') or die("Unauthorised access - shutting down.");

function pullquotes_init()
{
	wp_register_style('pullquotes-style', plugins_url().'/connors-pull-quotes/pullquotes.css', false, '1.0.0', 'all');
	
	function show_pullquote($atts = [], $content = null)
	{
		$align = null;
		switch($atts['align']){
			case 'right': $align = 'rightquote'; break;
			case 'left': $align = 'leftquote'; break;
			default: $align = 'centrequote'; break;
		}
		$content = '<div class="quotecontainer '.$align.'"><div class="pullquote"><p>'.$content.'</p></div>';
		if($atts['author']!=''){ $content .= '<div class="quoteauthor">'.$atts['author'].'</div>'; }
		$content .= '</div>';
		return $content;
	}
	add_shortcode('pullquote', 'show_pullquote');
}

function enqueue_style(){ wp_enqueue_style('pullquotes-style'); }

function pullquotes_admin_init()
{
	function add_tinymce_plugin($plugin_array){
		$plugin_array['pullquotes'] = plugins_url().'/connors-pull-quotes/pullquotes.js';
		return $plugin_array;
	}
	
	function add_tinymce_toolbar_button($buttons){
		array_push($buttons, '|', 'pullquotes');
		return $buttons;
	}
	
	if(!current_user_can('edit_posts') && !current_user_can('edit_pages')){ return; }
	if(get_user_option('rich_editing')!='true'){ return; }

	add_filter('mce_external_plugins', 'add_tinymce_plugin');
	add_filter('mce_buttons', 'add_tinymce_toolbar_button');
}

add_action('init', 'pullquotes_init');
add_action('wp_enqueue_scripts', 'enqueue_style');
if(is_admin()){ add_action('init', 'pullquotes_admin_init'); }

?>