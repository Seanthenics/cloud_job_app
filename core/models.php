<?php
require_once 'dbConfig.php';

function insertApplication($pdo, $first, $last, $email, $phone, $years, $platform, $cert, $github) {
    $sql = "INSERT INTO job_applications
            (first_name, last_name, email, phone_number, years_of_experience, cloud_platform, certification, github_link)
            VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first, $last, $email, $phone, $years, $platform, $cert, $github]);
}

function getAllApplications($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM job_applications ORDER BY application_id DESC");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getApplicationByID($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM job_applications WHERE application_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateApplication($pdo, $id, $first, $last, $email, $phone, $years, $platform, $cert, $github) {
    $sql = "UPDATE job_applications SET first_name=?, last_name=?, email=?, phone_number=?,
            years_of_experience=?, cloud_platform=?, certification=?, github_link=?
            WHERE application_id=?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first, $last, $email, $phone, $years, $platform, $cert, $github, $id]);
}

function deleteApplication($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM job_applications WHERE application_id = ?");
    return $stmt->execute([$id]);
}
