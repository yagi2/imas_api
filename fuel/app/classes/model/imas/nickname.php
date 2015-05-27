<?php

class Model_Imas_Nickname extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nickname',
		'type',
		'idol_id',
		'cv_id',
	);
	protected static $_table_name = 'imas_nicknames';

}
