<?php
/*
Plugin Name: Google +1 Easy Button
Plugin URI: http://gfxcomplex.com/
Description: easy way to create a Google +1 button in wordpress. example [plus1 size=small]http://somelink[/plus1]
Author: Joshua Randall Chernoff | GFX Complex
Version: 1.0
Author URI: http://gfxcomplex.com
*/
	
/*  Copyright 2011  Josh Chenroff GFX Complex (jchernoff[at]gfxcomplex.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_shortcode('plus1', 'writePlusOneButtonCode');  
add_action('init', 'add_plus1_button');  

function writePlusOneButtonCode($atts, $content) {  
    extract(shortcode_atts(array(  
        "size" => 'standard',  
		"count" => 'true'
    ), $atts));  
	
	$button_string = "<g:plusone"; 
	if($content){
		$button_string .= " href='". $content . "'";
	}	
	$button_string .= " size='".$size."' count='". $count ."'></g:plusone>";

	return $button_string;
}


function add_plus1_button() {
	wp_register_script( 'plusone', 'https://apis.google.com/js/plusone.js' );
	wp_enqueue_script( 'plusone' );
	
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }
 
   if ( get_user_option('rich_editing') == 'true' ) {
		add_filter('mce_external_plugins', 'add_plus1_plugin');  
    	add_filter('mce_buttons', 'register_plus1_button');  
   }
 
}

function add_plus1_plugin($plugin_array) {
   $plugin_array['plus1'] = get_bloginfo('wpurl').'/wp-content/plugins/'.basename(dirname(__FILE__)).'/js/customcodes.js';
   return $plugin_array;
}
function register_plus1_button($buttons) {
   array_push($buttons, "|",  "plus1");
   return $buttons;
}

function addHeaderCode() {
	
}

?>