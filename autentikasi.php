<?php
// Mengaktifkan session PHP
session_start();

include("koneksi.php");

$response = array();

if (empty($_POST['username']) || empty($_POST['password'])) {
    $response['error'] = "Please fill both the username and password fields!";
} else {
$captcha = $_POST['captcha'];
$randcaptcha = $_POST['captcha-rand'];
if ($captcha !== $randcaptcha) {
    $response['error'] = "reCAPTCHA verification failed!";
} else {
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id_agent, password, id_level FROM tb_agent WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $level);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            $session_id = uniqid();

            // Create sessions and store the unique ID
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username_agent'] = $_POST['username'];
            $_SESSION['id_agent'] = $id;
            $_SESSION['id_level'] = $level;
            $_SESSION['session_id'] = $session_id;

            // Check user level and redirect accordingly
            if ($level == "1") {
                header('Location: manager/dashboard.php');
                exit();
            } else if ($level == "2") {
                header('Location: leader/dashboard.php');
                exit();
            } else if ($level == "3") {
                $response['success'] = "Login Success! Welcome Agent " . $_POST['username'];
            } else {
                // Invalid user level
                echo 'Invalid user level!';
                exit();
            } 
        }   else {
            // Akun dengan username tersebut tidak ditemukan di kedua tabel
            $response['error'] = "Incorrect username or password!";
        }
    } else {
        // Tidak ditemukan akun dengan username tersebut
        // Mencoba mencari sebagai finance
        if ($stmt = $con->prepare('SELECT id_finance, password FROM tb_finance WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
                if (password_verify($_POST['password'], $password)) {
                    // Verification success! User has logged-in!

                    // Create sessions and store the unique ID
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['username_finance'] = $_POST['username'];
                    $_SESSION['id_finance'] = $id;

                    $response['success'] = "Login Success! Welcome " . $_POST['username'];
                }  else {
                    $response['error'] = "Incorrect username or password!";
                }
            } else {
                // Akun dengan username tersebut tidak ditemukan di kedua tabel
                $response['error'] = "Incorrect username or password!";
            }
            
        }
     // Tidak ditemukan akun dengan username tersebut
        // Mencoba mencari sebagai pemimpin
        if ($stmt = $con->prepare('SELECT id_leader, password, id_level FROM tb_leader WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password, $level);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
                if (password_verify($_POST['password'], $password)) {
                    // Verification success! User has logged-in!
                    $session_id = uniqid();

                    // Create sessions and store the unique ID
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['username_leader'] = $_POST['username'];
                    $_SESSION['id_leader'] = $id;
                    $_SESSION['id_level'] = $level;
                    $_SESSION['session_id'] = $session_id;

                    // Check user level and redirect accordingly
                    if ($level == "1") {
                        header('Location: manager/dashboard.php');
                        exit();
                    } else if ($level == "2") {
                        if ( $_SESSION['loggedin'] = TRUE) {
                            $response['success'] = "Login Success! Welcome Leader " . $_POST['username'];
                        } else {
                        exit();
                        }
                    } else if ($level == "3") {
                        header('Location: dashboard.php');
                    } else {
                        // Invalid user level
                        echo 'Invalid user level!';
                        exit();
                    }
                }  else {
                    $response['error'] = "Incorrect username or password!";
                }
            } else {
                // Akun dengan username tersebut tidak ditemukan di kedua tabel
                $response['error'] = "Incorrect username or password!";
            }
            
        }
    
    
    }
} else {
    $response['error'] = "Database connection error!";
} 

}
}



echo json_encode($response);

?>