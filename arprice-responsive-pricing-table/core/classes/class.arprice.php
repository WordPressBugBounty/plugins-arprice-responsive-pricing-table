<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

class arpricelite {

	function __construct() {
		add_action( 'wp_ajax_arpricelite_delete', array( $this, 'arpricelite_delete' ) );
		add_action( 'wp_ajax_arplite_pro_preview', array( $this, 'arplite_pro_preview' ) );
		add_action( 'wp_ajax_arpsubscribe', array( $this, 'arpreqact' ) );
		add_action( 'admin_init', array( $this, 'upgrade_data' ) );

		add_action( 'wp_ajax_arpricelite_get_sample_template_list', array( $this, 'arpricelite_get_sample_template_list' ) );

		add_action( 'arplite_remove_backup_data', array( $this, 'arplite_remove_backup_data' ) );

		add_filter( 'plugin_action_links', array( $this, 'arplite_plugin_action_links' ), 10, 2 );

		add_action( 'admin_footer', array( $this, 'arplite_deactivate_feedback_popup' ), 1 );

		add_action( 'wp_ajax_arplite_deactivate_plugin', array( $this, 'arplite_deactivate_plugin_func' ) );

		add_action( 'arprice_quick_help_links', array( $this, 'arprice_render_quick_help_links') );

		add_action('wp_ajax_arprice_get_help_data', array( $this, 'arprice_get_help_data_func' ));

	}
	function arprice_render_quick_help_links( $page = ''){
		global $arprice_global_settings;
		echo wp_nonce_field( 'arplite_wp_nonce', 'arplite_wp_nonce', 1, false );//phpcs:ignore	

		?>
	<div class="arp_help" onclick="return Show_Icon();">
		<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="arp_main_help_icon">
			<circle cx="35" cy="35" r="35" fill="#5758DC"/>
			<path d="M21.5694 48.4329C22.0846 48.9482 22.6131 49.4234 23.1725 49.8649C23.2914 49.9587 23.4639 49.9471 23.571 49.84L29.9483 43.4628C30.0821 43.3289 30.0549 43.1128 29.8954 43.011C29.3235 42.6457 28.7836 42.2142 28.2859 41.7165C27.8041 41.2347 27.388 40.711 27.0277 40.1656C26.9243 40.0092 26.7097 39.9849 26.5771 40.1175L20.2077 46.4869C20.0992 46.5953 20.0883 46.771 20.1844 46.8905C20.6145 47.4255 21.0722 47.9358 21.5694 48.4329Z" fill="white"/>
			<path d="M44.2454 51.6012C44.4184 51.5046 44.4502 51.2635 44.3101 51.1235L37.4925 44.3059C37.4215 44.2349 37.3196 44.2075 37.222 44.2307C35.7444 44.582 34.2125 44.5819 32.7422 44.2234C32.6441 44.1995 32.5417 44.2268 32.4703 44.2982L25.6612 51.1072C25.5213 51.2471 25.5528 51.4879 25.7255 51.5847C31.461 54.7972 38.5021 54.8052 44.2454 51.6012Z" fill="white"/>
			<path d="M46.8073 49.8891C47.3753 49.4396 47.9121 48.9561 48.4356 48.4325C48.9245 47.9437 49.3741 47.4418 49.796 46.9153C49.8918 46.7957 49.8808 46.6203 49.7724 46.5119L43.4053 40.1449C43.2719 40.0115 43.0567 40.0382 42.9541 40.1965C42.6051 40.7353 42.1917 41.2434 41.7191 41.7162C41.2134 42.2218 40.6654 42.661 40.0802 43.0286C39.9192 43.1298 39.8905 43.3466 40.025 43.481L46.4086 49.8645C46.5157 49.9717 46.6884 49.9831 46.8073 49.8891Z" fill="white"/>
			<path d="M18.4499 44.3443C18.5469 44.5163 18.7872 44.5475 18.9269 44.4078L25.7274 37.6073C25.7994 37.5354 25.8265 37.4321 25.8017 37.3334C25.4272 35.8454 25.4122 34.2815 25.7706 32.7788C25.7939 32.6812 25.7665 32.5795 25.6956 32.5086L18.8777 25.6907C18.7377 25.5507 18.4966 25.5824 18.4 25.7552C15.1798 31.5164 15.2038 38.591 18.4499 44.3443Z" fill="white"/>
			<path d="M32.6259 25.8058C34.1715 25.4088 35.7996 25.4085 37.3381 25.7982C37.4366 25.8232 37.5397 25.7961 37.6116 25.7242L44.4121 18.9238C44.5518 18.7841 44.5207 18.5437 44.3486 18.4466C38.552 15.1763 31.4106 15.1845 25.6297 18.4713C25.4582 18.5688 25.4276 18.8086 25.567 18.948L32.3512 25.7321C32.4233 25.8043 32.527 25.8312 32.6259 25.8058Z" fill="white"/>
			<path d="M43.0135 29.8927C43.1154 30.0523 43.3316 30.0795 43.4653 29.9457L49.8427 23.5684C49.9497 23.4614 49.9613 23.2888 49.8676 23.17C49.0453 22.1277 48.0073 21.0775 46.8932 20.1818C46.7736 20.0857 46.5979 20.0967 46.4894 20.2051L40.12 26.5745C39.9875 26.7071 40.0118 26.9217 40.1682 27.0251C41.3158 27.7833 42.2703 28.7288 43.0135 29.8927Z" fill="white"/>
			<path d="M51.5885 25.7226C51.4918 25.5499 51.2509 25.5183 51.111 25.6583L44.302 32.4672C44.2306 32.5386 44.2035 32.6409 44.2275 32.7389C44.6011 34.2594 44.586 35.8555 44.1961 37.3761C44.1707 37.4751 44.1977 37.5789 44.2699 37.6512L51.0538 44.435C51.1933 44.5744 51.4332 44.5437 51.5306 44.3721C54.8011 38.6091 54.8255 31.5013 51.5885 25.7226Z" fill="white"/>
			<path d="M23.0869 20.207C21.9807 21.0935 20.9396 22.1513 20.1131 23.1957C20.0191 23.3145 20.0304 23.4873 20.1376 23.5945L26.5212 29.978C26.6557 30.1125 26.8725 30.0838 26.9736 29.9228C27.6884 28.7852 28.6936 27.7696 29.8057 27.0488C29.9641 26.9462 29.9908 26.7311 29.8574 26.5977L23.4903 20.2307C23.382 20.1223 23.2065 20.1112 23.0869 20.207Z" fill="white"/>
		</svg>

		<div class="arp_help_icon" style="display:none;">
			<div class="arp_help_icon_display">	
				<?php
				$request_page = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : '';
				if( 'cross_selling_page' != $page && 'status_page' != $page){
				?>	
				<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg"  class="arp-documention arp_help_icon_data"  data-param="<?php echo esc_html($request_page); ?>" id="arprice_template_shortcode" data-copy-title="<?php esc_html_e( 'Need Help ?', 'arprice-responsive-pricing-table' ); ?>">
					<path d="M24.9129 12C25.6432 12 26.3735 12 27.0964 12C27.111 12.0584 27.1621 12.0511 27.2059 12.0511C27.7171 12.0877 28.221 12.1607 28.7176 12.263C34.5523 13.4319 38.9849 18.0927 39.8539 23.9517C39.8978 24.2658 39.8832 24.5945 40 24.9014C40 25.6465 40 26.399 40 27.1441C39.9124 27.1734 39.9489 27.2537 39.9416 27.3049C39.8905 27.8235 39.8174 28.3349 39.7079 28.8463C38.43 34.866 33.4861 39.3296 27.3958 39.9286C24.1681 40.2428 21.1667 39.5195 18.421 37.7662C13.5648 34.6541 11.1112 28.7879 12.2942 23.1554C13.5064 17.3914 18.1143 13.0447 23.9563 12.1534C24.2849 12.1023 24.6135 12.1242 24.9129 12ZM24.577 27.1295C24.577 27.2683 24.5697 27.3998 24.577 27.5386C24.6135 28.1596 24.8472 28.3934 25.4679 28.4445C25.6797 28.4591 25.8842 28.4372 26.0887 28.3861C26.4757 28.2838 26.6437 28.0573 26.6583 27.6555C26.6656 27.4802 26.6583 27.3122 26.6656 27.1368C26.6875 26.5816 26.8919 26.1141 27.3009 25.7342C27.4615 25.5881 27.6295 25.442 27.7975 25.3105C28.4182 24.8064 28.9659 24.2439 29.3456 23.5353C30.1781 21.9792 29.7034 20.3063 28.1407 19.5173C26.6802 18.7867 25.1612 18.7648 23.6715 19.4661C22.9924 19.7876 22.4812 20.299 22.2621 21.0514C22.0869 21.6432 22.2986 22.1618 22.8025 22.3883C23.3429 22.6367 23.708 22.5125 24.0951 21.9573C24.7012 21.0879 25.8185 20.8103 26.7751 21.2852C27.3009 21.5482 27.5346 22.0523 27.4031 22.6294C27.3228 22.9874 27.1183 23.2796 26.8627 23.528C26.6144 23.7836 26.3296 23.9955 26.0448 24.2074C25.059 24.9306 24.5551 25.9022 24.577 27.1295ZM27.0088 31.1475C27.0161 30.3731 26.3881 29.7303 25.6213 29.7157C24.8472 29.7083 24.2119 30.3293 24.1973 31.1037C24.19 31.9 24.818 32.5502 25.5921 32.5502C26.3589 32.5575 27.0015 31.9146 27.0088 31.1475Z" fill="white"/>
				</svg>	
				
				<?php } ?>
				<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" id="arprice_template_shortcode" data-copy-title="<?php esc_html_e( 'Facebook Community', 'arprice-responsive-pricing-table' ); ?>" class="arp_help_icon_data arprice_help_link" >
					<a href="https://www.facebook.com/groups/arplugins" target="_blank">
						<path d="M34.5741 31.3248C34.3082 29.5176 33.4033 27.8656 32.0236 26.6685C30.6439 25.4713 28.8808 24.8084 27.0541 24.8H25.3517C23.5251 24.8084 21.762 25.4713 20.3823 26.6685C19.0026 27.8656 18.0977 29.5176 17.8317 31.3248L17.0157 37.0304C16.9897 37.2148 17.0069 37.4028 17.066 37.5794C17.1252 37.756 17.2246 37.9164 17.3565 38.048C17.6765 38.368 19.6397 40 26.2045 40C32.7693 40 34.7277 38.3744 35.0525 38.048C35.1844 37.9164 35.2839 37.756 35.343 37.5794C35.4022 37.4028 35.4194 37.2148 35.3933 37.0304L34.5741 31.3248ZM19.0973 25.68C17.551 27.1055 16.5448 29.0216 16.2493 31.104L15.6573 35.2C10.9053 35.168 9.46533 33.44 9.22533 33.088C9.13256 32.9601 9.06635 32.8149 9.03063 32.661C8.9949 32.5071 8.99038 32.3476 9.01733 32.192L9.36933 30.208C9.55272 29.1711 9.98344 28.1937 10.625 27.3587C11.2665 26.5237 12.0999 25.8557 13.0545 25.4114C14.0092 24.9671 15.0569 24.7595 16.1088 24.8062C17.1607 24.853 18.1859 25.1527 19.0973 25.68ZM43.3853 32.192C43.4123 32.3476 43.4078 32.5071 43.372 32.661C43.3363 32.8149 43.2701 32.9601 43.1773 33.088C42.9373 33.44 41.4973 35.168 36.7453 35.2L36.1533 31.104C35.8578 29.0216 34.8517 27.1055 33.3053 25.68C34.2168 25.1527 35.2419 24.853 36.2939 24.8062C37.3458 24.7595 38.3935 24.9671 39.3481 25.4114C40.3028 25.8557 41.1362 26.5237 41.7777 27.3587C42.4192 28.1937 42.8499 29.1711 43.0333 30.208L43.3853 32.192ZM19.3693 22.16C18.9666 22.7311 18.4319 23.1967 17.8107 23.517C17.1895 23.8374 16.5002 24.003 15.8013 24C15.1041 24 14.4169 23.8343 13.7963 23.5166C13.1757 23.1989 12.6395 22.7383 12.2319 22.1727C11.8242 21.6071 11.5568 20.9527 11.4516 20.2635C11.3465 19.5743 11.4067 18.87 11.6271 18.2086C11.8476 17.5471 12.2221 16.9476 12.7197 16.4593C13.2174 15.971 13.8239 15.608 14.4894 15.4001C15.1549 15.1922 15.8602 15.1454 16.5473 15.2637C17.2344 15.3819 17.8836 15.6616 18.4413 16.08C18.2809 16.7073 18.2003 17.3524 18.2013 18C18.2025 19.4674 18.6066 20.9063 19.3693 22.16ZM41.0013 19.6C41.0017 20.1779 40.8882 20.7502 40.6673 21.2843C40.4463 21.8183 40.1222 22.3035 39.7135 22.7122C39.3049 23.1208 38.8197 23.4449 38.2856 23.6659C37.7516 23.8869 37.1793 24.0004 36.6013 24C35.9024 24.003 35.2131 23.8374 34.5919 23.517C33.9708 23.1967 33.4361 22.7311 33.0333 22.16C33.7961 20.9063 34.2001 19.4674 34.2013 18C34.2024 17.3524 34.1218 16.7073 33.9613 16.08C34.615 15.5897 35.3924 15.2911 36.2062 15.2177C37.02 15.1443 37.8382 15.299 38.5691 15.6645C39.2999 16.0299 39.9146 16.5916 40.3442 17.2867C40.7738 17.9818 41.0013 18.7828 41.0013 19.6Z" fill="white"/>
						<path d="M26.2013 24C29.515 24 32.2013 21.3137 32.2013 18C32.2013 14.6863 29.515 12 26.2013 12C22.8876 12 20.2013 14.6863 20.2013 18C20.2013 21.3137 22.8876 24 26.2013 24Z" fill="white"/>
					</a>
				</svg>
				
				<?php if( 'arprice' == $request_page ): ?>
				<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" id="arprice_template_shortcode" data-copy-title="<?php esc_html_e( 'Tour Guide', 'arprice-responsive-pricing-table' ); ?>" class="arp_help_icon_data arprice_help_link arp_tour_guide_start">
					<path d="M30.5 14.4999C25.7 11.6999 20.1667 14.6666 18 16.4999L16 17.5L13 24V28.5L15 32L13.5 34.5L14 38.5H17L20 37.5L22.5 38.5C23.5 39.3333 26.7 40.4 31.5 38C37.5 35 37.5 30.5 38.5 27.5C39.5 24.5 37.5 21.5 37 19C36.5 16.5 36.5 17.9999 30.5 14.4999Z" fill="white"/>
					<path d="M14.5125 39.9987C14.115 39.9968 13.7236 39.9009 13.3702 39.719C13.0168 39.537 12.7114 39.2741 12.4789 38.9516C12.2465 38.6292 12.0935 38.2564 12.0325 37.8636C11.9715 37.4708 12.0043 37.0692 12.128 36.6914L13.3332 33.109C13.4749 32.7089 13.4611 32.27 13.2945 31.8796C11.9139 28.8961 11.6272 25.522 12.4846 22.3483C13.3421 19.1747 15.289 16.4041 17.9843 14.5219C20.6795 12.6396 23.9512 11.7659 27.226 12.0538C30.5008 12.3417 33.5698 13.7728 35.8953 16.0964C38.2209 18.4199 39.6545 21.4878 39.9452 24.7623C40.2358 28.0369 39.3648 31.3093 37.4849 34.0061C35.6049 36.7029 32.8359 38.6522 29.663 39.5123C26.4901 40.3724 23.1157 40.0886 20.1311 38.7105C19.7331 38.539 19.2847 38.5257 18.8773 38.6732L15.3106 39.8712C15.0531 39.9561 14.7836 39.9991 14.5125 39.9987ZM25.9761 14.2055C23.9929 14.2015 22.0406 14.6973 20.2996 15.6472C18.5586 16.5971 17.0851 17.9705 16.0152 19.6403C14.9452 21.3102 14.3134 23.2228 14.178 25.2015C14.0426 27.1801 14.408 29.1609 15.2404 30.961C15.6399 31.8478 15.688 32.8531 15.3751 33.7739L14.1671 37.3735C14.1452 37.4367 14.1422 37.505 14.1585 37.5699C14.1748 37.6348 14.2097 37.6935 14.2588 37.7389C14.3049 37.788 14.3641 37.8228 14.4295 37.8391C14.4948 37.8554 14.5634 37.8524 14.6271 37.8306L18.2095 36.6284C19.1386 36.3081 20.1551 36.3563 21.0496 36.7631C22.6549 37.4995 24.4049 37.8667 26.1708 37.8376C27.9367 37.8086 29.6736 37.384 31.2538 36.5953C32.834 35.8065 34.2173 34.6735 35.3019 33.2796C36.3866 31.8857 37.1449 30.2665 37.5213 28.5409C37.8976 26.8153 37.8823 25.0273 37.4766 23.3084C37.0708 21.5895 36.2849 19.9834 35.1766 18.6083C34.0684 17.2332 32.6659 16.124 31.0725 15.3623C29.479 14.6006 27.7351 14.2058 25.969 14.2069L25.9761 14.2055ZM27.4306 21.7299C27.4306 21.3499 27.2796 20.9854 27.0109 20.7167C26.7421 20.4479 26.3777 20.297 25.9976 20.297H25.9833C25.7005 20.2998 25.4249 20.3862 25.1911 20.5454C24.9574 20.7046 24.7759 20.9293 24.6697 21.1914C24.5634 21.4535 24.5371 21.7411 24.594 22.0182C24.6509 22.2952 24.7885 22.5492 24.9894 22.7481C25.1904 22.9471 25.4457 23.0822 25.7233 23.1363C26.0009 23.1904 26.2882 23.1612 26.5493 23.0524C26.8103 22.9435 27.0332 22.7599 27.19 22.5245C27.3469 22.2892 27.4306 22.0127 27.4306 21.7299ZM27.0437 30.3277V26.0288C27.0437 25.7438 26.9305 25.4704 26.7289 25.2689C26.5274 25.0673 26.254 24.9541 25.969 24.9541C25.6839 24.9541 25.4106 25.0673 25.209 25.2689C25.0075 25.4704 24.8942 25.7438 24.8942 26.0288V30.3277C24.8942 30.6127 25.0075 30.8861 25.209 31.0876C25.4106 31.2892 25.6839 31.4024 25.969 31.4024C26.254 31.4024 26.5274 31.2892 26.7289 31.0876C26.9305 30.8861 27.0437 30.6127 27.0437 30.3277Z" fill="white"/>
					<path d="M27.65 21.0501V21.05C27.65 20.5461 27.4498 20.0629 27.0935 19.7065C26.7372 19.3502 26.2539 19.15 25.75 19.15H25.7325V19.15L25.731 19.1501C25.356 19.1538 24.9906 19.2684 24.6806 19.4795C24.3707 19.6905 24.1301 19.9885 23.9892 20.336C23.8483 20.6835 23.8134 21.0649 23.8889 21.4322C23.9643 21.7995 24.1467 22.1363 24.4132 22.4001C24.6797 22.664 25.0182 22.843 25.3863 22.9148C25.7543 22.9866 26.1353 22.9479 26.4814 22.8035C26.8275 22.6592 27.1231 22.4157 27.3311 22.1036C27.539 21.7916 27.65 21.425 27.65 21.0501ZM27.1775 31.55V26.3C27.1775 25.9122 27.0234 25.5402 26.7491 25.2659C26.4749 24.9916 26.1029 24.8375 25.715 24.8375C25.3271 24.8375 24.9551 24.9916 24.6809 25.2659C24.4066 25.5402 24.2525 25.9122 24.2525 26.3V31.55C24.2525 31.9379 24.4066 32.3099 24.6809 32.5842C24.9551 32.8585 25.3271 33.0125 25.715 33.0125C26.1029 33.0125 26.4749 32.8585 26.7491 32.5842C27.0234 32.3099 27.1775 31.9379 27.1775 31.55Z" fill="#5758DC" stroke="white" stroke-width="0.3"/>
				</svg>
				<?php endif; ?>

				<?php $arprice_global_settings->arprice_render_pro_settings( 'support_help_icon' ); ?>

				<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" class="arp-close-svg arp_help_icon_data" id="arprice_template_shortcode" data-copy-title="<?php esc_html_e( 'Close', 'arprice-responsive-pricing-table' ); ?>"  data-param="<?php echo esc_html($request_page); ?>">
					<path d="M40.4606 24.814C40.3578 24.6599 40.4178 24.4886 40.4178 24.3173C40.4349 24.3173 40.452 24.3173 40.4606 24.3173C40.4606 24.4886 40.4606 24.6513 40.4606 24.814Z" fill="#F5B11D"/>
					<path d="M40.4606 24.3258C40.4435 24.3258 40.4264 24.3258 40.4178 24.3258C40.4178 24.2659 40.375 24.1973 40.4606 24.1631C40.4606 24.2145 40.4606 24.2659 40.4606 24.3258Z" fill="#F5B11D"/>
					<path d="M17.8776 34.9777C17.8392 34.923 17.779 34.9284 17.7242 34.9065C16.9902 34.6053 16.7602 33.6687 17.286 33.0662C17.3353 33.0114 17.3901 32.9566 17.4448 32.9018C19.7015 30.6452 21.9582 28.3885 24.2204 26.1319C24.3354 26.0169 24.33 25.9676 24.2204 25.858C21.9418 23.5904 19.6687 21.3119 17.401 19.0388C16.8752 18.513 16.8752 17.7626 17.3955 17.297C17.8337 16.9026 18.4856 16.8972 18.9347 17.2806C19.0059 17.3408 19.0716 17.412 19.1374 17.4778C21.3776 19.718 23.6179 21.9582 25.8527 24.2039C25.9842 24.3353 26.0389 24.3134 26.1594 24.1984C28.4271 21.9253 30.6947 19.6577 32.9624 17.3901C33.4554 16.8972 34.151 16.8753 34.633 17.3189C34.8192 17.4887 34.9014 17.7133 35 17.9379C35 18.1022 35 18.2665 35 18.4308C34.8247 18.9183 34.4249 19.225 34.0798 19.5701C31.9819 21.6734 29.8786 23.7767 27.7698 25.8745C27.6657 25.9785 27.6712 26.0223 27.7753 26.1264C29.9662 28.3064 32.1463 30.4973 34.3318 32.6773C34.6056 32.9511 34.8905 33.214 35 33.6084C35 33.7618 35 33.9151 35 34.063C34.9069 34.2438 34.8466 34.441 34.7042 34.5998C34.5399 34.7805 34.3318 34.8791 34.1181 34.9777C33.9209 34.9777 33.7183 34.9777 33.5211 34.9777C33.0665 34.7915 32.7707 34.4136 32.442 34.0849C30.3387 31.9816 28.2354 29.8838 26.1375 27.7751C26.028 27.6655 25.9787 27.6655 25.8691 27.7751C23.6672 29.9824 21.4598 32.1898 19.2524 34.3971C19.0114 34.6381 18.7759 34.8737 18.4472 34.9777C18.2555 34.9777 18.0638 34.9777 17.8776 34.9777Z" fill="white"/>
				</svg>
			</div>
		</div>
	</div>

	<div class="arp_sidebar_drawer_main_wrapper">
		<div class="arp_sidebar_drawer_inner_wrapper">
			<div class="arp_sidebar_drawer_content">
				<div class="arp_sidebar_drawer_close_container">
					<div class="arp_sidebar_drawer_close_btn"></div>
				</div>
				<div class="arp_sidebar_drawer_body">
					<div class="arp_sidebar_content_wrapper">
						<div class="arp_sidebar_content_header" >
							<h1 class="arp_sidebar_content_heading"></h1>
							<a href="https://www.arpriceplugin.com/documentation/" target="_blank"  class="arp_readmore_link"><span class="arp_readmore">Read More</span></a>
						</div>
						<div class="arp_sidebar_content_body"></div>
					</div>
				</div>
				<div id="arp_help_loader_div" class="arp_help_loader" style="display: none;">
					<div class="arp_help_loader_img"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	function arprice_get_help_data_func()	
	{
		global $wpdb;

		if ( isset( $_POST['_wpnonce_arplite'] ) && '' != $_POST['_wpnonce_arplite'] && ! wp_verify_nonce( sanitize_text_field( $_POST['_wpnonce_arplite'] ), 'arplite_wp_nonce' ) ) {
			echo esc_attr( 'security_error' );
			die;
		}
	
		
		if ( !empty($_POST['action']) && $_POST['action'] == 'arprice_get_help_data' && !empty($_POST['page']) ) {
			$help_page = sanitize_text_field( $_POST['page'] );
				$arprice_remote_url = 'https://www.arpriceplugin.com';
				$arp_get_data_params = array(
					'method' => 'POST',
					'body' => array(
						'action' => 'get_documentation',
						'page' => $help_page,
					),
					'timeout' => 45,
				);
				$arp_doc_res = wp_remote_post( $arprice_remote_url, $arp_get_data_params );

								
				if(!is_wp_error($arp_doc_res)){
					$arp_doc_content = ! empty( $arp_doc_res['body'] ) ? $arp_doc_res['body'] : esc_html__('No data found', 'arprice-responsive-pricing-table');

				} else{
					$arp_doc_content = $arp_doc_res->get_error_message();
				}

			echo $arp_doc_content;//phpcs:ignore
			exit; 
		}
	}
	function arplite_plugin_action_links( $links, $file ) {

		if ( $file == 'arprice-responsive-pricing-table/arprice-responsive-pricing-table.php' ) {

			if ( isset( $links['deactivate'] ) ) {

				$deactivation_link = $links['deactivate'];

				$deactivation_link   = str_replace(
					'<a ',
					'<div class="arplite-deactivate-form-wrapper">
                         <span class="arplite-deactivate-form" id="arplite-deactivate-form-' . esc_attr( 'arprice-responsive-pricing-table' ) . '"></span>
                     </div><a id="arplite-deactivate-link-' . esc_attr( 'arprice-responsive-pricing-table' ) . '" ',
					$deactivation_link
				);
				$links['deactivate'] = $deactivation_link;
			}
		}
		return $links;
	}
	function arplite_deactivate_feedback_popup() {
		global $pagenow;

		if ( $pagenow == 'plugins.php' ) {

			$question_options = array();

			$question_options['list_data_options'] = array(
				'setup-difficult'  => esc_html__( 'Set up is too difficult', 'arprice-responsive-pricing-table' ),
				'docs-improvement' => esc_html__( 'Lack of documentation', 'arprice-responsive-pricing-table' ),
				'features'         => esc_html__( 'Not the features I wanted', 'arprice-responsive-pricing-table' ),
				'better-plugin'    => esc_html__( 'Found a better plugin', 'arprice-responsive-pricing-table' ),
				'incompatibility'  => esc_html__( 'Incompatible with theme or plugin', 'arprice-responsive-pricing-table' ),
				'bought-premium'   => esc_html__( 'I bought premium version of ARPrice', 'arprice-responsive-pricing-table' ),
				'maintenance'      => esc_html__( 'Other', 'arprice-responsive-pricing-table' ),
			);

			$html = '<div class="arplite-deactivate-form-head"><strong>' . esc_html__( 'ARPrice Lite - Sorry to see you go', 'arprice-responsive-pricing-table' ) . '</strong></div>';

			$html .= '<div class="arplite-deactivate-form-body">';

			if ( is_array( $question_options['list_data_options'] ) ) {

				$html .= '<div class="arplite-deactivate-options">';

					$html .= '<p><strong>' . esc_html__( 'Before you deactivate the ARPrice Lite plugin, would you quickly give us your reason for doing so?', 'arprice-responsive-pricing-table' ) . '</strong></p><p>';

				foreach ( $question_options['list_data_options'] as $key => $option ) {
					$html .= '<input type="radio" name="arplite-deactivate-reason" id="' . esc_attr( $key ) . '" value="' . esc_attr( $key ) . '"> <label for="' . esc_attr( $key ) . '">' . esc_attr( $option ) . '</label><br>';
				}

					$html .= '</p><label id="arplite-deactivate-details-label" for="arplite-deactivate-reasons"><strong>' . esc_html__( 'How could we improve ?', 'arprice-responsive-pricing-table' ) . '</strong></label><textarea name="arplite-deactivate-details" id="arplite-deactivate-details" rows="2"></textarea>';

					$html .= '</div>';
			}

			$html .= '<hr/>';

			$html .= '</div>';

			$html .= '<p class="deactivating-spinner"><span class="spinner"></span> ' . esc_html__( 'Submitting form', 'arprice-responsive-pricing-table' ) . '</p>';

			$html .= '<div class="arplite-deactivate-form-footer"><p>';

				$html .= '<label for="arplite_anonymous" title="'
					. esc_html__( 'If you UNCHECK this then your email address will be sent along with your feedback. This can be used by arplite to get back to you for more info or a solution.', 'arprice-responsive-pricing-table' )
					. '"><input type="checkbox" name="arplite-deactivate-tracking" checked="checked" id="arplite_anonymous"> ' . esc_html__( 'Send anonymous', 'arprice-responsive-pricing-table' ) . '</label><br>';

				$html .= '<a id="arplite-deactivate-submit-form" class="button button-primary" href="#">'. sprintf( esc_html__( '%1$s Submit and%2$s Deactivate', 'arprice-responsive-pricing-table' ), '<span>', '</span>' ). '</a>';//phpcs:ignore

			$html .= '</p></div>';
			?>
			<?php /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped --Reason: $html is properly escaped or hardcoded */ ?>
			<div class="arplite-deactivate-form-skeleton" id="arplite-deactivate-form-skeleton"><?php echo $html; ?></div>
			<div class="arplite-deactivate-form-bg"></div>
			<?php
		}
	}

	function arplite_deactivate_plugin_func() {

		check_ajax_referer( 'arplite_deactivate_plugin', 'security' );

		if ( ! empty( $_POST['arplite_reason'] ) && isset( $_POST['arplite_details'] ) ) {

			$arplite_anonymous        = isset( $_POST['arplite_anonymous'] ) && $_POST['arplite_anonymous']; //phpcs:ignore
			$arprice_post_data        = $_POST;
			$args                     = array_map( 'sanitize_text_field', $arprice_post_data );
			$args['arplite_site_url'] = esc_url( ARPLITE_HOME_URL );

			if ( ! $arplite_anonymous ) {
				$args['arp_lite_site_email'] = get_option( 'admin_email' );
			}

			$url = 'https://www.arpriceplugin.com/download_samples/arplite_feedback.php';

			$response = wp_remote_post(
				$url,
				array(
					'body'    => $args,
					'timeout' => 500,
				)
			);
		}
		echo wp_json_encode(
			array(
				'status' => 'OK',
			)
		);
		die();
	}

	function arplite_remove_backup_data() {
		global $wpdb;

		$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS `' . $wpdb->prefix . 'arplite_arprice_backup_v2.6`' ) );
		$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS `' . $wpdb->prefix . 'arplite_arprice_options_backup_v2.6`' ) );

		$wp_upload_dir = wp_upload_dir();
		$backup_dir    = $wp_upload_dir['basedir'] . '/arprice-responsive-pricing-table_backup_v6';
		if ( is_dir( $backup_dir ) ) {
			arp_rmdir( $backup_dir );
		}
	}

	function arpricelite_get_sample_template_list() {
		$return = array();

		$arp_sample_page = isset( $_REQUEST['sample_page'] ) ? sanitize_text_field( $_REQUEST['sample_page'] ) : 1;

		$return['current_page'] = $arp_sample_page;
		$return['is_last_page'] = 0;
		$return['arp_content']  = '';

		$arp_posturl = 'https://www.arpriceplugin.com/download_samples/arp_samples_list.php';

		$arp_response = wp_remote_post(
			$arp_posturl,
			array(
				'method'      => 'POST',
				'timeout'     => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking'    => true,
				'headers'     => array(),
				'body'        => array( 'arp_req_page' => $arp_sample_page ),
				'cookies'     => array(),
			)
		);

		if ( is_wp_error( $arp_response ) || $arp_response['response']['code'] != 200 ) {
			$return['error'] = true;
		} else {
			$return['error'] = false;
			$arp_samples     = maybe_unserialize( base64_decode( $arp_response['body'] ) );

			$arp_content = '';

			if ( isset( $arp_samples['is_last_page'] ) ) {
				$return['is_last_page'] = 1;
				unset( $arp_samples['is_last_page'] );
			}

			foreach ( $arp_samples as $arp_slug => $arp_sample ) {
				$arpsample_image    = isset( $arp_sample['image'] ) ? $arp_sample['image'] : '';
				$arpsample_redirect = ( isset( $arp_sample['redirect_url'] ) && $arp_sample['redirect_url'] != '' ) ? $arp_sample['redirect_url'] : '#';
				$arpsample_id       = ( isset( $arp_sample['template_id'] ) && $arp_sample['template_id'] != '' ) ? $arp_sample['template_id'] : '';

				$arp_content .= '<div class="arprice_select_template_container_item arprice_download_sample_container_item">';
				$arp_content .= '<div class="arprice_select_template_inner_container arprice_download_sample_inner_container">';
				$arp_content .= '<div class="arprice_select_template_bg_img arprice_download_sample_bg_img" style="background:url(' . $arpsample_image . ') no-repeat top left;"></div>';
				$arp_content .= '<div class="arprice_select_template_action_div arprice_download_sample_action_div">';
				$arp_content .= '<div class="arprice_select_template_action_btn arprice_download_sample_action_btn arprice_download_sample" id="arprice_download_sample" title="' . esc_html__( 'Install', 'arprice-responsive-pricing-table' ) . '" onClick="arp_download_sample(\'' . $arpsample_id . '\');"></div>';
				$arp_content .= '<div class="arprice_select_template_action_btn arprice_download_sample_action_btn arprice_redirect_sample" id="arprice_redirect_sample" title="' . esc_html__( 'Preview', 'arprice-responsive-pricing-table' ) . '" onClick="arp_redirect_to_sample(\'' . $arpsample_redirect . '\');"></div>';
				$arp_content .= '</div>';
				$arp_content .= '</div>';
				$arp_content .= '</div>';
			}

			$return['arp_content'] = $arp_content;
		}

		echo wp_json_encode( $return );
		die;
	}

	function upgrade_data() {
		global $wpdb, $arpricelite_version;
		$checkupdate = '';
		$checkupdate = get_option( 'arpricelite_version' );

		if ( version_compare( $checkupdate, '1.1', '<' ) ) {
			update_option( 'arpricelite_version', sanitize_text_field( $arpricelite_version ) );
			update_option( 'arplite_popup_display', sanitize_text_field( 'yes' ) );
			update_option( 'arplite_already_subscribe', sanitize_text_field( 'no' ) );
		}

		if ( version_compare( $checkupdate, '3.6.5', '<' ) ) {
			$path = ARPLITE_PRICINGTABLE_VIEWS_DIR . '/upgrade_latest_data.php';
			include $path;
		}
	}

	function arpreqact() {
		global $arpricelite_class;
		$plugres = $arpricelite_class->arpsubscribeuser();

		if ( isset( $plugres ) && $plugres != '' ) {
			$responsetext = $plugres;

			if ( $responsetext == 'Subscribed Successfully.' ) {
				update_option( 'arplite_popup_display', sanitize_text_field( 'no' ) );
				update_option( 'arplite_already_subscribe', sanitize_text_field( 'yes' ) );
				echo 'VERIFIED';
				exit;
			} else {
				echo esc_html($plugres);
				exit;
			}
		} else {
			echo 'Invalid Request';
			exit;
		}
	}

	function arpsubscribeuser() {
		global $arpricelite_class;
		$lidata = array();

		if ( empty( $_POST['cust_email'] ) || sanitize_email( $_POST['cust_email'] ) == '' ) { //phpcs:ignore
			echo 'Invalid Email';
			exit;
		}

		$lidata[] = sanitize_email( $_POST['cust_email'] ); //phpcs:ignore

		$pluginuniquecode = $arpricelite_class->generateplugincode();
		$lidata[]         = $pluginuniquecode;
		$lidata[]         = ARPLITEURL;
		$lidata[]         = get_option( 'arpricelite_version' );

		$valstring  = implode( '||', $lidata );
		$encodedval = base64_encode( $valstring );

		$urltopost = 'https://www.arpriceplugin.com/premium/arprice_subscribe.php';

		$response = wp_remote_post(
			$urltopost,
			array(
				'method'      => 'POST',
				'timeout'     => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking'    => true,
				'headers'     => array(),
				'body'        => array( 'verifysubscribe' => $encodedval ),
				'cookies'     => array(),
			)
		);

		if ( array_key_exists( 'body', $response ) && isset( $response['body'] ) && $response['body'] != '' ) {
			$responsemsg = $response['body'];
		} else {
			$responsemsg = '';
		}

		if ( $responsemsg != '' && $responsemsg == 'Subscribed Successfully.' ) {
			update_option( 'arplite_popup_display', sanitize_text_field( 'no' ) );
			update_option( 'arplite_already_subscribe', sanitize_text_field( 'yes' ) );
			return 'Subscribed Successfully.';
			exit;
		} else {
			return 'Invalid Request';
			exit;
		}
	}

	function arpricelite_delete() {

		global $wpdb,$arplite_pricingtable;

		$id              = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : '';
		$table           = $wpdb->prefix . 'arplite_arprice';
		$tbl_option      = $wpdb->prefix . 'arplite_arprice_options';
		$table_analytics = $wpdb->prefix . 'arplite_arprice_analytics';

		$check_caps = $arplite_pricingtable->arplite_check_user_cap( 'arplite_add_udpate_pricingtables', true );

		if ( $check_caps != 'success' ) {

			$check_caps_msg = json_decode( $check_caps, true );
			$response_data['status'] = 'error';
            $response_data['message'] = esc_html__( 'Sorry, you do not have permission to perform this action','arprice-responsive-pricing-table' );
            echo wp_json_encode($response_data);
            die;
		}

		if ( empty( $_POST['_wpnonce_arplite'] ) || ( isset( $_POST['_wpnonce_arplite'] ) && '' != $_POST['_wpnonce_arplite'] && ! wp_verify_nonce( sanitize_text_field( $_POST['_wpnonce_arplite'] ), 'arplite_wp_nonce' ) ) ) {

			$response_data['status'] = 'error';
            $response_data['message'] = esc_html__( 'Sorry, your request cannot be processed due to security reason.','arprice-responsive-pricing-table' );
            echo wp_json_encode($response_data);
            die;
		}

		$sql         = $wpdb->get_row( $wpdb->prepare( 'SELECT is_template FROM ' . $table . ' WHERE ID = %d', $id ) ); //phpcs:ignore
		$is_template = $sql->is_template;

		if ( $is_template != 1 ) {
			if ( file_exists( ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/arplitetemplate_' . $id . '.css' ) ) {
				unlink( ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/arplitetemplate_' . $id . '.css' );
			}
			if ( file_exists( ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $id . '.png' ) ) {
				unlink( ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $id . '.png' );
				unlink( ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $id . '_big.png' );
				unlink( ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $id . '_large.png' );
			}
		}

		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $table . ' WHERE ID = %d', $id ) ); //phpcs:ignore

		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $tbl_option . ' WHERE table_id = %d', $id ) ); //phpcs:ignore

		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $table_analytics . ' WHERE pricing_table_id = %d', $id ) ); //phpcs:ignore

		$response['variant'] = 'success';
        $response['title']   = esc_html__( 'Success', 'arprice-responsive-pricing-table' );
        $response['msg']     = esc_html__( 'Pricing table deleted successfully.', 'arprice-responsive-pricing-table' );
        echo wp_json_encode( $response );
        die();

	}

	function generateplugincode() {
		$siteinfo = array();

		$siteinfo[] = get_bloginfo( 'name' );
		$siteinfo[] = get_bloginfo( 'description' );
		$siteinfo[] = home_url();
		$siteinfo[] = get_bloginfo( 'admin_email' );
		$siteinfo[] = isset( $_SERVER['SERVER_ADDR'] ) ? sanitize_text_field( $_SERVER['SERVER_ADDR'] ) : ''; 

		$newstr  = implode( '^', $siteinfo );
		$postval = base64_encode( $newstr );

		return $postval;
	}

	function arplite_pro_preview() {
		global $arpricelite_img_css_version;

		$template_id = isset( $_REQUEST['template_id'] ) ? sanitize_text_field( $_REQUEST['template_id'] ) : '';

		echo "<image src='" . esc_url( ARPLITE_PRICINGTABLE_IMAGES_URL ) . '/' . esc_html($template_id) . '_v' . esc_html( $arpricelite_img_css_version ) . "_preview.png' style='width:1000px;position:relative;left:45px;' />";
		die();
	}

}
