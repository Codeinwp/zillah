<?php
/**
 * Customize control for choosing fonts
 *
 * @package zillah
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Class Zillah_Google_Fonts_Control
	 */
	class Zillah_Google_Fonts_Control extends WP_Customize_Control {

		/**
		 * Options for the control
		 *
		 * @var array
		 */
		private $options = array();

		/**
		 * Id of the control
		 *
		 * @var int|string
		 */
		private $control_id = '';

		/**
		 * Zillah_Google_Fonts_Control constructor.
		 *
		 * @param object  $manager Manager.
		 * @param integer $id Id.
		 * @param array   $args The arguments.
		 */
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			$this->options    = $args;
			$this->control_id = $id;
		}

		/**
		 * Create the control
		 */
		public function render_content() {
			$options    = $this->options;
			$control_id = $this->control_id;

			$ti_google_fonts = '';
			if ( ! empty( $options['ti_google_fonts'] ) ) {
				foreach ( $options['ti_google_fonts'] as $zilla_font ) {
					$ti_input_value   = implode( '|', $zilla_font );
					$ti_google_fonts .= '<label class="ti-google-font-label" style="font-family:\'' . esc_attr( $zilla_font['font_family'] ) . '\',' . esc_attr( $zilla_font['type'] ) . '"><input type="radio" name="' . esc_attr( $control_id ) . '" value="' . esc_attr( $ti_input_value ) . '">' . esc_html( $zilla_font['font_family'] ) . '</label>';
				}

				// Hackily add in the data link parameter.
				$ti_google_fonts = str_replace( '<input', '<input ' . $this->get_link(), $ti_google_fonts );
			}
			printf(
				'<div class="ti-google-fonts"><span class="customize-control-title">%s</span><div class="ti-google-fonts-wrap">%s</div></div>',
				$this->label,
				( ! empty( $ti_google_fonts ) ? $ti_google_fonts : __( 'No fonts to show', 'zillah' ) )
			);

		}

	}
}// End if().

