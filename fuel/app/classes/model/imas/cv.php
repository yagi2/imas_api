<?php

class Model_Imas_Cv extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'other_name',
		'name_ruby',
		'family_name',
		'family_name_ruby',
		'first_name',
		'first_name_ruby',
		'birth_month',
		'birth_day',
		'gender',
		'is_active',
	);
	protected static $_table_name = 'imas_cvs';

}
