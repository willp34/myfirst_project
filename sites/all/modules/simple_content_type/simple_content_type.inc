<?php

function _simple_content_type_installed_fields()
{
		//text field
	$fields['simple_content_type_text_field'] = array(
			'field_name' => 'simple_content_type_text_field',
			'label' => t('a text field'),
			'type' => 'text',
			'module' => 'text'
	);
	// textarea without filters
	$fields['simple_content_type_text_area'] = array(
			'field_name' => 'simple_content_type_text_area',
			'label' => t('a textArea'),
			'type' => 'text_long',
			'module' => 'text',
			'translatable' => '1',
			'foriegn keys' => array(
					'format' => array(
							'colmns' => array(
								'format' => 'format'
							),
							'table' => 'filter_format',							
					),
			),
			'indexes' => array(
				'format' => array(
						0=>'format',
				),
			),
	);
	// textarea with filters
	$fields['simple_content_type_txtarea_fltr'] = array(
			'field_name' => 'simple_content_type_txtarea_fltr',
			'label' => t('a textArea with format filters'),
			'type' => 'text_long',
			'module' => 'text',
			'translatable' => '1',
			'foriegn keys' => array(
					'format' => array(
							'colmns' => array(
								'format' => 'format'
							),
							'table' => 'filter_format',							
					),
			),
			'indexes' => array(
				'format' => array(
						0=>'format',
				),
			),
	);  
	
		drupal_set_message("content types done fun");
	return $fields;

}
function _simple_content_type_installed_instances(){
	 $instances['simple_content_type_text_field'] = array(
			'field_name' => 'simple_content_type_text_field',
			'type' => 'text',
			'label' => t('A Text field'),
			'widget' => array(
					'type' => 'text_textfield',
					'weight' => '-1',
					'settings' => array(
						'size' => '20',
						'max_length' => '100',
					),
			),
			'display' => array(
					'default' => array(
							'label' => 'inline',
							'settings' => array(),
							'type' => 'text_default',
							'weight' => -1
					),
					'teaser' => array(
							'label' => 'above',
							'settings' => array(),
							'type' => 'hidden',
							'weight' => -1
					),
			),
	);
     $instances['simple_content_type_text_area'] = array(
			'field_name' => 'simple_content_type_text_area',
			'type' =>'text_long',
			'label' => t('A Textarea wills'),
			'widget' => array(
					'type' => 'text_textarea',
					'weight' => 0,
					'settings' => array(
						'rows' => '5'
					),
			),
			'display' => array(
					'default' => array(
							'label' => 'above',
							'settings' => array(),
							'type' => 'text_default',
							'weight' => '0'
					),
					'teaser' => array(
							'label' => 'above',
							'settings' => array(),
							'type' => 'hidden',
							'weight' => '0'
					),
			),
			'required' => 0,
			'settings'=> array(
					'text_processing' => '0',
					'user_register_form' => false
			),
	);	
	// filters
     $instances['simple_content_type_txtarea_fltr'] = array(
			'field_name' => 'simple_content_type_txtarea_fltr',
			'type' =>'text_long',
			'label' => t('A Textarea with filter'),
			'widget' => array(
					'type' => 'text_textarea',
					'weight' => 1,
					'settings' => array(
						'rows' => '5'
					),
			),
			'display' => array(
					'default' => array(
							'label' => 'above',
							'settings' => array(),
							'type' => 'text_default',
							'weight' => 1
					),
					'teaser' => array(
							'label' => 'above',
							'settings' => array(),
							'type' => 'hidden',
							'weight' => 1
					),
			),
			'required' => 0,
			'settings'=> array(
					'text_processing' => '1',
					'user_register_form' => false
			),
	);	
	
	return $instances;
}
?>