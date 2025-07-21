# AI-Powered Laravel CMS

A modern, feature-rich Content Management System (CMS) built with Laravel 11, featuring a token-based API, role-based access control, and AI-powered content generation. The frontend is a sleek, responsive single-page application experience built with Blade and vanilla JavaScript.

## Features

### Core Backend & API
- **Modern Laravel 11 Backend**: Built on the latest version of Laravel for performance and security.
- **JWT-Based API Authentication**: Secure, stateless authentication for all API endpoints.
- **Asynchronous Job Queuing**: Heavy tasks like AI content generation are handled in the background for a snappy user experience.
- **Role-Based Access Control (RBAC)**:
    - **Admin**: Full control over all articles, categories, and users.
    - **Author**: Can only create and manage their own articles.
- **Comprehensive API Testing**: Feature tests for all major API endpoints to ensure reliability.

### AI-Powered Content Generation
- **Asynchronous Slug Generation**: Automatically creates a unique, SEO-friendly slug from the article title in a background job.
- **Asynchronous Summary Generation**: Uses a simulated AI service to automatically generate a concise summary of the article content.

### Content Management
- **Full Article CRUD**: Create, read, update, and delete articles.
- **Advanced Filtering**: Filter articles by category, status (draft, published, archived), or a specific date range.
- **Category Management (Admin Only)**: Admins have a dedicated interface to manage content categories.

### Modern Frontend
- **Reusable Blade Components**: A clean and maintainable frontend architecture using a master layout and shared components.
- **Dynamic UI**: The user interface dynamically shows or hides admin-only features based on the logged-in user's role.
- **Modern Design**:
    - **Glass-Morphism Login Screen**: A beautiful, animated login page.
    - **Professional Dashboard**: A sleek, responsive dashboard with a sidebar, animated content cards, and a personalized greeting.
    - **User-Friendly Forms**: Modern and intuitive forms for creating and editing content.

## Getting Started

Follow these instructions to get the project set up and running on your local machine.

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- A database (e.g., MySQL, PostgreSQL)

### 1. Clone the Repository

```bash
git clone https://github.com/vikrant-mayekar/cms.git
cd cms
```

### 2. Install Dependencies

Install both PHP and JavaScript dependencies.

```bash
composer install
npm install
```

### 3. Environment Configuration

Create a `.env` file by copying the example file.

```bash
cp .env.example .env
```

Now, open the `.env` file and configure your database connection details (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

### 4. Generate Application Keys

Generate the Laravel application key and the JWT secret key.

```bash
php artisan key:generate
php artisan jwt:secret
```

### 5. Run Database Migrations & Seeders

Reset the database and run all migrations and seeders. This will create all the necessary tables and populate the database with an admin and an author user.

```bash
php artisan migrate:fresh --seed
```

**Default User Credentials:**
- **Admin**: `admin@example.com` / `password`
- **Author**: `author@example.com` / `password`

### 6. Start the Servers

You need to run the Laravel development server and the Vite server for frontend assets.

```bash
# Start the Laravel server
php artisan serve

# In a new terminal, start the Vite server
npm run dev
```

### 7. Run the Queue Worker

To process the asynchronous AI jobs for slug and summary generation, you need to run the queue worker.

```bash
# In a new terminal, start the queue worker
php artisan queue:work
```

You're all set! Open your browser and navigate to `http://127.0.0.1:8000/login` to get started.
