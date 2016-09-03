<?php

/**
 * @file
 * Returns HTML for a set of links.
 *
 * Available variables:
 * - $variables['links']: An associative array of links to be themed. The key
 *   for each link is used as its CSS class. Each link should be itself an
 *   array, with the following elements:
 *   - title: The link text.
 *   - href: The link URL. If omitted, the 'title' is shown as a plain text item
 *     in the links list.
 *   - html: (optional) Whether or not 'title' is HTML. If set, the title will
 *     not be passed through check_plain().
 *   - attributes: (optional) Attributes for the anchor, or for the <span> tag
 *     used in its place if no 'href' is supplied. If element 'class' is
 *     included, it must be an array of one or more class names.
 *   If the 'href' element is supplied, the entire link array is passed to l()
 *   as its $options parameter.
 * - $variables['attributes']: A keyed array of attributes for the UL containing
 *   the list of links.
 * - $variables['heading']: (optional) A heading to precede the links. May be an
 *   associative array or a string. If it's an array, it can have the following
 *   elements:
 *   - text: The heading text.
 *   - level: The heading level (e.g. 'h2', 'h3').
 *   - class: (optional) An array of the CSS classes for the heading. When using
 *     a string it will be used as the text of the heading and the level will
 *     default to 'h2'. Headings should be used on navigation menus and any list
 *     of links that consistently appears on multiple pages. To make the heading
 *     invisible use the 'element-invisible' CSS class. Do not use
 *     'display:none', which removes it from screen-readers and assistive
 *     technology. Headings allow screen-reader and keyboard only users to
 *     navigate to or skip the links. See
 *     http://juicystudio.com/article/screen-readers-display-none.php and
 *     http://www.w3.org/TR/WCAG-TECHS/H42.html for more information.
 *
 * @see uikit_preprocess_links()
 * @see theme_links()
 *
 * @ingroup uikit_themeable
 */

$links = $variables['links'];
$attributes = $variables['attributes'];
$heading = $variables['heading'];
global $language_url;
$output = '';

if (count($links) > 0) {
  // Treat the heading first if it is present to prepend it to the list of
  // links.
  if (!empty($heading)) {
    if (is_string($heading)) {
      // Prepare the array that will be used when the passed heading is a
      // string.
      $heading = array(
        'text' => $heading,
        // Set the default level of the heading.
        'level' => 'h2',
      );
    }
    $output .= '<' . $heading['level'];
    if (!empty($heading['class'])) {
      $output .= drupal_attributes(array('class' => $heading['class']));
    }
    $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
  }

  $num_links = count($links);
  $i = 1;

  foreach ($links as $key => $link) {
    $link['attributes']['class'] = array(str_replace('_', '-', $key));

    // Add the UIkit button utility classes.
    $link['attributes']['class'][] = 'uk-button';
    if ($key == 'node-readmore') {
      $link['attributes']['class'][] = 'uk-button-primary';
    }
    $link['attributes']['class'][] = 'uk-margin-small-right';

    // Add first and last classes to the list of links to help out themers.
    if ($i == 1) {
      $link['attributes']['class'][] = 'first';
    }
    if ($i == $num_links) {
      $link['attributes']['class'][] = 'last';
    }

    if (isset($link['href'])) {
      // Pass in $link as $options, they share the same keys.
      $output .= l($link['title'], $link['href'], $link);
    }
    elseif (!empty($link['title'])) {
      // Some links are actually not links, but we wrap these in <span> for
      // adding title and class attributes.
      if (empty($link['html'])) {
        $link['title'] = check_plain($link['title']);
      }
      $span_attributes = '';
      if (isset($link['attributes'])) {
        $span_attributes = drupal_attributes($link['attributes']);
      }
      $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
    }

    $i++;
  }

}

print $output;
