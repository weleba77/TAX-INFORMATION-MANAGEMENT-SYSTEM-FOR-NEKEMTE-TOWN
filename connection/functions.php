<?php
function prepareAndExecute($conn, $query, $usernamedb, $password) {
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $usernamedb);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // Assuming passwords are hashed
                return $user;
            }
        }
    }
    return false;
}
function getIncome($conn, $user_id = null, $for_interviewer = false) {
    if ($for_interviewer) {
        $sql = "SELECT * FROM income WHERE interviewer_id = ? AND interviewer_approved = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
    } else if ($user_id) {
        $sql = "SELECT * FROM income WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
    } else {
        $sql = "SELECT * FROM income WHERE admin_approved = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
    }
   
    $stmt->execute();
     
    return $stmt->get_result();

}

function getIncomes($conn, $user_id, $pending = true) {
    $approved = $pending ? 0 : 1;
    $query = "SELECT * FROM income WHERE interviewer_approved = ? OR admin_approved = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $approved, $approved);
    $stmt->execute();
    return $stmt->get_result();
}

?>
