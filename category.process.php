<?php
session_start();
require './controllers/CURDCLass.php';

$cate = new CRUD();

if (isset($_GET['do']) && $_GET['do'] == 'add') {

    $_SESSION['model'] = 'show_cate';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_GET['do']) && $_GET['do'] == 'edit') {

    $_SESSION['model'] = 'show_edit_cate';
    $string = 'Location: index.php?key=' . trim($_GET['categoryid']);
    header($string);
}


if (isset($_GET['do']) && $_GET['do'] == 'delete') {
    $sql = $cate->delete("
    DELETE FROM catogries WHERE id = :cateid  
    ");
    $sql->execute([
        ':cateid' => $_GET['cateid']
    ]);
    unset($_SESSION['model']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}



if (isset($_GET['do']) && $_GET['do'] == 'update') {
    if (isset($_POST['title'])) {
        echo '<h1>hi</h1>';
        $sql = $cate->update("
    UPDATE catogries SET category_name  = :catetitle ,category_country= :count WHERE  id = :cateid  
    ");
        $sql->execute([
            ':catetitle' => $_POST['title'],
             ':cateid' => $_POST['cateid'],
             ':count' =>$_POST['count']
        ]);
        unset($_SESSION['model']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
if (isset($_GET['do']) && $_GET['do'] == 'inset') {
    if (isset($_POST['title'])) {
        echo '<h1>hi</h1>';
        $sql = $cate->insert("
    INSERT INTO catogries(category_name,category_country )  VALUES  ( :catetitle  , :count ) ; 
    ");
        $sql->execute([
            ':catetitle' => $_POST['title'],
            ':count' => $_POST['count']

        ]);
        unset($_SESSION['model']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}