<?php
switch($grid_style){
	case '0':
		include(ultimate_layouts_include_template('00-grid', '0'));					
		break;
	case '1':	
		include(ultimate_layouts_include_template('00-grid', '1'));				
		break;
	case '2':	
		include(ultimate_layouts_include_template('00-grid', '2'));				
		break;
	case '3':	
		include(ultimate_layouts_include_template('00-grid', '3'));				
		break;
	case '4':	
		include(ultimate_layouts_include_template('00-grid', '4'));				
		break;
	case '5':
		include(ultimate_layouts_include_template('00-grid', '5'));					
		break;
	case '6':	
		include(ultimate_layouts_include_template('00-grid', '6'));				
		break;	
	case '7':	
		include(ultimate_layouts_include_template('00-grid', '7'));				
		break;
	case '8':	
		include(ultimate_layouts_include_template('00-grid', '8'));				
		break;			
	default:
		include(ultimate_layouts_include_template('00-grid', '0'));						
}