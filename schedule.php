<?php
// ============================================================
//  schedule.php  —  Calendly-Style Booking Page
// ============================================================

$success = '';
$error = '';

// ─── DB Config ──────────────────────────────────────────────
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'test');

function getDB()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error)
        return null;
    $conn->set_charset('utf8mb4');
    $conn->query("
        CREATE TABLE IF NOT EXISTS call_bookings (
            id          INT AUTO_INCREMENT PRIMARY KEY,
            full_name   VARCHAR(120) NOT NULL,
            mobile      VARCHAR(20)  NOT NULL,
            call_date   DATE         NOT NULL,
            call_time   TIME         NOT NULL,
            booked_at   DATETIME     DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    // Add columns if upgrading from old schema
    $conn->query("ALTER TABLE call_bookings ADD COLUMN IF NOT EXISTS full_name VARCHAR(120) NOT NULL DEFAULT '' AFTER id");
    $conn->query("ALTER TABLE call_bookings ADD COLUMN IF NOT EXISTS mobile VARCHAR(20) NOT NULL DEFAULT '' AFTER full_name");
    return $conn;
}

// ─── Handle Booking POST ────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = trim($_POST['date'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $name = trim($_POST['full_name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    if (empty($date) || empty($time)) {
        $error = 'Please select both a date and a time slot.';
    } elseif (empty($name)) {
        $error = 'Please enter your full name.';
    } elseif (empty($mobile) || !preg_match('/^[+\d\s\-()]{7,20}$/', $mobile)) {
        $error = 'Please enter a valid mobile number.';
    } elseif (strtotime($date) < strtotime('today')) {
        $error = 'Please select a future date.';
    } else {
        $conn = getDB();
        if (!$conn) {
            $error = 'Database connection failed.';
        } else {
            $stmt = $conn->prepare("INSERT INTO call_bookings (full_name, mobile, call_date, call_time) VALUES (?,?,?,?)");
            $stmt->bind_param('ssss', $name, $mobile, $date, $time);
            if ($stmt->execute()) {
                $success = date('l, F j, Y', strtotime($date)) . ' at ' . date('g:ia', strtotime($time));
            } else {
                $error = 'Could not save booking. Please try again.';
            }
            $stmt->close();
            $conn->close();
        }
    }
}

