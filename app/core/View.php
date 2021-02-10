<?php
    class View{
        public function __construct($name, $args=null)
        {
            $this->file = $name;
            $this->args = $args;
        }

        public function generate(){
            include_once($this->file);
        }
    }
?>
