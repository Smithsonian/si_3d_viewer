<?php

namespace Drupal\si_3d_viewer\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'voyager' widget.
 *
 * @FieldWidget(
 *   id = "voyager_default",
 *   label = @Translation("Voyager"),
 *   field_types = {
 *     "voyager"
 *   }
 * )
 */
class VoyagerWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    /** @var \Drupal\link\LinkItemInterface $item */
    $item = $items[$delta];

    $element['uri'] = [
      '#type' => 'url',
      '#title' => $this->t('URL'),
      '#placeholder' => $this->getSetting('placeholder_url'),
      // The current field value could have been entered by a different user.
      // However, if it is inaccessible to the current user, do not display it
      // to them.
      '#default_value' => !$item->isEmpty() ? $item->uri : NULL,
      '#element_validate' => [[get_called_class(), 'validateUriElement']],
      '#maxlength' => 2048,
      '#required' => $element['#required'],
    ];


    $element['embed'] = [
	    '#type' => 'checkbox',
	    '#default_value' => !empty($items[$delta]->embed),
	    '#title' => $this->t('Iframe Embed?'),
    ];


    return $element;
  }

}
