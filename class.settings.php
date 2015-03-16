<?php
class piIPSettings extends WP_Widget
{
	public $piaType 	       = array('pi_it_flickr'=>'Flickr', 'pi_it_instagram'=>'Instagram');
	public $piaHandle 	       = array('pi_go_to'=>'Go To Image Link', 'pi_popup'=>'Appear Popup');
	public $piaDefault        = array('pi_type'=>'pi_it_flickr', 'pi_title'=>'Integrate Photo', 'pi_flickr_id'=>'', 'pi_number_of_photo'=>4, 'pi_photos_per_row'=>4, 'pi_handle'=>'pi_popup', 'pi_instagram_get'=>'popular', 'pi_instagram_tagged'=>'', 'pi_instagram_user_id'=>'', "pi_work_with_cycle"=>"pi_no_work_with_cycle", "pi_instagram_access_token"=>"", "pi_instagram_client_id"=>"",  "pi_using_template"=>0, "pi_custom_template"=>"", "pi_set_height"=>0);
    public $piaWorkWithCycle  = array("pi_work_with_cycle"=>"Yes", "pi_no_work_with_cycle"=>"No");
	public $piaInstagramGet   = array('popular'=>'Images from the popular page', 'tagged'=>'Images with a specific tag', 'user'=>'Images with a user');
    public $piaCustomTemplate = array(0=>'Default Template', 1=>'Custom Template');

