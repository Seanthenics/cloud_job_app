CREATE DATABASE IF NOT EXISTS cloud_job_db;
USE cloud_job_db;

CREATE TABLE IF NOT EXISTS job_applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    years_of_experience INT,
    cloud_platform VARCHAR(50),
    certification VARCHAR(100),
    github_link VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
