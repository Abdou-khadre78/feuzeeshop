<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    public function index()
    {
      
        if (isset($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['password'])) {
            //  $this->check('firstname', $_POST['firstname']);
            //  $this->check('lastname', $_POST['lastname']);
            //  $this->check('mail', $_POST['mail']);
            //  $this->check('password', $_POST['password']);
            // var_dump("test");
          
           

            if (empty($this->arrayError)) {
                $firstname = htmlspecialchars($_POST['firstname']);
                $lastname = htmlspecialchars($_POST['lastname']);
                $mail = htmlspecialchars($_POST['mail']);
                $password = htmlspecialchars($_POST['password']);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $role = 1;
                $user = new User(null, $firstname, $lastname, $mail, $password, null,null, null, $passwordHash, null, $role);
                $user->save();
                $this->redirectToRoute('/');
            }
        }
        require_once(__DIR__ . "/../Views/security/register.view.php");
    }
}