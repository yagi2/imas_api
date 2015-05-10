<?php

class Controller_Imas_Character extends Controller_Rest
{
  protected $format = 'json';
  
  public function object_merge(&$obj1, &$obj2, &$result)
  {
    $vars = get_object_vars($obj1);
    foreach ($vars as $key => $val){
      $result->$key = $val;
    }
    $vars = get_object_vars($obj2);
    foreach ($vars as $key => $val){
      $result->$key = $val;
    }
    return $result;
  }

  public function get_list()
  {
    $ipt = Input::all();
    $arr = array_filter($ipt, 'strlen');

    $params['id']         = Input::get('id',         null);
    $params['type']       = Input::get('type',       null);
    $params['c_name']     = Input::get('c_name',     null);
    $params['c_month']    = Input::get('c_month',    null);
    $params['c_day']      = Input::get('c_day',      null);
    $params['c_gender']   = Input::get('c_gender',   null);
    $params['is_idol']    = Input::get('is_idol',    null);
    $params['c_blood']    = Input::get('c_blood',    null);
    $params['c_color']    = Input::get('c_color',    null);
    $params['v_name']     = Input::get('v_name',     null);
    $params['v_month']    = Input::get('v_month',    null);
    $params['v_day']      = Input::get('v_day',      null);
    $params['v_gender']   = Input::get('v_gender',   null);
    $params['v_nichname'] = Input::get('v_nickname', null);

    if (empty($arr)) $this->response(Model_Imas_Character::find('all'));
    if ($params['id'] != null){
      $query = DB::select()->from('imas_characters')->where('id', $params['id']);
      $res   = $query->execute()->as_array();
      $this->response($res);
    }
    if ($params['c_name'] != null) {
      $query = DB::select()->from('imas_characters')->where('ch_name', $params['c_name']);
      $res   = $query->execute()->as_array();
      $this->response($res);
    }

    /*
    if ($params['type'] != null){
      $query = DB::select()->from('imas_characters')->where('type', $params['type']);
      $res   = $query->execute()->as_array();
      $this->response($res);
      }
    if ($params['c_month'] != null){
      $query = DB::select()->from('imas_characters')->where('ch_birth_month', $params['c_month']);
      $res   = $query->execute()->as_array();
      $this->response($res);
    }
    */

    /*
     if (!empty($arr)){
      if ($params['id'] != null){
	$id = Model_Imas_Character::find(array('id' => $params['id']));
      }
      if ($params['type'] != null){
	$type = Model_Imas_Character::find(array('type' => $params['type']));	  
      }
    
      $this->object_merge($id, $type, $characters);
      $this->response($characters);
    }
    else {
    */
    //      $characters = Model_Imas_Character::find('all');
    // $this->response($characters);
      // }
  }
}
