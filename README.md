# Purchase Request Management System

Built with **Laravel 12** and **PHP 8.2**.

---

## Requirements
- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- XAMPP recommended

---

## Installation Steps

**1. Clone the repository**    

**2. Install dependencies**

**3. Create environment file**

**4. Configure database in .env**

**5. Create database and import**
- Open phpMyAdmin at http://localhost/phpmyadmin
- Create new database named: purchase_request_db
- Click the database then click Import tab
- Choose the database.sql file from this project root
- Click Go

**6. Start the server**

**7. Open browser**

---

## Database Configuration

| Setting  | Value               |
|----------|---------------------|
| Host     | 127.0.0.1           |
| Port     | 3306                |
| Database | purchase_request_db |
| Username | root                |
| Password | leave empty         |

---

## Login Credentials

| Field    | Value          |
|----------|----------------|
| Email    | admin@test.com |
| Password | password123    |

Or register a new account at http://localhost:8000/register

---

## Features
- Login and Register authentication
- Dashboard with Total, Pending, Approved, Rejected counts
- Create, View, Edit, Delete Purchase Requests
- Search by PR Number
- Filter by Status
- Validation on all fields with custom error messages
- AJAX status update without page reload (Bonus)
- DataTables column sorting (Bonus)
- REST API endpoints (Bonus)
- Responsive Bootstrap 5 UI

---

## REST API Endpoints

| Method | URL                              | Description            |
|--------|----------------------------------|------------------------|
| GET    | /api/purchase-requests           | All requests as JSON   |
| GET    | /api/purchase-requests/{id}      | Single request as JSON |
| PATCH  | /purchase-requests/{id}/status   | Update status via AJAX |

---

## Assignment Requirements Completed
- [x] Authentication — Login and Register
- [x] Database — users and purchase_requests tables with all required columns
- [x] Dashboard — Total, Pending, Approved, Rejected counts
- [x] Create Purchase Request
- [x] View All Purchase Requests
- [x] View Single Purchase Request
- [x] Edit Purchase Request
- [x] Delete Purchase Request
- [x] Search by PR Number
- [x] Filter by Status
- [x] Validation — all fields required, PR Number unique, custom messages
- [x] Bootstrap 5 UI — Responsive design
- [x] AJAX status update without page reload (Bonus)
- [x] DataTables column sorting (Bonus)
- [x] REST API (Bonus)

---

Note: Bootstrap 5, Bootstrap Icons, jQuery, DataTables load via CDN.

