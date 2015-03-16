<?php 
/*
	Plugin Name:  Instagram Flickr Widget 
	Author URI: wiloke.com
	Author: wiloke
	Plugin URI: http://test.wiloke.com/instagram-flicrk-widget/
	Version: 1.0
	License: Under GPL2

	Copyright 2014 wiloke (email : piratesmorefun@gmail.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( !class_exists('wilokeIntegratePhoto') ) :

define('PI_IP_ASSETS', plugin_dir_url(__FILE__) . 'assets/');
define('PI_IP_SOURCE', plugin_dir_url(__FILE__) . 'source/');
define('PI_IP_MODULES_DIR', plugin_dir_path(__FILE__) . 'modules/');
define('PI_IP_VIEWS_DIR', plugin_dir_path(__FILE__) . 'views/');

/*=========================================*/
/*	Config
/*=========================================*/



class wilokeIntegratePhoto
{	
	public function __construct()
	{
		// $this->pi_init_modules();
		add_action('widgets_init', array($this, 'pi_widgets_building') );
		add_action("wp_enqueue_scripts", array($this, "pi_enqueue_scripts"));
		add_action("admin_enqueue_scripts", array($this, "pi_widget_scripts"));
	}

	public function pi_widgets_building()
	{
        register_widget( 'piIPSettings' );
	}

	public function pi_init_modules()
	{
		include ( PI_IP_MODULES_DIR . 'flickr/class.flickr.php' );
		include ( PI_IP_MODULES_DIR . 'instagram/class.instagram.php' );
	}

	public function pi_enqueue_scripts()
	{
		wp_register_style('pi_magnific_popup', PI_IP_ASSETS . 'magnific/magnific-popup.css', array(), '1.0.0', false);
		wp_enqueue_style('pi_magnific_popup');
	
		wp_register_style('pi_owlcarousel', PI_IP_ASSETS . 'owl-carousel/owl.carousel.css', array(), '1.0.0', false);
		wp_enqueue_style('pi_owlcarousel');

		wp_register_style('pi_owlcarousel_transition', PI_IP_ASSETS . 'owl-carousel/owl.transitions.css', array(), '1.0.0', false);
		wp_enqueue_style('pi_owlcarousel_transition');

		wp_register_style('pi_widget', PI_IP_SOURCE . 'css/pi.ip.css', array(), '1.0.0', false);
		wp_enqueue_style('pi_widget');

		wp_register_script('pi_magnific', PI_IP_ASSETS . 'magnific/jquery.magnific-popup.min.js', array(), '1.0.0', true);
		wp_enqueue_script('pi_magnific');

		wp_register_script('pi_owlcarousel', PI_IP_ASSETS . 'owl-carousel/owl.carousel.min.js', array(), '1.0.0', true);
		wp_enqueue_script('pi_owlcarousel');

		wp_register_script('pi_flickr', PI_IP_ASSETS . 'flickr/jflickrfeed.min.js', array(), '1.0.0', true);
		wp_enqueue_script('pi_flickr');

		wp_register_script('pi_instagram', PI_IP_ASSETS . 'instagram/instagram.min.js', array(), '1.0.0', true);
		wp_enqueue_script('pi_instagram');


		wp_register_script('pi_ip_widget', PI_IP_SOURCE . 'js/pi.fe.js', array(), '1.0.0', true);
		wp_enqueue_script('pi_ip_widget');
	}

	public function pi_widget_scripts()
	{
		global $pagenow;

		if ( $pagenow && $pagenow == 'widgets.php' )
		{
			wp_register_script('pi_widget', PI_IP_SOURCE . 'js/pi.admin.js', array(), '1.0.0', true);
			wp_enqueue_script('pi_widget');
		}

	}
}

new wilokeIntegratePhoto;

require_once ( plugin_dir_path(__FILE__) . 'class.settings.php' );

endif;