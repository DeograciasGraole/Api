# Language Learning API Backend

A comprehensive RESTful API backend built with Laravel 12 for a language learning application. This backend provides endpoints for managing languages, units, lessons, vocabulary, grammar, quizzes, and user progress tracking.

## 📋 Table of Contents

-   [Overview](#overview)
-   [Features](#features)
-   [Technology Stack](#technology-stack)
-   [Database Models](#database-models)
-   [Database Relationships](#database-relationships)
-   [API Endpoints](#api-endpoints)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Usage](#usage)

## 🎯 Overview

This backend API powers a language learning platform where users can:

-   Learn multiple languages through structured units and lessons
-   Study vocabulary with English and Turkish translations
-   Learn grammar rules with examples
-   Take quizzes to test their knowledge
-   Track their learning progress
-   Monitor completion status and progress percentages

## ✨ Features

-   **User Authentication**: Secure authentication using Laravel Sanctum with token-based API access
-   **Multi-language Support**: Support for multiple languages (currently English and Turkish)
-   **Structured Learning**: Organized content hierarchy: Languages → Units → Lessons
-   **Content Types**:
    -   Vocabulary lessons with word translations and examples
    -   Grammar lessons with rules, examples, and notes
-   **Quiz System**: Multiple-choice quizzes for each lesson
-   **Progress Tracking**: Track user progress through lessons with completion status and percentage
-   **Google OAuth**: Social login support via Google
-   **Role-based Access**: Admin/super user controls for content management

## 🛠 Technology Stack

-   **Framework**: Laravel 12
-   **PHP Version**: ^8.2
-   **Authentication**: Laravel Sanctum
-   **Database**: SQLite (default) / MySQL / PostgreSQL
-   **Social Auth**: Laravel Socialite (Google OAuth)
-   **Testing**: Pest PHP

## 📊 Database Models

The application consists of **9 main models**:

1. **User** - Application users/learners
2. **Language** - Supported languages (e.g., English, Turkish)
3. **Unit** - Learning units within a language
4. **Lesson** - Individual lessons within units
5. **Vocabulary** - Vocabulary words and translations
6. **Grammar** - Grammar rules and examples
7. **Quiz** - Quiz questions for lessons
8. **QuizResult** - User quiz attempt results
9. **UserProgress** - User progress tracking for lessons

## 🔗 Database Relationships

### Entity Relationship Diagram Overview

```
Language (1) ──→ (N) Units
Language (1) ──→ (N) Lessons
Language (1) ──→ (N) Vocabularies
Language (1) ──→ (N) Grammars
Language (1) ──→ (N) Quizzes

Unit (1) ──→ (N) Lessons
Unit (1) ──→ (N) Quizzes

Lesson (1) ──→ (N) Vocabularies
Lesson (1) ──→ (N) Grammars
Lesson (1) ──→ (N) Quizzes
Lesson (1) ──→ (1) UserProgress (for specific user)

User (1) ──→ (N) QuizResults
User (1) ──→ (N) UserProgress

Quiz (1) ──→ (N) QuizResults
```

### Detailed Relationships

#### **User Model**

-   `hasMany(QuizResult::class)` - A user can have multiple quiz results
-   `hasMany(UserProgress::class)` - A user can have progress records for multiple lessons

#### **Language Model**

-   `hasMany(Unit::class)` - A language has many units
-   `hasMany(Lesson::class)` - A language has many lessons
-   `hasMany(Vocabulary::class)` - A language has many vocabulary entries
-   `hasMany(Grammar::class)` - A language has many grammar rules
-   `hasMany(Quiz::class)` - A language has many quizzes

#### **Unit Model**

-   `belongsTo(Language::class)` - A unit belongs to a language
-   `hasMany(Lesson::class)` - A unit has many lessons
-   `hasMany(Quiz::class)` - A unit has many quizzes

#### **Lesson Model**

-   `belongsTo(Language::class)` - A lesson belongs to a language
-   `belongsTo(Unit::class)` - A lesson belongs to a unit
-   `hasMany(Vocabulary::class)` - A lesson has many vocabulary words
-   `hasMany(Grammar::class)` - A lesson has many grammar rules
-   `hasMany(Quiz::class)` - A lesson has many quizzes
-   `hasOne(UserProgress::class)` - A lesson has one progress record per user (scoped to authenticated user)

#### **Vocabulary Model**

-   `belongsTo(Language::class)` - A vocabulary entry belongs to a language
-   `belongsTo(Lesson::class)` - A vocabulary entry belongs to a lesson

#### **Grammar Model**

-   `belongsTo(Language::class)` - A grammar rule belongs to a language
-   `belongsTo(Lesson::class)` - A grammar rule belongs to a lesson

#### **Quiz Model**

-   `belongsTo(Language::class)` - A quiz belongs to a language
-   `belongsTo(Lesson::class)` - A quiz belongs to a lesson
-   `hasMany(QuizResult::class)` - A quiz has many results

#### **QuizResult Model**

-   `belongsTo(Quiz::class)` - A quiz result belongs to a quiz
-   `belongsTo(User::class)` - A quiz result belongs to a user (via foreign key)

#### **UserProgress Model**

-   `belongsTo(User::class)` - Progress belongs to a user
-   `belongsTo(Lesson::class)` - Progress belongs to a lesson

## 🚀 API Endpoints

### Authentication Endpoints

-   `POST /api/login` - User login (returns token)
-   `POST /api/register` - User registration (returns token)
-   `POST /api/logout` - User logout (requires authentication)
-   `GET /api/user` - Get authenticated user details (requires authentication)
-   `POST /api/auth/google` - Google OAuth login

### Protected Routes (Require Authentication)

All routes below require `auth:sanctum` middleware.

#### Units

-   `GET /api/units` - List all units with progress data
-   `POST /api/units` - Create a new unit (admin only - user_id 19)
-   `GET /api/units/{id}` - Get a specific unit with lessons
-   `PUT /api/units/{id}` - Update a unit (admin only)
-   `DELETE /api/units/{id}` - Delete a unit (admin only)

#### Lessons

-   `GET /api/units/{unit}/lessons` - List lessons in a unit
-   `POST /api/units/{unit}/lessons` - Create a lesson
-   `GET /api/units/{unit}/lessons/{lesson}` - Get a specific lesson
-   `PUT /api/units/{unit}/lessons/{lesson}` - Update a lesson
-   `DELETE /api/units/{unit}/lessons/{lesson}` - Delete a lesson

#### Vocabulary

-   `GET /api/units/{unit}/lessons/{lesson}/vocabularies` - List vocabularies in a lesson
-   `POST /api/units/{unit}/lessons/{lesson}/vocabularies` - Create vocabulary
-   `GET /api/units/{unit}/lessons/{lesson}/vocabularies/{vocabulary}` - Get vocabulary
-   `PUT /api/units/{unit}/lessons/{lesson}/vocabularies/{vocabulary}` - Update vocabulary
-   `DELETE /api/units/{unit}/lessons/{lesson}/vocabularies/{vocabulary}` - Delete vocabulary

#### Grammar

-   `GET /api/units/{unit}/lessons/{lesson}/grammars` - List grammar rules in a lesson
-   `POST /api/units/{unit}/lessons/{lesson}/grammars` - Create grammar rule
-   `GET /api/units/{unit}/lessons/{lesson}/grammars/{grammar}` - Get grammar rule
-   `PUT /api/units/{unit}/lessons/{lesson}/grammars/{grammar}` - Update grammar rule
-   `DELETE /api/units/{unit}/lessons/{lesson}/grammars/{grammar}` - Delete grammar rule

#### Quizzes

-   `GET /api/units/{unit}/lessons/{lesson}/quizzes` - List quizzes in a lesson
-   `POST /api/units/{unit}/lessons/{lesson}/quizzes` - Create quiz
-   `GET /api/units/{unit}/lessons/{lesson}/quizzes/{quiz}` - Get quiz
-   `PUT /api/units/{unit}/lessons/{lesson}/quizzes/{quiz}` - Update quiz
-   `DELETE /api/units/{unit}/lessons/{lesson}/quizzes/{quiz}` - Delete quiz

#### User Progress

-   `GET /api/progress` - Get authenticated user's progress
-   `POST /api/progress` - Mark lesson progress
-   `PUT /api/progress/{id}` - Update progress record

## 📦 Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js and npm (for frontend assets)

### Steps

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd LandApi
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node dependencies**

    ```bash
    npm install
    ```

4. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Database setup**

    ```bash
    # For SQLite (default)
    touch database/database.sqlite

    # Or configure MySQL/PostgreSQL in .env
    ```

6. **Run migrations**

    ```bash
    php artisan migrate
    ```

7. **Seed database (optional)**

    ```bash
    php artisan db:seed
    ```

8. **Start the development server**

    ```bash
    php artisan serve
    ```

    Or use the dev script:

    ```bash
    composer run dev
    ```

## ⚙️ Configuration

### Environment Variables

Key configuration in `.env`:

```env
APP_NAME="Language Learning API"
APP_ENV=local
APP_KEY=  # Generated by artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# For MySQL/PostgreSQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=landapi
# DB_USERNAME=root
# DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1

# Google OAuth (if using)
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/api/auth/google/callback
```

### Sanctum Configuration

The API uses Laravel Sanctum for authentication. Ensure your `.env` file has the correct `SANCTUM_STATEFUL_DOMAINS` configured for your frontend domain.

## 📝 Usage

### Authentication Flow

1. **Register a new user:**

    ```bash
    POST /api/register
    Body: {
      "name": "John Doe",
      "email": "john@example.com",
      "password": "password123"
    }
    ```

2. **Login:**

    ```bash
    POST /api/login
    Body: {
      "email": "john@example.com",
      "password": "password123"
    }
    Response: {
      "token": "1|...",
      "user": {...}
    }
    ```

3. **Use the token in subsequent requests:**
    ```bash
    Authorization: Bearer {token}
    ```

### Example API Calls

**Get all units with progress:**

```bash
GET /api/units
Headers: Authorization: Bearer {token}
```

**Get lessons in a unit:**

```bash
GET /api/units/1/lessons
Headers: Authorization: Bearer {token}
```

**Mark lesson progress:**

```bash
POST /api/progress
Headers: Authorization: Bearer {token}
Body: {
  "lesson_id": 1,
  "completed": true,
  "progress_percentage": 100
}
```

## 🗄️ Database Schema

### Tables Overview

-   **users** - User accounts
-   **languages** - Supported languages
-   **units** - Learning units
-   **lessons** - Individual lessons (type: vocabulary/grammar)
-   **vocabularies** - Vocabulary words with translations
-   **grammars** - Grammar rules with examples
-   **quizzes** - Quiz questions
-   **quiz_results** - User quiz attempts
-   **user_progress** - Lesson completion tracking
-   **personal_access_tokens** - Sanctum authentication tokens

## 🔒 Security Features

-   Password hashing using bcrypt
-   Token-based authentication via Laravel Sanctum
-   CSRF protection for web routes
-   SQL injection protection via Eloquent ORM
-   Input validation on all endpoints
-   Role-based access control (admin user_id: 19)

## 🧪 Testing

Run tests using Pest:

```bash
php artisan test
# or
composer run test
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👥 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

---

**Built with ❤️ using Laravel**
