<?php
// sign up form that creates user account
require_once 'login.php';

// connect to mysql
$conn = new mysqli($hn, $un, $pw, $db);

function signup($conn)
{
    // check connection
    if ($conn) {

        // connection but connection error
        if ($conn->connect_error)
            die($conn->connect_error);

        // html work for signup
        echo <<<_END
        <html>
        <head>
        	<title>Sign Up</title> <script src = "signup.js"></script>
        </head>
        <body>
        <div class="block" align= "center">
            <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
                <th colspan="2" align="center">Sign Up</th>
                <form name="myForm" action="signup.php" onsubmit="return validateForm()" method="post"><pre>
                    <tr><td>Email</td>
                    <td><input type="email" maxlength="64" name="Email"></td></tr>
                    <tr><td>Username</td>
                    <td><input type="text" maxlength="20" name="Username"></td></tr>
                    <tr><td>Password</td>
                    <td><input type="password" maxlength="20" name="Password" id="Password"></td></tr>
                    <tr><td colspan="2" align="center"><input type="submit" value="Sign Up"></td></tr>
                    <tr><td colspan="2" align="center"><a href="auth.php">Click to Login</a></td></tr>
                </pre>
                </form>
            </table>
        </div>
        
        </body>
        </html>
        _END;
        echo "</body></html>";

        //JS will handle empty and other associated inputs
        //JS will prompt required field input
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['Username']) && $_POST['Password']) {
                // get user email
                $email = $_POST['Email'];
                // get user username
                $username = $_POST['Username'];
                // get user password
                $password = $_POST['Password'];

                // sanitize
                $username = sanitize($conn, $username);
                $password = sanitize($conn, $password);

                // check just letters and numbers
                $check1 = stringCheck($conn, $username);
                $check2 = stringCheck($conn, $password);

                
                // $salt1 = "qm&h*"; 
                // $salt2 = "pg!@";
                // $token = hash('ripemd128', "$salt1$password$salt2");
                $token = password_hash("$password", PASSWORD_DEFAULT);
                if ($check1 && $check2) {
                    // add user to db and create account
                    add_user($conn, $email, $username, $token);
                    echo "Your account has been created!";
                }
            }
        }
    } else {
        echo "No connection to server";
    }
}

function add_user($conn, $email, $un, $pw)
{
    $query = "INSERT INTO users VALUES(NULL,'$email', '$un', '$pw')";
    $result = $conn->query($query);
    if (!$result) die($conn->error);
        
//         $conn->close();
}

// function to sanitize variables
function sanitize($conn, $var)
{
    $sanitize = $conn->real_escape_string($var);
    $sanitize = stripslashes($var);
    $sanitize = htmlentities($var, ENT_QUOTES);

    return $sanitize;
}

// check input for numbers and letters
function stringCheck($conn, $var)
{
    if (! preg_match('/[^A-Za-z0-9]/', $var) && ! empty($var)) {
        $bool = true;
    } else {
        $bool = false;
    }
    return $bool;
}

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var] ?? "");
}

// tester function
function tester()
{
    $pass = "p";
    $fail = " ";

    signup($pass);
    signup($fail);
}
signup($conn);
// tester();

?>