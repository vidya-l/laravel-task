# Requirements
PHP >= 7.4

Laravel >= 8.x

Composer

MySQL 

# Installation
1. Clone the repository
git clone https://github.com/vidya-l/laravel-task.git
cd laravel-task
2. Install dependencies
Install the necessary project dependencies using Composer:
composer install
3. Set up the environment file
Copy the example environment file and update the configuration settings for your local environment:
cp .env.example .env
Edit the .env file with your database and other environment configurations:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
PASSPORT_CLIENT_ID=your_client_id
PASSPORT_CLIENT_SECRET=your_client_secret
4. Generate the application key
Generate the Laravel application key:
php artisan key:generate
5. Migrate the database
php artisan migrate --seed
6. php artisan passport:install
7. Add the PASSPORT_CLIENT_ID and PASSPORT_CLIENT_SECRET you received from php artisan passport:install into the .env file.
8. Run the local server - php artisan serve

Authentication Endpoints
1. POST /api/register - Register a new user
Request body:

json
{
    "first_name": "vidya",
    "last_name": "vidya",
    "email": "vidya2@yopmail.com",
    "password": "vidya",
    "password_confirmation": "vidya"
}
Response:
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
2. POST /api/login - Login a user and return a token

Request body:
{
    "email": "vidya2@yopmail.com",
    "password": "vidya"
}

Response:
{
    "success": true,
    "message": "Login successful",
    "data": {
        "id": 2,
        "email": "vidya2@yopmail.com",
        "email_verified_at": null,
        "created_at": "2025-03-08T18:45:46.000000Z",
        "updated_at": "2025-03-08T18:45:46.000000Z",
        "first_name": "vidya",
        "last_name": "vidya",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTdkYzg3NjgzOGIwYWZhN2M1N2E2ODNhMTM3ODA0ZmFjYzQ2MjAzOWNlZmMyMWUwNjhhNWVmMTk4Mzk3NjA1NGQxYmRlYjk5NzgwZGY5OGYiLCJpYXQiOjE3NDE0NTk1ODMuMjk0OTgxLCJuYmYiOjE3NDE0NTk1ODMuMjk0OTg5LCJleHAiOjE3NzI5OTU1ODMuMjg2MTA4LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.Vok49nElBsNP67ZUocf1PpvpCOS5Kl-lz4k4FU29kwdwXeIKw5zBTP9aahDfkMARUik_aAS7Yr2UXsY-n1LtW5pkqXdTsJzol60EE9b5uCct3Wzyu5V4BEOcxgq0-bKmOBZjdI-tor1iwgGHk2p_tZneo50JcHJcO74b8eH3_2oW_jXKNdUNffMuHcqDo5dxOk2a5cwWZ0V7iutpCVDZsxCR8ro8HgqrjlwxjDTDT2XA8AxdnPjLq17aDWKH1FOtse5xUE-vOULA-W9kNTG3Al-IdrQLkDJEGmIhk8kjdmWsLvPKuTpFogNJI106PsqPUCj9jwJFAkdKvjphPrW8AC6GpiEo__SsGDqBRoMp4v65xzzFDRMc7HN-ajJANEEOdWOjjVDFAlLdcNwCRGVU4nteE0bIsFQqfdofI9UuQ5mK8bWZUHE4LkYu5QHJvcHqQSTaT07KhDcC6U9N71CE_2Cc-adfhOhAIHXiuamV33fnq3um0mgZqjG0Fk0CajULPbmZRFizTRXi3DFzBMjkTYGAgjLkcmex-7sGTamxyvgGeDKJi7O6yBt91g1GYyqbPleBwK-IXsvz59Gg6Y8dad9SW5duBM7LxGHU2rFxy_aXq5z7R33ASX13uhcQMdX8JzRLVBVyTiY_R9i_gTWdns0Kcu6S7_VLCcQS1L8VbhA"
    }
}
3. POST /api/logout - Logout the user 
Request body:None
Response:
{
    "success": true,
    "data": [],
     "message": "Logout successful"
}

