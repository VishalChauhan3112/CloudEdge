-- =============================================
--  DATABASE SETUP — setup_database.sql
--  phpMyAdmin mein SQL tab mein paste karke RUN karo
-- =============================================

-- Step 1: Database banao
CREATE DATABASE IF NOT EXISTS cloudedge_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- Step 2: Us database ko use karo
USE cloudedge_db;

-- Step 3: Contact form submissions table banao
CREATE TABLE IF NOT EXISTS contact_submissions (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    name             VARCHAR(150)  NOT NULL,
    email            VARCHAR(255)  NOT NULL,
    company          VARCHAR(200)  DEFAULT NULL,
    phone            VARCHAR(30)   DEFAULT NULL,
    message          TEXT          NOT NULL,
    agreed_to_policy TINYINT(1)   NOT NULL DEFAULT 0,
    submitted_at     DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Confirmation
SELECT 'cloudedge_db database aur contact_submissions table successfully ban gaya!' AS Status;
