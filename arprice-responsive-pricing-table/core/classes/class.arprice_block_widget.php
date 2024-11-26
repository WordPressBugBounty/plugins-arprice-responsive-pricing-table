<?php
class arprice_block_widget{

public $attributes = array(
    'table_id' => array(
        'type' => 'string',
        'default' => 0
    )
);

function __construct(){

    add_action( 'init', array( $this, 'arprice_register_gutenberg_blocks') );

    if (! empty($GLOBALS['wp_version']) && version_compare($GLOBALS['wp_version'], '5.7.2', '>') ) {
        add_filter('block_categories_all', array( $this, 'arprice_gutenberg_category' ), 10, 2);
    } else {
        add_filter('block_categories', array( $this, 'arprice_gutenberg_category' ), 10, 2);
    }

    add_action( 'enqueue_block_editor_assets', array( $this, 'arpricelite_enqueue_gutenberg_assets' ) );
}

function arprice_gutenberg_category( $category, $post ){
    $new_category     = array(
        array(
            'slug'  => 'arprice',
            'title' => 'ARPrice Blocks',
        ),
    );
    $final_categories = array_merge($category, $new_category);
    return $final_categories;
}



protected function get_block_properties() {
    return array(
        'render_callback' => array( $this, 'render_block' ),
        'attributes'      => $this->attributes,
    );
}

public function render_block( $attributes = array() ) {
   
    global $table, $arpricemain,$arplite_pricingtable;
    $table_id = !empty( $attributes['table_id'] ) ? $attributes['table_id'] : '';
    

    if(empty($table_id)) {
        return esc_html__("Please select valid table",'arprice-responsive-pricing-table');
    }

    global $wpdb, $table, $ARFLiteMdlDb,$arfliteform, $arflitemainhelper, $arfliterecordcontroller;
  
    // $arfliterecordcontroller->arflite_register_scripts();
    
        $tabel_key = $wpdb->get_var( $wpdb->prepare( "SELECT table_name FROM " . $wpdb->prefix . "arplite_arprice WHERE ID = %d AND is_template = %d ", $table_id, 0 ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- Reason: $tbl_arf_forms is table name defined globally. False Positive alarm
       

    if( empty( $table_id ) || empty( $tabel_key ) ){
        return esc_html__( 'Please select valid table', 'arprice-responsive-pricing-table' );
    }

    $params = '';

    if( !empty( $_REQUEST['context'] ) && 'edit' == $_REQUEST['context'] ){
        $params = ' is_gutenberg="true" ';
        global $is_gutenberg;
        $is_gutenberg = false;
        if(!empty($params) && 'true' == $params)
        {
            $is_gutenberg = true;
        }
    }
    
    if(empty( $_REQUEST['context'] ) ){
        $res = wp_cache_get( 'arprice_tabel_data' . $table_id );
        
        if ( false == $res ) {
            $arpricelite_table = $wpdb -> prefix .'arplite_arprice';
            $res = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $arpricelite_table.' WHERE ID = %d', $table_id ), 'ARRAY_A' );//phpcs:ignore
            wp_cache_set( 'arprice_tabel_data' . $table_id, $res );
        }

        $table_data = ( isset( $res[0] ) && is_array( $res ) && count( $res ) > 0 ) ? $res[0] : $res;
      
        if( empty( $table_data ) ){
            return esc_html__( 'Please select valid table', 'arprice-responsive-pricing-table' );
        }
        
        //$formoptions = maybe_unserialize( $res['options'] );
        
        if ( is_ssl() ) {
            $upload_main_url = str_replace( 'http://', 'https://', ARPLITE_PRICINGTABLE_UPLOAD_URL . '/css' );
        } else {
            $upload_main_url = ARPLITE_PRICINGTABLE_UPLOAD_URL . '/css';
        }
        $fid = "arplitetemplate_" . $table_id;
       
        global $arplite_pricingtable, $arfliteversion,$arpricelite_form,$arplite_db_version;
			
			if ( isset( $table_id ) ) {
				$fid = $upload_main_url . '/arplitetemplate_' . $table_id . '.css';
			}
			
			$arplite_data_uniq_id = rand( 1, 99999 );
			if ( empty( $arplite_data_uniq_id ) || $arplite_data_uniq_id == '' ) {
				if ( isset( $table_id ) ) {
					$arplite_data_uniq_id = $table_id;
				}
			}
            $arflite_func_val = '';
			if ( isset( $table_id ) ) {
				wp_register_style( 'arplite_front_css' . $table_id, $fid, array());
			}
            
			if ( $arflite_func_val == '' ) {
				if ( isset( $table_id ) ) {
					$arplite_pricingtable->arplite_front_assets( array( 'arplite_front_css' . $table_id, 'arflitedisplaycss', 'bootstrap' ), true );
				}
			} else {
				if ( isset( $table_id ) ) {
					$arplite_pricingtable->arplite_front_assets( array( 'arplite_front_css' . $table_id ), true );
				}
			}
    }

    //$params = apply_filters( 'arforms_modify_form_shortcode_params', $params, $attributes );

    
    $content = do_shortcode( '[ARPLite id='.$table_id.' '.$params.' ]' );
    
    
    return $content;
}


function arprice_register_gutenberg_blocks(){

    register_block_type( ARPLITE_PRICINGTABLE_DIR . '/js/build/arprice-table', $this->get_block_properties() );

    $script_handle = generate_block_asset_handle( 'arprice-responsive-pricing-table/arprice-table', 'editorScript' );

    // wp_set_script_translations( $script_handle, 'arforms-form-builder', ARFLITE_FORMPATH . '/js/build/arforms-form/languages/' );

}

function arpricelite_enqueue_gutenberg_assets() {

    global  $wpdb ,$table, $arplite_pricingtable;

    $page = isset( $_SERVER['PHP_SELF'] ) ? basename( sanitize_text_field( $_SERVER['PHP_SELF'] ) ) : '';

    if ( in_array( $page, array( 'post.php', 'page.php', 'page-new.php', 'post-new.php' ) ) || ( isset( $_GET ) && isset( $_GET['page'] ) && sanitize_text_field( $_GET['page'] ) == 'arpricelite-entry-templates' ) ) {

        
        $arprice_lite_data = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix  . 'arplite_arprice WHERE is_template=0 ORDER BY ID DESC ');//phpcs:ignore
    
        $arprice_table_lite_list = array();
        $n                       = 0;
        foreach ( $arprice_lite_data as $k => $value ) {
            $arprice_table_lite_list[ $n ]['id']    = $value->ID;
            $arprice_table_lite_list[ $n ]['label'] = $value->table_name . ' (id: ' . $value->ID . ')';
            $n++;
        }
       
        $arplite_gutenberg_show_previewdata_nonce = wp_create_nonce('arpricelite_gutenberg_show_previewdata_nonce');
       
        wp_localize_script(
            'wp-block-editor', 
            'arpricelite_gutenberg_script_objects', 
            array(
                'arpricelite_table_list' => $arprice_table_lite_list,
                'ajax_url'=>admin_url('admin-ajax.php'),
                'is_widget_page' => false,
                'arpricelite_edit_gutenberg_adminurl'=>admin_url("admin.php?page=arprice&arp_action=edit")
            )
        );

    } elseif ( in_array( $page, array( 'widgets.php', 'customize.php' ) ) ) {

      
        // wp_enqueue_style( 'arformslite_selectpicker', ARFLITEURL . '/css/arf_selectpicker.css', array(), $arfliteversion );
        wp_register_style('arplite-insert-form-css', ARPLITEURL . '/css/arprice_insert_form_style.css', array());
        wp_enqueue_style( 'arplite-insert-form-css');
        

        $arprice_lite_data = $wpdb->get_results(  'SELECT * FROM ' . $wpdb->prefix  . 'arplite_arprice WHERE is_template=0 ORDER BY ID DESC ' );//phpcs:ignore

        $arprice_table_lite_list = array();
        $n                       = 0;
        foreach ( $arprice_lite_data as $k => $value ) {
            $arprice_table_lite_list[ $n ]['id']    = $value->ID;
            $arprice_table_lite_list[ $n ]['label'] = $value->table_name . ' (id: ' . $value->ID . ')';
            $n++;
        }

        wp_localize_script(
            'wp-block-editor', 
            'arpricelite_gutenberg_script_objects', 
            array(
                'arpricelite_table_list' => $arprice_table_lite_list,
                'ajax_url'=>admin_url('admin-ajax.php'),
                'is_widget_page' => true,
                'arpricelite_edit_gutenberg_adminurl'=>admin_url("admin.php?page=arprice&arp_action=edit")
            )
        );

    }

}

}

global $arprice_block_widget;
$arprice_block_widget = new arprice_block_widget();