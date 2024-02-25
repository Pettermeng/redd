<?php
switch($timeline_style){
	case '0':
		include(ultimate_layouts_include_template('09-timeline', '0'));					
		break;
	case '1':	
		include(ultimate_layouts_include_template('09-timeline', '1'));				
		break;
	default:
		include(ultimate_layouts_include_template('09-timeline', '0'));						
}