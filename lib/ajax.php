<?php
class Message
{
    public $success;
    public $message;
    public $data;

    function __construct($success = false, $message = "", $data = null)
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

    function getMesage()
    {
        if ($this->success) {
            return json_encode(array(
                "success" => $this->success,
                "data" => $this->data,
            ));
        } else {
            return json_encode(array(
                "success" => $this->success,
                "message" => $this->message,
            ));
        }
    }
}
