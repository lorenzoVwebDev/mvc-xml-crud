<?php 
class Dog_entity {

  private $task_title = "";
  private $task_description = "";
  private $task_duedate = "";
  private $task_priority = "";
  private $error_message = "";
  private $allowed_priorities = array (
    'low',
    'medium',
    'high'
  );

  function __construct($properties_array) {
    $error_title = $this->set_task_title($properties_array[0]) == true ? 'true,' : 'false,';
    $error_description = $this->set_task_description($properties_array[1]) == true ? 'true,' : 'false,';
    $error_duedate = $this->set_task_duedate($properties_array[2]) == true ? 'true,' : 'false,';
    $error_priority = $this->set_task_priority($properties_array[3]) == true ? 'true,' : 'false,';

    $this->error_message = $error_title.$error_description.$error_duedate.$error_priority;
  }
  //returns the error message
  public function to_string() {
    return $this->error_message;
  }
  //setMethods
  public function set_task_title(string $value):bool {
    $error_message = true;
    (ctype_alpha($value) && (strlen($value) <= 20)) ? $this->task_title = $value : $error_message = false;
    return $error_message;
  }

  public function set_task_description(string $value):bool {
    $error_message = true;
    (is_string($value)&&(strlen($value)>5&&strlen($value)<100)) ? $this->task_description=$value:$error_message=false;
    return $error_message;
  }

  public function set_task_duedate(string $date):bool {
      $setDate = date_create($date);
      $logDate = date_format($setDate, "YmdHis");
      $dateBool = true;
      if ($logDate < date("YmdHis")) {
        $dateBool = false
      } 

      $dateBool ? $this->task_duedate = $date : $error_message=false;
      return $error_message;
  }

  public function set_task_priority($value) {
    $error_message = true;
    $priorities_array=$this->allowed_priorities;

    foreach($priorities_array as $priority) {
      if ((strcasecmp($value, $priority)==0)) {
        $this->task_priority=$value;
        return $error_message;
      }
    }
    $error_message=false;
    return $error_message;
  }

  //breed validator method

  function get_task_title() {
    return $this->dog_name;
  }

  function get_task_description() {
    return $this->dog_weight;
  }

  function get_task_duedate() {
    return $this->dog_breed;
  }

  function get_task_priority() {
    return $this->dog_color;
  }

  function get_properties() {
    return "$this->task_title"." "."$this->task_description"." "."$this->task_duedate"." "."$this->task_priority.";
  }
  
}
