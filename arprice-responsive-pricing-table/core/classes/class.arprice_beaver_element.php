<?php 
class ARP_BEAVER_MODULES_LOADER {
	
	static public function init() {
		add_action( 'plugins_loaded', __CLASS__ . '::setup_hooks' );
	}
	

	static public function setup_hooks() {

			if ( ! class_exists( 'FLBuilder' ) ) {
				return;	
			}
			
			add_action( 'init', __CLASS__ . '::load_modules' );
		
	}
	
	static public function load_modules() {
		require_once(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/beaver-modules/arprice_beaver_element.php');
	}

}
ARP_BEAVER_MODULES_LOADER::init();
 ?>