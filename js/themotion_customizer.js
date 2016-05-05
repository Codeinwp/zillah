/********************************************
*** General Repeater ***
*********************************************/

function zillah_uniqid(prefix, more_entropy) {

  if (typeof prefix === 'undefined') {
    prefix = '';
  }

  var retId;
  var formatSeed = function(seed, reqWidth) {
    seed = parseInt(seed, 10)
      .toString(16); // to hex str
    if (reqWidth < seed.length) { // so long we split
      return seed.slice(seed.length - reqWidth);
    }
    if (reqWidth > seed.length) { // so short we pad
      return Array(1 + (reqWidth - seed.length))
        .join('0') + seed;
    }
    return seed;
  };

  // BEGIN REDUNDANT
  if (!this.php_js) {
    this.php_js = {};
  }
  // END REDUNDANT
  if (!this.php_js.uniqidSeed) { // init seed with big random int
    this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
  }
  this.php_js.uniqidSeed++;

  retId = prefix; // start with prefix, add current milliseconds hex string
  retId += formatSeed(parseInt(new Date()
    .getTime() / 1000, 10), 8);
  retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
  if (more_entropy) {
    // for more entropy we add a float lower to 10
    retId += (Math.random() * 10)
      .toFixed(8)
      .toString();
  }

  return retId;
}


function zillah_refresh_general_control_values(){
	jQuery(".zillah_general_control_repeater").each(function(){
		var values = [];
		var th = jQuery(this);
		th.find(".zillah_general_control_repeater_container").each(function(){
			var icon_value = jQuery(this).find('.dd-selected-value').val();
			var link = jQuery(this).find(".zillah_link_control").val();
			var id = jQuery(this).find(".zillah_box_id").val();
            if( link !='' || icon_value!='' ){
                values.push({
                    "icon_value" : icon_value,
                    "link" : link,
                    "id" : id
                });
            }
        });
        th.find('.zillah_repeater_colector').val(JSON.stringify(values));
        th.find('.zillah_repeater_colector').trigger('change');
    });
}




