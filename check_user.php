<?php

use App\Models\User;

$user = User::find(8);
if ($user) {
    echo "User ID 8 found:\n";
    echo "Name: " . $user->name . "\n";
    echo "Photo: " . ($user->photo ?? 'NULL') . "\n";
    echo "NIM: " . $user->nim . "\n";
} else {
    echo "User ID 8 not found\n";
}