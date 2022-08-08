<?php
declare(strict_types=1);
namespace Katema\Router;

interface RouterInterface
{
    /**
     * add route to the routing table
     * @param string $route
     * @param array $parameters
     * @return void
     */
    public function add(string $route, array $parameters): void;

    /**
     * dispatches the route and create controller objects and execute default method
     * @param string $url
     * @return void
     */
    public function dispatch(string $url): void ;

}