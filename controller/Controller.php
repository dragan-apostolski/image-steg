<?php 

require_once("model/Database.php");
require_once("ViewHelper.php");

class Controller {
    public static function home(){
        if($_SESSION["logged"]) {
            ViewHelper::render("view/home.php");
        }
        else{
            ViewHelper::redirect(BASE_URL . "login");
        }
    }

    public static function gallery(){
        if($_SESSION["logged"]) {
            $user_data = Database::getGalleryImages($_SESSION["username"]);
            ViewHelper::render("view/gallery.php", ["data" => $user_data]);
        }
        else{
            ViewHelper::redirect(BASE_URL . "login");
        }
    }

    public static function addImageToGallery(){
       if(isset($_POST["image"])){
           $username = $_SESSION["username"];
           $img_name = $_POST["imageName"];
           $img_data = $_POST["image"];
           $img_messages = $_POST["messages"];
           $used_capacity = $_POST["usedCapacity"];
           $result = Database::addImageToDb($username, $img_name, $img_data, $img_messages, $used_capacity);
           echo $result;
       }
    }

    public static function updateImageInGallery(){
        if(isset($_POST["image"])){
            $username = $_SESSION["username"];
            $img_name = $_POST["imageName"];
            $img_data = $_POST["image"];
            $img_messages = $_POST["messages"];
            $used_capacity = $_POST["usedCapacity"];
            $result = Database::updateImageInDb($username, $img_name, $img_data, $img_messages, $used_capacity);
            echo $result;
        }
    }

    public static function editImage(){
        $edit_image = Database::getImage($_GET["id"]);
        $_SESSION["edit_image"] = $edit_image;
        ViewHelper::redirect(BASE_URL . "home");
    }

    public static function deleteImage(){
        $image_id = $_GET["id"];
        Database::deleteImageFromDb($image_id);
        ViewHelper::redirect(BASE_URL . "gallery");
    }

    public static function login(){
        if (Database::validLoginAttempt($_POST["username"], $_POST["password"])) {
            $_SESSION["logged"] = True;
            $_SESSION["username"] = $_POST["username"];
            ViewHelper::redirect(BASE_URL . "home");
       } else {
            ViewHelper::render("view/login.php", 
                ["errorMessage" => "Invalid username or password."]);
       }
    }

    public static function showEditProfileForm(){
        ViewHelper::render("view/edit-profile.php");
    }

    public static function changeUserPassoword(){
        if(!Database::validLoginAttempt($_POST["username"], $_POST["current_password"])){
            ViewHelper::render("view/edit-profile.php", 
                ["errorMessage" => "Your current password is incorrect."]);
        }
        else{
            if (Database::changeUserPassword($_POST["username"], $_POST["new_password"])){
                ViewHelper::render("view/edit-profile.php", ["success" => "success"]);
            }
        }
    }

    public static function logOut(){
        session_destroy();
        ViewHelper::redirect(BASE_URL . "login");
    }

    public static function showLoginForm(){
        if (isset($_SESSION["logged"]) && $_SESSION["logged"]){
            ViewHelper::redirect(BASE_URL . "home");
        }else{
            ViewHelper::render("view/login.php");
        }
    }

    public static function registerUser(){
        if(!Database::usernameExists($_POST["username"])){
            Database::addUserToDb($_POST["username"], $_POST["password"]);
            $_SESSION["logged"] = True;
            $_SESSION["username"] = $_POST["username"];
            ViewHelper::redirect(BASE_URL . "home");
        }
        else{
            ViewHelper::render("view/register.php", 
            ["errorMessage" => "Username already exists."]);
        }
    }

    public static function showRegisterForm(){
        ViewHelper::render("view/register.php");
    }
}
?>