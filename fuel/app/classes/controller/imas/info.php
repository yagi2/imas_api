<?php

class Controller_Imas_Info extends Controller_Rest
{
  protected $format = 'json';
  
  public function get_debug()
  {
    $result['character'] = Model_Imas_Character::find('all');
    $result['cv'] =  Model_Imas_Cv::find('all');
    $result['nickname'] = Model_Imas_Nickname::find('all');
    $result['production'] = Model_Imas_Production::find('all');
    
    $result += array('result' => count($result));
    
    $this->response($result); 
  }
  
  // 無効なパラメータの存在チェック 存在していた場合は1を返す
  public function invalid_check()
  { 
    return 0;
  }
  
  // エラーメッセージを作成してjsonで返す。
  public function create_error($code, $message)
  {
    $result['error_code'] = $code;
    $result['message'] = $message;
    
    $this->response($result);
  }
  
  // メインAPI
  public function get_find()
  {
    // パラメータの受取
    $ipt = Input::all();
    
    //print_r($ipt);
    
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
    
    $all_params['ch_params'] = $ch_params;
    $all_params['cv_params'] = $cv_params;
    $all_params['nn_params'] = $nn_params;
    $all_params['pd_params'] = $pd_params;
    
    // 無効なパラメータが存在していないかチェックしてから内部処理
    if($this->invalid_check()){
      $this->create_error(999, "テストエラー");
    }
    else {
      $debug['ch_params'] = $ch_params;
      $debug['cv_params'] = $cv_params;
      $debug['nn_params'] = $nn_params;
      $debug['pd_params'] = $pd_params;
      $debug += array('result' => count($ipt));
    
      $this->response($all_params);
    }
  }
}
