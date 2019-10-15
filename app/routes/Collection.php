<?php

class Collection
{
    private $prefix;

    private $handler;

    private $get = [];

    private $put = [];

    private $post = [];

    private $delete = [];

    function __construct($prefix = null) {
        if ($prefix) {
            $this->prefix = $prefix;
        }
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function setHandler($handler)
    {
        $this->handler = $handler;
        return $this;
    }

    public function getGet()
    {
        return $this->get;
    }

    public function setGet($route, $method)
    {
        $route = "$this->prefix$route";
        $route = "~$route~";

        $this->get[$method] = $route;
        return $this;
    }

    public function getPut()
    {
        return $this->put;
    }

    public function setPut($route, $method)
    {
        $route = "$this->prefix$route";
        $route = "~$route~";

        $this->put[$method] = $route;
        return $this;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($route, $method)
    {
        $route = "$this->prefix$route";
        $route = "~$route~";

        $this->post[$method] = $route;
        return $this;
    }

    public function getDelete()
    {
        return $this->delete;
    }

    public function setDelete($route, $method)
    {
        $route = "$this->prefix$route";
        $route = "~$route~";

        $this->delete[$method] = $route;
        return $this;
    }
}