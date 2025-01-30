

# Poll Sphere - Online Survey Management System



A robust web application built with **Laravel**, **Livewire**, and **Filament** for creating, managing, and analyzing online surveys. Designed for admins to effortlessly manage content and users, while providing actionable insights through interactive dashboards.

## ✨ Features

### **Admin Portal**
- **Survey Management**: Create, edit, publish/draft surveys, and track submission counts.
- **Question Bank**: Add/remove questions (multiple-choice, open-ended, etc.) and assign them to surveys.
- **User Management**: Add/remove users, assign surveys, and track submissions.
- **Analytics Dashboard**: Real-time charts for:
  - Published vs. Draft surveys
  - Survey submission trends
  - User participation rates
- **Filament-Powered Interface**: Sleek admin panel with CRUD operations and bulk actions.

### **User Portal**
- 📝 Submit assigned surveys with real-time validation.
- 📊 View completion status of assigned surveys.
- 🔍 Access survey history.

### **Technical Highlights**
- 🚀 Livewire for dynamic UI components.
- 📊 Chart.js (or your library) for visual analytics.
- 🔒 Role-based access control (Admin/User).

## 🛠️ Installation

### Prerequisites
- PHP ≥ 8.1
- Composer
- Node.js ≥ 16.x
- MySQL Database (or compatible)

### Step-by-Step Setup
1. **Clone the repository**:
   ```bash
   git clone https://github.com/ZahidKhan1100/Poll-Sphere.git
   cd poll-sphere
2. **Install PHP Dependencies**:
   ```bash
   composer install
4. **Install JavaScript Dependencies:**:
   ```bash
   npm install
6. **Configure Environment:**:
   Copy the example environment file:
   cp .env.example .env
   Generate the application encryption key:
   ```bash
   php artisan key:generate
Edit the .env file to match your database setup:
```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=8889
   DB_DATABASE=poll_sphere
   DB_USERNAME=
   DB_PASSWORD=
```
7. **Create the Database:**:
   Manually create a MySQL database named poll_sphere (matches your .env settings).

8. **Run Database Migrations & Seeding**:
    ```bash
   php artisan migrate --seed

9. **Compile Frontend Assets**:
```bash
   npm run build
```
10. **Start the Development Server**:
```bash
   php artisan serve
```
11. **Access the Application**:
    Admin Panel: Visit http://localhost:8000/admin/login
    Default Admin Credentials: admin@pollsphere.com / password

    User Portal: Visit http://localhost:8000/login
