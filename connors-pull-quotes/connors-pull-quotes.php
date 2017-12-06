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
	wp_register_style('new_style', plugins_url('/css/pullquotes.css', __FILE__), false, '1.0.0', 'all');
	
	function show_pullquote($atts = [], $content = null)
	{
		$align = null;
		switch($atts['align']){
			case 'right': $align = 'rightquote';
			case 'centre': $align = 'centrequote';
			case 'left': $align = 'leftquote';
			default: $align = 'centrequote';
		}
		$content = '<div class="'.$align.'">'.$content;
		if($atts['author']!=''){ $content .= '<div class="quoteauthor">'.$atts['author'].'</div>'; }
		$content .= '</div>';
		return $content;
	}
	add_shortcode('pullquote', 'show_pullquote');
}

add_action('init', 'pullquotes_init');

?>