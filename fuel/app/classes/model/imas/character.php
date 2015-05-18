<?php

class Model_Imas_Character extends \Orm\Model
{
	protected static $_properties = array(
		'id',                   //
		'type',					//
		'ch_name',				//
	    'ch_name_ruby',
		'ch_family_name',
		'ch_family_name_ruby',
		'ch_first_name',
		'ch_first_name_ruby',
		'ch_birth_month',		//
		'ch_birth_day',			//
		'ch_gender',			//
		'is_idol',				//
		'ch_blood_type',		//
		'ch_color',				//
		'cv_name',				//
		'cv_name_ruby',
		'cv_family_name',
		'cv_family_name_ruby',
		'cv_first_name',
		'cv_first_name_ruby',
		'cv_birth_month',		//
		'cv_birth_day',			//
		'cv_gender',			//
		'cv_nickname',			//
	);
	protected static $_table_name = 'imas_characters';

}
