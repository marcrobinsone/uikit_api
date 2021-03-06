<?php

/**
 * @file
 * Returns HTML for a textfield form element.
 */

$element = $variables['element'];
element_set_attributes($element, array(
  'id',
  'name',
  'value',
  'size',
  'maxlength',
));
_form_set_class($element, array('form-text'));

$element['#attributes']['type'] = 'text';
$element['#attributes']['size'] = '60';

$extra = '';
if ($element['#autocomplete_path'] && !empty($element['#autocomplete_input'])) {
  drupal_add_library('system', 'drupal.autocomplete');
  $element['#attributes']['class'][] = 'form-autocomplete';

  $attributes = array();
  $attributes['type'] = 'hidden';
  $attributes['id'] = $element['#autocomplete_input']['#id'];
  $attributes['value'] = $element['#autocomplete_input']['#url_value'];
  $attributes['disabled'] = 'disabled';
  $attributes['class'][] = 'autocomplete';
  $extra = '<input' . drupal_attributes($attributes) . ' />';
}

$output = '<div class="uk-form-icon">';
$output .= '<i id="' . $attributes['id'] . '-icon" class="uk-icon-refresh"></i>';
$output .= '<input' . drupal_attributes($element['#attributes']) . ' />';
$output .= '</div>';

print $output . $extra;
