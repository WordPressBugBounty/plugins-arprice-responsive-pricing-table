<?php
class arplite_fusion_builder{
    function __construct(){
        add_action( 'fusion_builder_shortcodes_init', array( $this, 'arpricelite_load_fusion_elements') );
    }

    function arpricelite_load_fusion_elements()
    {
        require_once ARPLITE_PRICINGTABLE_DIR.'/integrations/fusion/fusion_builder.php';
    }
}
global $arplite_fusion_builder;
$arplite_fusion_builder = new arplite_fusion_builder();
?>