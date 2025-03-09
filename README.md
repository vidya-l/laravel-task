# Requirements

- PHP >= 7.4
- Laravel >= 8.x
- Composer
- MySQL

# Installation

1. **Clone the repository**
    ```bash
    git clone https://github.com/vidya-l/laravel-task.git
    cd laravel-task
    ```

2. **Install dependencies**
    Install the necessary project dependencies using Composer:
    ```bash
    composer install
    ```

3. **Set up the environment file**
    Copy the example environment file and update the configuration settings for your local environment:
    ```bash
    cp .env.example .env
    ```
    Edit the `.env` file with your database and other environment configurations:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    PASSPORT_CLIENT_ID=your_client_id
    PASSPORT_CLIENT_SECRET=your_client_secret
    ```

4. **Generate the application key**
    Generate the Laravel application key:
    ```bash
    php artisan key:generate
    ```

5. **Migrate the database**
    ```bash
    php artisan migrate --seed
    ```

6. **Install Passport**
    ```bash
    php artisan passport:install
    ```

7. **Add the PASSPORT_CLIENT_ID and PASSPORT_CLIENT_SECRET**  
    After running the `php artisan passport:install` command, add the `PASSPORT_CLIENT_ID` and `PASSPORT_CLIENT_SECRET` you received into the `.env` file.

8. **Run the local server**
    ```bash
    php artisan serve
    ```

# Authentication Endpoints

### 1. POST /api/register - Register a new user

#### Request Body:
```json
{
    "first_name": "vidya",
    "last_name": "vidya",
    "email": "vidya2@yopmail.com",
    "password": "vidya",
    "password_confirmation": "vidya"
}
```


### Response:

```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "first_name": "vidya",
        "last_name": "vidya",
        "email": "vidya2@yopmail.com",
        "updated_at": "2025-03-08T18:45:46.000000Z",
        "created_at": "2025-03-08T18:45:46.000000Z",
        "id": 2
    }
}
```


### 2. POST /api/login - Login a user and return a token

### Request body:

```json
{
    "email": "vidya2@yopmail.com",
    "password": "vidya"
}

```


### Response:

```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "id": 2,
        "email": "vidya2@yopmail.com",
        "first_name": "vidya",
        "last_name": "vidya",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."
    }
}
```

### 3. POST /api/logout - Logout the user
### Response:

```json
{
    "success": true,
    "message": "Logout successful",
    "data": []
}
```

## CRUD Endpoints
### 1. GET /api/user - List all users
### Response:

```json
{
    "success": true,
    "message": "All users",
    "data": [
        {
            "id": 1,
            "email": "lvidya66@gmail.com",
            "first_name": "Vidya",
            "last_name": "l"
        }
    ]
}
```

### 2. GET /api/users/{id} - Get a specific user by ID
### Response:

```json
{
    "success": true,
    "message": "User detail",
    "data": {
        "id": 3,
        "email": "milan51@example.com",
        "first_name": "Demond",
        "last_name": "Durgan"
    }
}
```
## Attribute Endpoints
1. POST /api/attribute - Create new attribute
Request body:

```json
{
  "name": "end_date",
  "type": "date"
}
```

### Response:

```json
{
  "success": true,
  "message": "Attribute created successfully",
  "data": {
      "name": "end_date",
      "type": "date",
      "id": 7
  }
}
```

### 2. PUT /api/attribute/:attributeId - Update attribute
### Request body:

```json
{
  "name": "end_date",
  "type": "date"
}
```
### Response:

```json
{
  "success": true,
  "message": "Attribute updated successfully",
  "data": {
      "name": "end_date",
      "type": "date",
      "id": 7
  }
}
```
### Project Endpoints
### 1. POST /api/project - Create new project
### Request body:

```json
{
  "name": "Laravel test",
  "project_attributes": [
      {
          "attribute_id": 4,
          "value": "02-02-2025"
      },
      {
          "attribute_id": 6,
          "value": "IT"
      },
      {
          "attribute_id": 5,
          "value": "basecamp"
      }
  ]
}
```
### Response:

```json
{
  "success": true,
  "message": "Project created successfully",
  "data": {
      "id": 26,
      "name": "Laravel test",
      "status": "pending"
  }
}
```

## Timesheet Endpoints
### 1. POST /api/timesheet - Create new timesheet
### Request body:

```json
{
  "project_id": 4,
  "hours": 3,
  "date": "2020-04-05",
  "task_name": "Test"
}
```

### Response:

```json
{
  "success": true,
  "message": "Timesheet created successfully",
  "data": {
      "user_id": 1,
      "project_id": 4,
      "hours": 3,
      "date": "2020-04-05",
      "task_name": "Test"
  }
}
```

### Test Credentials
For API Testing, use the following credentials:

**Email: lvidya66@gmail.com**
**Password: password123**
