;(function($){
	"use strict";

	var $doc = $(document);


	/*=========================================*/
	/* Switch instagram settings
	/*=========================================*/
	function pi_switch_instagram_settings()
	{
		var _val = "";
		$(".pi_instagram_display").change(function()
		{
			_val = $(this).val();
			pi_excu_switch_instagram_settings(_val);
		});
	}

	function pi_excu_switch_instagram_settings(_val)
	{
			var 	$allSettings = $(".pi_setting_of_instagram"),
					$tag 		 = $(".pi_tag_name"),
					$location	 = $(".pi_location_id"),
					$userid		 = $(".pi_instagram_user_id");
			
			$allSettings.addClass("hidden");
			switch ( _val )
			{
				case 'tagged':
					$tag.removeClass("hidden");
					break;
				case 'location':
					$location.removeClass("hidden");
					break;
				case 'user':
					$userid.removeClass("hidden");
					break;
			}
	}


	/*=========================================*/
	/*	Switch settings
	/*=========================================*/
	function pi_switch_settings()
	{
		var _type 				= "";
		$(".pi_ip_type").change(function()
		{
			_type = $(this).val();
			pi_excu_switch(_type);
		});

	}

	function pi_excu_switch(_type)
	{
		var $flickSettings 		= $(".pi_ip_flickr_settings"),
			$instagramSettings 	= $(".pi_ip_instagram_settings");

			if ( _type == 'pi_it_flickr' )
			{
				$flickSettings.removeClass("hidden");
				$instagramSettings.addClass("hidden");
			}else{
				$flickSettings.addClass("hidden");
				$instagramSettings.removeClass("hidden");
			}
	}

	/*=========================================*/
	/*	Work with cycle
	/*=========================================*/
	function pi_switch_work_witch_cycle()
	{
		var _type = "";

		$(".pi_work_with_cycle").change(function()
		{
			_type = $(this).val();
			pi_excu_work_witch_cycle(_type);
		});
	}
	function pi_excu_work_witch_cycle(_type)
	{
		var $piNoCycle = $(".pi_no_cycle"),
			$piCycle   = $(".pi_use_cycle");

			if ( _type == 'pi_work_with_cycle' )
			{
				$piNoCycle.addClass("hidden");
				$piCycle.removeClass("hidden");
			}else{
				$piCycle.addClass("hidden");
				$piNoCycle.removeClass("hidden");
			}
	}

	/*=========================================*/
	/*	Custom Template
	/*=========================================*/
	function pi_switch_custom_template()
	{
		var _type = "";

		$(".pi_switch_template").change(function()
		{
			_type = $(this).val();
			pi_excu_switch_custom_template(_type);
		});
	}
	function pi_excu_switch_custom_template(_type)
	{
		var $piCustomTemplate = $(".pi_custom_template");
			
			if ( _type == 0 )
			{
				$piCustomTemplate.addClass("hidden");
			}else{
				$piCustomTemplate.removeClass("hidden");
			}
	}

	$(document).ready(function()
	{
		pi_switch_instagram_settings();
		pi_switch_work_witch_cycle();
		pi_switch_custom_template();
		pi_switch_settings();

		$(document).ajaxComplete(function(url, xhr, settings){
			if ( settings.data && ((settings.data).search("piipsettings") != 0 ) )
			{
				pi_switch_instagram_settings();
				pi_switch_work_witch_cycle();
				pi_switch_custom_template();
				pi_switch_settings();
			}
		})
	})



})(jQuery)
