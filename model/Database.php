<?php

require_once "DBInit.php";

class Database{
    
    public static function validLoginAttempt($username, $password) {

        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare("SELECT COUNT(id) FROM users 
            WHERE username = :username AND password = :password");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();

        return $statement->fetchColumn(0) == 1;
    }

    public static function usernameExists($username){
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare("SELECT COUNT(id) FROM users 
            WHERE username = :username");
        $statement->bindParam(":username", $username);
        $statement->execute();

        return $statement->fetchColumn(0) != 0;
    }

    public static function addUserToDb($username, $password){
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare("INSERT INTO users (username, password)
                VALUES(:username, :password)");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        return $statement->execute();
    }

    public static function changeUserPassword($username, $newPassword){
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare(
                "UPDATE users 
                SET password = :password
                WHERE username = :username;");
        $statement->bindParam(":password", $newPassword);   
        $statement->bindParam(":username", $username);
        return $statement->execute();
    }

    public static function addImageToDb($username, $image_name, $image_data, $image_messages, $used_capacity){
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare(
                "INSERT INTO images 
                (username, image_name, image_data, image_messages, used_capacity)
                VALUES(:username, :image_name, :image_data, :image_messages, :used_capacity)");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":image_name", $image_name);
        $statement->bindParam(":image_data", $image_data);
        $statement->bindParam(":image_messages", $image_messages);
        $statement->bindParam(":used_capacity", $used_capacity);
        return $statement->execute();
    }

    public static function updateImageInDb($username, $image_name, $image_data, $image_messages, $used_capacity){
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare(
                "UPDATE images 
                SET image_data = :image_data, image_messages = :image_messages, used_capacity = :used_capacity
                WHERE username = :username AND image_name = :image_name;");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":image_name", $image_name);
        $statement->bindParam(":image_data", $image_data);
        $statement->bindParam(":image_messages", $image_messages);
        $statement->bindParam(":used_capacity", $used_capacity);
        return $statement->execute();
    }

    public static function deleteImageFromDb($image_id){
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare(
            "DELETE FROM images 
            WHERE id=:image_id"
        );
        $statement->bindParam(":image_id", $image_id);
        return $statement->execute();
    }

    public static function getGalleryImages($username){
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare(
                "SELECT id, image_name, image_data, image_messages, used_capacity
                FROM images 
                WHERE username = :username");
        $statement->bindParam(":username", $username);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getImage($image_id){
        $dbh = DBInit::getInstance();

        $statement = $dbh->prepare(
                "SELECT image_name, image_data, image_messages, used_capacity
                FROM images 
                WHERE id = :id");
        $statement->bindParam(":id", $image_id);
        $statement->execute();

        return $statement->fetchAll()[0];
    }
}

?>