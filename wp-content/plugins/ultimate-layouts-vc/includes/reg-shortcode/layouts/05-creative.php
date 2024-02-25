<?php
switch($creative_style){
	case '0':
		include(ultimate_layouts_include_template('05-creative', '0'));					
		break;
	case '1':	
		include(ultimate_layouts_include_template('05-creative', '1'));				
		break;
	case '2':	
		include(ultimate_layouts_include_template('05-creative', '2'));				
		break;
	default:
		include(ultimate_layouts_include_template('05-creative', '0'));						
}