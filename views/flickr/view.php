<?php
$id = uniqid("pi-ip-flickr-widget_");

$output .= "<ul id='{$id}' class='thumbs rs clearfix pi_ip_widget pi-number-of-items-{$instance['pi_photos_per_row']} {$instance['pi_handle']} {$instance['pi_work_with_cycle']}' data-height='".$instance['pi_set_height']."'>";
$output .= '</ul>';
$output .= '</div>';
$output .='<script type="text/javascript">';
$output .= 'jQuery(document).ready(function($){';
$output .= '$("#'.$id.'").jflickrfeed({';
$output .= "limit:{$instance['pi_number_of_photo']},";
$output .= 'qstrings: {';
$output .= "id: '".$instance['pi_flickr_id']."',";
$output .= '},';
$output .= "itemTemplate:".$template;
$output .= '}, function(data){
	var $control = $(\'#'.$id.'\'), _height = $control.data(\'height\');
	if ( $control.hasClass(\'pi_work_with_cycle\') )
	{
		$(\'#'.$id.'.pi_work_with_cycle\').owlCarousel({
			autoPlay : true,
			singleItem:true,
			lazyLoad : true,
			transitionStyle: "fade",
			autoHeight : _height == 0 ? true : false,
		});
		
		if ( _height != 0 )
		{
			$control.parent().css({height: _height});
			$control.find(".owl-item").css({height: _height});
		}
	}
})';
$output .= '})';
$output .='</script>';
