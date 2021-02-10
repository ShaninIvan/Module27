<?php
    abstract class Controller{
        public function __construct($name)
        {
            $this->name = $name;
            $this->modelFile = MODELS . $name . 'Model.php';
            $this->viewFile = VIEWS . $name . 'View.php';
        }

        public function actionShow(){
            if(file_exists($this->modelFile)){
                require_once($this->modelFile);
                $modelName = $this->name . 'Model';
                $model = new $modelName();
                $this->args = $model -> getResult();
            }

            if (file_exists($this->viewFile)){
                $view = new View($this->viewFile, $this->args);
                $view->generate();
            }
        }
    }
?>
