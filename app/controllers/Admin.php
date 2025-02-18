<?php
class Admin extends Controller {
  public function dashboard($name) {
    $this->view($name);
  } 

  function taskcrud($type) {
    try {
      $crudArray = array (
        'insert',
        'select',
        'update',
        'delete'
      );

      $needle = in_array(filter_var($type, FILTER_SANITIZE_FULL_SPECIAL_CHARS), $crudArray);
      if (isset($_POST['task'])&&$needle) {    
        if ($type === 'insert') {
          if (isset($_POST['title'])&&isset($_POST['duedate'])) {
            $newTask['title'] = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $newTask['description'] = $_POST['description'] ? filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : 'none';
            $newTask['duedate'] = filter_var($_POST['duedate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            $newTask['priority'] = $_POST['priority'] ? filter_var($_POST['priority'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : 'none';

            $taskCrud = new Model();
            $inserted = $taskCrud->taskCrud($newTask, $type);
            if (is_array($inserted)) {
              http_response_code(200);
              header('Content-Type: application/json');
              $json = json_encode($inserted);
              echo $json; 
            } 

          } else {
            throw new Exception('title is missing', 401);
          }
        }
      } else {
        throw new Exception('form not valid', 401);
      }
    } catch (Exception $e) {
      if ($e->getCode() >= 400 && $e->getCode() < 500) {
        http_response_code($e->getCode());
        header('Content-Type: application/json');
        $response['result'] = $e->getMessage();
        $response['status'] = $e->getCode();
/*         echo json_encode($response); */
        require_once(__DIR__ ."//..//models//logs.model.php");
        $exception = new Logs_model($e->getMessage()." ".$e->getFile(), 'exception');
        $last_log_message = $exception->logException();
        unset($exception);
      } else {
        http_response_code(500);
        header('Content-Type: application/json');
        $response['result'] = 'We are sorry! We are goin to fix that as soon as possible';
        $response['status'] = 500;
/*         echo json_encode($response); */
        require_once(__DIR__ ."//..//models//logs.model.php");
        $exception = new Logs_model($e->getMessage()." ".$e->getFile(), 'exception');
        $last_log_message = $exception->logException();
        unset($exception);
      }
    }

  } 
}