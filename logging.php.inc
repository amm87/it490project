<?php

class errorLogger
{
  private $fp;
  
  
  public function __construct($outputfile = "/home/anthony/git/it490project/error.log")
  {
    $this->fp = fopen($outputfile,"a");
  }
  public function log($message)
  {
    fwrite($this->fp,$message.PHP_EOL);
  }
  public function __destruct()
  {
    fclose($this->fp);
  }
  
  
  public function logArray($info){
  $request = array();
  $request['type'] = "error";
  $request['error'] = $info;
  
  return $request;
  }
  
}
?>