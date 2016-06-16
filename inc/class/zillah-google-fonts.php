<?php
if (class_exists('WP_Customize_Control')) {
	class Zillah_Google_Fonts_Control extends WP_Customize_Control {
		/**
		 * Render the control's content.
		 *
		 * @since 3.4.0
		 */

		private $options = array();
		private $control_id = '';

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			$this->options = $args;
			$this->control_id = $id;
		}

		public function render_content() {
			$options = $this->options;
			$control_id = $this->control_id;

			$ti_google_fonts = '';
			foreach( $options['ti_google_fonts'] as $zilla_font ) {
				$ti_input_value = implode( '|', $zilla_font);
				$ti_google_fonts .= '<label class="ti-google-font-label" style="font-family:\''.$zilla_font['font_family'].'\','.$zilla_font['type'].'"><input type="radio" name="'.$control_id.'" value="'. $ti_input_value .'">'. $zilla_font['font_family'] .'</label>';
			}

			// Hackily add in the data link parameter.
			$ti_google_fonts = str_replace( '<input', '<input ' . $this->get_link(), $ti_google_fonts );

			printf(
				'<div class="ti-google-fonts"><span class="customize-control-title">%s</span><div class="ti-google-fonts-wrap">%s</div></div>',
				$this->label,
				$ti_google_fonts
			);

		}

	}
}
?>