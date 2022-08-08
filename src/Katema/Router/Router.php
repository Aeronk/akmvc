<?php
declare(strict_types=1);
namespace Katema\Router;
use Katema\Router\RouterInterface;

class Router implements  RouterInterface
{
    /*
    * Returns array of route from routing table
     */
    protected array $routes =[];
    /*
     * Returns an array of route parameters
     * @var array
      */
    protected array $params = [];
    /*
    * Adds suffix on a controller name
     * @var string
     */
    protected string $controllerSuffix = "controller";


    /**
     * add route to the routing table
     * @param string $route
     * @param array $parameters
     * @return void
     */
    public function add(string $route, array $parameters): void
    {
        $this->routes[$route]= $parameters;
    }

    /**
     * dispatches the route and create controller objects and execute default method
     * @param string $url
     * @return void
     */
    public function dispatch(string $url): void
    {
        if ($this->match($url)){

            $controllerString = $this->params['controller'];
            $controllerString = $this->transformUpperCamelCase($controllerString);

        }

    }

    public function transformUpperCamelCase( string  $string): string
    {
        return str_replace(' ','',ucwords(str_replace('-',' ',$string)));

    }

    /**
     * match the route to the routes in the routing table setting $this->params if route is found
     * @param $url
     * @return bool
     */
    private function match($url): bool{

        foreach ($this->routes as $route=>$params)
        {
            if (preg_match($route,$url,$matches)){
                foreach ($matches as $key =>$param){

                    if (is_string($key)){
                        $params[$key] = $param;
                    }
                }
                $this->params = $params;
                return true;
            }

        }
        return false;
    }
}