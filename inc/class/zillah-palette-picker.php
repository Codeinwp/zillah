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
				'color1'=>'#FF9F8C',
				'color2'=>'#495356',
				'color3'=>'#B1AFA9',
				'color4'=>'#F6F6F6',
				'color5'=>'#189AC4'
			),
			array(
				'pallete_name'=>'p1',
				'color1'=>'#7fcaad',
				'color2'=>'#575756',
				'color3'=>'#6f6e6b',
				'color4'=>'#F6F6F6',
				'color5'=>'#373735'
			),
			array(
				'pallete_name'=>'p1',
				'color1'=>'#7fcaad',
				'color2'=>'#575756',
				'color3'=>'#6f6e6b',
				'color4'=>'#F6F6F6',
				'color5'=>'#373735'
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