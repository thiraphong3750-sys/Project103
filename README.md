# Enterprise Employee Attendance System

ระบบลงเวลาเข้า-ออกงานระดับองค์กร (Enterprise Grade) พัฒนาด้วย PHP 8+ (MVC Architecture) และ MySQL พร้อมดีไซน์ที่ทันสมัย (Modern & Minimal) ใช้สี Corporate Purple (#5B2D90)

## คุณสมบัติเด่น (Features)
- 🔒 **Security First**: ป้องกัน SQL Injection ด้วย PDO, XSS Protection, CSRF Protection, Password Hashing
- 🎨 **Modern UI**: ออกแบบด้วย Tailwind CSS, แบบอักษร Prompt, รองรับ Dark/Light Mode แบบอัตโนมัติ
- 📱 **Responsive Design**: รองรับการใช้งานผ่านมือถือ แท็บเล็ต และคอมพิวเตอร์
- 📊 **Analytics**: กราฟแสดงสถิติการเข้างานรายวันและรายเดือนด้วย Chart.js
- 📍 **GPS Location**: เก็บพิกัดละติจูด-ลองจิจูดเมื่อพนักงานลงเวลา
- 📸 **Camera Ready**: เตรียม UI สำหรับรองรับการถ่ายภาพตอนลงเวลา
- 👥 **Role-Based Access**: แบ่งสิทธิ์การใช้งาน (Super Admin, Admin, HR, Manager, Employee)

## โครงสร้างระบบ (Architecture)
ระบบถูกออกแบบโดยใช้สถาปัตยกรรม **MVC (Model-View-Controller)**:
- `app/core` - แกนหลักของระบบ (Router, Database, Base Controller)
- `app/controllers` - ควบคุมการทำงาน (Business Logic)
- `app/models` - จัดการฐานข้อมูล
- `app/views` - หน้าจอแสดงผล (UI)
- `app/helpers` - ฟังก์ชันช่วยเหลือด้านความปลอดภัย

## วิธีการติดตั้ง (Installation)

1. **ฐานข้อมูล (Database)**
   - สร้างฐานข้อมูล MySQL
   - นำเข้าไฟล์ SQL จาก `sql/database.sql` ไปยังฐานข้อมูลของคุณ

2. **การตั้งค่าระบบ (Configuration)**
   - เปิดไฟล์ `app/config/config.php`
   - แก้ไขค่าคงที่ให้ตรงกับเซิร์ฟเวอร์ของคุณ:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'attendance_system');
     
     // ปรับ URLROOT ให้ตรงกับโฟลเดอร์ของระบบ
     define('URLROOT', 'http://localhost/your-folder'); 
     ```

3. **การเข้าใช้งาน (Login)**
   - **Username:** `admin`
   - **Password:** `admin123`

## การรันเซิร์ฟเวอร์ทดสอบแบบ Local (PHP Built-in Server)
หากคุณมี PHP ติดตั้งอยู่ในเครื่อง สามารถรันระบบได้ทันทีผ่าน Command Line (ที่โฟลเดอร์ root ของโปรเจกต์):
```bash
php -S localhost:8000
```
จากนั้นเปิดเบราว์เซอร์ไปที่ `http://localhost:8000`

---
*Developed for Enterprise Environments.*
