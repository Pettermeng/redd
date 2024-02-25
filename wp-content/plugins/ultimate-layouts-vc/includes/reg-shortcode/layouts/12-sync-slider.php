<?php
switch($sync_slider_style){
	case '0':
		include(ultimate_layouts_include_template('12-sync-slider', '0'));					
		break;
	case '1':	
		include(ultimate_layouts_include_template('12-sync-slider', '1'));				
		break;
	case '2':	
		include(ultimate_layouts_include_template('12-sync-slider', '2'));				
		break;	
	default:
		include(ultimate_layouts_include_template('12-sync-slider', '0'));						
}