jQuery(document).ready(function(){


/* Dropdown control */
  jQuery('#customize-theme-controls').on('click','.zillah-customize-control-title',function(){
      jQuery(this).next().slideToggle('medium', function() {
          if (jQuery(this).is(':visible'))
              jQuery(this).css('display','block');
      });
  });



	jQuery("#customize-theme-controls").on('change', '.dd-selected-value',function(){
		zillah_refresh_general_control_values();
		return false;
	});

	jQuery(".zillah_general_control_new_field").on("click",function(){

		var th = jQuery(this).parent();
		var id = 'zillah_' + zillah_uniqid();
		if(typeof th != 'undefined') {

            var field = th.find(".zillah_general_control_repeater_container:first").clone();
            if(typeof field != 'undefined'){


                field.find('.dd-container').before('<div class="zillah-dd"><select name="zillah_social_icons" class="zillah_icon_control"><option value="none" data-iconclass="none">none</option><option value="fa-500px" data-iconclass="fa-500px">500px</option><option value="fa-amazon" data-iconclass="fa-amazon">amazon</option><option value="fa-android" data-iconclass="fa-android">android</option><option value="fa-behance" data-iconclass="fa-behance">behance</option><option value="fa-behance-square" data-iconclass="fa-behance-square">behance-square</option><option value="fa-bitbucket" data-iconclass="fa-bitbucket">bitbucket</option><option value="fa-bitbucket-square" data-iconclass="fa-bitbucket-square">bitbucket-square</option><option value="fa-cc-amex" data-iconclass="fa-cc-amex">american-express</option><option value="fa-cc-diners-club" data-iconclass="fa-cc-diners-club">diners-club</option><option value="fa-cc-discover" data-iconclass="fa-cc-discover">discover</option><option value="fa-cc-jcb" data-iconclass="fa-cc-jcb">jcb</option><option value="fa-cc-mastercard" data-iconclass="fa-cc-mastercard">mastercard</option><option value="fa-paypal" data-iconclass="fa-paypal">paypal</option><option value="fa-cc-stripe" data-iconclass="fa-cc-stripe">stripe</option><option value="fa-cc-visa" data-iconclass="fa-cc-visa">visa</option><option value="fa-codepen" data-iconclass="fa-codepen">codepen</option><option value="fa-css3" data-iconclass="fa-css3">css3</option><option value="fa-delicious" data-iconclass="fa-delicious">delicious</option><option value="fa-deviantart" data-iconclass="fa-deviantart">deviantart</option><option value="fa-digg" data-iconclass="fa-digg">digg</option><option value="fa-dribbble" data-iconclass="fa-dribbble">dribble</option><option value="fa-dropbox" data-iconclass="fa-dropbox">dropbox</option><option value="fa-drupal" data-iconclass="fa-drupal">drupal</option><option value="fa-facebook" data-iconclass="fa-facebook">facebook</option><option value="fa-facebook-official" data-iconclass="fa-facebook-official">facebook-official</option><option value="fa-facebook-square" data-iconclass="fa-facebook-square">facebook-square</option><option value="fa-flickr" data-iconclass="fa-flickr">flickr</option><option value="fa-foursquare" data-iconclass="fa-foursquare">foursquare</option><option value="fa-git" data-iconclass="fa-git">git</option><option value="fa-git-square" data-iconclass="fa-git-square">git-square</option><option value="fa-github" data-iconclass="fa-github">github</option><option value="fa-github-alt" data-iconclass="fa-github-alt">github-alt</option><option value="fa-github-square" data-iconclass="fa-github-square">github-square</option><option value="fa-google" data-iconclass="fa-google">google</option><option value="fa-google-plus" data-iconclass="fa-google-plus">google-plus</option><option value="fa-google-plus-square" data-iconclass="fa-google-plus-square">google-plus-square</option><option value="fa-html5" data-iconclass="fa-html5">html5</option><option value="fa-instagram" data-iconclass="fa-instagram">instagram</option><option value="fa-joomla" data-iconclass="fa-joomla">joomla</option><option value="fa-jsfiddle" data-iconclass="fa-jsfiddle">jsfiddle</option><option value="fa-linkedin" data-iconclass="fa-linkedin">linkedin</option><option value="fa-linkedin-square" data-iconclass="fa-linkedin-square">linkedin-square</option><option value="fa-opencart" data-iconclass="fa-opencart">opencart</option><option value="fa-openid" data-iconclass="fa-openid">openid</option><option value="fa-pinterest" data-iconclass="fa-pinterest">pinterest</option><option value="fa-pinterest-p" data-iconclass="fa-pinterest-p">pinterest-p</option><option value="fa-pinterest-square" data-iconclass="fa-pinterest-square">pinterest-square</option><option value="fa-rebel" data-iconclass="fa-rebel">rebel</option><option value="fa-reddit" data-iconclass="fa-reddit">reddit</option><option value="fa-reddit-square" data-iconclass="fa-reddit-square">reddit-square</option><option value="fa-share-alt" data-iconclass="fa-share-alt">share</option><option value="fa-share-alt-square" data-iconclass="fa-share-alt-square">share-square</option><option value="fa-skype" data-iconclass="fa-skype">skype</option><option value="fa-slack" data-iconclass="fa-slack">slack</option><option value="fa-soundcloud" data-iconclass="fa-soundcloud">soundcloud</option><option value="fa-spotify" data-iconclass="fa-spotify">spotify</option><option value="fa-stack-overflow" data-iconclass="fa-stack-overflow">stack-overflow</option><option value="fa-steam" data-iconclass="fa-steam">steam</option><option value="fa-steam-square" data-iconclass="fa-steam-square">steam-square</option><option value="fa-tripadvisor" data-iconclass="fa-tripadvisor">tripadvisor</option><option value="fa-tumblr" data-iconclass="fa-tumblr">tumblr</option><option value="fa-tumblr-square" data-iconclass="fa-tumblr-square">tumblr-square</option><option value="fa-twitch" data-iconclass="fa-twitch">twitch</option><option value="fa-twitter" data-iconclass="fa-twitter">twitter</option><option value="fa-twitter-square" data-iconclass="fa-twitter-square">twitter-square</option><option value="fa-vimeo" data-iconclass="fa-vimeo">vimeo</option><option value="fa-vimeo-square" data-iconclass="fa-vimeo-square">vimeo-square</option><option value="fa-vine" data-iconclass="fa-vine">vine</option><option value="fa-whatsapp" data-iconclass="fa-whatsapp">whatsapp</option><option value="fa-wordpress" data-iconclass="fa-wordpress">wordpress</option><option value="fa-yahoo" data-iconclass="fa-yahoo">yahoo</option><option value="fa-youtube" data-iconclass="fa-youtube">youtube</option><option value="fa-youtube-play" data-iconclass="fa-youtube-play">youtube-play</option><option value="fa-youtube-square" data-iconclass="fa-youtube-square">youtube-squar</option></select></div>');
                field.find('.dd-container').remove();
                field.find(".zillah_general_control_remove_field").show();
                field.find('.zillah-dd').ddslick({
                  onSelected: function(selectedData){
                      //callback function: do something with selectedData;
                  }
                });

				field.find(".zillah_box_id").val(id);
                field.find(".zillah_link_control").val('');
                th.find(".zillah_general_control_repeater_container:first").parent().append(field);
                zillah_refresh_general_control_values();
            }
		}
		return false;
	 });

	jQuery("#customize-theme-controls").on("click", ".zillah_general_control_remove_field",function(){
		if( typeof	jQuery(this).parent() != 'undefined'){
			jQuery(this).parent().parent().remove();
			zillah_refresh_general_control_values();
		}
		return false;
	});

	jQuery("#customize-theme-controls").on('keyup', '.zillah_link_control',function(){
		zillah_refresh_general_control_values();
	});

	/*Drag and drop to change icons order*/
	jQuery(".zillah_general_control_droppable").sortable({
		update: function( event, ui ) {
			zillah_refresh_general_control_values();
		}
	});
});


jQuery(document).ready(function() {

	jQuery('.zillah-dd').ddslick({
		onSelected: function(selectedData){
			//callback function: do something with selectedData;
		}
	});

});