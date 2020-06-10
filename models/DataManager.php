<?php
require_once ('../config/db.php');

class DataManager
{
    function setConnection(){
        $servername = SERVER_NAME;
        $dbname= DB_NAME;
        $charset= CHARSET;
        $username = USER_NAME;
        $password = PASSWORD;

        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=$charset", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    function checkUserUnique()
    {
        $connect = $this->setConnection();
        $result = $connect->query('SELECT user_nickname FROM users')->fetchAll(PDO::FETCH_COLUMN, 0);

        return $result;
    }

    function addUser($nickname, $usermail, $phone, $image, $firstname = null, $lastname = null){

        $connect = $this->setConnection();

        $sql = $connect->prepare("insert into 
                                                trlogic.users (user_nickname, user_mail, user_firstname, user_lastname, phone, image)
                                          values (:nickname, :mail, :firstname, :lastname, :phone, :image)");

        $sql->bindParam(':nickname', $nickname);
        $sql->bindParam(':mail', $usermail);
        $sql->bindParam(':phone', $phone);
        $sql->bindParam(':image', $image);
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);

        $result = $sql->execute();
        return $result;
    }
}
