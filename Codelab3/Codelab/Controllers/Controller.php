<?php
namespace Controller;

class Controller{
    // Variable Atributes

    var $controllerName;
    var $controllerMethod;

    public function getControllerAttribute()
    {
        return[
            "ControllerName" => $this ->controllerName,
            "Method" => $this ->controllerMethod,
       ];
    }
}
