<?php
session_start();
if(isset($_SESSION['Id'])){
    if($_SESSION['user'] == "agent"){
        unset($_SESSION['Id']);
        unset($_SESSION['user']);
        echo "<script language='javascript' type='text/javascript'>window.location.href='agentLogin.php';</script>";
    }
    if($_SESSION['user'] == "tenant"){
        unset($_SESSION['Id']);
        unset($_SESSION['user']);
        if(isset($_SESSION['types'])){
        unset($_SESSION['types']);
        unset($_SESSION['budgets']);
        unset($_SESSION['locations']);
        }
        
        echo "<script language='javascript' type='text/javascript'>window.location.href='tenantLogin.php';</script>";
    }
    if($_SESSION['user'] == "admin"){
        unset($_SESSION['Id']);
        unset($_SESSION['user']);
        echo "<script language='javascript' type='text/javascript'>window.location.href='blkadmin.php';</script>";
    }
}
echo "<script language='javascript' type='text/javascript'>window.location.href='index.php';</script>";
?>