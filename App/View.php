<?php
require 'App/Models/Upload.php';

class View
{
    public function index()
    {
        $model = new Upload();
        $_model = $model->Read();
        $Result = $_model->fetchALL();
        return $Result;
    }
}
