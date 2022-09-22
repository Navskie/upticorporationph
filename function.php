<?php 
 function flash($name, $text = '') {
     if(isset($_SESSION[$name])) {
         $alert = $_SESSION[$name];
         unset($_SESSION[$name]);
         return $alert;
     } else {
         $_SESSION[$name] = $text;
     }
     return '';
 }
?>