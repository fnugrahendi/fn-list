<?php
//~ init widget
class FN_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'fn_widget', // Base ID
			esc_html__( 'FN Simple List', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'List widget', 'text_domain' ), ) // Args
		);
	}

	//~ Frontend
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$table = $GLOBALS['wpdb']->prefix.'fnlist';
		$results = $GLOBALS['wpdb']->get_results('SELECT * FROM '.$table.'');
		$rowNum = $GLOBALS['wpdb']->num_rows;
		$isMore = false;
		if($rowNum > 10) {
			$n = 10;
			$isMore = true;
		}
		else $n = $rowNum;
		for($idx = 0; $idx < $n; $idx++){
			$order = $results[$idx]->order;
			$name = $results[$idx]->name;
			echo esc_html__('#'.$order.'  ', 'text_domain' );
			echo esc_html__($name, 'text_domain' );
			echo "<br>";
		}
		if($isMore){
			echo '<a href="#">See more ...</a>';
		}
		echo $args['after_widget'];
	}

	//~ Backend
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	//~ Sanitize value
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}
//~ register widget
function register_fn_widget() {
    register_widget( 'FN_Widget' );
}
add_action( 'widgets_init', 'register_fn_widget' );

?>
