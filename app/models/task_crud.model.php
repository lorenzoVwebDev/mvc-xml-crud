<?php

class Task_data {
  public $task_array = array();
  public $task_data_xml = '';

  function __construct() {
      libxml_use_internal_errors(true);
      $xmlDoc = new DOMDocument();
    if (file_exists(__DIR__."//..//config//applications.xml")) {
      $xmlDoc->load(__DIR__."//..//config//applications.xml");
      $nodeValueArray = $xmlDoc->getElementByTagName('type');

      foreach ($nodeValueArray as $nodeValue) {
        $value = $nodeValue->getAttributeByName('ID'); 
        if ($value === 'task_data_storage') {
          $xmlLocation = $nodeValue->getElementByTagName('location');
          $this->task_data_xml = $xmlLocation->item(0)->nodeValue;
          break;
        }
      }     
    } else {
      throw new Exception("application.xml not found", 500);
    }

    $xmlfile = file_get_contents($this->task_data_xml);
    $xmlstring = simplexml_load_string($xmlfile);
    if ($xmlstring === false) {
      $errorString = "Failed loading XML: ";

      foreach(libxml_get_errors() as $error) {
        $errorString .= $error->message . " ";
      }

      throw new Exception($errorString);
    }
    $json = json_encode($xmlstring);
    $this->task_array = json_decode($json, TRUE);
  } 
}