<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

class arprice_pricing_table{

    function __construct(){

        global $wpdb;
        
        if( !$this->arprice_is_pro_active() ){
			add_action( 'admin_menu', array( $this, 'arprice_register_menu') );
        }
            add_action( 'admin_init', array( $this, 'arplite_redirect_with_nonce_url' ) );   
            add_action( 'admin_enqueue_scripts', array( $this, 'arprice_load_assets'), 10 );
			add_action( 'arplite_enqueue_internal_style', array( $this, 'arplite_enqueue_inline_editor_css' ) );
		
    }

    public static function arprice_is_pro_active(){
        return is_plugin_active( 'arprice/arprice.php' );
    }

	function arplite_enqueue_inline_editor_css() {
		global $arplite_mainoptionsarr,$arpricelite_fonts,$arpricelite_version,$arplite_editor_css, $arpricemain;
		
		if( !$arpricemain->arprice_is_pro_active() ){

			$handler = 'arplite_admin_css';
		} else {
			global $arprice_version;

			wp_register_style('arprice_admin_css', PRICINGTABLE_URL . '/css/arprice_admin.css', array(), $arprice_version);
			wp_enqueue_style('arprice_admin_css');

			$handler = 'arprice_admin_css';
		}
		$data    = '';

		if ( isset( $_GET['page'] ) && 'arprice' == $_GET['page'] && isset( $_GET['arp_action'] ) && '' != $_GET['arp_action'] ) {

			$basic_colors = $arplite_mainoptionsarr['general_options']['arp_basic_colors'];
			foreach ( $basic_colors as $key => $colors ) {
				$base_color     = $colors;
				$base_color_key = array_search( $base_color, $basic_colors );
				$gradient_color = $arplite_mainoptionsarr['general_options']['arp_basic_colors_gradient'][ $base_color_key ];
				$data          .= '.basic_color_box.basic_color_' . $key . '{
	                background:' . $base_color . ';
	                background-color:' . $base_color . ';
	                background-image:-moz-linear-gradient(top, ' . $base_color . ', ' . $gradient_color . ');";
	                background-image:-webkit-gradient(linear, 0 0, 0 100%, from(' . $base_color . '), to(' . $gradient_color . '));
	                background-image:-webkit-linear-gradient(top, ' . $base_color . ', ' . $gradient_color . ');
	                background-image:-o-linear-gradient(top, ' . $base_color . ', ' . $gradient_color . ');
	                background-image:linear-gradient(to bottom, ' . $base_color . ', ' . $gradient_color . ');
	                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=' . $base_color . ', endColorstr=' . $gradient_color . ', GradientType=0);
	                -ms-filter: "progid:DXImageTransform.Microsoft.gradient (startColorstr="' . $base_color . '", endColorstr="' . $gradient_color . '", GradientType=0)";
	                    background-repeat:repeat-x;
	            }';
			}
			$google_fonts = $arpricelite_fonts->google_fonts_list();

			$font_array = array_chunk( $google_fonts, 150 );

