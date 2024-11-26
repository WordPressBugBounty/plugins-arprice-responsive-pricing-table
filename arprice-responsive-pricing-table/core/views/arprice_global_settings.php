<?php
if ( ! defined( 'ABSPATH' ) || ! function_exists( 'current_user_can' ) || ! current_user_can( 'arplite_global_settings_pricingtables' ) || ! isset( $_GET['arprice_settings_nonce'] ) || ( isset( $_GET['arprice_settings_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( $_GET['arprice_settings_nonce'] ), 'arprice_settings_nonce' ) ) ) {
	exit;
}

global $arpricelite_default_settings,$arpricelite_version, $arpricemain,$arprice_global_settings,$arpricesettings; 

	$arprice_all_settings = $arpricemain->arprice_global_option_data();

	$arpricesettings = json_decode( wp_json_encode( $arprice_all_settings['general_settings'] ) );
?>

<input type="hidden" name="arp_version" id="arp_version" value="<?php echo esc_html( $arpricelite_version ); ?>" />

<div class="arp_global_setting_main">
	<div class="arp_global_setting_main_title">
		<?php esc_html_e( 'Pricing Table Settings', 'arprice-responsive-pricing-table' ); ?>
	</div>
	<div class="clear" style="clear:both;"></div>
	<div class="success_message global_settings" id="global_settings_success_message">
		<div class="message_descripiton">
			<?php esc_html_e( 'Changes Saved Successfully.', 'arprice-responsive-pricing-table' ); ?>
		</div>
	</div>
	<div class="dashboard_error_message" id="dashboard_error_message">
		<div class="message_descripiton"></div>
	</div>
	<div class="arp_global_setting_main_inner">
		<div class="arprice_global_settings">
			<div class="arp_global_setting_sub_title">
				<?php esc_html_e( 'Global Settings', 'arprice-responsive-pricing-table' ); ?>
			</div>
			<div class="arprice_analytics_browser" style="float:left;">
				<form id="arp_settings_form" name="arp_settings_form" method="post" enctype="multipart/form-data" class="arp_setting_form" onsubmit="return arp_global_form_validate();">
					<?php $arplite_nonce = wp_create_nonce( 'arplite_wp_nonce' ); ?>
					<input type="hidden" id="arprice_setting_nonce" name="_wpnonce_arplite" value="<?php echo esc_html( $arplite_nonce ); ?>">
					<input type="hidden" name="arp_version" id="arp_version" value="<?php echo esc_html( $arpricelite_version ); ?>" />
					<input type="hidden" name="arp_request_version" id="arp_request_version" value="<?php echo esc_html( get_bloginfo( 'version' ) ); ?>" />

					<table width="100%" cellpadding="0" cellspacing="0" border="0" style="float:left;">
						<?php if( !$arpricemain->arprice_is_pro_active() ){ ?> 
							<tr class="arfmainformfield" valign="top">
								<td class="lbltitle" colspan="3" >
									<div class="arp_global_setting_frm_main_title"> <?php esc_html_e( 'Product License', 'arprice-responsive-pricing-table' ); ?>&nbsp;</div>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="padding-left:10px;">
									<div class="license-details-block trial-details-block"> 
										<h1 style="text-align:center;margin-bottom:20px;font-size:20px;">You Are Using Free Version Of ARPrice</h1>
										<div class="license-details" style="text-align:center;"> 
											<a href="#" class="purchase-premium_link"> <span class="btn-gold btn-inner-wrap">Upgrade to Premium for $27</span></a>
										</div>
									</div>
								</td>
							</tr>
							<tr class="arfmainformfield" valign="top">
								<td class="lbltitle" colspan="3" style="width:100%;"><div class="arp_dotted_line"></div></td>
							</tr>
						<?php } ?>
						<?php
						 if($arpricemain->arprice_is_pro_active()){
							$arprice_global_settings->arprice_render_pro_settings('arprice_licence_purchase_info');
						 }
						 ?>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3">
								<div class="arp_global_setting_frm_main_title"> <?php esc_html_e( 'Global Custom CSS', 'arprice-responsive-pricing-table' ); ?></div>
							</td>
						</tr>
						<tr>
							<td class="lbltitle" colspan="3">
								<div class="arp_global_setting_frm_title"> <?php esc_html_e( 'Custom CSS', 'arprice-responsive-pricing-table' ); ?></div>
							</td>
						</tr>
						<?php if( !$arpricemain->arprice_is_pro_active() ){ ?>
						<tr>
							<td colspan="3">
								<textarea class='arp_custom_css arp_global_setting_custom_css_textarea' name='arp_custom_css' id='arp_custom_css' readonly='readonly' ></textarea>
								
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<span class="arp_global_setting_custom_css_eg">(e.g.)&nbsp;&nbsp; .btn{color:#000000;}</span> 
								<span class="align_right" style="padding-right:70px;color:#6bbc5b;font-size:16px;font-weight:bold;font-family:Ubuntu;"><?php esc_html_e( 'Please Upgrade to premium version to use this feature.', 'arprice-responsive-pricing-table' ); ?></span>
							</td>
						</tr>
						<?php } else {
							$arprice_global_settings->arprice_render_pro_settings('arprice_custom_css');
						} ?>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3"  style="width:100%;"><div class="arp_dotted_line"></div></td>
						</tr>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3">
								<div class="arp_global_setting_frm_main_title"> <?php esc_html_e( 'Resonsive Settings', 'arprice-responsive-pricing-table' ); ?></div>
							</td>
						</tr>
						<tr class="arpmainformfield arp_global_setting_resonsive_main" valign="top">
							<td class="tdclass arp_global_setting_resonsive_title_section">
								<label class="lblsubtitle arp_global_setting_resonsive_main_title"> <?php esc_html_e( 'Mobile View', 'arprice-responsive-pricing-table' ); ?><span class="arp_global_setting_resonsive_sub_title"> <?php esc_html_e( '(Max-Width)', 'arprice-responsive-pricing-table' ); ?> </span></label>
							</td>
							<td class="tdclass arp_global_setting_resonsive_title_section">
								<label class="lblsubtitle arp_global_setting_resonsive_main_title"><?php esc_html_e( 'Tablet View', 'arprice-responsive-pricing-table' ); ?><span class="arp_global_setting_resonsive_sub_title"><?php esc_html_e( '(Max-Width)', 'arprice-responsive-pricing-table' ); ?></span></label>
							</td>
							<td class="tdclass arp_global_setting_resonsive_title_section">
								<label class="lblsubtitle arp_global_setting_resonsive_main_title"> <?php esc_html_e( 'Desktop View', 'arprice-responsive-pricing-table' ); ?> <span class="arp_global_setting_resonsive_sub_title"><?php esc_html_e( '(Optional)', 'arprice-responsive-pricing-table' ); ?></span></label>
							</td>
						</tr>
						<tr class="arpmainformfield arp_global_setting_resonsive_main" valign="top">
							<td class="arp_global_setting_resonsive_title_section">
								<input type="text" onkeypress="return arp_check_numeric_input(event,this)" name="arp_mobile_responsive_size" id="arp_mobile_responsive_size" class="txtstandardnew" size="42" value="<?php echo !empty( $arpricesettings->arp_mobile_responsive_size ) ? esc_html($arpricesettings->arp_mobile_responsive_size) : 0 ; ?>" autocomplete="off" />
								&nbsp;&nbsp;
								<label class="responsive_screen_width_unit"><?php esc_html_e( 'px', 'arprice-responsive-pricing-table' ); ?></label>
							</td>
							<td class="arp_global_setting_resonsive_title_section">
								<input type="text" onkeypress="return arp_check_numeric_input(event,this)" name="arp_tablet_responsive_size" id="arp_tablet_responsive_size" class="txtstandardnew" size="42" value="<?php echo !empty( $arpricesettings->arp_tablet_responsive_size ) ? esc_html($arpricesettings->arp_tablet_responsive_size) : 0 ;; ?>" autocomplete="off" />
								&nbsp;&nbsp;
								<label class="responsive_screen_width_unit"><?php esc_html_e( 'px', 'arprice-responsive-pricing-table' ); ?></label>
							</td>
							<td class="arp_global_setting_resonsive_title_section">
								<input type="text" onkeypress="return arp_check_numeric_input(event,this)" name="arp_desktop_responsive_size" id="arp_desktop_responsive_size" class="txtstandardnew" size="42" value="<?php echo !empty( $arpricesettings->arp_desktop_responsive_size ) ? esc_html($arpricesettings->arp_desktop_responsive_size) : 0 ;; ?>" autocomplete="off" />
								&nbsp;&nbsp;
								<label class="responsive_screen_width_unit"><?php esc_html_e( 'px', 'arprice-responsive-pricing-table' ); ?>
								</label>
							</td>
						</tr>
						<tr class="arpmainformfield" valign="top">
							<td></td>
							<td></td>
							<td class="arp_global_setting_resonsive_title_section"><span class="arp_global_setting_resonsive_sub_untitle">(Zero (0) means Unlimited)</span></td>
						</tr>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3" style="width:100%;"><div class="arp_dotted_line"></div></td>
						</tr>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3">
								<div class="arp_global_setting_frm_main_title"><?php esc_html_e( 'Choose the character sets you want to add with google fonts', 'arprice-responsive-pricing-table' ); ?></div>
							</td>
						</tr>
						<tr class="arpmainformfield" valign="top">
							<td colspan="3" class="arp_fix_padding"><div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
									<?php
									/* $arp_default_character_arr = get_option( 'arplite_css_character_set' ); */
									$arp_default_character_arr = json_decode($arpricesettings->arp_css_character_set, true);
									$arp_google_character_arr  = array(
										'latin'        => 'Latin',
										'latin-ext'    => 'Latin-ext',
										'menu'         => 'Menu',
										'greek'        => 'Greek',
										'greek-ext'    => 'Greek-ext',
										'cyrillic'     => 'Cyrillic',
										'cyrillic-ext' => 'Cyrillic-ext',
										'vietnamese'   => 'Vietnamese',
										'arabic'       => 'Arabic',
										'khmer'        => 'Khmer',
										'lao'          => 'Lao',
										'tamil'        => 'Tamil',
										'bengali'      => 'Bengali',
										'hindi'        => 'Hindi',
										'korean'       => 'Korean',
									);
									?>
									<div style="width:100%; float:left;"> <span style="width:100%; float:left;">
										<?php $arp_chk_counter = 1; ?>
											<?php
											foreach ( $arp_google_character_arr as $arp_google_character_key => $arp_google_character_value ) {
												$arplite_db_charset = isset( $arp_default_character_arr[ $arp_google_character_key ] ) ? $arp_default_character_arr[ $arp_google_character_key ] : '';
												?>
												<p style="width: 117px; float: left;">

													<input type="checkbox" class="arp_checkbox light_bg arp_reset_templates" id="arp_character_<?php echo esc_attr( $arp_google_character_key ); ?>" name="arp_css_character_set[<?php echo esc_attr( $arp_google_character_key ); ?>]" <?php checked( $arplite_db_charset, $arp_google_character_key ); ?> value="<?php echo esc_attr( $arp_google_character_key ); ?>" />

													<label data-for="arp_character_<?php echo esc_attr( $arp_google_character_key ); ?>"><?php echo esc_attr( $arp_google_character_value ); ?></label>
												</p>
												<?php echo ( $arp_chk_counter % 8 == 0 ) ? '</span><span style="width:100%; float:left;">' : ''; ?>
												<?php $arp_chk_counter++; ?>
												<?php
											}
											?>
										</span> </div>
								</div></td>
						</tr>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3" style="width:100%;">
								<div class="arp_dotted_line"></div>
							</td>
						</tr>
						<?php if(! $arpricemain->arprice_is_pro_active() ) { ?>
							<tr class="arfmainformfield" valign="top">
								<td class="lbltitle" colspan="3">
									<div class="arp_global_setting_frm_main_title"><?php esc_html_e( 'Google Map Setting', 'arprice-responsive-pricing-table' ); ?></div>
									<div class="arp_global_setting_frm_main_title align_left" style="padding-top:0;padding-bottom:0;color:#6bbc5b;font-size:16px;font-weight:bold;top:-20px;width:auto;position:relative;"><?php esc_html_e( 'Please Upgrade to premium version to use this feature.', 'arprice-responsive-pricing-table' ); ?></div>
								</td>
							</tr>
							<tr class="arpmainformfield arp_global_setting_google_map_main" valign="top">
								<td class="tdclass arp_global_setting_resonsive_title_section" colspan="2"><label class="lblsubtitle arp_global_setting_resonsive_main_title"><?php esc_html_e( 'Enter Google Map API key', 'arprice-responsive-pricing-table' ); ?></label></td>
							</tr>
							<tr class="arpmainformfield arp_global_setting_google_map_main" valign="top">
								<td class="arp_global_setting_resonsive_title_section arplite_restricted_view" colspan="2">
									<input type="text" name="google_map_api_key" class="txtstandardnew arp_google_map_api" style="width:400px !important;" id="google_map_api_key" readonly="readonly">
								</td>
							</tr>
						<?php } else {
								$arprice_global_settings->arprice_render_pro_settings('arprice_google_api_key');
							}?>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3" style="width:100%;">
								<div class="arp_dotted_line"></div>
							</td>
						</tr>
						<?php if( !$arpricemain->arprice_is_pro_active() ){ ?>

							<tr class="arfmainformfield" valign="top">
								<td class="lbltitle" colspan="3">
									<div class="arp_global_setting_frm_main_title"><?php esc_html_e( 'A/B Testing', 'arprice-responsive-pricing-table' ); ?></div>
									<div class="arp_global_setting_frm_main_title align_left" style="padding-top:0;padding-bottom:0;color:#6bbc5b;font-size:16px;font-weight:bold;top:-20px;width:auto;position:relative;"><?php esc_html_e( 'Please Upgrade to premium version to use this feature.', 'arprice-responsive-pricing-table' ); ?></div>
								</td>
							</tr>
							<tr class="arpmainformfield arp_global_setting_google_map_main" valign="top">
								
								<td class="tdclass arp_global_setting_resonsive_title_section" colspan="1">
									<div class="arp_reset_template_wrapper arp_global_setting_google_fonts <?php echo ( !$arpricemain->arprice_is_pro_active() ) ? 'arplite_restricted_view' : '' ?>">
										<span>
											<p>
												<span class='arp_switch_wrapper arp_switch_on'>
													<input type="checkbox" id="arp_enable_ab_testing" name="arp_enable_ab_testing" value="" style="margin-top:0px;"/>
													<span></span>
												</span>
												<label data-for="arp_track_analytics"><?php esc_html_e( 'Enable A/B Testing', 'arprice-responsive-pricing-table' ); ?></label>                                            
											</p>
										</span>
									</div>
								</td>
							</tr>
						<?php } else {
							$arprice_global_settings->arprice_render_pro_settings( 'arp_enable_ab_testing' );
						} ?>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3" style="width:100%;">
								<div class="arp_dotted_line"></div>
							</td>
						</tr>


						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3">
								<div class="arp_global_setting_frm_main_title"><?php esc_html_e( 'Enable or Disable font icons', 'arprice-responsive-pricing-table' ); ?></div>
							</td>
						</tr>
						
						<tr class="arpmainformfield" valign="top">
							<td class="arp_fix_padding" colspan="3">
								<div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
									<span>
										<table cellspacing="5" width="75%" style="border-spacing: unset;">
										<?php if( !$arpricemain->arprice_is_pro_active() ){ ?>
										<tr>
											<td class="arp_global_setting_font_lable" style="width: 25%;">
												<label for="arp_enable_fontawesome_icon"><?php esc_html_e( 'Font-awesome', 'arprice-responsive-pricing-table' ); ?></label>
											</td>
											<td class="arp_global_setting_font_lable">
												<label for="arp_enable_material_design_icon"><?php esc_html_e( 'Material design', 'arprice-responsive-pricing-table' ); ?></label>
												<label class="arp_pro_version_label">(Pro version)</label>
											</td>
											<td class="arp_global_setting_font_lable">
												<label for="arp_enable_ionicons"><?php esc_html_e( 'Ionicons', 'arprice-responsive-pricing-table' ); ?></label>
												<label class="arp_pro_version_label">(Pro version)</label>
											</td>
											<td class="arp_global_setting_font_lable">
												<label for="arp_enable_typicons"><?php esc_html_e( 'Typicons', 'arprice-responsive-pricing-table' ); ?></label>
												<label class="arp_pro_version_label">(Pro version)</label>
											</td>

										</tr>
										<tr>
											<?php $arprice_enable_forntawesome_icon = !empty( $arpricesettings->enable_fontawesome_icon ) ? $arpricesettings->enable_fontawesome_icon : ''; ?>
											<td class="arp_global_setting_font_switch">
												<span class="arp_switch_wrapper" id="">
													<input type="checkbox" id="enable_fontawesome_icon" value="enable_fontawesome_icon" class="arp_switch" name="enable_fontawesome_icon" <?php echo !empty( $arprice_enable_forntawesome_icon ) ? 'checked="checked"' : ""; ?> />
													<span></span>
												</span>
												<input type="hidden" name="enable_fontawesome_icon" id="enable_fontawesome_icon_input" value="<?php echo !empty( $arprice_enable_forntawesome_icon ) ? $arprice_enable_forntawesome_icon : 0; ?>" />
											</td>

											<td class="arp_global_setting_font_switch">
												<span class="arp_switch_wrapper arp_switch_off arplite_restricted_view" id="">
													<input type="checkbox" id="arplite_enable_material_design_icon" value="enable_material_design_icon" class="arp_switch" name="arplite_enable_material_design_icon">
													<span></span>
												</span>                                             
											</td>

											<td class="arp_global_setting_font_switch">
												<span class="arp_switch_wrapper arp_switch_off arplite_restricted_view" id="">
													<input type="checkbox" id="arplite_enable_ionicons" value="enable_ionicons" class="arp_switch" name="arplite_enable_ionicons">
													<span></span>
												</span>  
											</td>

											<td class="arp_global_setting_font_switch">
												<span class="arp_switch_wrapper arp_switch_off arplite_restricted_view" id="">
													<input type="checkbox" id="arplite_enable_typicons" value="enable_typicons" class="arp_switch" name="arplite_enable_typicons">
													<span></span>
												</span>  
												
											</td>
										</tr>
										<?php } else {
											$arprice_global_settings->arprice_render_pro_settings( 'arp_font_icons' );
										} ?>
									</span>
								</div>
							</td>
						</tr>
						<tr class="arpmainformfield" valign="top">
							<td class="arp_fix_padding" colspan="3">
								<div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
									<span>
									</span>
									 </table>
								</div>
							</td>
						</tr> 
						
						<tr class="arpmainformfield" valign="top">
							<td colspan="4" style="line-height: 4;">
								<span class="arp_global_setting_custom_css_eg"> <?php esc_html_e( '( If you facing any loading performance issue then you can disable one or more font icon. )', 'arprice-responsive-pricing-table' ); ?> </span>
							</td>
						</tr>

						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3" style="width:100%;">
								<div class="arp_dotted_line"></div>
							</td>
						</tr>
						<?php if( !$arpricemain->arprice_is_pro_active()){ ?>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3"><div class="arp_global_setting_frm_main_title"><?php esc_html_e( 'Track button click of pricing table', 'arprice-responsive-pricing-table' ); ?></div>
								<div class="arp_global_setting_frm_main_title align_left" style="padding-top:0;padding-bottom:0;color:#6bbc5b;font-size:16px;font-weight:bold;top:-20px;width:auto;position:relative;">Please Upgrade to premium version to use this feature.</div>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<span class="arp_global_setting_custom_css_eg"><?php esc_html_e( ' ( If you do not want to get analytics of clicked column than uncheck below checkbox. )', 'arprice-responsive-pricing-table' ); ?> </span>
							</td>
						</tr>

						<tr class="arpmainformfield" valign="top">
							<td class="arp_fix_padding" colspan="3">
								<div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
									<span>
										<p>
											<span class='arp_switch_wrapper'> 
												<input type="checkbox" class="arp_checkbox light_bg arp_reset_templates arplite_restricted_view" id="arp_track_analytics" name="arp_track_analytics" style="margin-top:0px;"/>
												<span></span>
											</span>
											<label data-for="arp_track_analytics"><?php esc_html_e( 'Enable Analytics', 'arprice-responsive-pricing-table' ); ?></label>
										</p>
									</span>
								</div>
							</td>
						</tr>
						<?php } else {
							$arprice_global_settings->arprice_render_pro_settings( 'arp_enable_analytics' );
						} ?>
						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3" style="width:100%;">
								<div class="arp_dotted_line"></div>
							</td>
						</tr>

						<?php if( !$arpricemain->arprice_is_pro_active() ){ ?>
							<tr class="arfmainformfield" valign="top">
								<td class="lbltitle" colspan="3">
									<div class="arp_global_setting_frm_main_title"><?php esc_html_e( 'Display loader upon submission', 'arprice-responsive-pricing-table' ); ?></div>
									<div class="arp_global_setting_frm_main_title align_left" style="padding-top:0;padding-bottom:0;color:#6bbc5b;font-size:16px;font-weight:bold;top:-20px;width:auto;position:relative;">Please Upgrade to premium version to use this feature.</div>
								</td>
							</tr>                     
							<tr class="arpmainformfield" valign="top">
								<td class="arp_fix_padding" colspan="3">
									<div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
										<span>
											<p>
												<span class='arp_switch_wrapper'>
													<input type="checkbox" class="arp_checkbox light_bg arp_reset_templates arplite_restricted_view" id="arp_enable_loader" name="arp_enable_loader"  value="" style="margin-top:0px;"/>
												<span></span>
												</span>
												<label data-for="arp_enable_loader"><?php esc_html_e( 'Enable Loader', 'arprice-responsive-pricing-table' ); ?></label>
											</p>
										</span>
									</div>
								</td>
							</tr>
						<?php } else {
							$arprice_global_settings->arprice_render_pro_settings( 'arp_display_loader' );
						} ?>

						<tr class="arfmainformfield" valign="top">
							<td class="lbltitle" colspan="3" style="width:100%;">
								<div class="arp_dotted_line"></div>
							</td>
						</tr>                        
						<tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="3"><div class="arp_global_setting_frm_main_title"><?php esc_html_e( 'Load JS & CSS in all pages', 'arprice-responsive-pricing-table' ); ?></div></td></tr>
						<tr>
							<td colspan="3">
								<span class="arp_global_setting_custom_css_eg"><?php esc_html_e( ' ( Not recommended - If you have any js/css loading issue in your theme, only in that case you should enable this settings )', 'arprice-responsive-pricing-table' ); ?> </span>
							</td>
						</tr>
						<tr class="arpmainformfield" valign="top">

							<td class="arp_fix_padding" colspan="3">
								<div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
									<span>
										<p>
											<span class='arp_switch_wrapper'>
												
												<input type="checkbox" class="arp_checkbox light_bg arp_reset_templates" id="arp_load_js_css" name="arp_load_js_css" <?php checked( $arpricesettings->arp_load_js_css, 'arp_load_js_css' ); ?> value="arp_load_js_css" style="margin-top:0px;"/>
												
												<span></span>
											</span>
											<label data-for="arp_load_js_css"> <?php esc_html_e( 'Load JS & CSS', 'arprice-responsive-pricing-table' ); ?></label>
										</p>
									</span>
								</div>
							</td>
						</tr>
						<tr style="margin-top:50px;">
							<td colspan="1" class="arp_fix_padding">
								<button type="submit" id="set_global_settings" name="save_global_settings" class="arp_global_setting_btn"> <?php esc_html_e( 'Save Changes', 'arprice-responsive-pricing-table' ); ?></button>
								<div class="position_of__loader_settings"><span class="load_event_setting_img" id="arp_setting_save" ></div>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="arp_upgrade_modal" id="arplite_custom_css_notice" style="display:none;">
	<div class="upgrade_modal_top_belt">
		<div class="logo" style="text-align:center;"><img src="<?php echo esc_url( ARPLITE_PRICINGTABLE_IMAGES_URL ); ?>/arprice_update_logo.png" /></div>
		<div id="nav_style_close" class="close_button b-close"><img src="<?php echo esc_url( ARPLITE_PRICINGTABLE_IMAGES_URL ); ?>/arprice_upgrade_close_img.png" /></div>
	</div>
	<div class="upgrade_title"><?php esc_html_e( 'Upgrade To Premium Version.', 'arprice-responsive-pricing-table' ); ?></div>
	<div class="upgrade_message"><?php esc_html_e( 'Please upgrade to premium version to unlock this feature.', 'arprice-responsive-pricing-table' ); ?></div>
	<div class="upgrade_modal_btn">
		<a href="#" class="buy_now_button_link"><?php esc_html_e( 'Buy Now', 'arprice-responsive-pricing-table' ); ?></a>
		<a href="#" class="learn_more_button_link"><?php esc_html_e( 'Learn More', 'arprice-responsive-pricing-table' ); ?></a>
		<input type="hidden" name="arp_version" id="arp_version" value="<?php echo esc_html( $arpricelite_version ); ?>" />
		<input type="hidden" name="arp_request_version" id="arp_request_version" value="<?php echo esc_html( get_bloginfo( 'version' ) ); ?>" />

	</div>
</div>
<?php
$arprice_global_settings->arprice_render_pro_settings('arprice_pro_external_html');

do_action('arprice_quick_help_links');