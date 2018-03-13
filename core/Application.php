<?php 
namespace Core;

class Application
{
    use Helpers;

    public function launch()
    {
        $controller = $this->getController();
        $this->requestAction($controller);
    }
}
