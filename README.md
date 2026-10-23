# IT Asset Management System

A web-based internal inventory and asset lifecycle management system built with **CodeIgniter 4** to streamline hardware tracking, device mutations, damage logs, and IT operational planning.

---

## 🚀 Key Features

* **IT Asset Inventory Tracking:** Complete hardware lifecycle records (desktops, laptops, network gear, specs, serial numbers, and status).
* **Asset Mutation & Transfer Logs:** Detailed history tracking for asset movements and assignments across departments or users (`LogMutasi`).
* **Maintenance & Issue Management:** Operational logging for hardware damages, repair notes, and technical troubleshooting (`CatatanKerusakan` & `CatatanIt`).
* **IT Strategic Planning:** Built-in module for tracking IT procurement plans, system upgrades, and task roadmaps (`CatatanPlanning`).
* **Role-Based Authentication:** User management and access control for system administrators and IT staff.
* **Database Migrations & Seeders:** Included migration files and initial seeders for seamless local setup.

---

## 🛠️ Tech Stack

* **Framework:** PHP 8.x, CodeIgniter 4
* **Frontend:** Bootstrap / AdminLTE, JavaScript, HTML5/CSS3
* **Database:** MySQL
* **Environment:** Compatible with Apache, Nginx, Laragon, or XAMPP

---

## ⚙️ Local Installation & Setup

1. **Clone Repository**
   ```bash
   git clone [https://github.com/noviandf/it-asset-management.git](https://github.com/noviandf/it-asset-management.git)
   cd it-asset-management
Install Dependencies

Bash
composer install
Environment Configuration
Copy the example environment file and set up your local database credentials:

Bash
cp env .env
Update .env settings:

Ini, TOML
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = db_asset_management
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
Run Database Migrations & Seeders

Bash
php spark migrate
php spark db:seed InitSeeder
Start Development Server

Bash
php spark serve
Access the web application at http://localhost:8080.

📁 Core Directory Structure
Plaintext
app/
├── Config/            # Application & Database Configuration
├── Controllers/       # AsetIt, LogMutasi, CatatanIt, CatatanKerusakan, Auth
├── Database/          # Migrations & InitSeeder
├── Models/            # AsetItModel, LogMutasiModel, CatatanModels
└── Views/             # UI Templates for Assets, Logs, and Dashboard
🔒 Security & Sanitization Note
This repository has been fully sanitized for portfolio and demonstration purposes. All proprietary database SQL dumps, internal corporate IP addresses, employee details, and sensitive credentials have been removed or replaced with mock placeholder data.
