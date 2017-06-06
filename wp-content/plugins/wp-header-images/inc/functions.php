<?php
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


	

	//FOR QUICK DEBUGGING

	



	if(!function_exists('pre')){
		function pre($data){
			if(isset($_GET['debug'])){
				pree($data);
			}
		}	 
	} 
		
	if(!function_exists('pree')){
	function pree($data){
				echo '<pre>';
				print_r($data);
				echo '</pre>';	
		
		}	 
	} 




	function wphi_menu()
	{



		 add_options_page('WP Header Images', 'WP Header Images', 'install_plugins', 'wp_hi', 'wp_hi');



	}

	function wp_hi(){ 



		if ( !current_user_can( 'install_plugins' ) )  {



			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );



		}



		global $wpdb, $wphi_dir, $hi_pro, $hi_data; 

		
		include($wphi_dir.'inc/wphi_settings.php');
		

	}	



	
	

	function wphi_plugin_links($links) { 
		global $hi_premium_link, $hi_pro;
		
		$settings_link = '<a href="options-general.php?page=wp_hi">Settings</a>';
		
		if($hi_pro){
			array_unshift($links, $settings_link); 
		}else{
			 
			$hi_premium_link = '<a href="'.$hi_premium_link.'" title="Go Premium" target=_blank>Go Premium</a>'; 
			array_unshift($links, $settings_link, $hi_premium_link); 
		
		}
		
		
		return $links; 
	}
	
	function register_hi_scripts() {
		
			
		if (is_admin ()){
		
			wp_enqueue_media ();
		
			
			 
			wp_enqueue_script(
				'wphi-scripts',
				plugins_url('js/scripts.js', dirname(__FILE__)),
				array('jquery')
			);	
			
			
		
			wp_register_style('wphi-style', plugins_url('css/admin-styles.css', dirname(__FILE__)));	
			
			wp_enqueue_style( 'wphi-style' );
		
		}else{
					
			wp_register_style('wphi-style', plugins_url('css/front-styles.css', dirname(__FILE__)));	
			
			wp_enqueue_style( 'wphi-style' );
		}
		
	
	} 
		
	if(!function_exists('wp_header_images')){
	function wp_header_images(){

		
		}
	}
	
	
		
		
	function get_parent_hmenu_id($id, $arr){
		if($arr[$id]==0)
		return $id;
		else
		return get_parent_hmenu_id($arr[$id], $arr);
	}
	
	function get_header_images(){
		
		global $wphi_dir;
		$args = array( 'taxonomy'=>'nav_menu', 'hide_empty' => true );
		$menus = wp_get_nav_menus();//get_terms($args);
		$wp_header_images = get_option( 'wp_header_images');
		

		
		
		$arr = array();
		$arr_obj = array();
		$arr_urls = array();
		
		if(is_front_page() || is_home() || is_single())
		$page_id = 0;
		elseif(function_exists('is_product_category') && is_product_category()){
			$cate = get_queried_object();
			$page_id = $cate->term_id;
			//pre($cate);
		}
		elseif(is_archive())
		$page_id = get_cat_id( single_cat_title("",false) ); 		
		else
		$page_id = get_the_ID();
		
		//pre(is_product_category());
		//pre($page_id);
		
		foreach ( $menus as $menu ):
		$menu_items = wp_get_nav_menu_items($menu->name);
		if(!empty($menu_items)){
			foreach($menu_items as $items){
				$parent = $items->menu_item_parent;
				
				$arr[$items->ID] = $parent;
				//pre($arr_obj);
				$key = $items->object_id;
				$arr_obj[$key][$items->ID] = $items->ID;
				$arr_urls[$key][$items->ID] = $items->url;
				
			}
		}
		endforeach;
		
		//pree($arr_obj);
		//pre(get_the_ID());
		//pre($page_id);
		//pre($cur_cat_id);
		//pre(is_single());
		//pre(is_page());
		//pre(is_archive());
		//pre(is_shop());
		//pre($_SERVER);
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if(array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS']=='on'){
			$actual_link = str_replace('http://', 'https://', $actual_link);
		}
		
		$obj_id = 0;
		if($page_id!=0 && array_key_exists($page_id, $arr_urls)){
			if(count($arr_urls[$page_id])>0){
				$obj_id = array_search($actual_link, $arr_urls[$page_id]);
				//$arr_obj[$page_id] = array($arr_obj[$page_id][$obj_id]);
			}else{
			}
		}
			
		if($page_id==0 && is_array($arr_urls)){
			foreach($arr_urls as $expected_page_id => $arr_url){
				
				if($page_id==0){
					$obj_id = array_search($actual_link, $arr_url);
					if($obj_id>0){
						$page_id = $expected_page_id;
					}
				}
				
				
			}
		}
		
		if($page_id==0){
			$page_id = current(array_keys($arr_obj));
		}

		
		$parent_id = $arr_obj[$page_id][$obj_id];	

		
		$img_id = $wp_header_images[$parent_id];
		
		
		if($img_id>0){
			$img_url = wp_get_attachment_url( $img_id );			
			if($img_url!=''){			
				include($wphi_dir.'templates/header_images.php');
			}
		}
	}