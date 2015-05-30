<?php

class Controller_Imas_Info extends Controller_Rest
{
  protected $format = 'json';
  
  // デバッグ用 全データベースの全データを返す
  public function get_debug()
  {
    $result['character'] = Model_Imas_Character::find('all');
    $result['cv'] =  Model_Imas_Cv::find('all');
    $result['nickname'] = Model_Imas_Nickname::find('all');
    $result['production'] = Model_Imas_Production::find('all');
    
    $result += array('result' => count($result));
    
    $this->response($result); 
  }
  
  // 無効なパラメータの存在チェック 存在している場合は無効なパラメータを返す そうでない場合は0を返す。
  public function invalid_check($all_params, $use_params)
  {
    $result = array();
    foreach($all_params as $a_key => $a_value){
      $invalid_flag = true;
      foreach($use_params as $u_key => $u_value){
        foreach($u_value as $u_key2 => $u_value2){
          if ($a_value == $u_value2) {
            $invalid_flag = false;
            break;
          }
        }
        if (!($invalid_flag)) break;
      }
      if ($invalid_flag || $a_value == null) $result[$a_key] = $a_value;
    }
    
    if (count($result) == 0){
      return 0;
    }
    else {
      return $result;
    }
  }
  
  // リザルトメッセージを作成する。
  public function create_result($code, $message)
  {
    $result['result']['code'] = $code;
    $result['result']['message'] = $message;
    
    return $result;
  }
  
  public function find_data($ch_params, $table) {
    $result = array();
    
    foreach($ch_params as $key => $value){
      if($value != null) $result += DB::select()->from($table)->where($key, $value)->execute()->as_array();  
    }
    
    return $result;
  }
  
  // メインAPI
  public function get_find()
  {
    // パラメータの受取
    $ipt = Input::all();
    
    $params['character']['name']             = Input::get('ch_name',             null);
    $params['character']['name_ruby']        = Input::get('ch_name_ruby',        null);
    $params['character']['birth_month']      = Input::get('ch_birth_month',      null);
    $params['character']['birth_day']        = Input::get('ch_birth_day',        null);
    $params['character']['blood_type']       = Input::get('ch_blood_type',       null);
    $params['character']['color']            = Input::get('ch_color',            null);
    $params['character']['type']             = Input::get('type',                null);
    $params['cv']['name']                    = Input::get('cv_name',             null);
    $params['cv']['name_ruby']               = Input::get('cv_name_ruby',        null);
    $params['cv']['birth_month']             = Input::get('cv_birth_month',      null);
    $params['cv']['birth_day']               = Input::get('cv_birth_day',        null);
    $params['nickname']['nickname']          = Input::get('nickname',            null);
    $params['production']['name']            = Input::get('production',          null);
    $params['production']['president']       = Input::get('president',           null);
    
    $all_params['ch_params'] = $params['character'];
    $all_params['cv_params'] = $params['cv'];
    $all_params['nn_params'] = $params['nickname'];
    $all_params['pd_params'] = $params['production'];
    
    // 無効なパラメータが存在していないかチェックしてから内部処理
    $invalid = $this->invalid_check($ipt, $all_params);
    if($invalid != 0){
      $result = $this->create_result(401, "無効なパラメータが指定されています。");
      $result['invalid_params'] = $invalid;
      
      $this->response($result); 
    }
    else if (count($ipt) == 0){
      $result = $this->create_result(400, "パラメータが指定されていません。");
      
      $this->response($result);
    }
    else {
      // この部分を共通化してでメソッドで切り出したい。
      $result = $this->create_result(200, "");
      $result['input_params'] = $ipt;
      
      // ここでパラメータに合ったキャラクターデータ，声優データ，ニックネームデータ，プロダクションデータを返す。
      foreach($params as $key => $value) {
          $result['list'][$key] = $this->find_data($params[$key], 'imas_'.$key.'s');
      }
      
      // 返却数
      foreach($result['list'] as $key => $value) {
        $result['result']['count'][$key] = count($result['list'][$key]);
      }
      
      $this->response($result);
      
    }
  }
}
