<?php

class Controller_Shampoo_Cv extends Controller_Rest
{
  protected $format = 'json';
  
  // 無効なパラメータの存在チェック 存在している場合は無効なパラメータを返す そうでない場合は0を返す。
  public function invalid_check($all_params, $use_params)
  {
    $result = array();
    foreach($all_params as $a_key => $a_value){
      $invalid_flag = true;
      foreach($use_params as $u_key => $u_value){
        if ($a_value == $u_value) {
          $invalid_flag = false;
          break;
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
  
  // デバッグ用 全データベースの全データを返す
  public function get_debug()
  {
    $result['cv'] =  Model_Shampoo_Cv::find('all');
    $result['shampoo'] = Model_Shampoo_Shampoo::find('all');
    
    $result += array('result' => count($result));
    
    $this->response($result); 
  }
  
  // シャンプー検索
  public function get_cv ()
  {
    $ipt = Input::all();
    
    $params['cv_name'] = Input::get('name', null);
    $all_params['cv_name'] = $params['cv_name'];
    
    // 無効なパラメータチェック
    $invalid = $this->invalid_check($ipt, $all_params);
    if ($invalid != 0 || count($ipt) == 0) {
      $result = $this->create_result(401, "無効なパラメータが指定されているか，パラメータが空です。");
      $result['invalid_params'] = $invalid;
      
      $this->response($result);
    }
    else {
      $result = $this->create_result(200, "正常に処理が終了しました。");
      $result['input_params'] = $ipt;
      
      // 受け取った名前のシャンプーIDを取得
      $id = DB::select()->from('sh_cv_list')->where('name', $params['cv_name'])->execute()->as_array();
      
      if ((count($id)) == 0) {
        // そもそも受け取った名前がDBに存在しないとき        
        $result = $this->create_result(401, "一致するデータがありません。");
        $result['input_params'] = $ipt;
      }
      else {
        // シャンプーIDからシャンプー名を取得
        $result_tmp = DB::select()->from('sh_shampoo_list')->where('sh_id', $id[0]['sh_id'])->execute()->as_array();
        $result['list']['shampoo'] = $result_tmp[0]['name'];
        
        // 要素カウント
        $result['result']['count']['shampoo'] = 1;
        
      }
      $this->response($result);
    }
  }
  
  // 使用者検索
  public function get_shampoo ()
  {
    $ipt = Input::all();
    
    $params['name'] = Input::get('name', null);
    $all_params['name'] = $params['name'];
    
    // 無効なパラメータチェック
    $invalid = $this->invalid_check($ipt, $all_params);
    if ($invalid != 0 || count($ipt) == 0) {
      $result = $this->create_result(401, "無効なパラメータが指定されているか，パラメータが空です。");
      $result['invalid_params'] = $invalid;
      
      $this->response($result);
    }
    else {
      $result = $this->create_result(200, "正常に処理が終了しました。");
      $result['input_params'] = $ipt;
      
      // シャンプーのシャンプーIDを取得
      $id = DB::select()->from('sh_shampoo_list')->where('name', $params['name'])->execute()->as_array();
      
      if ((count($id)) == 0) {
        // そもそも受け取った名前がDBに存在しないとき        
        $result = $this->create_result(401, "一致するデータがありません。");
        $result['input_params'] = $ipt;
      }
      else {
        // シャンプーIDからシャンプー名を取得
        $result_tmp = DB::select()->from('sh_cv_list')->where('sh_id', $id[0]['sh_id'])->execute()->as_array();
        
        $result['list']['cv'] = array();
        $i = 0;
        foreach($result_tmp as $key => $value) {
          $result['list']['cv'][$i] = array('cv_name' => $value['name']);
          $i++;
        }
        
        // 要素カウント
        foreach($result['list'] as $key => $value) {
          $result['result']['count']['cv'] = count($result['list']['cv']);
        }
        
        // 結果がないとき
        if ($result['result']['count']['cv'] == 0) {
          $result = $this->create_result(401, "一致するデータがありません。");
          $result['input_params'] = $ipt;
        }
      }
      $this->response($result);
    }
  }
}