CRUD Endpoints
GET /api/user - List all users
Response:
{
    "success": true,
    "message": "All users",
    "data": [
        {
            "id": 1,
            "email": "lvidya66@gmail.com",
            "email_verified_at": null,
            "created_at": null,
            "updated_at": null,
            "first_name": "Vidya",
            "last_name": "l"
        },
    ]
}
GET /api/users/{id} - Get a specific user by ID
Response:
{
    "success": true,
    "message": "User detail",
    "data": {
        "id": 3,
        "email": "milan51@example.com",
        "email_verified_at": "2025-03-08T19:28:47.000000Z",
        "created_at": "2025-03-08T19:28:47.000000Z",
        "updated_at": "2025-03-08T19:28:47.000000Z",
        "first_name": "Demond",
        "last_name": "Durgan"
    }
}

# Attribute Endpoints
1. POST /api/attribute - Create new attribute
Request body:
{
  "name": "end_date",
  "type": "date"
}

Response:
{
  "success": true,
  "message": "Attribute created successfully",
  "data": {
      "name": "end_date",
      "type": "date",
      "updated_at": "2025-03-08T18:47:45.000000Z",
      "created_at": "2025-03-08T18:47:45.000000Z",
      "id": 7
  }
}

2. PUT /api/attribute/:attributeId - Update attribute
Request body:
{
  "name": "end_date",
  "type": "date"
}

Response:
{
  "success": true,
  "message": "Attribute created successfully",
  "data": {
      "name": "end_date",
      "type": "date",
      "updated_at": "2025-03-08T18:47:45.000000Z",
      "created_at": "2025-03-08T18:47:45.000000Z",
      "id": 7
  }
}

3. GET /api/attribute - List all attributes
Response:
{
  "success": true,
  "message": "Attributes listed successfully",
  "data": [
      {
          "id": 4,
          "name": "start_date",
          "type": "date",
          "created_at": "2025-03-08T07:07:09.000000Z",
          "updated_at": "2025-03-08T07:27:53.000000Z"
      },
  ]
}

4. GET /api/attribute/:attributeId - Get attribute detail
Response:
{
  "success": true,
  "message": "Attribute detail listed successfully",
  "data": [
      {
          "id": 4,
          "name": "start_date",
          "type": "date",
          "created_at": "2025-03-08T07:07:09.000000Z",
          "updated_at": "2025-03-08T07:27:53.000000Z"
      },
  ]
}

5. DELETE /api/attribute/:attributeId - Delete an attribute
Response:
{
  "success": true,
  "message": "Attribute deleted successfully",
  "data": []
}

# Project Endpoints
Pass authorization token in all endpoints
1. POST /api/project - Create new project
Request body:
{
  "name": "Laravel test",
  "project_attributes": [
      {
          "attribute_id": 4,
          "value":"02-02-2025"
      },
      {
          "attribute_id": 6,
          "value":"IT"
      },
      {
          "attribute_id": 5,
          "value":"basecamp"
      }
  ]
}

Response:
{
  "success": true,
  "message": "Project created successfully",
  "data": {
      "name": "Laravel test",
      "status": "pending",
      "updated_at": "2025-03-08T18:48:58.000000Z",
      "created_at": "2025-03-08T18:48:58.000000Z",
      "id": 26
  }
}

2. PUT /api/project/:projectid - Update project
Request body:
{
  "name": "vidya",
  "project_attributes": [
      {
          "attribute_id": 4,
          "value":"2-03-2025"
      }
  ]
}

Response:
{
  "success": true,
  "message": "Project updated successfully",
  "data": {
      "id": 1,
      "name": "vidya",
      "status": "pending",
      "created_at": "2025-03-08T19:28:47.000000Z",
      "updated_at": "2025-03-09T12:19:13.000000Z"
  }
}

