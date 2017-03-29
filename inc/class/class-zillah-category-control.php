<?php
/**
 * Customize control for categories selector
 *
 * @package zillah
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Class Zillah_Category_Control
	 */
	class Zillah_Category_Control extends WP_Customize_Control {
		/**
		 * Render the control's content.
		 *
		 * @since 3.4.0
		 */
		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => __( '&mdash; Select &mdash;', 'zillah' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);
			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}
}
