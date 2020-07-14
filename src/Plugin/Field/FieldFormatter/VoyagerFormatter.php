<?php

namespace Drupal\si_3d_viewer\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'field_example_simple_text' formatter.
 *
 * @FieldFormatter(
 *   id = "voyager",
 *   module = "si_3d_viewer",
 *   label = @Translation("Voyager formatter"),
 *   field_types = {
 *     "voyager"
 *   }
 * )
 */
class VoyagerFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
    	$parsed_uri = explode('/',$item->uri);
      $elements[$delta] = [
        // We create a render array to produce the desired markup,
        // "<p style="color: #hexcolor">The color code ... #hexcolor</p>".
        // See theme_html_tag().
        '#theme' => 'voyager',
        '#uri' => $item->uri,
        '#embed' => $item->embed,
	      '#document' => end($parsed_uri)
      ];
      if (empty($item->embed)) {
	      $elements[$delta]['#attached']['library'][] = 'si_3d_viewer/voyager';
      }
    }
	//	dump($elements);
    return $elements;
  }

}
