<?php
/**
 * A class to create a dropdown for theme colors
 */
class Zillah_Palette extends WP_Customize_Control {

	/**
	 * Render the content of the category dropdown
	 *
	 * @return HTML
	 */
	public function render_content() {

		$values = $this->value();
		$json = json_decode($values);

		$zillah_pallete = array(
			array(
				'pallete_name'=>'p1',
				'color1'=>'#be624d',
				'color2'=>'#f5876e',
				'color3'=>'#be624d',
				'color4'=>'#f6f6f6',
				'color5'=>'#6f6e6b'
			),
			array(
				'pallete_name'=>'p1',
				'color1'=>'#b0606d',
				'color2'=>'#f59f4c',
				'color3'=>'#ffc154',
				'color4'=>'#fafafa',
				'color5'=>'#6f6e6b'
			),
			array(
				'pallete_name'=>'p1',
				'color1'=>'#333331',
				'color2'=>'#c2a26f',
				'color3'=>'#E2C9A1',
				'color4'=>'#f6f6f6',
				'color5'=>'#6f6e6b'
			),
		);
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		</label>
		<div class="zillah_palette_selected">
			<div class="zillah_palette_input">
				<?php
				if(!empty($json)){
					foreach($json as $color){
						echo '<span style="background-color:'.$color.'"></span>';
					}
				} else {
					esc_html_e('Default','zillah');
				}
				?>
			</div>
			<div class="zillah_dropdown">&#x25BC;</div>
		</div>
		<ul class="zillah_palette_picker">
			<?php
			echo '<li class="zillah_pallete_default">';
			esc_html_e('Default','zillah');
			echo '</li>';
			foreach($zillah_pallete as $pallete){
				echo '<li class="'.$pallete['pallete_name'].'">';
				echo '<span style="background-color:'.$pallete['color1'].'"></span>';
				echo '<span style="background-color:'.$pallete['color2'].'"></span>';
				echo '<span style="background-color:'.$pallete['color3'].'"></span>';
				echo '<span style="background-color:'.$pallete['color4'].'"></span>';
				echo '<span style="background-color:'.$pallete['color5'].'"></span>';
				echo '</li>';
			}
			?>
		</ul>
		<input class='zillah_palette_colector' type='hidden' value='' <?php $this->link(); ?> />
		<?php
	}
}

?>