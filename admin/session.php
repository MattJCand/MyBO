<?php
  session_start();
if (isset($_SESSION['login']) && isset($_SESSION['mdp']))
{
    echo 'Bonjour ' . $_SESSION['login'];
}else{
    header('location:index.php');
}
?>
