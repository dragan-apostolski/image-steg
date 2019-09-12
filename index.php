<?php

session_start();

require_once("controller/Controller.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "view/css/");
define("JS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "view/js/");
define("VENDOR_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "view/vendor/");
define("STEG_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "view/steganography-js/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
   "home" => function () {
        Controller::home();
    },
    "gallery" => function(){
        if(isset($_SESSION["edit_image"])) unset($_SESSION["edit_image"]);
        Controller::gallery();
    },
    "gallery/add" => function(){
        Controller::addImageToGallery();
    },
    "gallery/update" => function(){
        Controller::updateImageInGallery();
    },
    "gallery/edit" => function(){
        if ($_GET["action"] == "Edit"){
            Controller::editImage();
        }
        else{
            Controller::deleteImage();
        }
    },
    "login" => function(){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            Controller::login();
        } else {
            Controller::showLoginForm();
        }
    },
    "register" => function(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Controller::registerUser();
        } else {
        Controller::showRegisterForm();
        }
    },
    "profile" => function(){
        Controller::showEditProfileForm();
    },
    "profile/change" => function(){
        Controller::changeUserPassoword();
    },
    "logout" => function(){
        Controller::logOut();
    },
    "" => function(){
        ViewHelper::redirect(BASE_URL . "home");
    }
];

try {
    if (isset($urls[$path])) {
       $urls[$path]();
    }
    else {
        echo "No controller for '$path'";
    }
} 
catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // ViewHelper::error404();
} 
