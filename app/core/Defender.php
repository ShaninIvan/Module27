<?php
    class Defender{
        // экранирование значений $_POST
        public function hscPost(){
            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES,"UTF-8");
            }
        }
    }   
?>
