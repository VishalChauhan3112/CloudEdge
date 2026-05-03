<?php


define('DB_HOST', 'localhost');     // Zyada tar localhost hi hota hai
define('DB_USER', 'root');          // Apna MySQL username (XAMPP mein 'root' hota hai)
define('DB_PASS', '');              // Apna MySQL password (XAMPP mein default blank hota hai)
define('DB_NAME', 'test'); // Wahi database naam jo setup_database.sql mein banaya

// ── MySQL Connection create karo ─────────────
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// ── Connection check karo ────────────────────
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]);
    exit;
}

// UTF-8 encoding set karo (special characters ke liye)
$conn->set_charset('utf8mb4');
?>
