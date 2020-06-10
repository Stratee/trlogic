<?php
session_start();
require_once ('../models/DataManager.php');

class UserController
{
    function __construct()
    {
        if ($_POST['nick']){
            $this->main();
        }
    }

    function main(){
        $nickname = trim(htmlspecialchars($_POST['nick']));
        $usermail = trim(htmlspecialchars($_POST['mail']));
        $phone = trim(htmlspecialchars($_POST['phone']));
        $firstname = $_POST['firstname'] ? trim(htmlspecialchars($_POST['firstname'])) : '';
        $lastname = $_POST['lastname'] ? trim(htmlspecialchars($_POST['lastname'])) : '';

        $imageSource = $_FILES['image']['name'];
        $imageDestination = '../misc/image/' . $imageSource;


        $check = $this->checkUserUnique($nickname);
        if ($check){
            $this->addUser($nickname, $usermail, $phone, $firstname, $lastname, $imageDestination);
            $_SESSION['userdata'] = $this->renderUserPage($nickname, $usermail, $phone, $firstname, $lastname, $imageDestination);
            header('Location: ../views/account.html');
        }
    }

    function checkUserUnique($nickname){
        $checking = new DataManager();
        $userArray = $checking->checkUserUnique();

        if (in_array($nickname, $userArray)){
            print 'Error! User already exists';
            exit();
        }
        else{
            return 1;
        }
    }

    function addUser($nickname, $usermail, $phone, $firstname, $lastname, $imageDestination){
        $_FILES ? move_uploaded_file($_FILES['image']['tmp_name'], $imageDestination) : '';
        $newUser = new DataManager();
        $newUser->addUser($nickname, $usermail, $phone, $imageDestination, $firstname, $lastname);
    }

    function renderUserPage($nickname, $usermail, $phone, $firstname, $lastname, $imageDestination){
        $result = [
            'nick' => $nickname,
            'mail' => $usermail,
            'phone' => $phone,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'imagesource' => $imageDestination
        ];
        return $result;
    }
}

$accept = new UserController();