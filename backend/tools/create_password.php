<?php
// Ask the CLI for the password
echo "Enter the password: ";
$password = trim(fgets(STDIN));

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

echo "Password: $password\n";
echo "Hashed Password: $hashed_password\n";
