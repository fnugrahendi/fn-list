<?php
/*
Plugin Name: List
Plugin URI: https://github.com/fnugrahendi/fn-list
Description: Simple List with backend menus, shortcode, and widget
Version: 1.0
Author: Ferindra Nugrahendi
*/

//~ add into admin menu
add_action( 'admin_menu', 'fn_admin_menu' );

function fn_admin_menu() {
	add_menu_page( 
		'List', 
		'Simple List', 
		'manage_options', 
		'fn-list.php', 
		'slist_admin_page', 
		'dashicons-editor-ol', 
		14
	);
}

//~ admin page function
function slist_admin_page(){
	?>
	<div class="wrap">
		<h1>Simple List</h2>
	</div>
	<?php
}

?>