3. GET /api/project?filters[start_date]>IT&filters[name]=Vidya&filters[status]=pending - List projects with filtering
Response:
{
  "success": true,
  "message": "Projects listed successfully",
  "data": [
      {
          "id": 22,
          "name": "vidya",
          "status": "pending",
          "created_at": "2025-03-08T09:28:36.000000Z",
          "updated_at": "2025-03-08T09:28:36.000000Z",
          "dynamic_attributes": [
              {
                  "id": 16,
                  "attribute_id": 4,
                  "entity_id": 22,
                  "value": "2025-02-02",
                  "created_at": "2025-03-08T09:28:36.000000Z",
                  "updated_at": "2025-03-08T09:28:36.000000Z"
              },
              {
                  "id": 17,
                  "attribute_id": 6,
                  "entity_id": 22,
                  "value": "IT",
                  "created_at": "2025-03-08T09:28:36.000000Z",
                  "updated_at": "2025-03-08T09:28:36.000000Z"
              },
              {
                  "id": 18,
                  "attribute_id": 5,
                  "entity_id": 22,
                  "value": "basecamp",
                  "created_at": "2025-03-08T09:28:36.000000Z",
                  "updated_at": "2025-03-08T09:28:36.000000Z"
              }
          ]
      },
    ]
}

4. GET /api/project/:projectid - Get project detail
Response:
{
  "success": true,
  "message": "Project details",
  "data": {
      "id": 1,
      "name": "vidya",
      "status": "pending",
      "created_at": "2025-03-07T17:54:33.000000Z",
      "updated_at": "2025-03-07T17:54:33.000000Z",
      "dynamic_attributes": [
          {
              "id": 12,
              "attribute_id": 4,
              "entity_id": 1,
              "value": "2-03-2025",
              "created_at": "2025-03-08T07:47:38.000000Z",
              "updated_at": "2025-03-08T07:47:38.000000Z",
              "attribute": {
                  "id": 4,
                  "name": "start_date",
                  "type": "date",
                  "created_at": "2025-03-08T07:07:09.000000Z",
                  "updated_at": "2025-03-08T07:27:53.000000Z"
              }
          }
      ]
  }
}

5. DELETE /api/project/:projectid - Delete project
Response:
{
  "success": true,
  "message": "Project deleted successfully",
  "data": []
}

# Timesheet Endpoints
Pass authorization token in all endpoints
1. POST /api/timesheet - Create new timesheet
Request body:
{
  "project_id": 4,
  "hours": 3,
  "date":"2020-04-05",
  "task_name": "Test"
}

Response:
{
  "success": true,
  "message": "Timesheet created successfully",
  "data": {
      "user_id": 1,
      "project_id": 4,
      "hours": 3,
      "date": "2020-04-05",
      "task_name": "Test",
      "updated_at": "2025-03-08T18:35:54.000000Z",
      "created_at": "2025-03-08T18:35:54.000000Z",
      "id": 3
  }
}

2. PUT /api/timesheet/:timesheetid - Update timesheet
Request body:
{
  "hours": 3,
  "date":"2020-04-05",
  "task_name": "Test11"
}

Response:
{
  "success": true,
  "message": "Timesheet updated successfully",
  "data": {
      "id": 1,
      "user_id": 1,
      "project_id": 4,
      "task_name": "Test11",
      "date": "2020-04-05",
      "hours": 3,
      "created_at": "2025-03-08T18:35:46.000000Z",
      "updated_at": "2025-03-08T18:38:24.000000Z"
  }
}

3. GET /api/timesheet - List timesheets of current logged in user
Response:
{
  "success": true,
  "message": "Timesheet listed successfully",
  "data": [
      {
          "id": 1,
          "user_id": 1,
          "project_id": 4,
          "task_name": "Test11",
          "date": "2020-04-05",
          "hours": 3,
          "created_at": "2025-03-08T18:35:46.000000Z",
          "updated_at": "2025-03-08T18:38:24.000000Z"
      },
  ]
}

4. GET /api/timesheet/:timesheetid - Get timesheet detail
Response:
{
  "success": true,
  "message": "Timesheet detail listed successfully",
  "data": {
      "id": 1,
      "user_id": 1,
      "project_id": 4,
      "task_name": "Test11",
      "date": "2020-04-05",
      "hours": 3,
      "created_at": "2025-03-08T18:35:46.000000Z",
      "updated_at": "2025-03-08T18:38:24.000000Z"
  }
}

5. DELETE /api/timesheet/:timesheetid - Delete timsheet
Response:
{
  "success": true,
  "message": "Timesheet deleted successfully",
  "data": []
}

# Test credentials 
For API Testing, please use the the following credentials:
Email: lvidya66@gmail.com
Password: password123