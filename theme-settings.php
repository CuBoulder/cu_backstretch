<?php

function cu_backstretch_form_system_theme_settings_alter(&$form, &$form_state) {
  $theme = $form_state['build_info']['args'][0];
  if (module_exists(backstretch)) {
	$form['cu_backstretch_theme_settings'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Backstretch Theme Settings'), 
		'#description' => '<a href="' . base_path() . 'admin/appearance/backstretch">Click here To set your background image</a>',
	);
	}
  
 	
	
	  
  
	
}
	
	

