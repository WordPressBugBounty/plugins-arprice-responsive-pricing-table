<?php
if( !defined( 'ABSPATH' ) ) exit;
class arprice_global_settings{

    function __construct(){

        add_action('wp_ajax_arp_save_setting_data', array($this,'arp_save_setting_data_func') );
    }

    function arp_save_setting_data_func(){

        global $arpricemain, $arprice_settings_tbl;

        $response = array();

        if ( empty( $_POST['_wpnonce_arpnonce'] ) || ( isset( $_POST['_wpnonce_arpnonce'] ) && '' != $_POST['_wpnonce_arpnonce'] && ! wp_verify_nonce( sanitize_text_field( $_POST['_wpnonce_arpnonce'] ), 'arplite_wp_nonce' ) ) ) {
            $response['variant'] = 'error';
            $response['title'] = esc_html__( 'Error', 'arprice-responsive-pricing-table');
            $response['msg'] = esc_html__( 'Sorry, your request could not be processed due to security reason.', 'arprice-responsive-pricing-table' );

            wp_send_json( $response );
            die;
		}

        if( !current_user_can( 'arplite_global_settings_pricingtables' ) ){
            $response['variant'] = 'error';
            $response['title'] = esc_html__( 'Error', 'arprice-responsive-pricing-table');
            $response['msg'] = esc_html__( 'Sorry, you do not have permission to perform this action', 'arprice-responsive-pricing-table' );;
            wp_send_json( $response );
            die;
        }

        $response['variant'] = 'error';
        $response['title']   = esc_html__('Error', 'arprice-responsive-pricing-table');
        $response['msg']     = esc_html__('Something Went wrong while updating settings...', 'arprice-responsive-pricing-table');

        $arp_setting_filterd_form = isset( $_POST['setting_form_data'] ) ?  stripslashes_deep( $_POST['setting_form_data'] ) : array(); //phpcs:ignore

        $settings_data = json_decode( $arp_setting_filterd_form, true );
 
        if( !empty( $settings_data )){
 
           
            $arprice_default_opts = $arpricemain->arplite_default_options();
 
            if( $arpricemain->arprice_is_pro_active() && class_exists('arprice_global_pro_settings') && method_exists('arprice_global_pro_settings', 'arprice_fetch_pro_default_options') ){
                $arprice_pro_default_opts = arprice_global_pro_settings::arprice_fetch_pro_default_options();
                if( !empty( $arprice_pro_default_opts ) ){
                    $arprice_default_opts = array_merge( $arprice_default_opts, $arprice_pro_default_opts );
                }
            }

            foreach( $arprice_default_opts as $option_name => $option_val ){

                if( isset( $settings_data[ $option_name ] ) ){
                    $opt_val = $settings_data[ $option_name ];
                    
                } else {
                    $opt_val = $option_val;
                    
                }
                
                $opt_val = is_array( $opt_val ) ? array_map( array( $arpricemain, 'arprice_sanitize_values' ), $opt_val ) : $arpricemain->arprice_sanitize_single_value( $opt_val );
 
                if( is_array( $opt_val ) ){
                    $opt_val = wp_json_encode( $opt_val );
                }

                $arpricemain->arprice_update_settings( $option_name, $opt_val, 'general_settings' );
 
            }

            $response['variant'] = 'success';
            $response['title']   = esc_html__('Success', 'arprice-responsive-pricing-table');
            $response['msg']     = esc_html__('changes saved successfully.', 'arprice-responsive-pricing-table');

        }

        wp_cache_delete( 'arprice_all_general_settings' );

        echo wp_json_encode($response);
        die;
 
    }   

    function arprice_render_pro_settings( $setting_key ){
        global $arpricemain;

        if( class_exists( 'arprice_global_pro_settings' ) && method_exists( 'arprice_global_pro_settings', 'arprice_render_pro_settings_ui' ) ){
            arprice_global_pro_settings::arprice_render_pro_settings_ui( $setting_key );
        }

    }
}
global $arprice_global_settings;
$arprice_global_settings = new arprice_global_settings();