<?php
class AdminController extends BaseController
{
    private $db;

    function __construct($model, $controller, $action, $api = false)
    {
        parent::__construct($model, $controller, $action, $api);
        if (!isset($this->db)) {
            $this->db = new Product();
        }
    }

    function manage()
    {
        if (!(isset($_SESSION['is_admin']) && $_SESSION['is_admin'])) {
            show_404();
        } else {
            $this->set("category", $this->getCategory());
            $this->set("subcategory", $this->getSubcategory());
        }
    }

    function view($offset = 1, $limit = 5)
    {
        if (!(isset($_SESSION['is_admin']) && $_SESSION['is_admin'])) {
            show_404();
        }
        $return = new Message();
        $data = $this->db->page(($offset - 1) * $limit, $limit);
        if ($data != null) {
            $return->success = true;
            $return->data['data'] = $data;
            $return->data['total'] = $this->db->getTotal()[""]["total"];
        } else {
            $return->message = "Error when fetch data from server";
        }
        $this->set("message", $return->getMesage());
    }
    function add()
    {
        if (!(isset($_SESSION['is_admin']) && $_SESSION['is_admin'])) {
            show_404();
        } else {
            $data = new Message(false, "Unknown Error");
            if ($_POST != null) {
                $this->db->insert_one($_POST);
                if ($this->db->getInserted() != 0)
                    $data->success = true;
                else
                    $data->success = false;
            }
            $this->set("message", $data->getMesage());
        }
    }
    function edit()
    {
        if (!(isset($_SESSION['is_admin']) && $_SESSION['is_admin'])) {
            show_404();
        } else {
            $data = new Message(true);
            if ($_POST != null) {
                $this->db->update_one($_POST);
                if ($this->db->affected_rows() > 0)
                    $data->success = true;
                else
                    $data->success = false;
            }
            $this->set("message", $data->getMesage());
        }
    }
    private function getCategory()
    {
        $query = "select id,name from categories;";
        return $this->db->query($query);
    }
    private function getSubcategory()
    {
        $query = "select id,name from subcategory;";
        return $this->db->query($query);
    }
}
