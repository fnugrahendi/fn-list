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
		<h1>Simple List</h2><br>
	<?php
	$table = $GLOBALS['wpdb']->prefix.'fnlist';
	$results = $GLOBALS['wpdb']->get_results('SELECT * FROM '.$table.'');
	?>
	<table class="wp-list-table fixed widefat stripped">
		<thead>
			<tr>
				<td style="width: 55px">Order</td>
				<td style="width: 155px">Name</td>
				<td>Description</td>
				<td style="width: 50px">Action</td>
			</tr>
		</thead>
		<tbody>
	<?php
	foreach($results as $record => $row){
		echo '<tr>';
		echo '<td>'.$row->order.'</td>';
		echo '<td>'.$row->name.'</td>';
		echo '<td>'.$row->description.'</td>';
		echo '<td style="text-align: center">';
		echo '<a href="#" onclick="test('.$row->id.')">';
		echo '<span class="dashicons dashicons-trash"></span>';
		echo '</a>';
		echo '</td>';
		echo '</tr>';
		echo '</form>';
	}
	echo '</tbody>';
	echo '</table>';
	
	echo '<div class="input_list" style="margin: 55px 0px;">';
	echo '<h3>Add New List</h3>';
	echo '<form action="'.esc_url($_SERVER['REQUEST_URI']).'" method = "post">';
	echo '<p>';
	echo 'Order (*) <br>';
	echo '<input type="number" name="fn-order" value="'.(isset($_POST["fn-order"]) ? esc_attr($_POST["fn-order"]):'').'" size="4">';
	echo '</p><p>';
	echo 'Name (*) <br>';
	echo '<input type="text" name="fn-name" value="'.(isset($_POST["fn-name"]) ? esc_attr($_POST["fn-name"]):'').'" size="35"/>';
	echo '</p><p>';
	echo 'Description (*) <br>';
	echo '<textarea rows="4" cols="35" name="fn-desc">' . ( isset( $_POST["fn-desc"] ) ? esc_attr( $_POST["fn-desc"] ) : '' ) . '</textarea>';
	echo '</p>';
	echo '<p><input type="submit" name="fn-add" value="Add"/></p>';
	echo '</form>';
	echo '</div>';
	
	echo '</div>';
}

?>
