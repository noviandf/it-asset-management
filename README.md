```markdown
# IT Asset Management System

A web-based internal inventory and asset lifecycle management system built with **CodeIgniter 4** to streamline hardware tracking, device mutation logs, damage reporting, and IT operational planning.

---

## 🚀 Key Features

* **IT Asset Inventory Tracking:** Complete hardware lifecycle records (desktops, laptops, network gear, specifications, serial numbers, and operational status).
* **Asset Mutation & Transfer Logs:** Detailed history tracking for asset movements and user/department reassignments (`LogMutasi`).
* **Maintenance & Issue Management:** Technical logs for hardware failures, repair status, and IT troubleshooting notes (`CatatanKerusakan` & `CatatanIt`).
* **IT Strategic Planning:** Built-in module for tracking IT procurement plans, system upgrades, and maintenance roadmaps (`CatatanPlanning`).
* **Role-Based Authentication & User Access:** Access control and account management for system administrators and IT staff (`Auth` & `User`).
* **Database Migrations & Seeders:** Fully structured schema migrations and initial database seeders for instant setup.

---

## 🛠️ Tech Stack

* **Backend Framework:** PHP 8.x, CodeIgniter 4
* **Frontend:** Bootstrap / AdminLTE, JavaScript, HTML5/CSS3
* **Database:** MySQL
* **Environment:** Compatible with Apache, Nginx, Laragon, or XAMPP

---

## ⚙️ Local Installation & Setup

1. **Clone Repository**
   ```bash
   git clone [https://github.com/noviandf/it-asset-management.git](https://github.com/noviandf/it-asset-management.git)
   cd it-asset-management

```

2. **Install Dependencies**
```bash
composer install

```


3. **Environment Configuration**
Copy the example environment file and configure your local database credentials:
```bash
cp env .env

```


Update settings in `.env`:
```ini
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = db_asset_management
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi

```


4. **Run Database Migrations & Seeders**
```bash
php spark migrate
php spark db:seed InitSeeder

```


5. **Start Development Server**
```bash
php spark serve

```


*Access the web application at `http://localhost:8080`.*

---

## 📁 Core Directory Structure

```text
app/
├── Config/            # Application, Security, Routes, & Database Configuration
├── Controllers/       # AsetIt, LogMutasi, CatatanIt, CatatanKerusakan, Auth, User
├── Database/          # Schema Migrations & InitSeeder
├── Models/            # AsetItModel, LogMutasiModel, CatatanModels
└── Views/             # UI Templates for Assets, Mutations, Logs, and Dashboard

```

---

## 🔒 Security & Sanitization Note

This repository has been fully sanitized for portfolio and demonstration purposes. All proprietary database SQL dumps, internal corporate IP addresses, employee details, and sensitive production credentials have been scrubbed or replaced with mock placeholder data.

```

```
