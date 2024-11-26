<?php

class arpricelite_fusion_builder_elements{
    function __construct(){

        add_action('fusion_builder_enqueue_live_scripts' ,array($this, 'arp_load_style'), 10);
        add_action('fusion_builder_admin_scripts_hook',array($this, 'arp_load_style'), 10);
        
        add_action( 'fusion_builder_before_init', array( $this, 'fusion_builder_elements_map') );
    }

    function arp_load_style(){
        global $arpricelite_version;
        wp_register_style( 'arpricelite_fusion_css', '/wp-content/plugins/arprice-responsive-pricing-table/integrations/fusion/css/fusion_builder.css'  , array() ,$arpricelite_version);
        wp_enqueue_style('arpricelite_fusion_css');
    }

    function fusion_builder_elements_map(){
        global $arpricelite_version, $wpdb;
        $table_name = $wpdb->prefix. 'arplite_arprice';
		$arprice_lite_data = $wpdb->get_results( 'SELECT * FROM `' . $table_name . "` WHERE is_template=0 ORDER BY id DESC" );//phpcs:ignore
        $arprice_lite_list = array();
		$n                       = 0;

		foreach ( $arprice_lite_data as $k => $value ) {
            $arprice_lite_list['']            =esc_html__("Please Select Pricing Table",'arprice-responsive-pricing-table');
			$arprice_lite_list[$value->ID]    =  $value->table_name  . ' (id: ' . $value->ID . ')';
			
		}


        fusion_builder_map(
            fusion_builder_frontend_data(

                'arplite_fusion_elements',
                [
                    'name'                     => esc_attr__( 'ARPrice Lite', 'arprice-responsive-pricing-table' ),
                    'shortcode'                => 'ARPLite',
                    'icon'                     => 'arprice-logo',
                    'tab'                      => 'ARPrice',
                    'params'                   => [
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Table', 'arprice-responsive-pricing-table' ),
                            'param_name'  => 'id',
                            'value'       => $arprice_lite_list,
                        ],
                        [
                            'type'        => 'hidden',
                            'param_name'  => 'is_fusionbuilder',
                            'value'       => true,
                        ],
                    ],
                ]
            )
        );
    }
}
global $fusion_builder_elements;
$fusion_builder_elements = new arpricelite_fusion_builder_elements();

?>