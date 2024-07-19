<?php

require_once 'application/models/Orders.model.php'; 

class BaseController
{
    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_template;

    function __construct($model, $controller, $action, $api = false)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_model = $model;

        if (class_exists($model)) {
            $this->$model = new $model;
        } else {
            throw new Exception("Class $model not found");
        }
        
        $this->_template = new Template($controller, $action, $api);
    }

    function set($name, $value)
    {
        $this->_template->set($name, $value);
    }

    function __destruct()
    {
        $this->_template->render();
    }
    protected function redirect($controller, $action)
    {
        header("Location: ?url=$controller/$action");
        exit();
    }
}
?>
