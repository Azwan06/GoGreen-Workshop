# 🌿 UTeM GoGreen — Campus Recycling Management

Native PHP + MySQL system for Universiti Teknikal Malaysia Melaka. No frameworks, no CDNs at runtime.

## ⚙️ Requirements
- XAMPP (Apache + MySQL + PHP 8.0+)

## 🚀 Setup (5 min)
1. **Copy** the `gogreen` folder into `C:\xampp\htdocs\` (or `/opt/lampp/htdocs/`).
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Open phpMyAdmin → click **Import** → choose `gogreen/gogreen.sql` → Go.
4. Visit **http://localhost/gogreen/**

If your MySQL has a password, edit `config/db.php`.

## 👤 Demo Accounts (password: `Password123`)
| Role   | Email                              |
|--------|------------------------------------|
| User   | student1@student.utem.edu.my       |
| Worker | worker1@staff.utem.edu.my          |
| Admin  | admin1@admin.utem.edu.my           |

## 📧 Email Domain → Role
- `@student.utem.edu.my` → User
- `@staff.utem.edu.my`   → Worker
- `@admin.utem.edu.my`   → Admin

Role is **auto-assigned** based on email domain. Other domains are rejected at register/login.

## 🏆 Points System
| Category | Points / KG |
|----------|-------------|
| Plastic  | 10          |
| Paper    | 5           |
| Glass    | 2           |

Every **10 points = 1 Tuah Indeks**. Points only awarded after admin approval.

## 📂 Structure
```
gogreen/
├── index.php · about.php · contact.php · login.php · register.php · logout.php
├── toggle_theme.php
├── config/db.php
├── includes/ (auth, helpers, header, footer, sidebar, profile_form)
├── assets/css · assets/js (incl. local Leaflet) · assets/images
├── uploads/ (profile, submissions, pickups, worker)
├── user/    (dashboard, submit, history, pickup, map, notifications, report, profile)
├── worker/  (dashboard, pickups, bins, reports, profile)
├── admin/   (dashboard, analytics, verify, pickups, bins, users, reports, profile)
└── gogreen.sql
```

## 🔒 Security
- Prepared statements everywhere (mysqli)
- `password_hash` / `password_verify` (bcrypt)
- Role-based access via `require_role()`
- File-upload MIME validation + size limit (5 MB)
- HTML output escaped through `e()`
- Session-based auth; banned users blocked at login

## ✨ Features
- 🌗 Dark mode (saved per-user in DB)
- 📱 Fully responsive (desktop / tablet / mobile hamburger sidebar)
- 🗺️ Campus bin map (local Leaflet + OSM tiles)
- 📈 Pure SVG analytics charts (no dependencies)
- 🔔 In-app notifications
- 🚚 Pickup workflow with worker assignment
- ✅ Manual admin verification
- 👤 Profile picture upload / remove
- 🔍 Search + pagination on tables

Enjoy building a greener UTeM 🌱
