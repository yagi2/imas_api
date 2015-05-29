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
  
  // メインAPI
  public function get_find()
  {
    // パラメータの受取
    $ipt = Input::all();
    
    $ch_params['name']             = Input::get('ch_name',             null);
    $ch_params['name_ruby']        = Input::get('ch_name_ruby',        null);
    $ch_params['birth_month']      = Input::get('ch_birth_month',      null);
    $ch_params['birth_day']        = Input::get('ch_birth_day',        null);
    $ch_params['type']             = Input::get('type',                null);
    $cv_params['name']             = Input::get('cv_name',             null);
    $cv_params['name_ruby']        = Input::get('cv_name_ruby',        null);
    $cv_params['birth_month']      = Input::get('cv_birth_month',      null);
    $cv_params['birth_day']        = Input::get('cv_birth_day',        null);
    $nn_params['nickname']         = Input::get('nickname',            null);
    $pd_params['name']             = Input::get('production',          null);
    $pd_params['president']        = Input::get('president',           null);
    
    $all_params['ch_prams'] = $ch_params;
    $all_params['cv_prams'] = $cv_params;
    $all_params['nn_prams'] = $nn_params;
    $all_params['pd_prams'] = $pd_params;
    
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
      $result['result']['code'] = 200;
      $result['result']['message'] = "";
      $result['input_params'] = $ipt;
      
      // ここでパラメータに合ったキャラクターデータ，声優データ，ニックネームデータ，プロダクションデータを返す。
      $result['list']['character'] = DB::select()->from('imas_characters')->where('name', $ch_params['name'])->execute()->as_array();
      $result['list']['cv'] = DB::select()->from('imas_cvs')->where('name', $cv_params['name'])->execute()->as_array();
      $result['list']['nickname'] = DB::select()->from('imas_nicknames')->where('nickname', $nn_params['nickname'])->execute()->as_array();
      $result['list']['production'] = DB::select()->from('imas_productions')->where('name', $pd_params['name'])->execute()->as_array();
      
      // 返却数
      $result['result']['count']['character']  = count($result['list']['character']);
      $result['result']['count']['cv']         = count($result['list']['cv']);
      $result['result']['count']['nickname']   = count($result['list']['nickname']);
      $result['result']['count']['production'] = count($result['list']['production']);
    
      $this->response($result);
    }
  }
}
