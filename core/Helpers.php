<?php

namespace Core;

/**
 * Helpers
 */
trait Helpers
{

    /**
     * 
     */
    public function url($action, $code = null)
    {
        if (isset($code))
        {
            return "index.php?action=$action&code=$code";    
        }

        return "index.php?action=$action";
    }
    

    private function runRequestAction($controller, $action)
    {
        $controller->$action();
    }


    public function getController($requestController = "home")
    {
        $controller = "\Controller\\".\ucwords($requestController)."Controller";
        
        return new $controller();
    }

    public function requestAction($controller)
    {
        if (isset($_GET["action"]) && method_exists($controller, $_GET["action"])) {
            $this->runRequestAction($controller, $_GET["action"]);
        } else {
            $this->runRequestAction($controller, "index");
        }
    }
}
