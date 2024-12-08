<?php

class Route
{
    private $routes = [];
    private $basePrefix;

    public function __construct($basePrefix = '')
    {
        $this->basePrefix = $basePrefix;
    }

    // Registrar ruta GET
    public function get($path, $callback)
    {
        $path = $this->basePrefix . $path;
        $this->routes['GET'][] = ['path' => $path, 'callback' => $callback];
    }

    // Registrar ruta POST
    public function post($path, $callback)
    {
        $path = $this->basePrefix . $path;
        $this->routes['POST'][] = ['path' => $path, 'callback' => $callback];
    }

    // Método para manejar las rutas
    public function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route) {
                $routePath = $this->prepareRouteRegex($route['path']);
                $matches = [];

                // Verificar si la ruta coincide
                if (preg_match($routePath, $currentPath, $matches)) {
                    // Extraer parámetros de la URL
                    array_shift($matches);
                    $params = array_combine($this->extractRouteParams($route['path']), $matches);

                    // Llamar al callback con los parámetros
                    call_user_func($route['callback'], $params);
                    return;
                }
            }
        }

        // Si no se encuentra la ruta
        http_response_code(404);
        require_once './src/views/errors/404.php';
    }

    // Método para agrupar rutas
    public function group($prefix, $callback)
    {
        $originalPrefix = $this->basePrefix;
        $this->basePrefix .= $prefix;
        $callback($this);
        $this->basePrefix = $originalPrefix;
    }

    // Convertir una ruta en un patrón regex
    private function prepareRouteRegex($path)
    {
        $path = preg_replace('/\//', '\/', $path);
        return '/^' . preg_replace('/:([a-zA-Z0-9_]+)/', '([a-zA-Z0-9_-]+)', $path) . '$/';
    }

    // Extraer los nombres de los parámetros de una ruta
    private function extractRouteParams($path)
    {
        preg_match_all('/:([a-zA-Z0-9_]+)/', $path, $matches);
        return $matches[1];
    }
}