			foreach ( $font_array as $key => $font_values ) {
				$google_fonts_string = implode( '|', $font_values );

				if ( is_ssl() ) {
					$google_font_url = 'https://fonts.googleapis.com/css?family=' . $google_fonts_string;
				} else {
					$google_font_url = 'http://fonts.googleapis.com/css?family=' . $google_fonts_string;
				}

				wp_enqueue_style( 'arplite-editor-google-fonts' . $key, $google_font_url, array(), $arpricelite_version );

			}
		} elseif ( isset( $_GET['page'] ) && 'arprice' == $_GET['page'] ) {

			$arplite_editor_data = '@import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700);';
			wp_add_inline_style( $handler, $arplite_editor_data );

		} elseif ( isset( $_GET['page'] ) && 'arprice_import_export' == $_GET['page'] ) {
			if ( is_ssl() ) {
				$google_font_url = 'https://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Open+Sans';
			} else {
				$google_font_url = 'http://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Open+Sans';
			}
			$data .= '@import url(' . $google_font_url . ');#wpcontent,#wpfooter{background:#fff}';
		} elseif ( isset( $_GET['page'] ) && 'arplite_ab_testing' == $_GET['page'] ) {
			if ( is_ssl() ) {
				$google_font_url = 'https://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Open+Sans';
			} else {
				$google_font_url = 'http://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Open+Sans';
			}
			$data .= '@import url(' . $google_font_url . ');#wpcontent,#wpfooter{background:#fff}';
		} elseif ( isset( $_GET['page'] ) && 'arprice_settings' == $_GET['page'] ) {
			if ( is_ssl() ) {
				$google_font_url = 'https://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Open+Sans';
			} else {
				$google_font_url = 'http://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Open+Sans';
			}

			$data .= '@import url(' . $google_font_url . ');#wpcontent,#wpfooter{background:#fff}.purchased_info{color:#7cba6c;font-weight:700;font-size:15px}#license_success{color:#8ccf7a!important}#arfresetlicenseform{border-radius:0;text-align:center;width:700px;height:500px;left:35%;border:none;background:#fff!important;padding-top:15px;margin-top:8%!important;margin:0 auto}.arfnewmodalclose{font-size:15px;font-weight:700;height:19px;position:absolute;right:3px;top:5px;width:19px;cursor:pointer;color:#D1D6E5}.newform_modal_title{font-size:25px;line-height:25px;margin-bottom:10px}.newmodal_field_title{font-size:16px;line-height:16px;margin-bottom:10px}.license-details-block{padding:20px;width:450px;margin:0 auto;position:relative;background:#fff;border:1px solid #b3b3b3;color:#333;border-radius:5px;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;height:110px}.arp_version_detail{padding:5px 0 0;width:100%;height:auto;font-size:16px}.arp_version_table{margin-top:50px;width:100%;text-align:left}.arp_version_table_header th{background:#31363d;color:#fff;padding:15px;font-size:18px}.arp_version_feature_detail td{padding:15px}.arp_version_feature_detail td:first-child,.arp_version_table_header th:first-child{width:370px}td#arp_premium_row{background:#f0f7f8;font-weight:700;width:300px}.arp_premium_version_info_belt{box-shadow:0 0 10px #ffa800;float:left;font-size:24px;font-weight:700;margin-bottom:50px;margin-top:90px;min-height:75px;line-height:70px;text-align:center;width:100%;color:#ffa800}.arp_premium_img{margin:15px 0;padding:5px;text-align:center}h1.arp_highlighted_points{font-size:18px;color:#1f98ff}#arp_sub_label{font-weight:700;margin:15px 0}.btn-gold{background:#62ca24;box-shadow:0 1px 1px 0 #747B73;border-radius:6px;color:#fff;cursor:pointer;display:inline-block;font-weight:700;line-height:16px;padding:20px;width:250px;font-size:16px}';
		}
		wp_add_inline_style( $handler, $data );
	}


    function arprice_register_menu(){

        global $arplite_pricingtable;

        $place = $arplite_pricingtable->get_free_menu_position( 26.1, .1 );

        add_menu_page( 'ARPrice', 'ARPrice', 'arplite_view_pricingtables', 'arprice', array( $this, 'route_data' ), ARPLITE_PRICINGTABLE_IMAGES_URL . '/pricing_table_icon.png', $place );

        add_submenu_page( 'arprice', esc_html__( 'Import/Export', 'arprice-responsive-pricing-table' ), esc_html__( 'Import/Export', 'arprice-responsive-pricing-table' ), 'arplite_import_export_pricingtables', 'arprice_import_export', array( $this, 'route_data' ) );

		add_submenu_page( 'arprice', esc_html__( 'A/B Testing', 'arprice-responsive-pricing-table' ), esc_html__( 'A/B Testing', 'arprice-responsive-pricing-table' ), 'arplite_ab_testing_pricingtables', 'arplite_ab_testing', array( $this, 'route_data' ) );

		add_submenu_page( 'arprice', esc_html__( 'Settings', 'arprice-responsive-pricing-table' ), esc_html__( 'Settings', 'arprice-responsive-pricing-table' ), 'arplite_global_settings_pricingtables', 'arprice_settings', array( $this, 'route_data' ) );

		add_submenu_page( 'arprice', esc_html__( 'Growth Plugins', 'arprice-responsive-pricing-table' ), esc_html__( 'Growth Plugins', 'arprice-responsive-pricing-table' ), 'arplite_view_pricingtables', 'arprice_growth_tools', array( $this, 'route_data' ) );

		$this->set_premium_link();

    }


    function arprice_load_assets() {

        global $arpricelite_version,$pagenow,$arpricemain;

        $arp_current_date = current_time('timestamp', true );
		$arp_sale_start_time = '1732064400';
		$arp_sale_end_time = '1733270399';

        if ( $pagenow == 'edit.php' || $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			return;
		}

		if(! $arpricemain->arprice_is_pro_active() ){
	wp_register_style( 'arplite_menu_css', ARPLITE_PRICINGTABLE_URL . '/css/arplite_menu.css', array(), $arpricelite_version );

			wp_enqueue_style( 'arplite_menu_css' );
			/** for sale purpose */
			if( $arp_current_date >= $arp_sale_start_time && $arp_current_date <= $arp_sale_end_time ){
				$stylesheet = '#adminmenu #toplevel_page_arprice .wp-submenu li:last-child a {
					color:red !important;
					background: transparent !important;
					font-weight: bold;
				}
				#adminmenu #toplevel_page_arprice .wp-submenu li:last-child a:hover{
					color : red !important;
				}';
				wp_add_inline_style( 'arplite_menu_css', $stylesheet );
			}
		}

		wp_register_style( 'arplite_admin_css', ARPLITE_PRICINGTABLE_URL . '/css/arprice_admin.css', array(), $arpricelite_version );

		wp_register_style( 'fontawesome', ARPLITE_PRICINGTABLE_URL . '/css/font-awesome.css', array(), $arpricelite_version );

		wp_register_style( 'tipso', ARPLITE_PRICINGTABLE_URL . '/css/tipso.min.css', array(), $arpricelite_version );

		wp_register_style( 'arplite_font_css_admin', ARPLITE_PRICINGTABLE_URL . '/fonts/arp_fonts.css', array(), $arpricelite_version );

		wp_register_style( 'bootstrap-tour-standalone', ARPLITE_PRICINGTABLE_URL . '/css/bootstrap-tour-standalone.css', array(), $arpricelite_version );

		wp_register_style( 'arplite_admin_css_3.8', ARPLITE_PRICINGTABLE_URL . '/css/arprice_admin_3.8.css', array(), $arpricelite_version );

		if(! $arpricemain->arprice_is_pro_active() ){
			wp_register_style( 'arplite_menu_css', ARPLITE_PRICINGTABLE_URL . '/css/arplite_menu.css', array(), $arpricelite_version );

			wp_enqueue_style( 'arplite_menu_css' );
		}

		wp_register_style( 'arplite_editor_front_css', ARPLITE_PRICINGTABLE_URL . '/css/arprice_front.css', array(), $arpricelite_version );

		wp_register_style( 'arplite_cross_sellling', ARPLITE_PRICINGTABLE_URL .'/css/arplite_cross_selling.css', array(), $arpricelite_version );

		wp_register_script( 'arplite_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice.js', array(), $arpricelite_version );

		wp_register_script( 'arplite_sortable_resizable_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_sortable_resizable.js', array(), $arpricelite_version );

		wp_register_script( 'bpopup', ARPLITE_PRICINGTABLE_URL . '/js/jquery.bpopup.min.js', array(), $arpricelite_version );

		wp_register_script( 'tipso', ARPLITE_PRICINGTABLE_URL . '/js/tipso.min.js', array(), $arpricelite_version );

		wp_register_script( 'arplite_editor_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_editor.js', array(), $arpricelite_version );

		wp_register_script( 'arpricelite-sortable-js', ARPLITE_PRICINGTABLE_URL . '/js/sortable.min.js', array(), $arpricelite_version );

		wp_register_script( 'html2canvas', ARPLITE_PRICINGTABLE_URL . '/js/html2canvas.js', array(), $arpricelite_version );

		wp_register_script( 'bootstrap-tour-standalone', ARPLITE_PRICINGTABLE_URL . '/js/bootstrap-tour-standalone.js', array(), $arpricelite_version );

		wp_register_script( 'arplite_tour_guide', ARPLITE_PRICINGTABLE_URL . '/js/arprice_tour_guide.js', array(), $arpricelite_version );

		wp_register_script( 'arplite_dashboard_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_dashboard.js', array(), $arpricelite_version );

		wp_register_script( 'arprice_template_listing', ARPLITE_PRICINGTABLE_URL . '/js/arprice_template_listing.js', array(), $arpricelite_version );

		wp_register_script( 'arprice_settings_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_settings.js', array(), $arpricelite_version );

		wp_register_style( 'arprice_common_css', ARPLITE_PRICINGTABLE_URL .'/css/arprice_common_css.css', array(), $arpricelite_version );
		wp_enqueue_style( 'arprice_common_css' );

		if( $arpricemain->arprice_is_pro_active() ){
			wp_register_script('arp_import_table', PRICINGTABLE_URL . '/js/arprice_import_table.js', array(), $arpricelite_version);
			if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arprice_import_export') {
				wp_enqueue_script('arp_import_table');
			}
	
		}


        if ( isset( $_GET['page'] ) && ( $_GET['page'] == 'arprice' || $_GET['page'] == 'arplite_add_pricing_table' || $_GET['page'] == 'arp_analytics' || $_GET['page'] == 'arprice_import_export' || $_GET['page'] == 'arprice_settings' || $_GET['page'] == 'arplite_upgrade_to_premium' || $_GET['page'] == 'arprice_growth_tools' || $_GET['page'] == 'arplite_ab_testing' ) ) {

			if(is_rtl()){
				wp_enqueue_style('arprice_admin_rtl_css_3.8', ARPLITE_PRICINGTABLE_URL . '/css/arprice_admin_rtl_3.8.css', array(), $arpricelite_version);
			}
			if ( version_compare( $GLOBALS['wp_version'], '3.7', '>' ) ) {
				wp_enqueue_style( 'arplite_admin_css_3.8' );
				wp_enqueue_style( 'tipso' );
			}
			if( !$arpricemain->arprice_is_pro_active() ){

				wp_enqueue_style( 'arplite_admin_css' );
			}

			do_action( 'arplite_enqueue_internal_style' );
			if ( $_GET['page'] != 'arprice_settings' && $_GET['page'] != 'arprice_import_export' && $_GET['page'] != 'arplite_ab_testing' ) {

				wp_enqueue_style( 'fontawesome' );

				wp_enqueue_style( 'bootstrap-tour-standalone' );
			}

			if ( isset( $_GET['page'] ) && $_GET['page'] == 'arprice' ) {
				wp_enqueue_style( 'tipso' );
			}
		}

        if ( isset( $_GET['page'] ) && ( $_GET['page'] == 'arprice' || $_GET['page'] == 'arplite_add_pricing_table' || $_GET['page'] == 'arplite_analytics' || $_GET['page'] == 'arprice_import_export' || $_GET['page'] == 'arprice_settings' || $_GET['page'] == 'arplite_ab_testing' ) && ( $pagenow !== 'edit.php' && $pagenow !== 'post.php' && $pagenow !== 'post-new.php' ) ) {

            wp_register_script( 'jscolor', ARPLITE_PRICINGTABLE_URL . '/js/jscolor.js', array(), $arpricelite_version );
			wp_enqueue_script( 'jquery' );

			if ( $_GET['page'] == 'arprice' ) {
				wp_enqueue_script( 'bootstrap-tour-standalone' );
				wp_enqueue_script( 'arplite_tour_guide' );
				if( !$arpricemain->arprice_is_pro_active() && ( ($_GET['page'] == 'arprice') && isset($_GET['arp_action']) && ($_GET['arp_action'] == 'edit' || $_GET['arp_action'] == 'new')))
				wp_enqueue_script( 'arplite_dashboard_js' );
				wp_enqueue_script( 'arprice_template_listing' );
				do_action( 'arplite_add_tour_guide_js' );
			}

			if ( $_GET['page'] != 'arprice_import_export' ) {
				wp_enqueue_script( 'bpopup' );
			}

            if ( isset( $_GET['page'] ) && ( $_GET['page'] == 'arprice' || $_GET['page'] == 'arprice_settings' || $_GET['page'] == 'arplite_ab_testing' || $_GET['page'] == 'arprice_import_export' ) ) {
				if ( $_GET['page'] == 'arprice' && isset( $_GET['arp_action'] ) ) {

					if( !$arpricemain->arprice_is_pro_active() ){

						wp_enqueue_script( 'arplite_js' );
						wp_enqueue_script( 'arplite_sortable_resizable_js' );
						wp_enqueue_script( 'arplite_editor_js' );
					}

					do_action( 'arplite_enqueue_internal_script' );

					wp_enqueue_script( 'html2canvas' );
					wp_enqueue_script( 'jquery-ui-core' );

					wp_enqueue_script( 'jquery-effects-slide' );

					wp_enqueue_script( 'arpricelite-sortable-js' );

					// wp_enqueue_script( 'jquery-ui-sortable' );

					wp_enqueue_script( 'jquery-ui-slider' );

					wp_enqueue_script( 'media-upload' );
					wp_enqueue_script( 'jscolor' );
					wp_enqueue_script( 'sack' );

					wp_enqueue_script( 'bootstrap-tour-standalone' );
					wp_enqueue_script( 'arplite_tour_guide' );
				}

				if ( ( $_GET['page'] == 'arprice' && ! isset( $_GET['arp_action'] ) ) || $_GET['page'] == 'arprice_settings' || $_GET['page'] == 'arprice_import_export' || $_GET['page'] == 'arplite_ab_testing' ) {
					wp_enqueue_script( 'arplite_dashboard_js' );
					if ( $_GET['page'] == 'arprice' && isset( $_GET['arp_action'] ) && $_GET['arp_action'] == '' ) {
						wp_enqueue_script( 'bootstrap-tour-standalone' );
						wp_enqueue_script( 'arplite_tour_guide' );
					}
				}

				if(  "arprice_settings" == $_GET['page'] ){

					wp_enqueue_script('arprice_settings_js');
					
				}

				wp_enqueue_script( 'tipso' );

				wp_localize_script(
					'arplite_editor_js',
					'arplite_editor_obj',
					array(
						'inherit_font' => esc_html__( 'Inherit from Theme', 'arprice-responsive-pricing-table' ),
					)
				);
			}
			if(is_rtl()){
                wp_enqueue_style('arprice_admin_rtl_css');
            }
        }

		if( !empty( $_GET['page'] ) &&  $_GET['page'] == 'arprice_growth_tools' ){
            
			wp_enqueue_style( 'arplite_cross_sellling' );
			wp_enqueue_script( 'arplite_dashboard_js' );
			wp_enqueue_script( 'tipso' );
		}

		if ( $pagenow == 'plugins.php' ) {
			wp_register_style( 'arplite-feedback-popup-style', ARPLITE_PRICINGTABLE_URL . '/css/arplite_deactivation_style.css', array(), $arpricelite_version );
			wp_enqueue_style( 'arplite-feedback-popup-style' );

            wp_register_script( 'arplite-feedback-popup-script', ARPLITE_PRICINGTABLE_URL . '/js/arplite_deactivation_script.js', array( 'jquery' ), $arpricelite_version );
			wp_enqueue_script( 'arplite-feedback-popup-script' );

			$scriptData = 'var arplite_detailsStrings = {
				"setup-difficult":"' . esc_html__( 'What was the dificult part?', 'arprice-responsive-pricing-table' ) . '",
				"docs-improvement":"' . esc_html__( 'What can we describe more?', 'arprice-responsive-pricing-table' ) . '",
				"features":"' . esc_html__( 'How could we improve?', 'arprice-responsive-pricing-table' ) . '",
				"better-plugin":"' . esc_html__( 'Can you mention it?', 'arprice-responsive-pricing-table' ) . '",
				"incompatibility":"' . esc_html__( 'With what plugin or theme is incompatible?', 'arprice-responsive-pricing-table' ) . '",
				"bought-premium":"' . esc_html__( 'Please specify experience', 'arprice-responsive-pricing-table' ) . '",
				"maintenance":"' . esc_html__( 'Please specify', 'arprice-responsive-pricing-table' ) . '"
			};

			var pluginName = "' . esc_attr( 'arprice-responsive-pricing-table' ) . '";
			var pluginSecurity = "' . wp_create_nonce( 'arplite_deactivate_plugin' ) . '";
			';

			wp_add_inline_script( 'arplite-feedback-popup-script', $scriptData );
		}
    }

    function set_premium_link() {

		if ( file_exists( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_upgrade_to_premium.php' ) ) {
			include ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_upgrade_to_premium.php';
		}
	}

    function route_data() {
		global $arpricemain, $arpricelite_form;
 

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'arprice' && isset( $_GET['arp_action'] ) && $_GET['arp_action'] == '' ) {
			$arpricemain->addnew();
		} elseif ( isset( $_GET['page'] ) && $_GET['page'] == 'arplite_add_pricing_table' ) {
			if ( isset( $_GET['arpaction'] ) && $_GET['arpaction'] == 'create_new' ) {
				$arpricelite_form->edit_template();
			} else {
				$arpricemain->addnew();
			}
		} elseif ( isset( $_GET['page'] ) && $_GET['page'] == 'arplite_analytics' ) {
			$arpricemain->analytics();
		} elseif ( isset( $_GET['page'] ) && $_GET['page'] == 'arprice_import_export' ) {
			$arpricemain->import_export();
		} elseif ( isset( $_GET['page'] ) && $_GET['page'] == 'arprice_settings' ) {
			$arpricemain->load_global_settings();
		} elseif ( isset( $_GET['page'] ) && $_GET['page'] == 'arplite_ab_testing' ) {
			$arpricemain->load_abtesting_settings();
		} elseif ( isset( $_GET['page'] ) && $_GET['page'] == 'arplite_upgrade_to_premium' ) {
			$arpricemain->arplite_upgrade_to_premium();
		} elseif( isset( $_GET['page'] ) && $_GET['page'] == 'arprice_growth_tools' ) {
			$arpricemain->arprice_growth_tools();
		}
		
		elseif ( isset( $_GET['page'] ) && $_GET['page'] == 'arprice' && isset( $_GET['arp_action'] ) && $_GET['arp_action'] != '' ) {
			$arpricemain->pricing_table_content();
		} else {
			$arpricemain->addnew();
		}
	}

    function arprice_growth_tools() {
		if ( file_exists( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_growth_tools.php' ) ) {
			include ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_growth_tools.php';
		}
	}
	function arplite_upgrade_to_premium() {
		if ( file_exists( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_upgrade_to_premium.php' ) ) {
			include ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_upgrade_to_premium.php';
		}
	}

	function addnew() {
		if ( file_exists( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_template_listing_2.0.php' ) ) {
			include ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_template_listing_2.0.php';
		}
	}

	function pricing_table_content() {
		if ( file_exists( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_listing_editor.php' ) ) {
			include ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_listing_editor.php';
		}
	}

	function import_export() {
		if ( file_exists( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_import_export.php' ) ) {
			include ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_import_export.php';
		}
	}

	function load_global_settings() {
		if ( file_exists( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_global_settings.php' ) ) {
			include ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_global_settings.php';
		}
	}

	function load_abtesting_settings() {
		if ( file_exists( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_ab_testing.php' ) ) {
			include ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_ab_testing.php';
		}
	}

    function arplite_redirect_with_nonce_url() {

		if ( is_admin() ) {

			if ( isset( $_GET['page'] ) && 'arprice' == $_GET['page'] ) {

				if ( ! isset( $_GET['arprice_page_nonce'] ) ) {
					$url = admin_url( 'admin.php?page=arprice&arprice_page_nonce=' . wp_create_nonce( 'arprice_page_nonce' ) );
					if ( isset( $_GET['arp_action'] ) || isset( $_GET['arpricelite_show_deal'] ) ) {
						$query_args = '';
						unset( $_GET['page'] );
						foreach ( $_GET as $k => $v ) {
							$query_args .= '&' . $k . '=' . $v;
						}
						$url .= $query_args;
					}
					wp_redirect( $url );
					die;
				} elseif ( isset( $_GET['arprice_page_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( $_GET['arprice_page_nonce'] ), 'arprice_page_nonce' ) ) {
					wp_die( 'Sorry, the page you are trying to access is not accessible due to security reason.' );
				}
			} elseif ( isset( $_GET['page'] ) && 'arprice_import_export' == $_GET['page'] ) {

				if ( ! isset( $_GET['arprice_import_export_nonce'] ) ) {
					$url = admin_url( 'admin.php?page=arprice_import_export&arprice_import_export_nonce=' . wp_create_nonce( 'arprice_import_export_nonce' ) );

					wp_redirect( $url );
					die;
				} elseif ( isset( $_GET['arprice_import_export_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( $_GET['arprice_import_export_nonce'] ), 'arprice_import_export_nonce' ) ) {
					wp_die( 'Sorry, the page you are trying to access is not accessible due to security reason.' );
				}
			} elseif ( isset( $_GET['page'] ) && 'arprice_settings' == $_GET['page'] ) {

				if ( ! isset( $_GET['arprice_settings_nonce'] ) ) {
					$url = admin_url( 'admin.php?page=arprice_settings&arprice_settings_nonce=' . wp_create_nonce( 'arprice_settings_nonce' ) );

					wp_redirect( $url );
					die;
				} elseif ( isset( $_GET['arprice_settings_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( $_GET['arprice_settings_nonce'] ), 'arprice_settings_nonce' ) ) {
					wp_die( 'Sorry, the page you are trying to access is not accessible due to security reason.' );
				}
			} elseif ( isset( $_GET['page'] ) && 'arplite_ab_testing' == $_GET['page'] ) {

				if ( ! isset( $_GET['arplite_ab_testing_nonce'] ) ) {
					$url = admin_url( 'admin.php?page=arplite_ab_testing&arplite_ab_testing_nonce=' . wp_create_nonce( 'arplite_ab_testing_nonce' ) );

					wp_redirect( $url );
					die;
				} elseif ( isset( $_GET['arplite_ab_testing_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( $_GET['arplite_ab_testing_nonce'] ), 'arplite_ab_testing_nonce' ) ) {
					wp_die( 'Sorry, the page you are trying to access is not accessible due to security reason.' );
				}
			}
		}
	}
	
	public static function arplite_default_options() {
		return array(
			'arp_mobile_responsive_size' => 480,
			'arp_tablet_responsive_size' => 768,
			'arp_desktop_responsive_size'=> 0,
			'enable_fontawesome_icon' => 1,
			'arp_css_character_set' => array(),
			'arp_load_js_css' => '',
		);
	}

	/** ARPrice settings data update */
	function arprice_update_settings( $setting_name, $setting_value, $setting_type ){

		global $wpdb, $arprice_settings_tbl;

		$arprice_settings_tbl = $wpdb->prefix . 'arprice_settings';

		$check_settings = $wpdb->get_var( $wpdb->prepare( "SELECT setting_id FROM {$arprice_settings_tbl} WHERE setting_name = %s AND setting_type = %s", $setting_name, $setting_type )); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- Reason: $tbl_arf_settings is table name defined globally. False Positive alarm

		if( empty( $check_settings ) ){
			$wpdb->insert(
				$arprice_settings_tbl,
				array(
					'setting_name' => $setting_name,
					'setting_value' => $setting_value,
					'setting_type' => $setting_type
				)
			);
		} else {
			$wpdb->update(
				$arprice_settings_tbl,
				array(
					'setting_value' => $setting_value,
				),
				array(
					'setting_name' => $setting_name,
					'setting_type' => $setting_type
				)
			);
		}

	}

	/** ARPrice settings fetch */

	public function arprice_get_settings( $setting_name, $setting_type ) {

		global $arpricemain;

		$arprice_general_setting_options  = $arpricemain->arprice_global_option_data();

		if( !is_array( $setting_name ) && isset( $arprice_general_setting_options[ $setting_type ][ $setting_name ] ) ){
			$return_setting_data = $arprice_general_setting_options[ $setting_type ][ $setting_name ];
			$return_setting_data = apply_filters( 'arprice_modified_get_settings',$return_setting_data,$setting_type,$setting_name);
			return $return_setting_data;

		} else if( is_array( $setting_name ) ){
			$return_data = array();
			foreach( $setting_name as $setting_name_key ){
				if( !empty( $arprice_general_setting_options[ $setting_type ][ $setting_name_key ] ) ){
					$return_setting_data = $arprice_general_setting_options[ $setting_type ][ $setting_name_key ];
					$return_setting_data = apply_filters( 'arprice_modified_get_settings',$return_setting_data,$setting_type,$setting_name_key);
					$return_data[ $setting_name_key ] = $return_setting_data;
				} else {
					$return_data[ $setting_name_key ] = '';
				}
			}
			return $return_data;
		} else {
			return '';
		}
    }

	function arprice_global_option_data(){

		global $arprice_settings_tbl, $wpdb;

		$arprice_settings_tbl = $wpdb->prefix . 'arprice_settings';
		
		$arprice_general_settings_data = array();

        // Get all the general settings
		$arprice_cached_general_settings = wp_cache_get( 'arprice_all_general_settings' );

		if( false === $arprice_cached_general_settings ){
			$arprice_all_general_settings = $wpdb->get_results( "SELECT setting_name,setting_value,setting_type FROM {$arprice_settings_tbl} ORDER BY setting_type ASC" ); //phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- Reason: $tbl_arf_settings is table name defined globally. False Positive alarm 
			wp_cache_set( 'arprice_all_general_settings', $arprice_all_general_settings ); 
		} else {
			$arprice_all_general_settings = $arprice_cached_general_settings;
		}

		if( !empty( $arprice_all_general_settings ) ){
			foreach( $arprice_all_general_settings as $cs_key => $cs_value ){
				$general_type = $cs_value->setting_type;
				if( empty( $arprice_general_settings_data[ $general_type ] ) ){
					$arprice_general_settings_data[ $general_type ] = array();
				}

				$arprice_general_settings_data[ $general_type ][ $cs_value->setting_name ] = $cs_value->setting_value;
			}
		}

		$global_data = $arprice_general_settings_data;

		return $global_data;
	}

	function arprice_sanitize_values( $data_array ){
		if( null == $data_array ){
			return $data_array;
		}

		if (is_array($data_array) ) {
			return array_map(array( $this, __FUNCTION__ ), $data_array);
		} else {
			if(preg_match( '/<[^<]+>/', $data_array ) ) {
				return wp_kses( $data_array, $this->arprice_wpkses_allowed_html() );
			} else {
				return $this->arprice_sanitize_single_value($data_array);
			}
		}
	}

	function arprice_sanitize_single_value( $value ){
		if( empty( $value ) || gettype( $value ) === 'boolean' ){
			return $value;
		}

		if( filter_var( $value, FILTER_VALIDATE_INT ) ){
			return intval( $value );
		} else if( filter_var( $value, FILTER_VALIDATE_EMAIL) ){
			return sanitize_email( $value );
		} else if( filter_var( $value, FILTER_VALIDATE_FLOAT ) ){
			return floatval( $value );
		} else if( filter_var( $value, FILTER_VALIDATE_URL ) ){
			return esc_url( $value );
		}


		return sanitize_text_field( $value );

	}

	function arprice_wpkses_allowed_html(){
		$allowed_html_arr = array(
			'a' => array('title'=>array(), 'href'=>array(), 'target'=>array(), 'class'=>array(), 'id'=>array(), 'style'=>array()),
			'arftotal' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'b' => array(),
			'blockquote' => array(),
			'br' => array(),
			'button' => array('class'=>array(), 'id'=>array(), 'style'=>array(), 'title'=>array()),
			'canvas' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'center' => array(),
			'code' => array(),
			'dd' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'del' => array('datetime' => array(), 'title' => array()),
			'div' => array('class'=>array(), 'id'=>array(), 'style'=>array(), 'title'=>array()),
			'dl' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'dt' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'em' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'embed' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'font' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'frame' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'frameset' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'h1' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'h2' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'h3' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'h4' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'h5' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'hr' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'i' => array(),
			'iframe' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'img' => array('class'=>array(), 'id'=>array(), 'style'=>array(), 'src'=>array(), 'alt'=>array(), 'height'=>array(), 'width'=>array()),
			'label' => array('class'=>array(), 'id'=>array(), 'style'=>array(), 'for'=>array()),
			'li' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'link' => array('href'=>array(), 'type'=>array()),
			'meta' => array(),
			'object' => array(),
			'ol' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'p' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'pre' => array(),
			'q' => array('cite' => array(), 'title' => array()),
			'span' => array('class'=>array(), 'id'=>array(), 'style'=>array(), 'title'=>array()),
			'script' => array('src'=>array(), 'type'=>array()),
			'strike' => array(),
			'sub' => array(),
			'sup' => array(),
			'svg' => array(),
			'strong' => array(),
			'tfooter' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'tbody' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'thead' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'th' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'td' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'tr' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'table' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
			'u' => array(),
			'ul' => array('class'=>array(), 'id'=>array(), 'style'=>array()),
		);

		return $allowed_html_arr;	
	}

	function arprice_render_lisitng_settings( $setting_key ){
        global $arpricemain;

        if( class_exists( 'arprice_pro_listing_page' ) && method_exists( 'arprice_pro_listing_page', 'arprice_pro_listing_settings_ui' ) ){
            arprice_pro_listing_page::arprice_pro_listing_settings_ui( $setting_key );
        }

    }
 
}

global $arpricemain;
$arpricemain = new arprice_pricing_table();