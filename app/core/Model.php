<?php
class Model {
  use Database;
  public $givenDate = '';
  function __construct() {
    $this->givenDate = date('mdy');
  }
  
  function logEvent($log_message, $log_type, $log_event = 'write') {
    try {
      if (file_exists(__DIR__ ."//..//models//logs.model.php")) {
        require_once(__DIR__ ."//..//models//logs.model.php");

        $event_log = new Logs_model($log_message, $log_type);
        if ($log_event === 'write') {
          $event_log_method = "log".ucfirst($log_type);
          $last_log_message = $event_log->$event_log_method();
          unset($event_log);
          if ($last_log_message[0] === 500) {
            $error_message = $last_log_message;
            return $error_message;
          } else {
            return $last_log_message;
          }
        } else if ($log_event === 'delete') {
            $delete_log = new Logs_model('', $log_type);
            $log_deleted = $delete_log->deleteLog($log_message);
            if ($log_deleted === 'log deleted') {
              return $log_deleted;
            } else {
              throw new Exception();
            }
        }
      } else {
        throw new Exception('logs.model.php not found');
      } 
    } catch (Exception $e) {
      require_once(__DIR__ ."//..//models//logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $exception->logException();
      return $e;
    } 
  } 

  function logsArray($logType, $date = null) {
    try {
      if (file_exists(__DIR__ ."//..//models//logs_array.model.php")) {
        require_once(__DIR__ ."//..//models//logs_array.model.php");
        $array_creation = new Logs_array_model($logType);
        $array_creation_method = "array".ucfirst($logType);
        $logArray = $array_creation->$array_creation_method($date);
        unset($array_creation);
        if (is_array($logArray)) {
          return $logArray;
        } else {
          $error_message = $logArray;
          return $error_message;
        }
      } else {
        throw new Exception('logs_array.model.php not found');
      } 
    } catch (Exception $e) {
      require_once(__DIR__ ."//..//models//logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $exception->logException();
      return $e->getMessage();
    } 
  }

  function sendMail($infoArray = []) {
    if ($infoArray[0] === 'table-mail') {
      if (file_exists(__DIR__."//..//models//tablemail.model.php")) {
        require_once(__DIR__."//..//models//tablemail.model.php");
        $name = $infoArray[1];
        $surname = $infoArray[2];
        $logdate = $infoArray[3];
        $type = $infoArray[4];
        $mail = $infoArray[5];
        $table = $infoArray[6];
        $tablemail = new Table_mail([$name, $surname, $logdate, $type, $mail, $table]);
        $result = $tablemail->sendTableMail();
        if ($result === 'sent') {
          return true;
        } else {
          return false;
        }
      }
    } 
  }

  function taskCrud(array $taskArray, $type = 'read') {
      if (file_exists(__DIR__."//..//models//entities//task.entity.php")) {
        require_once(__DIR__."//..//models//entities//task.entity.php");
        if ($type === 'insert') {
          $taskObject = new Task_entity($taskArray);
          $inserted =  $taskObject->insert_data($type);
          if ($inserted === 'inserted') {
            return $taskArray;
          } 
        }

      } else {
        throw new Exception('task.entity.php not found', 500);
      }
  }
}