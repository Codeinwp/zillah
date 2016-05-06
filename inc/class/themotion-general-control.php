<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class Themotion_General_Repeater extends WP_Customize_Control {

        private $options = array();

        public function __construct( $manager, $id, $args = array() ) {
            parent::__construct( $manager, $id, $args );
            $this->options = $args;
        }

        public function render_content() {


            $this_default = json_decode($this->setting->default);


            $values = $this->value();
            $json = json_decode($values);
            if(!is_array($json)) $json = array($values);
            $it = 0;

            $options = $this->options;
            if(!empty($options['zillah_icon_control'])){
                $zillah_icon_control = $options['zillah_icon_control'];
                $icons_array = array('none' => 'none','500px' => 'fa-500px','amazon' => 'fa-amazon','android' => 'fa-android','behance' => 'fa-behance','behance-square' => 'fa-behance-square','bitbucket' => 'fa-bitbucket','bitbucket-square' => 'fa-bitbucket-square','american-express' => 'fa-cc-amex','diners-club' => 'fa-cc-diners-club','discover' => 'fa-cc-discover','jcb' => 'fa-cc-jcb','mastercard' => 'fa-cc-mastercard','paypal' => 'fa-cc-paypal','stripe' => 'fa-cc-stripe','visa' => 'fa-cc-visa','codepen' => 'fa-codepen','css3' => 'fa-css3','delicious' => 'fa-delicious','deviantart' => 'fa-deviantart','digg' => 'fa-digg','dribble' => 'fa-dribbble','dropbox' => 'fa-dropbox','drupal' => 'fa-drupal','facebook' => 'fa-facebook','facebook-official' => 'fa-facebook-official','facebook-square' => 'fa-facebook-square','flickr' => 'fa-flickr','foursquare' => 'fa-foursquare','git' => 'fa-git','git-square' => 'fa-git-square','github' => 'fa-github','github-alt' => 'fa-github-alt','github-square' => 'fa-github-square','google' => 'fa-google','google-plus' => 'fa-google-plus','google-plus-square' => 'fa-google-plus-square','html5' => 'fa-html5','instagram' => 'fa-instagram','joomla' => 'fa-joomla','jsfiddle' => 'fa-jsfiddle','linkedin' => 'fa-linkedin','linkedin-square' => 'fa-linkedin-square','opencart' => 'fa-opencart','openid' => 'fa-openid','paypal' => 'fa-paypal','pinterest' => 'fa-pinterest','pinterest-p' => 'fa-pinterest-p','pinterest-square' => 'fa-pinterest-square','rebel' => 'fa-rebel','reddit' => 'fa-reddit','reddit-square' => 'fa-reddit-square','share' => 'fa-share-alt','share-square' => 'fa-share-alt-square','skype' => 'fa-skype','slack' => 'fa-slack','soundcloud' => 'fa-soundcloud','spotify' => 'fa-spotify','stack-overflow' => 'fa-stack-overflow','steam' => 'fa-steam','steam-square' => 'fa-steam-square','tripadvisor' => 'fa-tripadvisor','tumblr' => 'fa-tumblr','tumblr-square' => 'fa-tumblr-square','twitch' => 'fa-twitch','twitter' => 'fa-twitter','twitter-square' => 'fa-twitter-square','vimeo' => 'fa-vimeo','vimeo-square' => 'fa-vimeo-square','vine' => 'fa-vine','whatsapp' => 'fa-whatsapp','wordpress' => 'fa-wordpress','yahoo' => 'fa-yahoo','youtube' => 'fa-youtube','youtube-play' => 'fa-youtube-play','youtube-squar' => 'fa-youtube-square');
            } else {
                 $zillah_icon_control = false;
            }

            if(!empty($options['zillah_link_control'])){
                $zillah_link_control = $options['zillah_link_control'];
            } else {
                $zillah_link_control = false;
            }



 ?>

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="zillah_general_control_repeater zillah_general_control_droppable">
                <?php
                    if(empty($json)) {

                ?>
                        <div class="zillah_general_control_repeater_container">
                            <div class="zillah-customize-control-title"><?php esc_html_e('Zillah','zillah')?></div>
                            <div class="zillah-box-content-hidden">
                                <?php
                                       if($zillah_icon_control ==true){
                                ?>
                                            <span class="customize-control-title"><?php esc_html_e('Icon','zillah')?></span>
                                            <div class="zillah-dd">
                                                <select name="<?php echo esc_attr($this->id); ?>" class="zillah_icon_control">
                                                    <?php
                                                        foreach($icons_array as $key => $value) {
                                                            echo '<option value="'.esc_attr($value).'" data-iconclass="'.esc_attr($value).'" >'.esc_attr($key).'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                <?php   }




                                    if($zillah_link_control==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Link','zillah')?></span>
                                        <input type="text" class="zillah_link_control" placeholder="<?php esc_html_e('Link','zillah'); ?>"/>
                                <?php } ?>
                            <input type="hidden" class="zillah_box_id">
                            <button type="button" class="zillah_general_control_remove_field button" style="display:none;"><?php esc_html_e('Delete field','zillah'); ?></button>
                            </div>
                        </div>
                <?php
                    } else {
                        if ( !empty($this_default) && empty($json)) {

                            foreach($this_default as $icon){

                ?>
                                <div class="zillah_general_control_repeater_container zillah_draggable">
                                    <div class="zillah-customize-control-title"><?php esc_html_e('Zillah','zillah')?></div>
                                    <div class="zillah-box-content-hidden">

                                        <?php

                                                if($zillah_icon_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Icon','zillah')?></span>
                                                    <div class="zillah-dd">

                                                        <select name="<?php echo esc_attr($this->id); ?>" class="zillah_icon_control">
                                                            <?php
                                                                foreach($icons_array as $key => $value) {
                                                                    echo '<option value="'.esc_attr($value).'" '.selected($icon->icon_value,$value).' data-iconclass="'.esc_attr($value).'" >'.esc_attr($key).'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                        <?php
                                                }

                                                if($zillah_link_control){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Link','zillah')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="zillah_link_control" placeholder="<?php esc_html_e('Link','zillah'); ?>"/>
                                        <?php } ?>
                                    <input type="hidden" class="zillah_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                    <button type="button" class="zillah_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','zillah'); ?></button>
                                    </div>

                                </div>

                <?php
                                $it++;
                            }
                        } else {

                            foreach($json as $icon){

                    ?>
                                <div class="zillah_general_control_repeater_container zillah_draggable">
                                    <div class="zillah-customize-control-title"><?php esc_html_e('Zillah','zillah')?></div>
                                    <div class="zillah-box-content-hidden">
                                    <?php if($zillah_icon_control==true){ ?>
                                            <span class="customize-control-title"><?php esc_html_e('Icon','zillah')?></span>

                                            <div class="zillah-dd">
                                                <select name="<?php echo esc_attr($this->id); ?>" class="zillah_icon_control">
                                                    <?php
                                                        foreach($icons_array as $key => $value) {
                                                            echo '<option value="'.esc_attr($value).'" '.selected($value,$icon->icon_value).' data-iconclass="'.esc_attr($value).'" >'.esc_attr($key).'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                    <?php }

                                        if($zillah_link_control){ ?>
                                            <span class="customize-control-title"><?php esc_html_e('Link','zillah')?></span>
                                            <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="zillah_link_control" placeholder="<?php esc_html_e('Link','zillah'); ?>"/>
                                        <?php } ?>
                                        <input type="hidden" class="zillah_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                        <button type="button" class="zillah_general_control_remove_field button" <?php
                                            if ($it == 0)
                                            echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','zillah'); ?></button>
                                    </div>

                                </div>
                    <?php
                                $it++;

                            }
                        }
                    }

                if ( !empty($this_default) && empty($json)) {

                ?>
                    <input type="hidden" id="zillah_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="zillah_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
            <?php } else {	?>
                    <input type="hidden" id="zillah_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="zillah_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
            <?php } ?>
            </div>

            <button type="button"   class="button add_field zillah_general_control_new_field"

            ><?php esc_html_e('Add new field','zillah'); ?></button>

            <?php

    }

}
