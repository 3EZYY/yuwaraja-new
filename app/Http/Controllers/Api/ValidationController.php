<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function checkUsername(Request $request)
    {
        $username = $request->get('username');
        
        if (empty($username)) {
            return response()->json(['available' => true]);
        }
        
        $exists = User::where('username', $username)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Username sudah dipakai nih!' : 'Username tersedia!'
        ]);
    }
    
    public function checkEmail(Request $request)
    {
        $email = $request->get('email');
        
        if (empty($email)) {
            return response()->json(['available' => true]);
        }
        
        $exists = User::where('email', $email)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email sudah dipakai nih!' : 'Email tersedia!'
        ]);
    }
    
    public function checkEmailStudent(Request $request)
    {
        $email_student = $request->get('email_student');
        
        if (empty($email_student)) {
            return response()->json(['available' => true]);
        }
        
        $exists = User::where('email_student', $email_student)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email student sudah dipakai!' : 'Email student tersedia!'
        ]);
    }
    
    public function checkNim(Request $request)
    {
        $nim = $request->get('nim');
        
        if (empty($nim)) {
            return response()->json(['available' => true]);
        }
        
        $exists = User::where('nim', $nim)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'NIM sudah terdaftar!' : 'NIM tersedia!'
        ]);
    }
}
