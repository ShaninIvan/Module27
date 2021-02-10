<?php
    class Router{
        public function __construct()
        {
            $this->routes = include(ROOT . '/app/config/ruotes.php');
            $this->URIRoutes = $this->routes['URIRoutes'];
            $this->submitRoutes = $this->routes['submitRoutes'];
            $this->AJAXRoutes = $this->routes['AJAXRoutes'];
        }
        
        // Определение типов запросов
        public function run(){
            if(array_key_exists('AJAX', $_POST)){
                $this->AJAXRequest();
                exit;
            }
            
            // Если происходит отправка формы, она обрабатывается и происходит редирект на тот же URI, чтобы убрать
            // возможность повторной отправки. После этого загружается контент согласно URI
            if(array_key_exists('submit', $_POST)){
                $this->submitRequest();
                header('location: ' . $_SERVER["REQUEST_URI"]);
            }else{
                $uri = $_SERVER['REQUEST_URI'];
                $this->URIRequest($uri);
            }    
        }

        private function submitRequest(){
            $request = $_POST['submit'];
            foreach($this->submitRoutes as $key => $route){
                if($request == $key){
                    $segments = explode('/', $route);
                    $name = ucfirst(array_shift($segments));
                    $modelName = $name . 'Model';
                    $modelFile = MODELS . '/submit/' . $modelName . '.php';
                    $actionName = 'action' . ucfirst(array_shift($segments));;
                    if(file_exists($modelFile)){
                        require_once($modelFile);
                        $model = new $modelName;
                        $model->$actionName();
                    }
                    break;
                }
            }
        }

        private function URIRequest($uri){
            // Перебирать маршруты по регулярному выражению, пока не будет совпадения с URI
            foreach($this->URIRoutes as $pattern => $route){
                if(preg_match("~$pattern~i", $uri)){
                    // Интерпретация маршрута по принципу "контроллер/дейстие"
                    $segments = explode('/', $route);
                    $name = ucfirst(array_shift($segments));
                    $controllerName = $name . 'Controller';
                    $controllerFile = CONTROLLERS . $controllerName . '.php';
                    $actionName = 'action' . ucfirst(array_shift($segments));

                    // Вызов контроллера и действия show
                    if(file_exists($controllerFile)){
                        require_once($controllerFile);

                        $controller = new $controllerName($name);
                        $controller->$actionName();
                    }

                    break;
                }
            }
        }

        private function AJAXRequest(){
            $request = $_POST['AJAX'];
            foreach($this->AJAXRoutes as $key => $route){
                if($request == $key){
                    $segments = explode('/', $route);
                    $name = ucfirst(array_shift($segments));
                    $controllerName = $name . 'Controller';
                    $controllerFile = CONTROLLERS . 'AJAX/' . $controllerName . '.php';
                    $actionName = 'action' . ucfirst(array_shift($segments));;
                    if(file_exists($controllerFile)){
                        require_once($controllerFile);
                        $controller = new $controllerName;
                        $controller->$actionName();
                    }
                    break;
                }
            }
        }
    }
?>
