<?php

class Controller_Imas_Proto extends Controller_Rest
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
    
  public function get_cv()
  {
    $this->response(Model_Imas_Cv::find('all'));
  }
  
  public function get_idol()
  {
    $this->response(Model_Imas_Idol::find('all'));
  }
  
  public function get_nickname()
  {
    $this->response(Model_Imas_Nickname::find('all'));
  }
  
  public function get_prodcution()
  {
    $this->response(Model_Imas_Production::find('all'));
  }
}
