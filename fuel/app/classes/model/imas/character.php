<?php

class Model_Imas_Character extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'type',
		'character_name',
	        'character_name_ruby',
		'character_family_name',
		'character_family_name_ruby',
		'character_first_name',
		'character_first_name_ruby',
		'character_birth_month',
		'character_birth_day',
		'character_gender',
		'is_idol',
		'character_blood_type',
		'character_color',
		'cv_name',
		'cv_name_ruby',
		'cv_family_name',
		'cv_family_name_ruby',
		'cv_first_name',
		'cv_first_name_ruby',
		'cv_birth_month',
		'cv_birth_day',
		'cv_gender',
		'cv_nickname',
	);
	protected static $_table_name = 'imas_characters';

}
