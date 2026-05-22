# GoGreen — Modular Native PHP Backend

## Install (XAMPP)

1. Copy this folder into `C:\xampp\htdocs\gogreen`.
2. Start Apache + MySQL in XAMPP.
3. Create DB & import schema:
   - Open phpMyAdmin → New → DB name: `gogreen` (utf8mb4_unicode_ci)
   - Import `database/schema.sql`, then `database/seeds/seed.sql`
4. Edit `config/db.php` if your MySQL user/password differs (default: root / empty).
5. Visit `http://localhost/gogreen/public/` (front controller).

> Production: point Apache `DocumentRoot` at `public/` so the rest of the tree is unreachable. On XAMPP dev, `public/index.php` is already the entry point.

## Demo accounts (after seeding)

| Role   | Email                          | Password   |
|--------|--------------------------------|------------|
| Admin  | admin@admin.utem.edu.my        | Admin@123  |
| Worker | worker@staff.utem.edu.my       | Worker@123 |
| User   | student@student.utem.edu.my    | User@123   |

(Worker account is a staff user promoted to Worker via the admin panel — already done in seed.)

## Email policy

Only these domains can register/login:
- `@student.utem.edu.my` → role `user`
- `@staff.utem.edu.my`   → role `user` (admin can promote to worker)
- `@admin.utem.edu.my`   → role `admin`

## Points

| Material  | Points / kg |
|-----------|-------------|
| Plastic   | 10 |
| Paper     | 5 |
| Aluminium | 15 |
| Glass     | 2 |

10 points = 1 Tuah Indeks (configurable in `settings.points_per_indeks`).

## Cron (optional)

```
* * * * * php C:\xampp\htdocs\gogreen\scripts\send_notifications.php
0 2 * * * php C:\xampp\htdocs\gogreen\scripts\rebuild_analytics.php
0 3 * * * php C:\xampp\htdocs\gogreen\scripts\prune_logs.php
```

See `.lovable/plan.md` for the full architecture blueprint.
