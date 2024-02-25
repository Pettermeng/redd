<?php
switch($carousel_t_style){
	case '0':
		include(ultimate_layouts_include_template('01-carousel-t', '0'));					
		break;
	case '1':	
		include(ultimate_layouts_include_template('01-carousel-t', '1'));				
		break;
	case '2':	
		include(ultimate_layouts_include_template('01-carousel-t', '2'));				
		break;
	case '3':	
		include(ultimate_layouts_include_template('01-carousel-t', '3'));				
		break;
	case '4':	
		include(ultimate_layouts_include_template('01-carousel-t', '4'));				
		break;
	case '5':	
		include(ultimate_layouts_include_template('01-carousel-t', '5'));				
		break;	
	default:
		include(ultimate_layouts_include_template('01-carousel-t', '0'));						
}