$time_slots = [
    '09:00',
    '09:30',
    '10:00',
    '10:30',
    '11:00',
    '11:30',
    '12:00',
    '12:30',
    '13:00',
    '13:30',
    '14:00',
    '14:30',
    '15:00',
    '15:30',
    '16:00',
    '16:30',
    '17:00'
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('ce-theme');
                if (theme === 'day') {
                    document.documentElement.setAttribute('data-theme', 'day');
                } else {
                    document.documentElement.removeAttribute('data-theme');
                }
            } catch (e) { }
        })();
    </script>
    <title>Schedule A Call — CLOUDedge</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #080810;
            --card: #10101c;
            --card2: #13131f;
            --border: rgba(255, 255, 255, 0.07);
            --purple: #7c3aed;
            --purple2: #8b5cf6;
            --purple-lt: rgba(139, 92, 246, 0.15);
            --text: #e8e8f8;
            --muted: #55556e;
            --sub: #9090b0;
        }

        [data-theme="day"] {
            --bg: #F3F7FF;
            --card: #FFFFFF;
            --card2: #F2F7FF;
            --border: rgba(16, 34, 71, 0.14);
            --purple: #0B63F6;
            --purple2: #0B63F6;
            --purple-lt: rgba(11, 99, 246, 0.12);
            --text: #102247;
            --muted: #4E6489;
            --sub: #3F5A86;
        }

        body {
            background: var(--bg);
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            display: flex;
            flex-direction: column;
        }

        [data-theme="day"] body {
            background:
                radial-gradient(1000px 520px at 5% 0%, rgba(11, 99, 246, 0.12), transparent 65%),
                radial-gradient(900px 500px at 100% 0%, rgba(33, 161, 255, 0.10), transparent 65%),
                linear-gradient(180deg, #F8FBFF 0%, #EEF5FF 45%, #E6F0FF 100%);
        }

        /* ── NAV ── */
        nav {
            background: rgba(8, 8, 16, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        [data-theme="day"] nav {
            background: rgba(255, 255, 255, 0.86);
            box-shadow: 0 10px 28px rgba(11, 64, 156, 0.12);
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            color: var(--text);
            text-decoration: none;
            letter-spacing: 0.06em;
        }

        .logo span {
            color: var(--purple2);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
            padding: 8px 0;
        }

        .back-btn:hover {
            color: var(--purple2);
        }

        [data-theme="day"] .logo span {
            color: #0B63F6;
        }

        [data-theme="day"] .back-btn {
            color: #355382;
        }

        .theme-toggle {
            display: inline-flex;
            align-items: center;
            background: rgba(13, 13, 20, 0.7);
            border: 1px solid var(--border);
            border-radius: 50px;
            padding: 3px;
            gap: 2px;
            flex-shrink: 0;
        }

        [data-theme="day"] .theme-toggle {
            background: rgba(255, 255, 255, 0.7);
        }

        .theme-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            background: transparent;
            color: var(--sub);
            cursor: pointer;
            font-size: 0.85rem;
            transition: background 0.25s ease, color 0.25s ease, transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .theme-btn:hover {
            color: var(--text);
            transform: scale(1.15);
        }

        .theme-btn.active {
            background: var(--purple);
            color: #fff;
            transform: scale(1.1);
            box-shadow: 0 0 14px rgba(168, 85, 247, 0.40);
        }

        [data-theme="day"] .theme-btn.active {
            box-shadow: 0 0 16px rgba(11, 99, 246, 0.45);
        }

        /* ── PAGE ── */
        .page {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        /* ── SUCCESS STATE ── */
        .success-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 60px 48px;
            text-align: center;
            max-width: 480px;
            width: 100%;
            animation: fadeIn 0.4s ease;
        }

        .success-card .icon {
            width: 72px;
            height: 72px;
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 28px;
            color: #10b981;
        }

        .success-card h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
            color: var(--text);
        }

        .success-card .datetime {
            background: var(--purple-lt);
            border: 1px solid rgba(139, 92, 246, 0.25);
            border-radius: 12px;
            padding: 14px 20px;
            color: #c4b5fd;
            font-size: 16px;
            font-weight: 600;
            margin: 20px 0 28px;
        }

        .success-card p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .btn-again {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--purple);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-again:hover {
            background: #6d28d9;
            transform: translateY(-1px);
        }

        /* ── BOOKING CARD ── */
        .booking-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 260px 1fr 1fr;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.35s ease;
            min-height: 560px;
        }

        [data-theme="day"] .booking-card {
            box-shadow: 0 30px 70px rgba(11, 64, 156, 0.16);
        }

        @media (max-width: 820px) {
            .booking-card {
                grid-template-columns: 1fr;
                max-width: 480px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── LEFT PANEL ── */
        .panel-left {
            padding: 40px 28px;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        @media (max-width: 820px) {
            .panel-left {
                border-right: none;
                border-bottom: 1px solid var(--border);
                padding: 28px 24px;
            }
        }

        .panel-left .org {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .panel-left h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 0.04em;
            color: var(--text);
            line-height: 1.1;
        }

        .meta-row {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--sub);
            font-size: 13px;
        }

        .meta-row i {
            width: 28px;
            height: 28px;
            background: var(--purple-lt);
            color: var(--purple2);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
        }

        .divider {
            height: 1px;
            background: var(--border);
        }

        .panel-left .description {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        [data-theme="day"] .panel-left,
        [data-theme="day"] .panel-cal,
        [data-theme="day"] .panel-times {
            background: rgba(255, 255, 255, 0.76);
            backdrop-filter: blur(7px);
        }

        /* ── MIDDLE: CALENDAR ── */
        .panel-cal {
            padding: 36px 28px;
            border-right: 1px solid var(--border);
        }

        @media (max-width: 820px) {
            .panel-cal {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }
        }

        .panel-cal h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 28px;
        }

        /* Month nav */
        .month-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .month-nav .month-label {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }

        .nav-btn {
            width: 32px;
            height: 32px;
            background: var(--card2);
            border: 1px solid var(--border);
            border-radius: 50%;
            color: var(--sub);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.18s;
        }

        .nav-btn:hover {
            border-color: var(--purple2);
            color: var(--purple2);
            background: var(--purple-lt);
        }

        /* Day labels */
        .cal-head {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            margin-bottom: 8px;
        }

        .cal-head span {
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 4px 0;
        }

        /* Calendar grid */
        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 3px;
        }

        .cal-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 500;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.15s;
            color: var(--sub);
            position: relative;
        }

        .cal-day.empty {
            cursor: default;
        }

        .cal-day.available {
            color: var(--text);
            background: rgba(139, 92, 246, 0.08);
            border: 1px solid rgba(139, 92, 246, 0.18);
        }

        [data-theme="day"] .cal-day.available {
            background: rgba(11, 99, 246, 0.10);
            border-color: rgba(11, 99, 246, 0.22);
        }

        .cal-day.available:hover {
            background: var(--purple-lt);
            border-color: var(--purple2);
            color: #c4b5fd;
        }

        [data-theme="day"] .cal-day.available:hover {
            color: #0B63F6;
        }

        .cal-day.selected {
            background: var(--purple);
            border-color: var(--purple);
            color: #fff !important;
            box-shadow: 0 4px 14px rgba(124, 58, 237, 0.4);
        }

        .cal-day.past,
        .cal-day.weekend {
            color: #2a2a40;
            cursor: not-allowed;
            background: none;
            border: none;
        }

        .cal-day.today:not(.selected) {
            border: 1px solid rgba(139, 92, 246, 0.4);
        }

        [data-theme="day"] .cal-day.today:not(.selected) {
            border-color: rgba(11, 99, 246, 0.45);
        }

        /* Timezone */
        .tz-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            color: var(--muted);
            font-size: 12px;
        }

        .tz-row i {
            color: var(--purple2);
        }

        .tz-row span {
            color: var(--sub);
        }

        /* ── RIGHT: TIME SLOTS ── */
        .panel-times {
            padding: 36px 24px;
            display: flex;
            flex-direction: column;
        }

        .panel-times .date-heading {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 20px;
            min-height: 22px;
        }

        .panel-times .date-heading.empty {
            color: var(--muted);
            font-weight: 400;
            font-size: 13px;
        }

        .slots-list {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            overflow-y: auto;
            max-height: 420px;
            padding-right: 4px;
        }

        .slots-list::-webkit-scrollbar {
            width: 4px;
        }

        .slots-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .slots-list::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.25);
            border-radius: 2px;
        }

        [data-theme="day"] .slots-list::-webkit-scrollbar-thumb {
            background: rgba(11, 99, 246, 0.30);
        }

        .time-slot {
            background: transparent;
            border: 1px solid rgba(139, 92, 246, 0.25);
            border-radius: 10px;
            color: var(--purple2);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            padding: 12px;
            cursor: pointer;
            text-align: center;
            transition: all 0.16s;
            letter-spacing: 0.02em;
        }

        [data-theme="day"] .time-slot {
            border-color: rgba(11, 99, 246, 0.26);
            color: #0B63F6;
            background: rgba(11, 99, 246, 0.05);
        }

        .time-slot:hover {
            background: var(--purple-lt);
            border-color: var(--purple2);
            color: #c4b5fd;
        }

        [data-theme="day"] .time-slot:hover {
            color: #0B63F6;
        }

        .time-slot.selected {
            background: var(--purple);
            border-color: var(--purple);
            color: #fff;
            box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35);
        }

        /* Confirm button inside slot (after select) */
        .time-slot-wrap {
            display: flex;
            gap: 6px;
            align-items: stretch;
        }

        .time-slot-wrap .time-slot {
            flex: 1;
        }

        .btn-confirm {
            background: var(--purple);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s;
            white-space: nowrap;
            display: none;
        }

        .btn-confirm.show {
            display: block;
        }

        .btn-confirm:hover {
            background: #6d28d9;
        }

        .no-date-msg {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--muted);
            font-size: 13px;
            text-align: center;
            gap: 12px;
            padding: 40px 0;
        }

        .no-date-msg i {
            font-size: 32px;
            color: #1e1e30;
        }

        /* ── DETAILS MODAL ── */
        .details-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(6px);
            z-index: 200;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        [data-theme="day"] .details-overlay {
            background: rgba(16, 34, 71, 0.28);
        }

        .details-overlay.show {
            display: flex;
        }

        .details-modal {
            background: var(--card);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 20px;
            padding: 36px 32px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.25s ease;
        }

        [data-theme="day"] .details-modal {
            border-color: rgba(11, 99, 246, 0.24);
            box-shadow: 0 24px 60px rgba(11, 64, 156, 0.22);
        }

        .details-modal h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }

        .details-modal .sub-text {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 24px;
        }

        .details-modal .booking-summary {
            background: var(--purple-lt);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 10px;
            padding: 10px 14px;
            color: #c4b5fd;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        [data-theme="day"] .details-modal .booking-summary {
            border-color: rgba(11, 99, 246, 0.24);
            color: #0B63F6;
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 24px;
        }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 6px;
        }

        .field-input {
            width: 100%;
            background: var(--card2);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            padding: 12px 14px;
            outline: none;
            transition: border-color 0.18s;
        }

        .field-input::placeholder {
            color: var(--muted);
        }

        .field-input:focus {
            border-color: var(--purple2);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.12);
        }

        [data-theme="day"] .field-input {
            background: #F4F8FF;
        }

        [data-theme="day"] .field-input:focus {
            box-shadow: 0 0 0 3px rgba(11, 99, 246, 0.15);
        }

        .modal-actions {
            display: flex;
            gap: 10px;
        }

        .btn-cancel-modal {
            flex: 1;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            padding: 12px;
            cursor: pointer;
            transition: all 0.18s;
        }

        .btn-cancel-modal:hover {
            border-color: var(--sub);
            color: var(--sub);
        }

        [data-theme="day"] .btn-cancel-modal {
            color: #355382;
        }

        .btn-book-now {
            flex: 2;
            background: var(--purple);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            padding: 12px;
            cursor: pointer;
            transition: all 0.18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-book-now:hover {
            background: #6d28d9;
        }

        .modal-err {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            margin-bottom: 14px;
            display: none;
        }

        .modal-err.show {
            display: block;
        }

        /* ── HIDDEN FORM ── */
        #bookingForm {
            display: none;
        }

        /* ── ERROR ALERT ── */
        .alert-err {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        [data-theme="day"] .no-date-msg i {
            color: #8FA6CD;
        }

        [data-theme="day"] .alert-err {
            color: #B42318;
            background: rgba(180, 35, 24, 0.08);
            border-color: rgba(180, 35, 24, 0.2);
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <a href="index.php" class="logo">CLOUD<span>edge</span></a>
        <div style="display: flex; gap: 12px; align-items: center;">
            <div class="theme-toggle" id="themeToggle"></div>
            <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
        </div>
    </nav>

    <div class="page">

        <?php if ($success): ?>
            <!-- ── SUCCESS ── -->
            <div class="success-card">
                <div class="icon"><i class="fas fa-check"></i></div>
                <h2>You're Booked!</h2>
                <div class="datetime"><i class="fas fa-calendar-check"
                        style="margin-right:8px;"></i><?= htmlspecialchars($success) ?></div>
                <p>Hi <strong><?= htmlspecialchars($name) ?></strong>, your call has been scheduled. We'll reach out to
                    <strong><?= htmlspecialchars($mobile) ?></strong> to confirm the meeting details.
                </p>
                <a href="schedule.php" class="btn-again"><i class="fas fa-plus"></i> Schedule Another Call</a>
            </div>

        <?php else: ?>
            <!-- ── BOOKING CARD ── -->
            <div class="booking-card">

                <!-- LEFT INFO -->
                <div class="panel-left">
                    <div class="org">CLOUDedge Tech Services</div>
                    <h2>Schedule A Call</h2>
                    <div class="divider"></div>
                    <div class="meta-row">
                        <i class="fas fa-clock"></i>
                        <span>30 min</span>
                    </div>
                    <div class="meta-row">
                        <i class="fas fa-video"></i>
                        <span>Google Meet / Zoom</span>
                    </div>
                    <div class="meta-row">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Mon – Fri, 9 AM – 5 PM</span>
                    </div>
                    <div class="divider"></div>
                    <p class="description">
                        Let's talk about your project. We'll walk you through our solutions and explore how CLOUDedge can
                        help your business grow.
                    </p>
                </div>

                <!-- CALENDAR -->
                <div class="panel-cal">
                    <h3>Select a Date &amp; Time</h3>

                    <?php if ($error): ?>
                        <div class="alert-err"><i class="fas fa-exclamation-circle"></i><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <div class="month-nav">
                        <button class="nav-btn" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                        <span class="month-label" id="monthLabel"></span>
                        <button class="nav-btn" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
                    </div>

                    <div class="cal-head">
                        <span>MON</span><span>TUE</span><span>WED</span>
                        <span>THU</span><span>FRI</span><span>SAT</span><span>SUN</span>
                    </div>

                    <div class="cal-grid" id="calGrid"></div>

                    <div class="tz-row">
                        <i class="fas fa-globe"></i>
                        <span id="tzLabel">Detecting timezone...</span>
                    </div>
                </div>

                <!-- TIME SLOTS -->
                <div class="panel-times">
                    <div class="date-heading empty" id="dateHeading">← Select a date</div>
                    <div class="slots-list" id="slotsList">
                        <div class="no-date-msg">
                            <i class="fas fa-calendar"></i>
                            <span>Pick a date on the calendar<br>to see available times</span>
                        </div>
                    </div>
                </div>

            </div><!-- /.booking-card -->

            <!-- Details Modal -->
            <div class="details-overlay" id="detailsOverlay">
                <div class="details-modal">
                    <h3>Your Details</h3>
                    <p class="sub-text">Almost done! Just a couple more details.</p>
                    <div class="booking-summary" id="modalSummary"></div>
                    <div class="modal-err" id="modalErr"></div>
                    <div class="field-group">
                        <div>
                            <label class="field-label" for="inp_name"><i class="fas fa-user"
                                    style="margin-right:5px;"></i>Full Name</label>
                            <input class="field-input" type="text" id="inp_name" placeholder="e.g. Rahul Sharma"
                                autocomplete="name">
                        </div>
                        <div>
                            <label class="field-label" for="inp_mobile"><i class="fas fa-mobile-alt"
                                    style="margin-right:5px;"></i>Mobile Number</label>
                            <input class="field-input" type="tel" id="inp_mobile" placeholder="e.g. +91 98765 43210"
                                autocomplete="tel">
                        </div>
                    </div>
                    <div class="modal-actions">
                        <button class="btn-cancel-modal" id="modalCancelBtn" type="button">Cancel</button>
                        <button class="btn-book-now" id="modalBookBtn" type="button">
                            <i class="fas fa-calendar-check"></i> Book Call
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hidden form for submission -->
            <form method="POST" action="schedule.php" id="bookingForm">
                <input type="hidden" name="date" id="f_date">
                <input type="hidden" name="time" id="f_time">
                <input type="hidden" name="full_name" id="f_name">
                <input type="hidden" name="mobile" id="f_mobile">
            </form>

        <?php endif; ?>

    </div>

    <script>
        const TIME_SLOTS = <?= json_encode($time_slots) ?>;

        const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const DAYS_SHORT = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];

        let today = new Date();
        today.setHours(0, 0, 0, 0);

        let viewYear = today.getFullYear();
        let viewMonth = today.getMonth();
        let selDate = null;
        let selTime = null;

        function fmt12(t) {
            const [h, m] = t.split(':').map(Number);
            const ampm = h >= 12 ? 'pm' : 'am';
            const h12 = h % 12 || 12;
            return h12 + ':' + String(m).padStart(2, '0') + ampm;
        }

        function fmtDateLong(d) {
            const day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return day[d.getDay()] + ', ' + MONTHS[d.getMonth()] + ' ' + d.getDate();
        }

        function renderCal() {
            document.getElementById('monthLabel').textContent = MONTHS[viewMonth] + ' ' + viewYear;

            const grid = document.getElementById('calGrid');
            grid.innerHTML = '';

            const firstDay = new Date(viewYear, viewMonth, 1);
            // Monday = 0
            let startOffset = (firstDay.getDay() + 6) % 7; // shift so Monday=0

            const daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();
            const maxDate = new Date(today);
            maxDate.setMonth(maxDate.getMonth() + 3);

            // empty cells
            for (let i = 0; i < startOffset; i++) {
                const el = document.createElement('div');
                el.className = 'cal-day empty';
                grid.appendChild(el);
            }

            for (let d = 1; d <= daysInMonth; d++) {
                const date = new Date(viewYear, viewMonth, d);
                const el = document.createElement('div');
                el.className = 'cal-day';
                el.textContent = d;

                const isWeekend = date.getDay() === 0 || date.getDay() === 6;
                const isPast = date < today;
                const isFuture = date > maxDate;
                const isToday = date.getTime() === today.getTime();

                if (isPast || isWeekend || isFuture) {
                    el.classList.add(isPast || isFuture ? 'past' : 'weekend');
                } else {
                    el.classList.add('available');
                    if (isToday) el.classList.add('today');

                    const dateStr = viewYear + '-' + String(viewMonth + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');

                    if (selDate === dateStr) el.classList.add('selected');

                    el.addEventListener('click', () => {
                        selDate = dateStr;
                        selTime = null;
                        renderCal();
                        renderSlots(date);
                    });
                }

                grid.appendChild(el);
            }
        }

        function renderSlots(dateObj) {
            const heading = document.getElementById('dateHeading');
            const list = document.getElementById('slotsList');

            heading.textContent = fmtDateLong(dateObj);
            heading.classList.remove('empty');
            list.innerHTML = '';

            TIME_SLOTS.forEach(t => {
                const wrap = document.createElement('div');
                wrap.className = 'time-slot-wrap';

                const btn = document.createElement('div');
                btn.className = 'time-slot' + (selTime === t ? ' selected' : '');
                btn.textContent = fmt12(t);

                const confirmBtn = document.createElement('button');
                confirmBtn.className = 'btn-confirm' + (selTime === t ? ' show' : '');
                confirmBtn.textContent = 'Confirm';
                confirmBtn.type = 'button';

                btn.addEventListener('click', () => {
                    selTime = t;
                    renderSlots(dateObj);
                });

                confirmBtn.addEventListener('click', () => {
                    // Show details modal
                    openDetailsModal(dateObj);
                });

                wrap.appendChild(btn);
                wrap.appendChild(confirmBtn);
                list.appendChild(wrap);
            });
        }

        // ── DETAILS MODAL ──
        function openDetailsModal(dateObj) {
            const summary = document.getElementById('modalSummary');
            summary.innerHTML = '<i class="fas fa-calendar-alt" style="margin-right:8px;"></i>' +
                fmtDateLong(dateObj) + ' &nbsp;•&nbsp; ' + fmt12(selTime);
            document.getElementById('detailsOverlay').classList.add('show');
            document.getElementById('inp_name').focus();
            document.getElementById('modalErr').classList.remove('show');
        }

        document.getElementById('modalCancelBtn').addEventListener('click', () => {
            document.getElementById('detailsOverlay').classList.remove('show');
        });

        document.getElementById('detailsOverlay').addEventListener('click', function (e) {
            if (e.target === this) this.classList.remove('show');
        });

        document.getElementById('modalBookBtn').addEventListener('click', () => {
            const name = document.getElementById('inp_name').value.trim();
            const mobile = document.getElementById('inp_mobile').value.trim();
            const errEl = document.getElementById('modalErr');

            if (!name) {
                errEl.textContent = 'Please enter your full name.';
                errEl.classList.add('show');
                document.getElementById('inp_name').focus();
                return;
            }
            if (!mobile || !/^[+\d\s\-()]{7,20}$/.test(mobile)) {
                errEl.textContent = 'Please enter a valid mobile number.';
                errEl.classList.add('show');
                document.getElementById('inp_mobile').focus();
                return;
            }

            document.getElementById('f_date').value = selDate;
            document.getElementById('f_time').value = selTime;
            document.getElementById('f_name').value = name;
            document.getElementById('f_mobile').value = mobile;
            document.getElementById('bookingForm').submit();
        });

        // Allow Enter key in modal inputs
        ['inp_name', 'inp_mobile'].forEach(id => {
            document.getElementById(id).addEventListener('keydown', e => {
                if (e.key === 'Enter') document.getElementById('modalBookBtn').click();
            });
        });

        // ── CALENDAR INIT ──
        document.getElementById('prevBtn').addEventListener('click', () => {
            viewMonth--;
            if (viewMonth < 0) { viewMonth = 11; viewYear--; }
            renderCal();
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            viewMonth++;
            if (viewMonth > 11) { viewMonth = 0; viewYear++; }
            renderCal();
        });

        // Timezone auto-detect
        try {
            const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
            const now = new Date().toLocaleTimeString('en-US', { timeZone: tz, hour: '2-digit', minute: '2-digit' });
            document.getElementById('tzLabel').textContent = tz.replace('_', ' ') + ' (' + now + ')';
        } catch (e) {
            document.getElementById('tzLabel').textContent = 'Local Time';
        }

        function applyTheme(theme) {
            if (theme === 'day') {
                document.documentElement.setAttribute('data-theme', 'day');
            } else {
                document.documentElement.removeAttribute('data-theme');
                theme = 'night';
            }
            localStorage.setItem('ce-theme', theme);

            document.querySelectorAll('[data-theme-btn]').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-theme-btn') === theme);
            });
        }

        function initThemeToggle() {
            const mount = document.getElementById('themeToggle');
            if (!mount || mount.querySelector('[data-theme-btn]')) return;

            const themes = [
                { key: 'night', icon: 'fa-moon', label: 'Night' },
                { key: 'day', icon: 'fa-sun', label: 'Day' }
            ];

            themes.forEach(({ key, icon, label }) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'theme-btn';
                btn.setAttribute('data-theme-btn', key);
                btn.setAttribute('aria-label', label + ' mode');
                btn.setAttribute('title', label);
                btn.innerHTML = '<i class="fas ' + icon + '"></i>';
                btn.addEventListener('click', () => applyTheme(key));
                mount.appendChild(btn);
            });

            const currentTheme = localStorage.getItem('ce-theme') === 'day' ? 'day' : 'night';
            applyTheme(currentTheme);
        }

        initThemeToggle();

        renderCal();
    </script>
</body>

</html>