    public function __construct()
    {
        $args = array('classname'=>'pi_it_photo', 'description'=>'');
        parent::__construct("piIPSettings", __('Instagram Flickr Widget', 'wiloke'), $args);
    }
    public function form($instance)
    {
        $instance = wp_parse_args( (array) $instance, $this->piaDefault );
        ?>
		<p>
            <label for="<?php echo $this->get_field_id( 'pi_title' ); ?>"><?php _e('Title', 'wiloke'); ?></label>
            <input id="<?php echo $this->get_field_id( 'pi_title' ); ?>" name="<?php echo $this->get_field_name( 'pi_title' ); ?>" value="<?php echo esc_attr($instance['pi_title']); ?>" class="widefat" type="text" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id( 'pi_type' ); ?>"><?php _e('Get Photo From', 'wiloke') ?></label>
        	<select name="<?php echo $this->get_field_name( 'pi_type' ); ?>" id="<?php echo $this->get_field_id( 'pi_type' ); ?>" class="pi_ip_type">
				<?php  
					foreach ( $this->piaType  as $k => $v ) :
				?>
				<option value="<?php echo esc_attr($k) ?>" <?php selected($instance['pi_type'], $k) ?>><?php printf( (__('%s', 'wiloke')), $v ); ?></option>
				<?php
					endforeach;
				?>
        	</select>
        </p>

       
        <div class="pi_ip_flickr_settings<?php $this->pi_add_hidden($instance['pi_type'], 'pi_it_flickr') ?>">
	        <p>
	            <label for="<?php echo $this->get_field_id( 'pi_flickr_id' ); ?>"><?php _e('Flickr ID', 'wiloke'); ?></label>
	            <input id="<?php echo $this->get_field_id( 'pi_flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'pi_flickr_id' ); ?>" value="<?php echo esc_attr($instance['pi_flickr_id']); ?>" class="widefat" type="text" />
	            <span class="help"><?php printf( (__('Find Your ID at <a target="_blank" style="color:red" href="%1$s">( idGettr</a> )', 'wiloke') ), 'http://www.idgettr.com' ); ?></span>
	        </p>
		</div>
        
		<div class="pi_ip_instagram_settings<?php $this->pi_add_hidden($instance['pi_type'], 'pi_it_instagram') ?>">
			<p>
				<label for="<?php echo $this->get_field_id( 'pi_instagram_get' ); ?>"><?php _e('Get', 'wiloke'); ?></label>
	            <select name="<?php echo $this->get_field_name( 'pi_instagram_get' ); ?>" id="<?php echo $this->get_field_id( 'pi_instagram_get' ); ?>" class="pi_instagram_display">
					<?php  
						foreach ( $this->piaInstagramGet  as $k => $v ) :
					?>
					<option value="<?php echo esc_attr($k) ?>" <?php selected($instance['pi_instagram_get'], $k) ?>><?php printf( (__('%s', 'wiloke')), $v ); ?></option>
					<?php
						endforeach;
					?>
	        	</select>
        	</p>
        	<p class="pi_tag_name pi_setting_of_instagram<?php $this->pi_add_hidden($instance['pi_instagram_get'], 'tagged') ?>">
        		<label for="<?php echo $this->get_field_id( 'pi_instagram_tagged' ); ?>"><?php _e('Tag Name - Name of the tag to get.', 'wiloke'); ?></label>
        		<input id="<?php echo $this->get_field_id( 'pi_instagram_tagged' ); ?>" name="<?php echo $this->get_field_name( 'pi_instagram_tagged' ); ?>" value="<?php echo esc_attr($instance['pi_instagram_tagged']); ?>" type="text" class="widefat" size="3" />
        	</p>
        	<p class="pi_instagram_user_id pi_setting_of_instagram<?php $this->pi_add_hidden($instance['pi_instagram_get'], 'user') ?>">
        		<label for="<?php echo $this->get_field_id( 'pi_instagram_user_id' ); ?>"><?php _e('User ID - Unique id of a user to get.', 'wiloke'); ?></label>
        		<input id="<?php echo $this->get_field_id( 'pi_instagram_user_id' ); ?>" name="<?php echo $this->get_field_name( 'pi_instagram_user_id' ); ?>" value="<?php echo esc_attr($instance['pi_instagram_user_id']); ?>" class="widefat" type="text" size="3" />
        		<span class="help"><?php printf( (__('Find User ID at <a target="_blank" style="color:red" href="%1$s">( jelled</a> )', 'wiloke') ), 'http://jelled.com/instagram/lookup-user-id' ); ?></span>
        	</p>
            <p class="pi_instagram_user_id pi_setting_of_instagram<?php $this->pi_add_hidden($instance['pi_instagram_get'], 'user', 'popular'); ?>">
                <label for="<?php echo $this->get_field_id( 'pi_instagram_access_token' ); ?>"><?php _e('Access Token - A valid oAuth token.', 'wiloke'); ?></label>
                <input id="<?php echo $this->get_field_id( 'pi_instagram_access_token' ); ?>" name="<?php echo $this->get_field_name( 'pi_instagram_access_token' ); ?>" value="<?php echo esc_attr($instance['pi_instagram_access_token']); ?>" class="widefat" type="text" size="3" />
                <span class="help"><?php printf( (__('How to get access token <a target="_blank" style="color:red" href="%1$s">( jelled</a> )', 'wiloke') ), 'http://jelled.com/instagram/access-token' ); ?></span>
            </p>
          <!--   <p class="pi_instagram_client_id">
                <label for="<?php echo $this->get_field_id( 'pi_instagram_client_id' ); ?>"><?php _e('Client Id - Your API client id from Instagram. <strong>Required</strong>.', 'wiloke'); ?></label>
                <input id="<?php echo $this->get_field_id( 'pi_instagram_client_id' ); ?>" name="<?php echo $this->get_field_name( 'pi_instagram_client_id' ); ?>" value="<?php echo esc_attr($instance['pi_instagram_client_id']); ?>" class="widefat" type="text" size="3" />
                <span class="help"><?php printf( (__('How to get client id <a target="_blank" style="color:red" href="%1$s">( darkwhispering</a> )', 'wiloke') ), 'http://darkwhispering.com/how-to/get-a-instagram-client_id-key' ); ?></span>
            </p> -->
		</div>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'pi_work_with_cycle' ); ?>"><?php _e('Work with jQuery Owl', 'wiloke'); ?></label>
            <select name="<?php echo $this->get_field_name( 'pi_work_with_cycle' ); ?>" id="<?php echo $this->get_field_id( 'pi_work_with_cycle' ); ?>" class="pi_work_with_cycle">
                <?php  
                    foreach ( $this->piaWorkWithCycle  as $k => $v ) :
                ?>
                <option value="<?php echo esc_attr($k) ?>" <?php selected($instance['pi_work_with_cycle'], $k) ?>><?php printf( (__('%s', 'wiloke')), $v ); ?></option>
                <?php
                    endforeach;
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'pi_number_of_photo' ); ?>"><?php _e('Number of photos to show', 'wiloke'); ?></label>
            <input id="<?php echo $this->get_field_id( 'pi_number_of_photo' ); ?>" name="<?php echo $this->get_field_name( 'pi_number_of_photo' ); ?>" value="<?php echo esc_attr($instance['pi_number_of_photo']); ?>" class="widefat" type="text" size="3" />
        </p>
        


        <div class="pi_use_cycle<?php $this->pi_add_hidden($instance['pi_work_with_cycle'], 'pi_work_with_cycle'); ?>">
            <p>
                <label for="<?php echo $this->get_field_id( 'pi_set_height' ); ?>"><?php _e('Set height - 0 mean auto height', 'wiloke'); ?></label>
                <input id="<?php echo $this->get_field_id( 'pi_set_height' ); ?>" name="<?php echo $this->get_field_name( 'pi_set_height' ); ?>" value="<?php echo esc_attr($instance['pi_set_height']); ?>" class="widefat" type="text" size="3" />
            </p>
        </div>

        <div class="pi_no_cycle<?php $this->pi_add_hidden($instance['pi_work_with_cycle'], 'pi_no_work_with_cycle');?>">
    	 	<p>
                <label for="<?php echo $this->get_field_id( 'pi_photos_per_row' ); ?>"><?php _e('Number of photos per row - max of 12', 'wiloke'); ?></label>
                <input id="<?php echo $this->get_field_id( 'pi_photos_per_row' ); ?>" name="<?php echo $this->get_field_name( 'pi_photos_per_row' ); ?>" value="<?php echo esc_attr($instance['pi_photos_per_row']); ?>" class="widefat" type="text" size="3" />
            </p>
        </div>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'pi_handle' ); ?>"><?php _e('When click on photo', 'wiloke'); ?></label>
            <select name="<?php echo $this->get_field_name( 'pi_handle' ); ?>" id="<?php echo $this->get_field_id( 'pi_handle' ); ?>">
                <?php  
                    foreach ( $this->piaHandle  as $k => $v ) :
                ?>
                <option value="<?php echo esc_attr($k) ?>"  <?php selected($instance['pi_handle'], $k) ?>><?php printf( (__('%s', 'wiloke')), $v ); ?></option>
                <?php
                    endforeach;
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'pi_handle' ); ?>"><?php _e('Template', 'wiloke'); ?></label> 
            <p>
            <code class="help" style="background-color: #ccc"><?php _e("The control the way Flickr/Instagram looks on your website", "wiloke"); ?></code>
            </p>
            <select name="<?php echo $this->get_field_name( 'pi_using_template' ); ?>" id="<?php echo $this->get_field_id( 'pi_using_template' ); ?>"
                class="pi_switch_template">
                <?php  
                    foreach ( $this->piaCustomTemplate  as $k => $v ) :
                ?>
                <option value="<?php echo esc_attr($k) ?>"  <?php selected($instance['pi_using_template'], $k) ?>><?php printf( (__('%s', 'wiloke')), $v ); ?></option>
                <?php
                    endforeach;
                ?>
            </select>
        </p>

        <div class="pi_custom_template<?php $this->pi_add_hidden($instance['pi_using_template'], 1); ?>">
            <p>
            <textarea rows="5" name="<?php echo $this->get_field_name( 'pi_custom_template' ); ?>" class="widefat"><?php echo esc_textarea($instance['pi_custom_template']); ?></textarea>
                <code class="help"><a href="#" target="_blank"><?php _e('Quick example about create a template', 'wiloke'); ?></a></code>
            </p>
        </div>

        <?php
    }

    public function pi_add_hidden($instance, $compare, $second="")
    {
        if($instance != $compare)
        {
            if ( $second != "" )
            {
                if ( $second  != $instance )
                {
                    echo " hidden"; 
                }
            }else{
                echo " hidden";
            }
        }
    }

    public  function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['pi_title']              	= strip_tags( $new_instance['pi_title'] );
        $instance['pi_type']    				= strip_tags ( $new_instance['pi_type'] );
        $instance['pi_flickr_id']          	= strip_tags( $new_instance['pi_flickr_id'] );
        $instance['pi_handle']          		= strip_tags( $new_instance['pi_handle'] );
        $instance['pi_number_of_photo']    	= (int)$new_instance['pi_number_of_photo'];
        $instance['pi_instagram_get']    		= strip_tags($new_instance['pi_instagram_get']);
        $instance['pi_photos_per_row']     	= (int)$new_instance['pi_photos_per_row'];
        $instance['pi_instagram_user_id']     	= strip_tags($new_instance['pi_instagram_user_id']);
        $instance['pi_instagram_location_id'] 	= strip_tags($new_instance['pi_instagram_location_id']);
        $instance['pi_instagram_tagged'] 		= strip_tags($new_instance['pi_instagram_tagged']);
        $instance['pi_instagram_client_id']    = strip_tags($new_instance['pi_instagram_client_id']);
        $instance['pi_instagram_access_token'] = strip_tags($new_instance['pi_instagram_access_token']);
        $instance['pi_work_with_cycle']        = strip_tags($new_instance['pi_work_with_cycle']);
        $instance['pi_using_template']         = strip_tags($new_instance['pi_using_template']);
        $instance['pi_custom_template']        = stripslashes($new_instance['pi_custom_template']);
        $instance['pi_set_height']             = stripslashes($new_instance['pi_set_height']);
        return $instance;
    }

    public function widget( $args, $instance )
    {
        extract( $args, EXTR_SKIP );
        $title  = apply_filters('widget_title', $instance['pi_title'] );

        if ( $instance['pi_work_with_cycle'] == 'pi_work_with_cycle' )
        {
            $instance['pi_photos_per_row'] = 1;
        }

        if ( (int)$instance['pi_photos_per_row'] == 1  )
        {
            $size  = "image_m";
        }else{
            $size  = "image_s";
        }
        
        $link = $instance['pi_handle'] == 'pi_popup' ? "image_b" : "link";
        if ( $instance['pi_using_template'] != 1 )
        {
            $template = '\'<li class="transition"><a href="{{'.$link.'}}" title="{{title}}"" target="_blank"><img alt="{{title}}" src="{{'.$size.'}}" /></a></li>\'';
        }else{
            $template = '\''.$instance['pi_custom_template'].'\'';
        }

        $output  = "";
        $output .= $before_widget;
        
        if(!empty($title))
        {
            $output .= $before_title.esc_attr($title).$after_title;
        }

        $output .= '<div class="pi_ip_widget_wrapper">';
            if ( $instance['pi_type'] == 'pi_it_flickr' )
            {
                include ( PI_IP_VIEWS_DIR . 'flickr/view.php' );
            }else{
                include ( PI_IP_VIEWS_DIR . 'instagram/view.php' );
            }
        $output .= '</div>';

        $output .= $after_widget;

        echo $output;
    }
}