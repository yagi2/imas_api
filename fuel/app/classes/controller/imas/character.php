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
    // そのうちcheck_result()とresult_check()は共通部分に移す
    // check_result() : 結果で一致一致しないものを削除
    function check_result($param_name, $res_array, $res_array_tmp, $params) {
      if (empty($res_array)) {
        $res_array = $res_array_tmp;
      }
      else {
        foreach ($res_array as $key => $value) {
          if ($value[$param_name] != $params[$param_name]) unset($res_array[$key]);
        }
      }
      return $res_array;
    }
    // result_get() : DBからする結果を取得する
    function result_get($params, $param_key, $res_array) {
      if ($params[$param_key] != null) {
        $query = DB::select()->from('imas_characters')->where($param_key, $params[$param_key]);
        $res_tmp = $query->execute()->as_array();
        
        $res_array = check_result($param_key, $res_array, $res_tmp, $params);
        
        return $res_array;
      }
      return $res_array;
    }
    
    $ipt = Input::all();
    $arr = array_filter($ipt, 'strlen');

    $params['id']             = Input::get('id',             null);
    $params['type']           = Input::get('type',           null);
    $params['ch_name']        = Input::get('ch_name',        null);
    $params['ch_birth_month'] = Input::get('ch_birth_month', null);
    $params['ch_birth_day']   = Input::get('ch_birth_day',   null);
    $params['ch_gender']      = Input::get('ch_gender',      null);
    $params['is_idol']        = Input::get('is_idol',        null);
    $params['ch_blood_type']  = Input::get('ch_blood_type',  null);
    $params['ch_color']       = Input::get('ch_color',       null);
    $params['cv_name']        = Input::get('cv_name',        null);
    $params['cv_birth_month'] = Input::get('cv_birth_month', null);
    $params['cv_birth_day']   = Input::get('cv_birth_day',   null);
    $params['cv_gender']      = Input::get('cv_gender',      null);
    $params['cv_nickname']    = Input::get('cv_nickname',    null);
   
    $res = array();
    
    // パラメータを渡さない場合はすべて返す
    if (empty($arr)) $this->response(Model_Imas_Character::find('all'));
    
    $res = result_get($params, "id",             $res);
    $res = result_get($params, "type",           $res);
    $res = result_get($params, "ch_name",        $res);
    $res = result_get($params, "ch_birth_month", $res);
    $res = result_get($params, "ch_birth_day",   $res);
    $res = result_get($params, "ch_gender",      $res);
    $res = result_get($params, "is_idol",        $res);
    $res = result_get($params, "ch_blood_type",  $res);
    $res = result_get($params, "ch_color",       $res);
    $res = result_get($params, "cv_name",        $res);
    $res = result_get($params, "cv_birth_month", $res);
    $res = result_get($params, "cv_birth_day",   $res);
    $res = result_get($params, "cv_gender",      $res);
    $res = result_get($params, "cv_nickname",    $res);

    $this->response($res);
  }
}
