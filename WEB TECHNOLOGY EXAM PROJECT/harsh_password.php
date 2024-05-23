<?php
$password = password_hash('your_password', PASSWORD_DEFAULT);

if (password_verify($input_password, $row['Password'])) {
    // Password is correct
}
?>
