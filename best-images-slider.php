<?php
/*
Plugin Name: Best Images Slider
Plugin URL: http://beautiful-module.com/demo/best-images-slider/
Description: A simple Responsive Best Images Slider
Version: 1.0
Author: Module Express
Author URI: http://beautiful-module.com
Contributors: Module Express
*/
/*
 * Register CPT sp_best.images.slider
 *
 */
if(!class_exists('Best_Images_Slider')) {
	class Best_Images_Slider {

		function __construct() {
		    if(!function_exists('add_shortcode')) {
		            return;
		    }
			add_action ( 'init' , array( $this , 'bis_responsive_gallery_setup_post_types' ));

			/* Include style and script */
			add_action ( 'wp_enqueue_scripts' , array( $this , 'bis_register_style_script' ));
			
			/* Register Taxonomy */
			add_action ( 'init' , array( $this , 'bis_responsive_gallery_taxonomies' ));
			add_action ( 'add_meta_boxes' , array( $this , 'bis_rsris_add_meta_box_gallery' ));
			add_action ( 'save_post' , array( $this , 'bis_rsris_save_meta_box_data_gallery' ));
			register_activation_hook( __FILE__, 'bis_responsive_gallery_rewrite_flush' );


			// Manage Category Shortcode Columns
			add_filter ( 'manage_responsive_best_slider-category_custom_column' , array( $this , 'bis_responsive_gallery_category_columns' ), 10, 3);
			add_filter ( 'manage_edit-responsive_best_slider-category_columns' , array( $this , 'bis_responsive_gallery_category_manage_columns' ));
			require_once( 'bis_gallery_admin_settings_center.php' );
		    add_shortcode ( 'sp_best.images.slider' , array( $this , 'bis_responsivegallery_shortcode' ));
		}


		function bis_responsive_gallery_setup_post_types() {

			$responsive_gallery_labels =  apply_filters( 'best_images_slider_labels', array(
				'name'                => 'Responsive header image gallery',
				'singular_name'       => 'Responsive header image gallery',
				'add_new'             => __('Add New', 'best_images_slider'),
				'add_new_item'        => __('Add New Image', 'best_images_slider'),
				'edit_item'           => __('Edit Image', 'best_images_slider'),
				'new_item'            => __('New Image', 'best_images_slider'),
				'all_items'           => __('All Image', 'best_images_slider'),
				'view_item'           => __('View Image', 'best_images_slider'),
				'search_items'        => __('Search Image', 'best_images_slider'),
				'not_found'           => __('No Image found', 'best_images_slider'),
				'not_found_in_trash'  => __('No Image found in Trash', 'best_images_slider'),
				'parent_item_colon'   => '',
				'menu_name'           => __('Best images slider', 'best_images_slider'),
				'exclude_from_search' => true
			) );


			$responsiveslider_args = array(
				'labels' 			=> $responsive_gallery_labels,
				'public' 			=> true,
				'publicly_queryable'		=> true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'capability_type' 	=> 'post',
				'has_archive' 		=> true,
				'hierarchical' 		=> false,
				'menu_icon'   => 'dashicons-format-gallery',
				'supports' => array('title','editor','thumbnail')
				
			);
			register_post_type( 'best_images_slider', apply_filters( 'sp_faq_post_type_args', $responsiveslider_args ) );

		}
		
		function bis_register_style_script() {
		    wp_enqueue_style( 'css_responsiveimgslider',  plugin_dir_url( __FILE__ ). 'css/responsiveimgslider.css' );
			/*   REGISTER ALL CSS FOR SITE */
			wp_enqueue_style( 'css_sprout_slide',  plugin_dir_url( __FILE__ ). 'css/sprout-slide.css' );
			wp_enqueue_style( 'css_best-images-slider',  plugin_dir_url( __FILE__ ). 'css/bis_best-images-slider.css' );

			/*   REGISTER ALL JS FOR SITE */			
			wp_enqueue_script( 'js_sprout_slide', plugin_dir_url( __FILE__ ) . 'js/sprout-slide.js', array( 'jquery' ));
			wp_enqueue_script( 'js_slider.touchSwipe', plugin_dir_url( __FILE__ ) . 'js/slider.touchSwipe.js', array( 'jquery' ));
		}
		
		
		function bis_responsive_gallery_taxonomies() {
		    $labels = array(
		        'name'              => _x( 'Category', 'taxonomy general name' ),
		        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		        'search_items'      => __( 'Search Category' ),
		        'all_items'         => __( 'All Category' ),
		        'parent_item'       => __( 'Parent Category' ),
		        'parent_item_colon' => __( 'Parent Category:' ),
		        'edit_item'         => __( 'Edit Category' ),
		        'update_item'       => __( 'Update Category' ),
		        'add_new_item'      => __( 'Add New Category' ),
		        'new_item_name'     => __( 'New Category Name' ),
		        'menu_name'         => __( 'Gallery Category' ),
		    );

		    $args = array(
		        'hierarchical'      => true,
		        'labels'            => $labels,
		        'show_ui'           => true,
		        'show_admin_column' => true,
		        'query_var'         => true,
		        'rewrite'           => array( 'slug' => 'responsive_best_slider-category' ),
		    );

		    register_taxonomy( 'responsive_best_slider-category', array( 'best_images_slider' ), $args );
		}

		function bis_responsive_gallery_rewrite_flush() {  
				bis_responsive_gallery_setup_post_types();
		    flush_rewrite_rules();
		}


		function bis_responsive_gallery_category_manage_columns($theme_columns) {
		    $new_columns = array(
		            'cb' => '<input type="checkbox" />',
		            'name' => __('Name'),
		            'best_slider_shortcode' => __( 'Gallery Category Shortcode', 'best_slick_slider' ),
		            'slug' => __('Slug'),
		            'posts' => __('Posts')
					);

		    return $new_columns;
		}

		function bis_responsive_gallery_category_columns($out, $column_name, $theme_id) {
		    $theme = get_term($theme_id, 'responsive_best_slider-category');

		    switch ($column_name) {      
		        case 'title':
		            echo get_the_title();
		        break;
		        case 'best_slider_shortcode':
					echo '[sp_best.images.slider cat_id="' . $theme_id. '"]';			  	  

		        break;
		        default:
		            break;
		    }
		    return $out;   

		}

		/* Custom meta box for slider link */
		function bis_rsris_add_meta_box_gallery() {
			add_meta_box('custom-metabox',__( 'LINK URL', 'link_textdomain' ),array( $this , 'bis_rsris_gallery_box_callback' ),'best_images_slider');			
		}
		
		function bis_rsris_gallery_box_callback( $post ) {
			wp_nonce_field( 'bis_rsris_save_meta_box_data_gallery', 'rsris_meta_box_nonce' );
			$value = get_post_meta( $post->ID, 'rsris_slide_link', true );
			echo '<input type="url" id="rsris_slide_link" name="rsris_slide_link" value="' . esc_attr( $value ) . '" size="25" /><br />';
			echo 'ie http://www.google.com';
		}
		
		function bis_rsris_save_meta_box_data_gallery( $post_id ) {
			if ( ! isset( $_POST['rsris_meta_box_nonce'] ) ) {
				return;
			}
			if ( ! wp_verify_nonce( $_POST['rsris_meta_box_nonce'], 'bis_rsris_save_meta_box_data_gallery' ) ) {
				return;
			}
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			if ( isset( $_POST['post_type'] ) && 'best_images_slider' == $_POST['post_type'] ) {

				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				}
			} else {

				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}
			if ( ! isset( $_POST['rsris_slide_link'] ) ) {
				return;
			}
			$link_data = sanitize_text_field( $_POST['rsris_slide_link'] );
			update_post_meta( $post_id, 'rsris_slide_link', $link_data );
		}
		
		/*
		 * Add [sp_best.images.slider] shortcode
		 *
		 */
		function bis_responsivegallery_shortcode( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				"limit"  => '',
				"cat_id" => '',
				"duration" => '',
				"autoplay" => '',
				"autoplay_interval" => '',
				"height" => '',
				"width" => '',
				"animate_style"=>'',
				"slide_num"=>'',
			), $atts));
			
			if( $limit ) { 
				$posts_per_page = $limit; 
			} else {
				$posts_per_page = '-1';
			}
			if( $cat_id ) { 
				$cat = $cat_id; 
			} else {
				$cat = '';
			}
			
			if( $width ) { 
				$width_slider = $width; 
			} else {
				$width_slider = 'auto';
			}	
			
			if( $height ) { 
				$height_slider = $height; 
			} else {
				$height_slider = '450';
			}	
			
			
			if( $duration ) { 
				$duration_slider = $duration; 
			} else {
				$duration_slider = "700";
			}	

			if( $autoplay ) { 
				$autoplay_slider = $autoplay; 
			} else {
				$autoplay_slider = 'true';
			}	 	
			
			if( $autoplay_interval ) { 
				$autoplay_intervalslider = $autoplay_interval; 
			} else {
				$autoplay_intervalslider = '4000';
			}
			
			if( $animate_style ) { 
				$animateStyle_slider = $animate_style; 
			} else {
				$animateStyle_slider = 'slide';
			}

			if( $slide_num ) { 
				$slide_num_slider = $slide_num; 
			} else {
				$slide_num_slider = '4';
			}

			ob_start();
			// Create the Query
			$post_type 		= 'best_images_slider';
			$orderby 		= 'post_date';
			$order 			= 'DESC';
						
			 $args = array ( 
		            'post_type'      => $post_type, 
		            'orderby'        => $orderby, 
		            'order'          => $order,
		            'posts_per_page' => $posts_per_page,  
		           
		            );
			if($cat != ""){
		            	$args['tax_query'] = array( array( 'taxonomy' => 'responsive_best_slider-category', 'field' => 'id', 'terms' => $cat) );
		            }        
		      $query = new WP_Query($args);

			$post_count = $query->post_count;
			$i = 1;
			if( $post_count > 0) :
			?>
				<div style="width:1000px; margin:10px auto;">
					<div class="sprout-slide-container" id="best_images_slider">
					    <div class="sprout-slide-wrapper">
					        <ul class="sprout-slide">
					        	<?php								
									while ($query->have_posts()) : $query->the_post();
										include('designs/design-1.php');
										
									$i++;
									endwhile;									
								?>				            
					        </ul>
					    </div>
					    <div class="sprout-arrow">
					        <div class="sprout-prev"></div>
					        <div class="sprout-next"></div>
					    </div>
					    <div class="sprout-dots">
					    </div>
					</div>
				</div>
			<?php	else : ?>

				<?php
				endif;
				// Reset query to prevent conflicts
				wp_reset_query();
			?>							

			<script type="text/javascript">
				var JJ= jQuery.noConflict(); 
				JJ(document).ready(function(){
					JJ('#best_images_slider').sproutSlide({
						animateStyle: "<?php echo $animateStyle_slider; ?>",
						width: "<?php echo $width_slider; ?>",
						slideNum: <?php echo $slide_num_slider; ?>,
						duration: <?php echo $duration_slider; ?>,
						autovalue: <?php if($autoplay_slider == "false") { echo 'false';} else { echo 'true'; } ?>,
						interval: <?php echo $autoplay_intervalslider; ?>,
						enableDot:true,
						enableArrow:true,
						enableLoop:false,
						enablePageNo:true,
						hoverShowArrow:false,
						onInit:function(slider,current,total){
							slider.find('.customize-page-text').html('IMAGES: '+(current+1)+' / '+total);
						},
						beforeAnimate:function(slider,current,total){
							slider.find('.customize-page-text').html('IMAGES: '+(current+1)+' / '+total);
						}
					});						
				});
		    </script>
			<?php
			return ob_get_clean();
		}		
	}
}
	
function bis_best_images_slider_load() {
        global $mfpd;
        $mfpd = new Best_Images_Slider();
}
add_action( 'plugins_loaded', 'bis_best_images_slider_load' );