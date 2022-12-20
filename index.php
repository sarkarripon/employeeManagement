<?php
   session_start();
   if($_SERVER['REQUEST_URI'] == "/" || $_SERVER['REQUEST_URI'] == "/sarkar/php/Exercise/oopems/"){
    // base_url session
    header('Location: index.php?page=dashboard');
  }
?>

   <?php
  $page_name = isset($_GET['page'])? $_GET['page']: '';

    if ($page_name != 'login'){
        include_once('view/includes/header.php');//including header
        include_once ('view/includes/sidebar.php'); //and sidebar
    }
  $pageName =str_replace('-', ' ', $page_name);
  echo "<h1 style='text-align: center;'>".ucfirst($pageName)."</h1>";


if ($page_name == 'dashboard') {

        include_once "view/dashboard/data.php";
    }
    if ($page_name == 'salary-list') {
        include_once "view/salary/list.php";
    }
    if ($page_name == 'salary-add') {
        include_once "view/salary/add.php";
    }
    if ($page_name == 'salary-statement') {
        include_once "view/salary/statement.php";
    }
    if ($page_name == 'employee-add') {
        include_once "view/employee/add.php";
    }
    if ($page_name == 'employee-list') {
        include_once "view/employee/list.php";
    }
    if ($page_name == 'single-statement') {
        include_once "view/salary/statement.php";
    }
    if ($page_name == 'statement') {
        include_once "view/salary/statementFilter.php";
    }

    if ($page_name == 'login') {
        include_once "view/authentication/login.php";
    }
    if ($page_name != 'login'){
        include_once ('view/includes/footer.php'); //including footer
    }

  
?>
    
    
