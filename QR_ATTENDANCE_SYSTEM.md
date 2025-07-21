# QR Code Attendance System Documentation

## Overview
This QR code-based attendance system allows administrators to create attendance sessions, generate QR codes, and track student attendance with time restrictions and role-based access.

## Features

### 1. Admin Features
- **Create Attendance Sessions**: Admins can create new attendance sessions with title, description, start time, and end time
- **Generate QR Codes**: Automatically generates unique QR codes for each attendance session
- **Download QR Codes**: Download QR codes as SVG files for printing or sharing
- **View Participants**: See detailed attendance reports with student information
- **Time Management**: Set specific time windows for attendance (e.g., 6 AM - 12 PM)

### 2. Student Features
- **QR Code Scanning**: Students can scan QR codes using their mobile devices
- **Attendance History**: View personal attendance history
- **Current Sessions**: See active attendance sessions
- **Real-time Feedback**: Immediate confirmation of attendance status

### 3. SPV (Supervisor) Features
- **Attendance Dashboard**: Overview of all attendance sessions
- **Detailed Reports**: View attendance by session with statistics
- **Export Data**: Export attendance data to CSV format
- **Group Analytics**: See attendance breakdown by student groups (kelompok)

## System Components

### Database Tables
1. **absensi**: Stores attendance sessions
   - `judul`: Session title
   - `deskripsi`: Session description
   - `qr_code`: Unique QR code identifier
   - `jam_mulai`: Start time
   - `jam_selesai`: End time
   - `is_active`: Active status

2. **absensi_mahasiswa**: Stores individual attendance records
   - `absensi_id`: Reference to attendance session
   - `user_id`: Reference to student
   - `waktu_absen`: Attendance timestamp
   - `ip_address`: Student's IP address
   - `user_agent`: Student's browser information

### Models
- **Absensi**: Main attendance session model with QR code generation
- **AbsensiMahasiswa**: Individual attendance record model

### Controllers
- **AbsensiController**: Handles QR code scanning and student attendance
- **SpvAbsensiController**: Manages SPV dashboard and reports

### Views
- **Admin Panel**: Filament-based admin interface for managing attendance
- **Student Views**: Mobile-friendly attendance interface
- **SPV Dashboard**: Supervisor reporting interface

## Usage Instructions

### For Administrators
1. **Access Admin Panel**: Login to `/admin` with admin credentials
2. **Create Attendance Session**:
   - Navigate to "Absensi" in the admin panel
   - Click "Buat Absensi Baru" (Create New Attendance)
   - Fill in title, description, start time, and end time
   - Save the session
3. **Download QR Code**:
   - In the attendance list, click the "Download QR Code" button
   - The QR code will be downloaded as an SVG file
   - Print or share the QR code with students
4. **Monitor Attendance**:
   - Click "Lihat Peserta" (View Participants) to see attendance status
   - Export data using the export function

### For Students
1. **Access Current Sessions**: Visit `/mahasiswa/absensi/current`
2. **Scan QR Code**:
   - Click "Scan QR Code" button
   - Allow camera access
   - Point camera at the QR code
   - Automatic redirect to attendance confirmation
3. **View History**: Check attendance history at `/mahasiswa/absensi/history`

### For SPV (Supervisors)
1. **Access Dashboard**: Login and visit `/spv/absensi`
2. **View Sessions**: See all attendance sessions with statistics
3. **Detailed Reports**: Click on any session to see detailed attendance
4. **Export Data**: Use the export button to download CSV reports

## Security Features
- **Role-based Access**: Only students can mark attendance
- **Time Restrictions**: Attendance only allowed within specified time windows
- **Duplicate Prevention**: Students cannot mark attendance twice for the same session
- **IP and User Agent Logging**: Track attendance source for security

## Technical Requirements
- **PHP 8.1+**
- **Laravel 10+**
- **MySQL Database**
- **QR Code Library**: simplesoftwareio/simple-qrcode
- **Filament Admin Panel**
- **Mobile Camera Access**: For QR code scanning

## File Structure
```
app/
├── Models/
│   ├── Absensi.php
│   └── AbsensiMahasiswa.php
├── Http/Controllers/
│   ├── AbsensiController.php
│   └── SpvAbsensiController.php
├── Filament/Resources/
│   ├── AbsensiResource.php
│   └── AbsensiResource/
│       ├── Actions/DownloadQrCodeAction.php
│       └── Pages/
resources/views/
├── absensi/
│   └── scan.blade.php
├── mahasiswa/absensi/
│   ├── current.blade.php
│   └── history.blade.php
└── spv/absensi/
    ├── index.blade.php
    └── show.blade.php
```

## Installation Steps
1. Run migrations: `php artisan migrate`
2. Install QR code package: `composer require simplesoftwareio/simple-qrcode`
3. Seed sample data: `php artisan db:seed --class=AbsensiSeeder`
4. Configure routes in `routes/web.php`
5. Set up admin panel access

## Troubleshooting
- **QR Code Not Working**: Check if the URL is accessible and the session is active
- **Camera Access Denied**: Ensure HTTPS is enabled for camera access
- **Time Zone Issues**: Verify server time zone matches local time zone
- **Database Errors**: Check MySQL connection and driver installation

## Future Enhancements
- **GPS Location Tracking**: Add location verification for attendance
- **Facial Recognition**: Integrate facial recognition for additional security
- **Mobile App**: Develop dedicated mobile application
- **Analytics Dashboard**: Advanced reporting and analytics
- **Notification System**: Email/SMS notifications for attendance