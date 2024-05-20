<?php

namespace Src\Controllers;

use Core\Controller;
use Core\FlashBag;
use Src\Managers\UserManager;

class AuthController extends Controller
{
    public function showProfile()
    {
        $this->render('profile.phtml', './src/Views/layout.phtml');
    }
    
    public function handleRegister()
    {
        try
        {
            if(
                !$this->isNotEmpty( $_POST['username'] ) ||    
                !$this->isNotEmpty( $_POST['email'] ) ||    
                !$this->isNotEmpty( $_POST['password'] )   
            )
            {
                throw new \Exception("All fields are requiered.");
            }
            
            $userManager = new UserManager();
            $dbUser = $userManager->findByEmail( $_POST['email'] );
            
            if( $dbUser )
            {
                throw new \Exception("This email is already used.");
            }
            
            $userManager->create([
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => password_hash( $_POST['password'], PASSWORD_BCRYPT),
                'role_id' => 1
            ]);
            FlashBag::set( "Congrats! Your account has been created. Please Login !", 'success');
            $this->redirectToRoute('home');
        }
        catch( \Exception $e )
        {
            FlashBag::set( $e->getMessage(), 'error');
            $this->redirectToRoute('register');
        }
    }
    
    public function handleLogin()
    {
        try
        {
            if(
                !$this->isNotEmpty( $_POST['email'] ) ||
                !$this->isNotEmpty( $_POST['password'] )
            )
            {
                throw new \Exception("All fields are requiered.");
            }
            
            $userManager = new UserManager();
            $userToLog = $userManager->findByEmail( $_POST['email'] );
            
            if(
                !$userToLog ||
                ( $userToLog && !password_verify( $_POST['password'], $userToLog->getPassword() ) )
            )
            {
                throw new \Exception("Invalid credentials.");
            }
            
            $_SESSION['user'] = [
                'id' => $userToLog->getId(),
                'username' => $userToLog->getUsername(),
                'role' => $userToLog->getRole()->getName()
            ];
            
            $this->redirectToRoute('profile');
        }
        catch( \Exception $e )
        {
            FlashBag::set( $e->getMessage(), 'error');
            $this->redirectToRoute('home');
        }
    }
}