<?php

namespace Drupal\si_3d_viewer\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'voyager' field type.
 *
 * @FieldType(
 *   id = "voyager",
 *    label = @Translation("Voyager link"),
 *   module = "si_3d_viewer",
 *   description = @Translation("Add field to enter voyager uri."),
 *   default_widget = "voyager_default",
 *   default_formatter = "voyager"
 * )
 */
class VoyagerItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
	      'uri' => [
		      'description' => 'The URI of the link.',
		      'type' => 'varchar',
		      'length' => 2048,
	      ],
	      'embed' => [
		      'type' => 'int',
		      'size' => 'tiny',
	      ]
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
	  $value = $this->get('uri')->getValue();
	  return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
	  $properties['uri'] = DataDefinition::create('uri')
		  ->setLabel(t('URI'));
	  $properties['embed'] = DataDefinition::create('boolean')
		  ->setLabel(t('Voyager Embed'))
		  ->setRequired(TRUE);

	  return $properties;
  }

}
