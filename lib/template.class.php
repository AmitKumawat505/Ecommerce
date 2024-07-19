<?php
class Template
{

    protected $variables = array();
    protected $_controller;
    protected $_action;
    protected $_api;
    function __construct($controller, $action, $api)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_api = $api;
    }

    /** Set Variables **/

    function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /** Display Template **/

    function render()
    {
        if (!($this->_api || $this->_controller == "user")) {
            require VIEWPATH . "base/header.php";
        }
        if (is_file(VIEWPATH . $this->_controller . '/' . $this->_action . '.php')) {
            extract($this->variables);
            include(VIEWPATH . $this->_controller . '/' . $this->_action . '.php');
        } else
            show_404();

        if (!($this->_api || $this->_controller == "user")) {
            require VIEWPATH . "base/footer.php";
        }
    }
}
