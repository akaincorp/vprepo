<?php
session_start();
include("koneksi.php");

function sendResponse($success, $message) {
    echo json_encode(array('success' => $success, 'message' => $message));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Coba autentikasi sebagai agent
    if ($stmt = $con->prepare('SELECT id_agent, password, id_level FROM tb_agent WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password, $level);
            $stmt->fetch();
            if (password_verify($_POST['password'], $password)) {
                $session_id = uniqid();
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username_agent'] = $_POST['username'];
                $_SESSION['id_agent'] = $id;
                $_SESSION['id_level'] = $level;
                $_SESSION['session_id'] = $session_id;
            sendResponse(true, 'Login success! Welcome Agent ' . $username);
        }
    }
    }

    // Coba autentikasi sebagai finance
    if ($stmt = $con->prepare('SELECT id_finance, password FROM tb_finance WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            if (password_verify($_POST['password'], $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username_finance'] = $_POST['username'];
                $_SESSION['id_finance'] = $id;
            sendResponse(true, 'Login success! Welcome ' . $username);
        }
    }
    }

    // Coba autentikasi sebagai pemimpin
    if ($stmt = $con->prepare('SELECT id_leader, password, id_level FROM tb_leader WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password, $level);
            $stmt->fetch();
            if (password_verify($_POST['password'], $password)) {
                $session_id = uniqid();
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username_leader'] = $_POST['username'];
                $_SESSION['id_leader'] = $id;
                $_SESSION['id_level'] = $level;
                $_SESSION['session_id'] = $session_id;
            sendResponse(true, 'Login success! Welcome Leader ' . $username);
        }
    }
    }

    sendResponse(false, 'Incorrect username or password');
} else {
    sendResponse(false, 'Invalid request method');
}
?>
