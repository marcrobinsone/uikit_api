<?php

$items = $variables['items'];
$title = $variables['title'];
$type = $variables['type'];
$attributes = $variables['attributes'];

// Only output the list container and title, if there are any list items.
// Check to see whether the block title exists before adding a header.
// Empty headers are not semantic and present accessibility challenges.
$output = '<div class="item-list">';
if (isset($title) && $title !== '') {
  $output .= '<h3>' . $title . '</h3>';
}

if (!empty($items)) {
  $attributes['class'] = array('uk-list', 'uk-list-line');
  $output .= "<$type" . drupal_attributes($attributes) . '>';
  $num_items = count($items);
  $i = 0;
  foreach ($items as $item) {
    $attributes = array();
    $children = array();
    $data = '';
    $i++;
    if (is_array($item)) {
      foreach ($item as $key => $value) {
        if ($key == 'data') {
          $data = $value;
        }
        elseif ($key == 'children') {
          $children = $value;
        }
        else {
          $attributes[$key] = $value;
        }
      }
    }
    else {
      $data = $item;
    }
    if (count($children) > 0) {
      // Render nested list.
      $data .= theme_item_list(array('items' => $children, 'title' => NULL, 'type' => $type, 'attributes' => $attributes));
    }
    if ($i == 1) {
      $attributes['class'][] = 'first';
    }
    if ($i == $num_items) {
      $attributes['class'][] = 'last';
    }
    $output .= '<li' . drupal_attributes($attributes) . '>' . $data . "</li>\n";
  }
  $output .= "</$type>";
}
$output .= '</div>';
print $output;
