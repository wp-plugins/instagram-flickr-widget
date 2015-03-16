<?php

$id = uniqid("pi-ip-flickr-widget_");
$userID = !empty($instance["pi_instagram_user_id"]) ? $instance["pi_instagram_user_id"] : "''";
$output .= "<ul id='{$id}' class='thumbs rs pi_instagram clearfix pi_ip_widget pi-number-of-items-{$instance['pi_photos_per_row']} {$instance['pi_handle']} {$instance['pi_work_with_cycle']}' data-height='".$instance['pi_set_height']."'>";
$output .= '</ul>';

$output .='<script type="text/javascript">
jQuery(window).load(function($){
	var feed = new Instafeed({
		get: "'.$instance['pi_instagram_get'].'",
		tagName: "'.$instance['pi_instagram_tagged'].'",
		limit: "'.$instance['pi_number_of_photo'].'",
		target: "'.$id.'",
		accessToken: "'.$instance["pi_instagram_access_token"].'",
		userId: '.$userID.',
		template: '.$template.',
		mock: true,
	  	custom: {
		    images: [],
		    showImage: function () {
		      var result, htmlString="";
		      for (var _i = 0, _len = this.options.custom.images.length; _i < _len; _i++) {
			      image = this.options.custom.images[_i];
			      result = this._makeTemplate(this.options.template, {
			        model: image,
			        id: image.id,
			        link: image.link,
			        image_s: image.images[\'thumbnail\'].url,
					image_m: image.images[\'low_resolution\'].url,
					image_b: image.images[\'standard_resolution\'].url,
			        caption: this._getObjectProperty(image, \'caption.text\'),
			        likes: image.likes.count,
			        comments: image.comments.count,
			        location: this._getObjectProperty(image, \'location.name\')
			      });
				  htmlString += result;
			  }
			  jQuery("#'.$id.'").html(htmlString);
		    }
	  	},
  	  	success: function (data) {
		    this.options.custom.images = data.data; 
		    this.options.custom.showImage.call(this);
	  	},
		after: function()
		{
			var $control = jQuery(\'#'.$id.'\'), _height = $control.data(\'height\');
			if ( $control.hasClass(\'pi_work_with_cycle\') )
			{
				jQuery(\'#'.$id.'.pi_work_with_cycle\').owlCarousel({
					autoPlay : true,
					singleItem:true,
					lazyLoad : true,
					lazyEffect: "fade",
					transitionStyle: "goDown",
					autoHeight : _height == 0 ? true : false,
				});
				
				if ( _height != 0 )
				{
					$control.parent().css({height: _height});
					$control.find(".owl-item").css({height: _height});
				}
			}
		}
	});
	feed.run();
})
</script>';

