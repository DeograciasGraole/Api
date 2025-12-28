# Language Learning API Backend

A comprehensive RESTful API backend built with Laravel 12 for a language learning application. This backend provides endpoints for managing languages, units, lessons, vocabulary, grammar, quizzes, and user progress tracking.

## 📋 Table of Contents

-   [Overview](#overview)
-   [Features](#features)
-   [Technology Stack](#technology-stack)
-   [Database Models](#database-models)
-   [Database Relationships](#database-relationships)
-   [API Endpoints](#api-endpoints)
    -   [Authentication](#authentication-endpoints)
    -   [Units](#units-endpoints)
    -   [Lessons](#lessons-endpoints)
    -   [Vocabulary](#vocabulary-endpoints)
    -   [Grammar](#grammar-endpoints)
    -   [Quizzes](#quizzes-endpoints)
    -   [User Progress](#user-progress-endpoints)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Usage Examples](#usage-examples)
-   [Request/Response Formats](#requestresponse-formats)
-   [Error Handling](#error-handling)
-   [Authentication](#authentication)
-   [Database Schema](#database-schema)
-   [Security Features](#security-features)
-   [Testing](#testing)
-   [Deployment](#deployment)
-   [Contributing](#contributing)
-   [License](#license)

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
-   **Role-based Access Control**: Admin role-based permissions for content management (CRUD operations restricted to admins)

## 🛠 Technology Stack

-   **Framework**: Laravel 12
-   **PHP Version**: ^8.2
-   **Authentication**: Laravel Sanctum
-   **Database**: SQLite (default) / MySQL / PostgreSQL
-   **Social Auth**: Laravel Socialite (Google OAuth)
-   **Testing**: Pest PHP
-   **Package Manager**: Composer
-   **Frontend Assets**: Vite, npm

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

### Base URL

All API endpoints are prefixed with `/api`:

```
http://localhost:8000/api
```

### Authentication

Most endpoints require authentication via Laravel Sanctum. Include the token in the Authorization header:

```
Authorization: Bearer {token}
```

### Access Control

- **Public Routes**: Registration and login endpoints are publicly accessible
- **Authenticated Routes**: All other endpoints require authentication. Regular users can read (GET) resources
- **Admin Routes**: Create, update, and delete operations require admin role (`role === 'admin'`)

### Route Structure

The API follows a nested resource structure:

```
/api/units                          # List all units (GET) | Create unit (POST - Admin)
/api/units/{id}                     # Get unit (GET) | Update unit (PUT - Admin) | Delete unit (DELETE - Admin)
/api/units/{unit}/lessons           # List lessons (GET) | Create lesson (POST - Admin)
/api/units/{unit}/lessons/{lesson}  # Get lesson (GET) | Update lesson (PUT - Admin) | Delete lesson (DELETE - Admin)
/api/units/{unit}/lessons/{lesson}/vocabularies  # List vocabularies (GET) | CRUD (Admin)
/api/units/{unit}/lessons/{lesson}/grammars      # List grammars (GET) | CRUD (Admin)
/api/units/{unit}/lessons/{lesson}/quizzes       # List quizzes (GET) | CRUD (Admin)
```

**Note**: All nested routes use Laravel's route model binding with `scopeBindings()` to ensure proper parent-child relationships.

---

## Authentication Endpoints

### Register User

Register a new user account.

**Endpoint:** `POST /api/register`

**Authentication:** Not required

**Request Body:**

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

**Validation Rules:**

-   `name`: required, string, max:255
-   `email`: required, email, unique:users,email
-   `password`: required

**Response:** `201 Created`

```json
{
    "token": "1|abcdef1234567890...",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

---

### Login

Authenticate user and receive access token.

**Endpoint:** `POST /api/login`

**Authentication:** Not required

**Request Body:**

```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Validation Rules:**

-   `email`: required
-   `password`: required

**Response:** `200 OK`

```json
{
    "token": "1|abcdef1234567890...",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

**Error Response:** `422 Unprocessable Entity`

```json
{
    "message": "The email credentials are incorrect",
    "errors": {
        "email": ["The email credentials are incorrect"]
    }
}
```

---

### Logout

Logout user and revoke all tokens.

**Endpoint:** `POST /api/logout`

**Authentication:** Required

**Response:** `200 OK`

```json
{
    "message": "Logged out from all devices successfully"
}
```

---

### Get Authenticated User

Get details of the currently authenticated user.

**Endpoint:** `GET /api/user`

**Authentication:** Required

**Response:** `200 OK`

```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

---

### Google OAuth Login

**Note**: Google OAuth controller exists but route is not currently registered. To enable, add the following route in `routes/api.php`:

```php
Route::post('google-login', [GoogleController::class, 'googleLogin']);
```

Authenticate user via Google OAuth.

**Endpoint:** `POST /api/google-login` (when enabled)

**Authentication:** Not required

**Request Body:**

```json
{
    "token": "google_id_token_string"
}
```

**Response:** `200 OK`

```json
{
    "token": "1|abcdef1234567890...",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

**Error Responses:**

-   `401 Unauthorized` - Invalid Google token
-   `500 Internal Server Error` - Google sign in failed

---

## Units Endpoints

### List All Units

Get all units with progress data for the authenticated user.

**Endpoint:** `GET /api/units`

**Authentication:** Required

**Response:** `200 OK`

```json
[
    {
        "id": 1,
        "language_id": 1,
        "title": "Unit 1: Basics",
        "description": "Introduction to basic concepts",
        "image": "https://example.com/image.jpg",
        "total_lessons": 5,
        "completed_lessons": 2,
        "total_percentage": 40.0
    }
]
```

---

### Get Single Unit

Get a specific unit with its lessons.

**Endpoint:** `GET /api/units/{id}`

**Authentication:** Required

**Parameters:**

-   `id` (path, required): Unit ID

**Response:** `200 OK`

```json
{
    "id": 1,
    "language_id": 1,
    "title": "Unit 1: Basics",
    "description": "Introduction to basic concepts",
    "image": "https://example.com/image.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "lessons": [
        {
            "id": 1,
            "unit_id": 1,
            "language_id": 1,
            "name": "Lesson 1: Greetings",
            "type": "vocabulary",
            "content": "...",
            "order": 1
        }
    ]
}
```

---

### Create Unit

Create a new unit (Admin only).

**Endpoint:** `POST /api/units`

**Authentication:** Required

**Request Body:**

```json
{
    "language_id": 1,
    "title": "Unit 1: Basics",
    "description": "Introduction to basic concepts",
    "image": "https://example.com/image.jpg"
}
```

**Validation Rules:**

-   `language_id`: required
-   `title`: required
-   `description`: required
-   `image`: optional

**Response:** `201 Created`

```json
{
    "id": 1,
    "language_id": 1,
    "title": "Unit 1: Basics",
    "description": "Introduction to basic concepts",
    "image": "https://example.com/image.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

---

### Update Unit

Update an existing unit (Admin only).

**Endpoint:** `PUT /api/units/{id}`

**Authentication:** Required

**Parameters:**

-   `id` (path, required): Unit ID

**Request Body:**

```json
{
    "title": "Updated Unit Title",
    "description": "Updated description",
    "image": "https://example.com/new-image.jpg"
}
```

**Validation Rules:**

-   `language_id`: optional
-   `title`: optional
-   `description`: optional
-   `image`: optional

**Response:** `200 OK`

```json
{
    "id": 1,
    "language_id": 1,
    "title": "Updated Unit Title",
    "description": "Updated description",
    "image": "https://example.com/new-image.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T12:00:00.000000Z"
}
```

**Error Response:** `403 Forbidden`

```json
{
    "message": "Forbidden"
}
```

---

### Delete Unit

Delete a unit (Admin only).

**Endpoint:** `DELETE /api/units/{id}`

**Authentication:** Required

**Parameters:**

-   `id` (path, required): Unit ID

**Response:** `204 No Content`

---

## Lessons Endpoints

### List Lessons in Unit

Get all lessons in a specific unit.

**Endpoint:** `GET /api/units/{unit}/lessons`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID

**Response:** `200 OK`

```json
[
    {
        "id": 1,
        "unit_id": 1,
        "language_id": 1,
        "name": "Lesson 1: Greetings",
        "type": "vocabulary",
        "content": "Lesson content...",
        "order": 1,
        "progress": {
            "id": 1,
            "user_id": 1,
            "lesson_id": 1,
            "completed": true,
            "progress_percentage": 100
        }
    }
]
```

---

### Get Single Lesson

Get a specific lesson with vocabularies, grammars, quizzes, and progress.

**Endpoint:** `GET /api/units/{unit}/lessons/{lesson}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Response:** `200 OK`

```json
{
    "id": 1,
    "unit_id": 1,
    "language_id": 1,
    "name": "Lesson 1: Greetings",
    "type": "vocabulary",
    "content": "Lesson content...",
    "order": 1,
    "vocabularies": [
        {
            "id": 1,
            "language_id": 1,
            "lesson_id": 1,
            "word_en": "Hello",
            "word_tr": "Merhaba",
            "example_en": "Hello, how are you?",
            "example_tr": "Merhaba, nasılsın?",
            "image": null
        }
    ],
    "grammars": [
        {
            "id": 1,
            "language_id": 1,
            "lesson_id": 1,
            "title": "Present Tense",
            "description": "...",
            "sentence_en": "I am happy",
            "sentence_tr": "Ben mutluyum",
            "note": "Important note...",
            "image": null
        }
    ],
    "quizzes": [
        {
            "id": 1,
            "lesson_id": 1,
            "language_id": 1,
            "question": "What is 'Hello' in Turkish?",
            "option_a": "Merhaba",
            "option_b": "Güle güle",
            "option_c": "Teşekkürler",
            "option_d": "Lütfen",
            "correct_option": "a",
            "image": null
        }
    ],
    "progress": {
        "id": 1,
        "user_id": 1,
        "lesson_id": 1,
        "completed": true,
        "progress_percentage": 100
    }
}
```

---

### Create Lesson

Create a new lesson in a unit (Admin only).

**Endpoint:** `POST /api/units/{unit}/lessons`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID

**Request Body:**

```json
{
    "name": "Lesson 1: Greetings",
    "type": "vocabulary",
    "content": "Lesson content...",
    "order": 1
}
```

**Validation Rules:**

-   `name`: required
-   `type`: required (vocabulary/grammar)
-   `content`: optional
-   `order`: required

**Response:** `201 Created`

```json
{
    "id": 1,
    "language_id": 3,
    "unit_id": 7,
    "name": "Lesson 1: Greetings",
    "type": "vocabulary",
    "content": "Lesson content...",
    "order": 1,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

**Note:** The `language_id` is automatically set from the parent unit's `language_id`.

---

### Update Lesson

Update an existing lesson (Admin only).

**Endpoint:** `PUT /api/units/{unit}/lessons/{lesson}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Request Body:**

```json
{
    "name": "Updated Lesson Name",
    "type": "grammar",
    "content": "Updated content...",
    "order": 2
}
```

**Validation Rules:**

-   `name`: optional
-   `type`: optional
-   `content`: optional
-   `order`: optional

**Response:** `200 OK`

```json
{
    "id": 1,
    "unit_id": 1,
    "language_id": 1,
    "name": "Updated Lesson Name",
    "type": "grammar",
    "content": "Updated content...",
    "order": 2,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T12:00:00.000000Z"
}
```

**Error Response:** `403 Forbidden`

```json
{
    "message": "Forbidden"
}
```

---

### Delete Lesson

Delete a lesson (Admin only).

**Endpoint:** `DELETE /api/units/{unit}/lessons/{lesson}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Response:** `204 No Content`

---

## Vocabulary Endpoints

### List Vocabularies in Lesson

Get all vocabulary words in a specific lesson.

**Endpoint:** `GET /api/units/{unit}/lessons/{lesson}/vocabularies`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Response:** `200 OK`

```json
{
    "id": 1,
    "unit_id": 1,
    "language_id": 1,
    "name": "Lesson 1: Greetings",
    "type": "vocabulary",
    "content": "...",
    "order": 1,
    "vocabularies": [
        {
            "id": 1,
            "language_id": 1,
            "lesson_id": 1,
            "word_en": "Hello",
            "word_tr": "Merhaba",
            "example_en": "Hello, how are you?",
            "example_tr": "Merhaba, nasılsın?",
            "image": "https://example.com/image.jpg",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ]
}
```

---

### Create Vocabulary

Add a new vocabulary word to a lesson (Admin only).

**Endpoint:** `POST /api/units/{unit}/lessons/{lesson}/vocabularies`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Request Body:**

```json
{
    "word_en": "Hello",
    "word_tr": "Merhaba",
    "example_en": "Hello, how are you?",
    "example_tr": "Merhaba, nasılsın?",
    "image": "https://example.com/image.jpg"
}
```

**Validation Rules:**

-   `word_en`: required, string
-   `word_tr`: required, string
-   `example_en`: required, string
-   `example_tr`: required, string
-   `image`: optional

**Response:** `201 Created`

```json
{
    "id": 1,
    "language_id": 1,
    "lesson_id": 1,
    "word_en": "Hello",
    "word_tr": "Merhaba",
    "example_en": "Hello, how are you?",
    "example_tr": "Merhaba, nasılsın?",
    "image": "https://example.com/image.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

---

### Update Vocabulary

Update an existing vocabulary word (Admin only).

**Endpoint:** `PUT /api/units/{unit}/lessons/{lesson}/vocabularies/{vocabulary}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID
-   `vocabulary` (path, required): Vocabulary ID

**Request Body:**

```json
{
    "word_en": "Hi",
    "word_tr": "Selam",
    "example_en": "Hi there!",
    "example_tr": "Selam!"
}
```

**Validation Rules:**

-   All fields optional (use `sometimes` validation)

**Response:** `200 OK`

```json
{
    "id": 1,
    "language_id": 1,
    "lesson_id": 1,
    "word_en": "Hi",
    "word_tr": "Selam",
    "example_en": "Hi there!",
    "example_tr": "Selam!",
    "image": "https://example.com/image.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T12:00:00.000000Z"
}
```

---

### Delete Vocabulary

Delete a vocabulary word (Admin only).

**Endpoint:** `DELETE /api/units/{unit}/lessons/{lesson}/vocabularies/{vocabulary}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID
-   `vocabulary` (path, required): Vocabulary ID

**Response:** `204 No Content`

---

## Grammar Endpoints

### List Grammar Rules in Lesson

Get all grammar rules in a specific lesson.

**Endpoint:** `GET /api/units/{unit}/lessons/{lesson}/grammars`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Response:** `200 OK`

```json
{
    "id": 1,
    "unit_id": 1,
    "language_id": 1,
    "name": "Lesson 1: Grammar",
    "type": "grammar",
    "content": "...",
    "order": 1,
    "grammars": [
        {
            "id": 1,
            "language_id": 1,
            "lesson_id": 1,
            "title": "Present Tense",
            "description": "The present tense is used...",
            "sentence_en": "I am happy",
            "sentence_tr": "Ben mutluyum",
            "note": "Important: Always use 'am' with 'I'",
            "image": "https://example.com/image.jpg",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ]
}
```

---

### Create Grammar Rule

Add a new grammar rule to a lesson (Admin only).

**Endpoint:** `POST /api/units/{unit}/lessons/{lesson}/grammars`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Request Body:**

```json
{
    "title": "Present Tense",
    "description": "The present tense is used...",
    "sentence_en": "I am happy",
    "sentence_tr": "Ben mutluyum",
    "note": "Important: Always use 'am' with 'I'",
    "image": "https://example.com/image.jpg"
}
```

**Validation Rules:**

-   `title`: required, string
-   `description`: required, string
-   `sentence_en`: required, string
-   `sentence_tr`: required, string
-   `note`: required, string
-   `image`: required

**Response:** `201 Created`

```json
{
    "id": 1,
    "language_id": 1,
    "lesson_id": 1,
    "title": "Present Tense",
    "description": "The present tense is used...",
    "sentence_en": "I am happy",
    "sentence_tr": "Ben mutluyum",
    "note": "Important: Always use 'am' with 'I'",
    "image": "https://example.com/image.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

---

### Update Grammar Rule

Update an existing grammar rule (Admin only).

**Endpoint:** `PUT /api/units/{unit}/lessons/{lesson}/grammars/{grammar}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID
-   `grammar` (path, required): Grammar ID

**Request Body:**

```json
{
    "title": "Updated Title",
    "description": "Updated description...",
    "note": "Updated note"
}
```

**Validation Rules:**

-   All fields optional (use `sometimes` validation)

**Response:** `200 OK`

```json
{
    "id": 1,
    "language_id": 1,
    "lesson_id": 1,
    "title": "Updated Title",
    "description": "Updated description...",
    "sentence_en": "I am happy",
    "sentence_tr": "Ben mutluyum",
    "note": "Updated note",
    "image": "https://example.com/image.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T12:00:00.000000Z"
}
```

---

### Delete Grammar Rule

Delete a grammar rule (Admin only).

**Endpoint:** `DELETE /api/units/{unit}/lessons/{lesson}/grammars/{grammar}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID
-   `grammar` (path, required): Grammar ID

**Response:** `204 No Content`

---

## Quizzes Endpoints

### List Quizzes in Lesson

Get all quizzes in a specific lesson.

**Endpoint:** `GET /api/units/{unit}/lessons/{lesson}/quizzes`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Response:** `200 OK`

```json
{
    "id": 1,
    "unit_id": 1,
    "language_id": 1,
    "name": "Lesson 1: Quiz",
    "type": "vocabulary",
    "content": "...",
    "order": 1,
    "quizzes": [
        {
            "id": 1,
            "lesson_id": 1,
            "language_id": 1,
            "question": "What is 'Hello' in Turkish?",
            "option_a": "Merhaba",
            "option_b": "Güle güle",
            "option_c": "Teşekkürler",
            "option_d": "Lütfen",
            "correct_option": "a",
            "image": "https://example.com/image.jpg",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ]
}
```

---

### Create Quiz

Add a new quiz question to a lesson (Admin only).

**Endpoint:** `POST /api/units/{unit}/lessons/{lesson}/quizzes`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID

**Request Body:**

```json
{
    "language_id": 1,
    "question": "What is 'Hello' in Turkish?",
    "option_a": "Merhaba",
    "option_b": "Güle güle",
    "option_c": "Teşekkürler",
    "option_d": "Lütfen",
    "correct_option": "a",
    "image": "https://example.com/image.jpg"
}
```

**Validation Rules:**

-   `language_id`: required
-   `question`: required, string
-   `option_a`: required, string
-   `option_b`: required, string
-   `option_c`: required, string
-   `option_d`: required, string
-   `correct_option`: required, string (a, b, c, or d)
-   `image`: required

**Response:** `201 Created`

```json
{
    "message": "Quiz created successfully",
    "data": {
        "id": 1,
        "lesson_id": 1,
        "language_id": 1,
        "question": "What is 'Hello' in Turkish?",
        "option_a": "Merhaba",
        "option_b": "Güle güle",
        "option_c": "Teşekkürler",
        "option_d": "Lütfen",
        "correct_option": "a",
        "image": "https://example.com/image.jpg",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

---

### Update Quiz

Update an existing quiz question (Admin only).

**Endpoint:** `PUT /api/units/{unit}/lessons/{lesson}/quizzes/{quiz}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID
-   `quiz` (path, required): Quiz ID

**Request Body:**

```json
{
    "question": "Updated question?",
    "option_a": "Updated option A",
    "correct_option": "b"
}
```

**Validation Rules:**

-   All fields optional (use `sometimes` validation)

**Response:** `200 OK`

```json
{
    "id": 1,
    "lesson_id": 1,
    "language_id": 1,
    "question": "Updated question?",
    "option_a": "Updated option A",
    "option_b": "Güle güle",
    "option_c": "Teşekkürler",
    "option_d": "Lütfen",
    "correct_option": "b",
    "image": "https://example.com/image.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T12:00:00.000000Z"
}
```

---

### Delete Quiz

Delete a quiz question (Admin only).

**Endpoint:** `DELETE /api/units/{unit}/lessons/{lesson}/quizzes/{quiz}`

**Authentication:** Required

**Parameters:**

-   `unit` (path, required): Unit ID
-   `lesson` (path, required): Lesson ID
-   `quiz` (path, required): Quiz ID

**Response:** `204 No Content`

---

## User Progress Endpoints

### Get User Progress

Get all progress records for the authenticated user.

**Endpoint:** `GET /api/progress`

**Authentication:** Required

**Response:** `200 OK`

```json
[
    {
        "id": 1,
        "user_id": 1,
        "lesson_id": 1,
        "completed": true,
        "progress_percentage": 100,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T12:00:00.000000Z"
    }
]
```

---

### Create/Update Progress

Create or update progress for a lesson (upsert operation).

**Endpoint:** `POST /api/progress`

**Authentication:** Required

**Request Body:**

```json
{
    "lesson_id": 1,
    "completed": true,
    "progress_percentage": 100
}
```

**Validation Rules:**

-   `lesson_id`: required, exists:lessons,id
-   `completed`: required, boolean
-   `progress_percentage`: optional, integer, min:0, max:100 (defaults to 0)

**Response:** `200 OK` or `201 Created`

```json
{
    "id": 1,
    "user_id": 1,
    "lesson_id": 1,
    "completed": true,
    "progress_percentage": 100,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T12:00:00.000000Z"
}
```

**Note:** This endpoint uses `updateOrCreate`, so it will update if a progress record already exists for the user and lesson, or create a new one if it doesn't.

---

### Update Progress

Update an existing progress record.

**Endpoint:** `PUT /api/progress/{id}`

**Authentication:** Required

**Parameters:**

-   `id` (path, required): Progress record ID

**Request Body:**

```json
{
    "completed": false,
    "progress_percentage": 50
}
```

**Validation Rules:**

-   `completed`: optional, boolean
-   `progress_percentage`: optional, integer, min:0, max:100

**Response:** `200 OK`

```json
{
    "id": 1,
    "user_id": 1,
    "lesson_id": 1,
    "completed": false,
    "progress_percentage": 50,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T13:00:00.000000Z"
}
```

---

## 📦 Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js and npm (for frontend assets)
-   SQLite (default) or MySQL/PostgreSQL

### Steps

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd Api
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

    This will create:
    - A test admin user: `test@example.com` / `password` (role: admin)
    - 10 regular users
    - Sample languages, units, lessons, vocabularies, grammars, and quizzes

8. **Start the development server**

    ```bash
    php artisan serve
    ```

    Or use the dev script:

    ```bash
    composer run dev
    ```

    This will start:

    - Laravel server on `http://localhost:8000`
    - Queue worker
    - Vite dev server

---

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

### User Roles

Users have a `role` field that defaults to `'user'`. To create an admin user:

1. **Via Database Seeder**: The seeder creates a default admin user
2. **Via Database**: Update a user's role directly:
   ```sql
   UPDATE users SET role = 'admin' WHERE id = 1;
   ```
3. **Via Tinker**:
   ```bash
   php artisan tinker
   ```
   ```php
   $user = User::find(1);
   $user->role = 'admin';
   $user->save();
   ```

---

## 📝 Usage Examples

### Complete Authentication Flow

1. **Register a new user:**

    ```bash
    curl -X POST http://localhost:8000/api/register \
     -H "Content-Type: application/json" \
     -d '{
      "name": "John Doe",
      "email": "john@example.com",
      "password": "password123"
     }'
    ```

2. **Login:**

    ```bash
    curl -X POST http://localhost:8000/api/login \
     -H "Content-Type: application/json" \
     -d '{
      "email": "john@example.com",
      "password": "password123"
     }'
    ```

3. **Use the token in subsequent requests:**

    ```bash
    curl -X GET http://localhost:8000/api/units \
     -H "Authorization: Bearer 1|abcdef1234567890..."
    ```

### Example API Workflows

**Get all units with progress:**

```bash
curl -X GET http://localhost:8000/api/units \
  -H "Authorization: Bearer {token}"
```

**Get lessons in a unit:**

```bash
curl -X GET http://localhost:8000/api/units/1/lessons \
  -H "Authorization: Bearer {token}"
```

**Get a specific lesson with all content:**

```bash
curl -X GET http://localhost:8000/api/units/1/lessons/1 \
  -H "Authorization: Bearer {token}"
```

**Mark lesson progress:**

```bash
curl -X POST http://localhost:8000/api/progress \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
  "lesson_id": 1,
  "completed": true,
  "progress_percentage": 100
  }'
```

**Create a vocabulary entry:**

```bash
curl -X POST http://localhost:8000/api/units/1/lessons/1/vocabularies \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "word_en": "Hello",
    "word_tr": "Merhaba",
    "example_en": "Hello, how are you?",
    "example_tr": "Merhaba, nasılsın?",
    "image": "https://example.com/image.jpg"
  }'
```

---

## Request/Response Formats

### Content-Type

All requests should use `Content-Type: application/json` header.

### Date Format

All dates are returned in ISO 8601 format:

```
2024-01-01T00:00:00.000000Z
```

### Pagination

Currently, endpoints return all results. Pagination can be added in future versions.

---

## Error Handling

### HTTP Status Codes

-   `200 OK` - Successful GET, PUT requests
-   `201 Created` - Successful POST requests (resource created)
-   `204 No Content` - Successful DELETE requests
-   `401 Unauthorized` - Authentication required or failed
-   `403 Forbidden` - Insufficient permissions
-   `404 Not Found` - Resource not found
-   `422 Unprocessable Entity` - Validation errors
-   `500 Internal Server Error` - Server error

### Error Response Format

**Validation Errors (422):**

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password must be at least 8 characters."]
    }
}
```

**Unauthorized (401):**

```json
{
    "message": "Unauthenticated."
}
```

**Forbidden (403):**

```json
{
    "message": "Forbidden"
}
```

**Not Found (404):**

```json
{
    "message": "No query results for model [App\\Models\\Unit] 999"
}
```

---

## Authentication

### Token-Based Authentication

This API uses Laravel Sanctum for token-based authentication:

1. Register or login to receive an access token
2. Include the token in the `Authorization` header for protected routes:

    ```
    Authorization: Bearer {token}
    ```

3. Tokens are valid until the user logs out or the token is revoked
4. Logout revokes all tokens for the user

### Token Lifecycle

-   Tokens are created when users register or login
-   Tokens persist until explicitly revoked
-   Multiple tokens can exist per user (one per device/session)
-   Logout deletes all tokens for the user

### Role-Based Access Control

The API implements role-based access control (RBAC) with two user roles:

-   **User** (`role: 'user'`): Default role for all registered users
    -   Can read (GET) all resources (units, lessons, vocabularies, grammars, quizzes)
    -   Can manage their own progress
    -   Cannot create, update, or delete content

-   **Admin** (`role: 'admin'`): Administrative role
    -   Has all user permissions
    -   Can create, update, and delete all resources
    -   Full CRUD access to units, lessons, vocabularies, grammars, and quizzes

**Admin Access**: Admin routes are protected by the `isAdmin` middleware, which checks if the authenticated user's `role` field equals `'admin'`.

---

## 🗄️ Database Schema

### Tables Overview

-   **users** - User accounts

    -   `id`, `name`, `email`, `password`, `role` (default: 'user'), `created_at`, `updated_at`

-   **languages** - Supported languages

    -   `id`, `name`, `code`, `created_at`, `updated_at`

-   **units** - Learning units

    -   `id`, `language_id`, `title`, `description`, `image`, `created_at`, `updated_at`

-   **lessons** - Individual lessons (type: vocabulary/grammar)

    -   `id`, `unit_id`, `language_id`, `name`, `type`, `content`, `order`, `created_at`, `updated_at`

-   **vocabularies** - Vocabulary words with translations

    -   `id`, `language_id`, `lesson_id`, `word_en`, `word_tr`, `example_en`, `example_tr`, `image`, `created_at`, `updated_at`

-   **grammars** - Grammar rules with examples

    -   `id`, `language_id`, `lesson_id`, `title`, `description`, `sentence_en`, `sentence_tr`, `note`, `image`, `created_at`, `updated_at`

-   **quizzes** - Quiz questions

    -   `id`, `lesson_id`, `language_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `image`, `created_at`, `updated_at`

-   **quiz_results** - User quiz attempts

    -   `id`, `quiz_id`, `user_id`, `selected_option`, `is_correct`, `created_at`, `updated_at`

-   **user_progress** - Lesson completion tracking

    -   `id`, `user_id`, `lesson_id`, `completed`, `progress_percentage`, `created_at`, `updated_at`

-   **personal_access_tokens** - Sanctum authentication tokens
    -   `id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`

---

## 🔒 Security Features

-   **Password Hashing**: Using bcrypt for secure password storage
-   **Token-based Authentication**: Laravel Sanctum for secure API access
-   **CSRF Protection**: Enabled for web routes
-   **SQL Injection Protection**: Eloquent ORM prevents SQL injection
-   **Input Validation**: All endpoints validate incoming data
-   **Role-based Access Control**: Admin role-based permissions via `isAdmin` middleware for CRUD operations
-   **HTTPS Ready**: Configure for HTTPS in production

### Security Best Practices

1. **Environment Variables**: Never commit `.env` file
2. **API Keys**: Store sensitive keys in environment variables
3. **Rate Limiting**: Consider implementing rate limiting for production
4. **HTTPS**: Always use HTTPS in production
5. **Token Expiration**: Consider implementing token expiration policies

---

## 🧪 Testing

Run tests using Pest:

```bash
php artisan test
```

Or using the composer script:

```bash
composer run test
```

### Test Structure

-   Feature tests: `tests/Feature/`
-   Unit tests: `tests/Unit/`

---

## 🚀 Deployment

### Production Checklist

-   [ ] Set `APP_ENV=production` in `.env`
-   [ ] Set `APP_DEBUG=false` in `.env`
-   [ ] Generate application key: `php artisan key:generate`
-   [ ] Run migrations: `php artisan migrate --force`
-   [ ] Clear config cache: `php artisan config:cache`
-   [ ] Clear route cache: `php artisan route:cache`
-   [ ] Clear view cache: `php artisan view:cache`
-   [ ] Optimize autoloader: `composer install --optimize-autoloader --no-dev`
-   [ ] Set up HTTPS/SSL certificate
-   [ ] Configure database (MySQL/PostgreSQL recommended for production)
-   [ ] Set up proper file permissions
-   [ ] Configure web server (Apache/Nginx)

### Docker Support

A `Dockerfile` is included for containerized deployments.

### Nginx Configuration

An example Nginx configuration is available in `conf/nginx/nginx-site.conf`.

---

## 📚 Additional Resources

### API Rate Limiting

Consider implementing rate limiting for production use. Laravel provides built-in rate limiting:

```php
RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});
```

### API Versioning

For future API versions, consider implementing versioning:

```
/api/v1/units
/api/v2/units
```

### Documentation Tools

Consider using tools like:

-   [Laravel API Documentation Generator](https://github.com/mpociot/laravel-apidoc-generator)
-   [Swagger/OpenAPI](https://swagger.io/)

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

### Contribution Guidelines

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Style

This project uses Laravel Pint for code formatting:

```bash
./vendor/bin/pint
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👥 Support

For support, please open an issue in the repository or contact the development team.

---

## 📝 Changelog

### Version 1.0.0

-   Initial release
-   User authentication with Sanctum
-   Unit and Lesson management
-   Vocabulary and Grammar content
-   Quiz system
-   Progress tracking
-   Google OAuth integration

### Version 1.1.0

-   Role-based access control (RBAC) implementation
-   Admin middleware for protected CRUD operations
-   User role field added to users table
-   Improved security with role-based permissions

---

**Built with ❤️ using Laravel**
