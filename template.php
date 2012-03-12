<?php

/**
 * Implements hook_preprocess_html().
 */
function cu_backstretch_preprocess_html(&$vars) {
  unset($vars['classes_array'][array_search('show-grid', $vars['classes_array'])]);
  $logo = theme_get_setting('logo');
  $logo_css = "#branding h1 a, #branding #logo a { background-image:url(" . check_url($logo) . "); }";
  $options = array(
    'type' => 'inline',
    'group' => CSS_THEME,
	);
  drupal_add_css($logo_css , $options);
  $vars['head_title'] = $vars['head_title'] . ' | CU-Boulder'; 
  global $base_path;
  $vars['classes_array'][]='banner-white';
  $font_set = theme_get_setting('fonts');
  $font_path = drupal_get_path('theme','cu_bootstrap');
  if($font_set) {
    drupal_add_css($font_path .'/fonts/' . $font_set . '.css', array('group' => CSS_THEME, 'every_page' => TRUE));
  }
  
  $bg_path = file_create_url(theme_get_setting('bg_path'));
  if ($bg_path) {
    $bg_css = '#main-wrapper { background-image:url(' . check_url($bg_path) . '); background-repeat:no-repeat;}';
    $options = array(
      'type' => 'inline',
      'group' => CSS_THEME,
  	);
    drupal_add_css($bg_css , $options);
    
    drupal_add_js('jQuery.backstretch(" ' . check_url($bg_path) . '");',
    array('type' => 'inline', 'scope' => 'footer', 'weight' => 5)
  );
  }
  
}