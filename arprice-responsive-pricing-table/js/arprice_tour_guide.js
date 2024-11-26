"use strict";function EditorTourGuide(r){var o=new Tour({storage:!1});o.addSteps([{element:"#arp_allcolumnsdiv",title:__REAL_TIME_EDITOR_TEXT,content:__REAL_TIME_EDITOR_CONT,placement:"top",backdrop:!0,orphan:!0,onShown:function(r){jQuery("#arp_allcolumnsdiv").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("-webkit-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("-moz-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("-o-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("float","left"),jQuery("#arp_allcolumnsdiv").css("padding-top","10px"),jQuery("#arp_allcolumnsdiv").css("background","#ffffff"),jQuery(".arp_tour").css("margin-top","15px")},onHide:function(r){jQuery("#arp_allcolumnsdiv").css("box-shadow",""),jQuery("#arp_allcolumnsdiv").css("-webkit-box-shadow",""),jQuery("#arp_allcolumnsdiv").css("-moz-box-shadow",""),jQuery("#arp_allcolumnsdiv").css("-o-box-shadow",""),jQuery("#arp_allcolumnsdiv").css("float",""),jQuery("#arp_allcolumnsdiv").css("padding",""),jQuery("#arp_allcolumnsdiv").css("background",""),jQuery(".arp_tour").css("margin-top","")},template:"<div class='popover tour arp_tour'><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button id='arp_next_two' class='arp_tour_next' style='margin:0 15px 15px;' data-role='next'>"+__ARP_NEXT_TEXT+"</button><button class='arp_tour_end_tour' style='margin-right:15px;' data-role='end'>"+__END_TOUR+"</button></div></nav></div>"},{element:".arprice_top_belt_menu_option#all_color_options",title:__CHOOSE_COLOR,content:__CHOOSE_COLOR_TEXT,backdrop:!0,orphan:!0,placement:"left",onShown:function(r){jQuery("#arp_allcolumnsdiv").css("z-index","999"),jQuery("#arp_allcolumnsdiv").css("position","relative"),jQuery(".arprice_top_belt_menu_option#all_color_options").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_top_belt_menu_option#all_color_options").css("-webkit-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_top_belt_menu_option#all_color_options").css("-moz-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_top_belt_menu_option#all_color_options").css("-o-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_top_belt_menu_option#all_color_options").click(),jQuery("#arp_allcolumnsdiv").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("-webkit-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("-moz-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("-o-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("float","left"),jQuery("#arp_allcolumnsdiv").css("padding-top","10px"),jQuery("#arp_allcolumnsdiv").css("background","#ffffff");var o=jQuery(".arprice_top_belt_menu_option#all_color_options").outerWidth();o+=60;jQuery("body").hasClass("rtl")&&(jQuery(".arp_tour").removeClass("left"),jQuery(".arp_tour").addClass("right"),jQuery(".popover.tour.arp_tour.tour-tour.tour-tour-1.fade.right.in").css("left",o+"px"),jQuery(".arp_tour").find(".arrow").css("top","12%"),jQuery(".arp_tour").find(".arrow").css("right","385px"))},onHide:function(r){jQuery("#arp_allcolumnsdiv").css("z-index",""),jQuery("#arp_allcolumnsdiv").css("position",""),jQuery(".arprice_top_belt_menu_option#all_color_options").css("box-shadow",""),jQuery(".arprice_top_belt_menu_option#all_color_options").css("-webkit-box-shadow",""),jQuery(".arprice_top_belt_menu_option#all_color_options").css("-moz-box-shadow",""),jQuery(".arprice_top_belt_menu_option#all_color_options").css("-o-box-shadow",""),jQuery("#arp_allcolumnsdiv").css("box-shadow",""),jQuery("#arp_allcolumnsdiv").css("-webkit-box-shadow",""),jQuery("#arp_allcolumnsdiv").css("-moz-box-shadow",""),jQuery("#arp_allcolumnsdiv").css("-o-box-shadow",""),jQuery("#arp_allcolumnsdiv").css("float",""),jQuery("#arp_allcolumnsdiv").css("padding",""),jQuery("#arp_allcolumnsdiv").css("background",""),jQuery(".arprice_toggle_menu_options").click()},template:"<div class='popover tour arp_tour' style='margin:75px 0 0 -25px'><div class='arrow arrow_color'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>"+__ARP_PREV_TEXT+"</button> <button id='arp_next_thiree' class='arp_tour_next' data-role='next'>"+__ARP_NEXT_TEXT+"</button><button class='arp_tour_end_tour' data-role='end'>"+__END_TOUR+"</button></div></div>"},{element:"#main_column_0",title:__COLUMN_LEVEL_CHANGES,content:__COLUMN_LEVEL_CHANGES_TEXT,backdrop:!0,orphan:!0,placement:"right",onShown:function(r){jQuery("#main_column_0").trigger("mouseover"),jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),jQuery("#main_column_0").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#main_column_0").css("-webkit-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#main_column_0").css("-moz-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#main_column_0").css("-o-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#main_column_0").css("z-index","999"),jQuery(".tour-backdrop").css("z-index","99"),jQuery(".tour-step-background").removeAttr("style"),jQuery("body").scrollTop(100),jQuery("body").hasClass("rtl")&&(jQuery(".arp_tour").find(".arrow").css("right","385px"),jQuery(".tour-backdrop.right").css("width","100%"))},onHide:function(r){jQuery("#arp_allcolumnsdiv").removeClass("no_arp_tour_hover"),jQuery("#main_column_0").css("box-shadow",""),jQuery("#main_column_0").css("-webkit-box-shadow",""),jQuery("#main_column_0").css("-moz-box-shadow",""),jQuery("#main_column_0").css("-o-box-shadow",""),jQuery("#main_column_0").css("z-index","")},template:"<div style='margin:0 0 0 20px;'; class='popover tour arp_tour'><div class='arrow arrow_header'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>"+__ARP_PREV_TEXT+"</button><button id='arp_next_four' class='arp_tour_next' data-role='next'>"+__ARP_NEXT_TEXT+"</button><button class='arp_tour_end_tour' data-role='end'>"+__END_TOUR+"</button></div></div>"},{element:"#main_column_0",title:__PRICING_AREA_TEXT,content:__PRICING_AREA_CONT,backdrop:!0,orphan:!0,placement:"right",onShown:function(r){jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),jQuery("#main_column_0").addClass("ArpPricingTableColumnWrapper_inner_selected selected"),jQuery("#main_column_0").css("z-index","9999"),jQuery("#main_column_0").trigger("mouseover"),jQuery("#main_column_0").find(".arppricetablecolumnprice").trigger("mouseover"),jQuery(".tour-step-background").removeAttr("style"),jQuery("body").hasClass("rtl")&&(jQuery(".arp_tour").find(".arrow").css("right","385px"),jQuery(".tour-backdrop.right").css("width","100%"))},onHide:function(r){jQuery("#arp_allcolumnsdiv").removeClass("no_arp_tour_hover"),jQuery("#main_column_0").removeClass("ArpPricingTableColumnWrapper_inner_selected selected"),jQuery("#main_column_0").css("z-index","")},template:"<div style='margin:0 0 0 20px;' class='popover tour arp_tour'><div class='arrow arrow_price'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>"+__ARP_PREV_TEXT+"</button><button id='arp_next_four' class='arp_tour_next' data-role='next'>"+__ARP_NEXT_TEXT+"</button><button class='arp_tour_end_tour' data-role='end'>"+__END_TOUR+"</button></div></div>"},{element:"#preview_btn",title:__PREVIEW_BTN,content:__PREVIEW_BTN_TEXT,backdrop:!0,orphan:!0,placement:"bottom",onNext:function(r){jQuery("#preview_btn").css("box-shadow",""),jQuery("#preview_btn").css("-webkit-box-shadow",""),jQuery("#preview_btn").css("-moz-box-shadow",""),jQuery("#preview_btn").css("-o-box-shadow",""),jQuery("#preview_btn").addClass("DisplayTourGuide"),jQuery("#preview_btn").trigger("click"),jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),r.end()},onShown:function(r){jQuery("body").hasClass("rtl")&&(jQuery(".arp_tour").find(".arrow").css("right","80%"),jQuery(".arp_tour").find(".arrow").css("left","unset !important")),jQuery("#preview_btn").addClass("DisplayTourGuide")},template:"<div style='margin:12px 0 0 -10px;' class='popover tour arp_tour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>"+__ARP_PREV_TEXT+"</button><button id='arp_next_preview' class='arp_tour_next' data-role='next'>"+__ARP_NEXT_TEXT+"</button><button class='arp_tour_end_tour' data-role='end'>"+__END_TOUR+"</button></div></div>"}]),setTimeout(function(){o.init(),o.start(),0<r&&o.goTo(r)},1e3)}function previewTour(r){var o=new Tour({storage:!1});o.addSteps([{element:"#mobile_icon",title:__CHANGE_VIEW,content:__CHANGE_VIEW_TEXT,backdrop:!0,orphan:!0,placement:"bottom",onShown:function(r){jQuery("#preview_btn").removeClass("DisplayTourGuide"),jQuery("#mobile_icon").addClass("DisplayTourGuide");var o="left";jQuery("body").hasClass("rtl")&&(o="right"),1900<jQuery(window).width()&&(jQuery(".popover.tour.arp_tour.tour-tour.tour-tour-0.fade.bottom.in").css(o,"410px"),jQuery(".popover.tour.arp_tour.tour-tour.tour-tour-0.fade.bottom.in").css("top","97px")),jQuery("body").hasClass("rtl")&&(jQuery(".arp_tour_preview").find(".arrow").css("right","57%"),jQuery(".arp_tour_preview").find(".arrow").css("left","unset !important"))},onNext:function(r){jQuery("#mobile_icon").trigger("click")},onPrev:function(r){EditorTourGuide(4),jQuery("#arp_pricing_table_preview .b-close").trigger("click"),r.end()},template:"<div style='margin-top:23px;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>"+__ARP_PREV_TEXT+"</button><button id='arp_next_mobile' class='arp_tour_next' data-role='next'>"+__ARP_NEXT_TEXT+"</button><button class='arp_tour_end_tour' data-role='end'>"+__END_TOUR+"</button></div></div>"},{element:"#mobile_icon",title:__MOBILE_VIEW,content:__MOBILE_VIEW_TEXT,backdrop:!0,orphan:!0,placement:"bottom",onShown:function(r){jQuery("#preview_btn").removeClass("DisplayTourGuide"),jQuery("body").hasClass("rtl")&&(jQuery(".arp_tour_preview").find(".arrow").css("right","78%"),jQuery(".arp_tour_preview").find(".arrow").css("left","unset !important")),1900<jQuery(window).width()&&jQuery(".popover.tour.arp_tour_preview.tour-tour.fade.bottom.in").css("top","97px")},onNext:function(r){AnimationTours(),jQuery("#arp_pricing_table_preview .b-close").trigger("click"),r.end()},onPrev:function(r){jQuery("#computer_icon").trigger("click")},template:"<div style='margin-top:23px;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>"+__ARP_PREV_TEXT+"</button><button id='arp_next_mobile' class='arp_tour_next' data-role='next'>"+__ARP_NEXT_TEXT+"</button><button class='arp_tour_end_tour' data-role='end'>"+__END_TOUR+"</button></div></div>"}]),setTimeout(function(){o.init(),o.start(),0<r&&o.goTo(r)},1e3)}function AnimationTours(){var r=new Tour({storage:!1});r.addSteps([{element:".arprice_options_menu_belt",title:__GENERAL_SETTINGS,content:__GENERAL_SETTINGS_CONT,backdrop:!0,orphan:!0,placement:"bottom",onShown:function(r){jQuery("#preview_btn").removeClass("DisplayTourGuide"),jQuery(".arprice_options_menu_belt").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_options_menu_belt").css("-webkit-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_options_menu_belt").css("-moz-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_options_menu_belt").css("-o-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_options_menu_belt").css("margin","0 4px 0 4px"),jQuery(".arprice_options_menu_belt").css("width","100%");var o=jQuery("#column_options").width(),e=jQuery("#column_effects").width(),t=jQuery("#tootip_options").width(),a=jQuery("#custom_css_options").width(),s=jQuery("#toggle_content_options").width(),_=jQuery("#all_font_options").width();parseInt(o),parseInt(e),parseInt(t),parseInt(a),parseInt(s),parseInt(_);jQuery(".arprice_options_menu_belt").css("background","#ffffff"),jQuery("body").hasClass("rtl")&&(jQuery(".arp_tour_preview").css("right","20%"),jQuery(".arp_tour_preview").find(".arrow").css("right","60%"),jQuery(".arp_tour_preview").find(".arrow").css("left","unset !important"))},onHide:function(r){jQuery(".arprice_options_menu_belt").css("box-shadow",""),jQuery(".arprice_options_menu_belt").css("-webkit-box-shadow",""),jQuery(".arprice_options_menu_belt").css("-moz-box-shadow",""),jQuery(".arprice_options_menu_belt").css("-o-box-shadow",""),jQuery(".arprice_options_menu_belt").css("margin",""),jQuery(".arprice_options_menu_belt").css("width",""),jQuery(".arprice_options_menu_belt").css("background",""),jQuery(".arp_tour_preview").css("margin-left","-25%"),jQuery(".arprice_top_belt_menu_right").show()},onNext:function(r){jQuery("#arp_shortcode").css("background","transparent !important"),jQuery(".arp_shortcode_main.arp_shortcode").show(),jQuery("#save_btn").trigger("click"),jQuery("#arp_shortcode").trigger("click")},onPrev:function(r){jQuery(".arprice_options_menu_belt").css("box-shadow",""),jQuery(".arprice_options_menu_belt").css("-webkit-box-shadow",""),jQuery(".arprice_options_menu_belt").css("-moz-box-shadow",""),jQuery(".arprice_options_menu_belt").css("-o-box-shadow",""),jQuery(".arprice_options_menu_belt").css("margin",""),jQuery(".arprice_options_menu_belt").css("width",""),jQuery(".arprice_options_menu_belt").css("background",""),jQuery("#preview_btn").addClass("DisplayTourGuide"),jQuery("#preview_btn").trigger("click"),r.end()},template:"<div style='margin:21px 0 0 -25%;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>"+__ARP_PREV_TEXT+"</button><button id='arp_next_effects' class='arp_tour_next' data-role='next'>"+__ARP_NEXT_TEXT+"</button><button class='arp_tour_end_tour' data-role='end'>"+__END_TOUR+"</button></div></div>"},{element:".arp_shortcode_main.arp_shortcode",title:__FINISH,content:__FINISH_TEXT,backdrop:!0,orphan:!0,placement:"bottom",onShown:function(r){jQuery(".arp_shortcode_main.arp_shortcode").show(),jQuery(".arp_shortcode_main.arp_shortcode").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arp_shortcode_main.arp_shortcode").css("-webkit-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arp_shortcode_main.arp_shortcode").css("-moz-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arp_shortcode_main.arp_shortcode").css("-o-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arp_shortcode_main.arp_shortcode").css("background","transparent"),jQuery(".arp_shortcode_main.arp_shortcode").css("height","45px"),jQuery(".arp_shortcode_main.arp_shortcode").css("top","5px"),1599<jQuery(window).width()&&jQuery(".arp_shortcode_main.arp_shortcode").css("height","50px"),jQuery("body").hasClass("rtl")&&(jQuery(".arp_tour_preview").find(".arrow").css("right","57%"),jQuery(".arp_tour_preview").find(".arrow").css("left","unset !important"))},onHide:function(r){jQuery(".arprice_options_menu_belt").css("box-shadow",""),jQuery(".arprice_options_menu_belt").css("-webkit-box-shadow",""),jQuery(".arprice_options_menu_belt").css("-moz-box-shadow",""),jQuery(".arprice_options_menu_belt").css("-o-box-shadow","")},onNext:function(r){r.end(),window.location.href="admin.php?page=arprice"},template:"<div style='margin:18px 0 0 0' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_end_tour' data-role='next'>"+__END_TOUR+"</button></div></div>"}]),setTimeout(function(){r.init(),r.start()},1e3)}var $start=jQuery(".arp_tour_guide_start"),tour=new Tour({storage:!1,onStart:function(){return 3<jQuery(".arprice_editable_template_container").length?(jQuery("#arplite_save_table_notice_editor").bPopup(),void tour.end()):$start.addClass("disabled",!0)},onEnd:function(){$start.removeClass("disabled",!0)}});jQuery(document).ready(function(){var r="<div style='margin-top:18px;' class='popover tour arp_tour'>",r=(r=(r=(r=(r=r+"<div class='arrow'></div><h3 class='popover-title'></h3>"+"<div class='popover-content'></div><div class='popover-navigation'>")+("<button id='arp_next_one' class='arp_tour_next' style='margin:0 15px 15px;' data-role='next'>"+__ARP_NEXT_TEXT+"</button>"))+("<button class='arp_tour_end_tour' style='margin-right:15px;'  data-role='end'>"+__END_TOUR+"</button>"))+"</div>"+"</div>",tour.addSteps([{element:"#arp_template_8",title:__CHOOSE_TEMPLATE,content:__TOUR_NEXT_LABEL,placement:"bottom",backdrop:!0,orphan:!0,onShown:function(r){jQuery("#arprice_templates").hasClass("arp_active")&&jQuery("#arprice_templates").removeClass("arp_active"),0==jQuery("#arp_create_new_template").hasClass("arp_active")&&jQuery("#arp_create_new_template").addClass("arp_active"),jQuery(".arprice_select_template_container_item").css("z-index","0"),jQuery("#arp_template_8").trigger("click"),jQuery("#arp_template_8").css("background","#ffffff"),jQuery("#arp_template_8").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_template_8").css("-webkit-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_template_8").css("-moz-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_template_8").css("-o-box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_template_8").css("z-index","9999"),jQuery("#arp_template_8 .arprice_select_template_bg_img").addClass("arp_tour_guide_template_active"),jQuery(".tour-step-background").removeAttr("style");var o="left";jQuery("body").hasClass("rtl")&&(o="right"),jQuery(".popover.tour.arp_tour.tour-tour.tour-tour-0.fade.bottom.in").css(o,"541px"),jQuery(".popover.tour.arp_tour.tour-tour.tour-tour-0.fade.bottom.in").find(".arrow").css(o,"50%"),1599<jQuery(window).width()&&jQuery(window).width()<1900&&jQuery(".popover.tour.arp_tour.tour-tour.tour-tour-0.fade.bottom.in").css(o,"630px"),1900<jQuery(window).width()&&jQuery(".popover.tour.arp_tour.tour-tour.tour-tour-0.fade.bottom.in").css(o,"190px")},onHide:function(r){jQuery(".arprice_select_template_container_item").css("z-index","999"),jQuery("#arp_template_8").css("background",""),jQuery("#arp_template_8").css("box-shadow",""),jQuery("#arp_template_8").css("-webkit-box-shadow",""),jQuery("#arp_template_8").css("-moz-box-shadow",""),jQuery("#arp_template_8").css("-o-box-shadow","")},onNext:function(r){jQuery(".arprice_select_template_container_item").css("z-index","999");var o=jQuery("#arp_template_8").find("#arplite_clone_template").attr("data-url")+"&tour_guid=true";jQuery("#arp_template_8").find("#arplite_clone_template").attr("data-url",o),jQuery("#arp_template_8").find("#arplite_clone_template").trigger("click"),r.end()},template:r}]),tour.init(),window.location.href);/(tour_guid=true)/gi.test(r)&&EditorTourGuide(0),jQuery(document).on("click",".arp_tour_guide_start",function(r){r.preventDefault(),jQuery(".arprice_download_sample_container").hasClass("arp_active")?(jQuery(".arprice_download_sample_container").removeClass("arp_active"),jQuery(".arprice_select_template_container").addClass("arp_active"),jQuery(".arprice_select_template_container.arp_active").find(".arprice_select_template_list_container").show()):(jQuery(".arprice_new_template_box.arp_create_new").trigger("click"),jQuery(".arprice_select_template_container_item").css("z-index","0")),jQuery("html").scrollTop(500),jQuery(this).hasClass("disabled")||tour.restart()}),"yes"==jQuery("#arp_tour_guide_value").val()&&setTimeout(function(){jQuery("#arp_tour_guide_model").bPopup()},1e3)}),jQuery(document).on("click","#arp_tour_guide_model #nav_style_close",function(){var r=jQuery("#ajaxurl").val();jQuery.ajax({url:r,type:"POST",data:"action=update_arplite_tour_guide_value&arp_tour_guide_value=arp_tour_guide_start_no",success:function(r){"1"==r&&(jQuery("#arp_tour_guide_start").trigger("click"),jQuery("#arp_tour_guide_model").removeClass("arp_active"),tour.start())}})}),jQuery(document).on("click",".arp_tour_guide_start_model",function(){var r=jQuery("#ajaxurl").val(),o=jQuery(this).attr("id");jQuery.ajax({url:r,type:"POST",data:"action=update_arplite_tour_guide_value&arp_tour_guide_value="+o,success:function(r){"1"==r&&(jQuery("#arp_tour_guide_model").bPopup().close(),jQuery("#arp_tour_guide_start").trigger("click"),jQuery("#arp_tour_guide_model").removeClass("arp_active"),tour.start()),"arp_tour_guide_start_no"==o&&jQuery("#arp_tour_guide_model").bPopup().close()}})});