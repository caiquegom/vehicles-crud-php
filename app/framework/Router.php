<?php

namespace app\framework;

use Exception;

class Router
{
    public static array $params;
    private static string $uri;
    private static string $requestMethod;
    private static string $dynamicParamPattern = "/\{(.*)\}/";

    private static function loadController(string $controller, string $action): void
    {
        try {
            $controllerNamespace = "app\\controllers\\{$controller}";

            if (!class_exists($controllerNamespace)) {
                throw new Exception("O controller {$controller} não existe");
            }

            $controllerInstance = new $controllerNamespace();

            if (!method_exists($controllerInstance, $action)) {
                throw new Exception("A action {$action} não existe");
            }

            $controllerInstance->$action();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private static function getControllerFromDynamicRoute(array $routes): string
    {
        foreach ($routes[self::$requestMethod] as $endpoint => $controllerAction) {
            $uriParams = explode('/', self::$uri);
            $endpointParams = explode('/', $endpoint);

            if (count($uriParams) !== count($endpointParams)) continue;

            foreach ($endpointParams as $index => $endpointParam) {
                if (preg_match(self::$dynamicParamPattern, $endpointParam)) continue;

                if ($endpointParam !== $uriParams[$index]) break;

                if ($index == count($uriParams) - 1 ) return $controllerAction;
            }
        }

        return '';
    }

    private static function getDynamicParamsValue(array $routes, string $currentControllerAction): array
    {
        $dynamicParamsValue = [];

        $currentRoute = array_filter($routes[self::$requestMethod], function ($controllerAction, $endpoint) use ($currentControllerAction) {
            return $controllerAction == $currentControllerAction;
        }, ARRAY_FILTER_USE_BOTH);

        $uriParams =  explode("/", self::$uri);
        $currentUriParams = explode("/", array_key_first($currentRoute));

        foreach ($currentUriParams as $index => $param) {
            if (!preg_match(self::$dynamicParamPattern, $param)) continue;

            $paramName = preg_replace(self::$dynamicParamPattern, "$1", $param);
            $dynamicParamsValue[$paramName] = $uriParams[$index];
        }

        return $dynamicParamsValue;
    }

    public static function execute($routes): void
    {
        self::$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        self::$requestMethod = $_SERVER['REQUEST_METHOD'];

        if (!isset($routes[self::$requestMethod])) throw new Exception("O método HTTP não existe");

        if (array_key_exists(self::$uri, $routes[self::$requestMethod])) {
            [$controller, $action] = explode('@', $routes[self::$requestMethod][self::$uri]);
            self::$params = [];
        } else {
            $controllerAction = self::getControllerFromDynamicRoute($routes);

            if ($controllerAction) {
                [$controller, $action] = explode('@', $controllerAction);
                self::$params = self::getDynamicParamsValue($routes, $controllerAction);
            }
        }

        if (!isset($controller) || !isset($action)) throw new Exception("A rota não existe");

        self::loadController($controller, $action);
    }
}