<?php

namespace Core;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function add(string $route, array $params = []): void
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = "/^{$route}$/i";

        $this->routes[$route] = $params;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $url
     * @return void
     */
    public function dispatch(string $url): void
    {
        $url = $this->removeQueryStringVars($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToPascalCase($controller);
            $controller = "App\\Controllers\\{$controller}";

            if (class_exists($controller)) {
                $controllerObj = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (is_callable([$controllerObj, $action])) {
                    $controllerObj->action();
                }
            }
        } else {
            // update later
        }
    }

    /**
     * @param string $url
     * @return string
     */
    protected function removeQueryStringVars(string $url): string
    {
        if ($url != '') {
            $vars = explode('&', $url, 2);

            if (!strpos($vars[0], '=')) {
                $url = $vars[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    /**
     * @param string $value
     * @return string
     */
    private function convertToPascalCase(string $value): string
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value)));
    }

    /**
     * @param string $value
     * @return string
     */
    private function convertToCamelCase(string $value): string
    {
        return strtolower($this->convertToPascalCase($value));
    }
}
