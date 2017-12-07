<?php
class errorLogger
{
  private $fp;
  
    /**
    * Constructing a path to put the error logs in
    * @param is the path you are putting the log in
    */
  public function __construct($outputfile = "/home/anthony/git/it490project/error.log")
  {
    $this->fp = fopen($outputfile,"a");
  }
  
    /**
    * add strings to the error log file
    * @param is a error message string
    */
  public function log($message)
  {
    fwrite($this->fp,$message.PHP_EOL);
  }
  
    /**
    * Cleans up the log once it is done
    */
  public function __destruct()
  {
    fclose($this->fp);
  }
  
    /**
    * add strings to an array for recording purposes
    * @param is the info we are adding to the array
    */
  public function logArray($info){
  $request = array();
  $request['type'] = "error";
  $request['error'] = $info;
  
  return $request;
  }
  
}
?>
