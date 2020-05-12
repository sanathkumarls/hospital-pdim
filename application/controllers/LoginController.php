<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 5:57 PM
 */

require_once __DIR__."/../models/Patient.php";
require_once __DIR__."/../models/Doctor.php";
require_once __DIR__."/../models/Insurer.php";
require_once __DIR__."/../models/Medical.php";
require_once __DIR__."/../utilities/Constants.php";
session_start();

if(isset($_POST['submit']))
{
    $objLoginController = new LoginController();
    $objLoginController->getUserInput();
}

class LoginController
{
    public function getUserInput()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        //print_r($name);
        //print_r($password);
        if($email != null && $password != null)
            $this->checkLogin($email,$password);
        else
            echo "<script>
                        alert('Please Enter Useremail And Password');
                       window.location.href='../views/login.php';
                </script>";
    }
    public function checkLogin($email,$password)
    {
        $objPatient = new Patient();
        $objDoctor = new Doctor();
        $objInsurer = new Insurer();
        $objMedical = new Medical();

        if($objPatient->canLogin($email,$password))
        {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = Constants::rolePatient;
            echo '<script>window.location.href="../views/patient/home.php"</script>';
        }
        elseif($objDoctor->canLogin($email,$password))
        {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = Constants::roleDoctor;
            echo '<script>window.location.href="../views/doctor/home.php"</script>';
        }
        elseif($objInsurer->canLogin($email,$password))
        {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = Constants::roleInsurer;
            echo '<script>window.location.href="../views/insurer/home.php"</script>';
        }
        elseif($objMedical->canLogin($email,$password))
        {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = Constants::roleMedical;
            echo '<script>window.location.href="../views/medical/home.php"</script>';
        }
        else
        {
            echo '<script>alert("Incorrect Username Or Password"); window.location.href="../views/login.php"</script>';
        }
    }
}