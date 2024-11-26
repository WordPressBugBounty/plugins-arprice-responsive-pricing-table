<?php

class ArpriceBEAVERAddModule extends FLBuilderModule
{

    public function __construct()
    {
        parent::__construct(
            array(
            'name'          => esc_html__('ARPrice Lite', 'arprice-responsive-pricing-table'),
            'description'   => esc_html__('Add pricing table.', 'arprice-responsive-pricing-table'),
            'category'        => esc_html__('ARPrice Modules', 'arprice-responsive-pricing-table'),
            'dir'           => ARPLITE_PRICINGTABLE_CLASSES_DIR . '/beaver-modules/arprice_beaver_element/',
            'url'           => ARPLITEURL . '/beaver-modules/arprice_beaver_element/',
            'editor_export' => true,
            'enabled'       => true,
            )
        );
    }
}

Global $wpdb;
    $table_name = $wpdb->prefix. 'arplite_arprice';
    $results =$wpdb->get_results($wpdb->prepare("SELECT ID, table_name FROM `{$table_name}` WHERE is_template= %d", 0));//phpcs:ignore
    $tables=array();
    $params = '';
    $params = ' is_beaverbuilder="true" ';
    $tables['Please Select Pricing Table'] = esc_html__('Please Select Pricing Table.', 'arprice-responsive-pricing-table');
if(!empty($results)) {
    foreach ($results as $key => $table) {
        $tables['[ARPLite id='.$table->ID.' '.$params.']'] = $table->table_name .' [ '.$table->ID.' ]';
    }
}

FLBuilder::register_module(
    'ArpriceBEAVERAddModule', array(
    'general'       => array( 
        'title'         => esc_html__('General', 'arprice-responsive-pricing-table'),
        'sections'      => array(
            'general'       => array(
                'title'         => esc_html__('ARPrice lite', 'arprice-responsive-pricing-table'), 
                'fields'        => array( 
                    'select_field'   => array(
                        'type'          => 'select',
                        'label'         => esc_html__('Select pricing table', 'arprice-responsive-pricing-table'),
                        'default'       => 'Please Select Pricing Table',
                        'options'       => $tables
                    ),
              
                )
            )
        )
    )
    )
);
?>
