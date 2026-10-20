<?php
require_once 'models.php';

if (isset($_POST['insertBtn'])) {
    insertApplication($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'],
        $_POST['phone_number'], $_POST['years_of_experience'], $_POST['cloud_platform'],
        $_POST['certification'], $_POST['github_link']);
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['updateBtn'])) {
    updateApplication($pdo, $_POST['application_id'], $_POST['first_name'], $_POST['last_name'],
        $_POST['email'], $_POST['phone_number'], $_POST['years_of_experience'],
        $_POST['cloud_platform'], $_POST['certification'], $_POST['github_link']);
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['deleteBtn'])) {
    deleteApplication($pdo, $_POST['application_id']);
    header("Location: ../index.php");
    exit;
}
