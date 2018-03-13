<?php

namespace Core;

/**
 * Controller
 */
class ControllerBase
{
    use Helpers;

    public function __construct()
    {
    }

    public function view($view, $data)
    {
        foreach ($data as $id_assoc => $value) {
            ${$id_assoc} = $value;
        }

        require_once "views/$view/View.php";
    }

    public function redirect($controller="home", $action="index")
    {
        \header("Location:index.php?controller=$controller&action=$action");
    }
}
