<?php
session_start();
include '../connection/connection.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); 
    // Redirect to login page if not logged in
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$submission_id = $_POST['submission_id'];

$query = "SELECT * FROM income WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $submission_id);
$stmt->execute();
$result = $stmt->get_result();
$submission = $result->fetch_assoc();
$stmt->close();

if ($submission['interviewer_approved'] && $submission['admin_approved'] && is_null($submission['tax_amount'])) {
    $income = $submission['income_amount'];
    $income_source = $submission['income_source'];

    switch ($income_source) {
        case 'Employment':
            $tax = calculateTax($income);
            break;
        case 'Rental of Building':
            $tax = calculateRentalTax($income);
            break;
        case 'Business Activities':
            $tax = calculateBusinessTax($income);
            break;
    }

    $query = "UPDATE income SET tax_amount = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $tax, $submission_id);
    $stmt->execute();
    $stmt->close();

    echo "Tax calculated and updated: ETB " . number_format($tax, 2);
} else {
    echo "Cannot calculate tax: Submission not approved or already calculated.";
}

function calculateTax($income) {
    if ($income <= 600) {
        return 0;
    } elseif ($income <= 1650) {
        return ($income - 600) * 0.1;
    } elseif ($income <= 3200) {
        return (1650 - 600) * 0.1 + ($income - 1650) * 0.15;
    } elseif ($income <= 5250) {
        return (1650 - 600) * 0.1 + (3200 - 1650) * 0.15 + ($income - 3200) * 0.2;
    } elseif ($income <= 7800) {
        return (1650 - 600) * 0.1 + (3200 - 1650) * 0.15 + (5250 - 3200) * 0.2 + ($income - 5250) * 0.25;
    } elseif ($income <= 10900) {
        return (1650 - 600) * 0.1 + (3200 - 1650) * 0.15 + (5250 - 3200) * 0.2 + (7800 - 5250) * 0.25 + ($income - 7800) * 0.3;
    } else {
        return (1650 - 600) * 0.1 + (3200 - 1650) * 0.15 + (5250 - 3200) * 0.2 + (7800 - 5250) * 0.25 + (10900 - 7800) * 0.3 + ($income - 10900) * 0.35;
    }
}

function calculateRentalTax($income) {
    if ($income <= 7200) {
        return 0;
    } elseif ($income <= 19800) {
        return ($income - 7200) * 0.1;
    } elseif ($income <= 38400) {
        return (19800 - 7200) * 0.1 + ($income - 19800) * 0.15;
    } elseif ($income <= 63000) {
        return (19800 - 7200) * 0.1 + (38400 - 19800) * 0.15 + ($income - 38400) * 0.2;
    } elseif ($income <= 93600) {
        return (19800 - 7200) * 0.1 + (38400 - 19800) * 0.15 + (63000 - 38400) * 0.2 + ($income - 63000) * 0.25;
    } elseif ($income <= 130800) {
        return (19800 - 7200) * 0.1 + (38400 - 19800) * 0.15 + (63000 - 38400) * 0.2 + (93600 - 63000) * 0.25 + ($income - 93600) * 0.3;
    } else {
        return (19800 - 7200) * 0.1 + (38400 - 19800) * 0.15 + (63000 - 38400) * 0.2 + (93600 - 63000) * 0.25 + (130800 - 93600) * 0.3 + ($income - 130800) * 0.35;
    }
}

function calculateBusinessTax($income) {
    if ($income <= 7200) {
        return 0;
    } elseif ($income <= 19800) {
        return ($income - 7200) * 0.1;
    } elseif ($income <= 38400) {
        return (19800 - 7200) * 0.1 + ($income - 19800) * 0.15;
    } elseif ($income <= 63000) {
        return (19800 - 7200) * 0.1 + (38400 - 19800) * 0.15 + ($income - 38400) * 0.2;
    } elseif ($income <= 93600) {
        return (19800 - 7200) * 0.1 + (38400 - 19800) * 0.15 + (63000 - 38400) * 0.2 + ($income - 63000) * 0.25;
    } elseif ($income <= 130800) {
        return (19800 - 7200) * 0.1 + (38400 - 19800) * 0.15 + (63000 - 38400) * 0.2 + (93600 - 63000) * 0.25 + ($income - 93600) * 0.3;
    } else {
        return (19800 - 7200) * 0.1 + (38400 - 19800) * 0.15 + (63000 - 38400) * 0.2 + (93600 - 63000) * 0.25 + (130800 - 93600) * 0.3 + ($income - 130800) * 0.35;
    }
}
?>
