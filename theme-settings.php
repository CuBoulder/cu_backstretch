<?php

function cu_backstretch_form_system_theme_settings_alter(&$form, &$form_state) {
  $theme = $form_state['build_info']['args'][0];
	$form['cu_backstretch_theme_settings'] = array(
		'#type' => 'fieldset', 
		'#title' => t('cu_backstretch Theme Settings'), 
	);
  
 	
	
	  
  // BACKGROUND IMAGE OPTIONS
	$form['cu_backstretch_theme_settings']['background_image'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Background Image'), 
		'#collapsible' => TRUE, 
		'#collapsed' => TRUE,
	);
	
	
	
	// Default path for image
  $bg_path = theme_get_setting('bg_path');
  if (file_uri_scheme($bg_path) == 'public') {
    $bg_path = file_uri_target($bg_path);
  }
  
  // Helpful text showing the file name, disabled to avoid the user thinking it can be used for any purpose.
  $form['cu_backstretch_theme_settings']['background_image']['bg_path'] = array(
    '#type' => 'textfield',
    '#title' => 'Path to background image',
    '#default_value' => $bg_path,
    '#disabled' => FALSE,
  );

  // Upload field
  $form['cu_backstretch_theme_settings']['background_image']['bg_upload'] = array(
    '#type' => 'file',
    '#title' => 'Upload background image',
    '#description' => 'Upload a new image for the background.',
  );
  
 
  // Attach custom submit handler to the form
  $form['#submit'][] = 'cu_backstretch_settings_submit';
	
}
	
	
function cu_backstretch_settings_submit($form, &$form_state) {
  $settings = array();
  // Get the previous value
  $previous = 'public://' . $form['cu_backstretch_theme_settings']['background_image']['bg_path']['#default_value'];
  $file = file_save_upload('bg_upload');
  if ($file) {
    $parts = pathinfo($file->filename);
    $destination = 'public://' . $parts['basename'];
    $file->status = FILE_STATUS_PERMANENT;
    
    if(file_copy($file, $destination, FILE_EXISTS_REPLACE)) {
      $_POST['bg_path'] = $form_state['values']['bg_path'] = $destination;
      // If new file has a different name than the old one, delete the old
      
      if ($destination != $previous) {
        drupal_unlink($previous);
      }
    
    }
  
  } else {
    // Avoid error when the form is submitted without specifying a new image
    $_POST['bg_path'] = $form_state['values']['bg_path'] = $previous;
  }
  
 
}
