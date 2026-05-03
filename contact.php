<?php
// ============================================================
//  contact.php  —  Contact Form ka MySQL Backend
//  Yeh file form data receive karke database mein save karti hai
// ============================================================

header('Content-Type: application/json');

// ─── Database Configuration ───────────────────────────────
define('DB_HOST', 'localhost');      // MySQL server (usually localhost)
define('DB_USER', 'root');           // Apna MySQL username yahan likho
define('DB_PASS', '');               // Apna MySQL password yahan likho
define('DB_NAME', 'test');   // Database ka naam

// ─── Helper: JSON response bhejo aur exit karo ──────────────
function send($success, $message) {
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

// ─── Sirf POST request allow hai ────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send(false, 'Invalid request method.');
}

// ─── Form Data Sanitize karo ────────────────────────────────
$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$company = trim($_POST['company'] ?? '');
$phone   = trim($_POST['phone']   ?? '');
$message = trim($_POST['message'] ?? '');
$agree   = isset($_POST['agree']) ? 1 : 0;

// ─── Server-side Validation ─────────────────────────────────
if (empty($name)) {
    send(false, 'Full name is required.');
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    send(false, 'A valid email address is required.');
}
if (strlen($message) < 10) {
    send(false, 'Message must be at least 10 characters.');
}
if (!$agree) {
    send(false, 'You must agree to the Privacy Policy.');
}

// ─── Database Connection ────────────────────────────────────
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    // Production mein exact error mat dikhao
    send(false, 'Database connection failed. Please try later.');
}

$conn->set_charset('utf8mb4');

// ─── Table create karo agar exist nahi karti ───────────────
$createTable = "
CREATE TABLE IF NOT EXISTS contact_submissions (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(150)  NOT NULL,
    email      VARCHAR(255)  NOT NULL,
    company    VARCHAR(150)  DEFAULT NULL,
    phone      VARCHAR(30)   DEFAULT NULL,
    message    TEXT          NOT NULL,
    agreed     TINYINT(1)    DEFAULT 1,
    ip_address VARCHAR(45)   DEFAULT NULL,
    submitted_at DATETIME    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if (!$conn->query($createTable)) {
    send(false, 'Table setup failed: ' . $conn->error);
}

// ─── Data Insert karo (Prepared Statement — SQL Injection safe) ─
$stmt = $conn->prepare(
    "INSERT INTO contact_submissions (name, email, company, phone, message, agreed, ip_address)
     VALUES (?, ?, ?, ?, ?, ?, ?)"
);

if (!$stmt) {
    send(false, 'Query preparation failed.');
}

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

$stmt->bind_param(
    'sssssis',  // s=string, i=integer
    $name,
    $email,
    $company,
    $phone,
    $message,
    $agree,
    $ip
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    send(true, 'Message sent successfully!');
} else {
    $stmt->close();
    $conn->close();
    send(false, 'Could not save your message. Please try again.');
}
?>
