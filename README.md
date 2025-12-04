# 📚 API Documentation - NutriCare Backend

## 🌐 Base URL
```
http://localhost:8000/api
```

---

##  **Table of Contents**
1. [Badges API](#badges-api)
2. [User Badges API](#user-badges-api)
3. [Challenges API](#challenges-api)
4. [User Challenges API](#user-challenges-api)
5. [Food Logs API](#food-logs-api)

---

##  **BADGES API**

### 1. Get All Badges
**Endpoint:** `GET /badges`

**Example:**
```
GET http://localhost:8000/api/badges
```

**Response (200):**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "name": "First Steps",
            "description": "Complete your first challenge",
            "icon": "icon-badge-1.png",
            "created_at": "2025-12-04 19:56:20",
            "updated_at": "2025-12-04 19:56:20"
        }
    ],
    "message": "Badges fetched successfully",
    "code": 200
}
```

---

### 2. Get Badge by ID
**Endpoint:** `GET /badges/{id}`

**Example:**
```
GET http://localhost:8000/api/badges/1
```

**Response (200):**
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "name": "First Steps",
        "description": "Complete your first challenge",
        "icon": "icon-badge-1.png"
    },
    "message": "Badge fetched successfully",
    "code": 200
}
```

---

##  **USER BADGES API**

### Get User Badges
**Endpoint:** `GET /user-badges?user_id={id}`

**Query Parameters:**
- `user_id` (required): User ID

**Example:**
```
GET http://localhost:8000/api/user-badges?user_id=1
```

**Response (200):**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "badge_id": 1,
            "earned_at": "2025-12-05 03:00:00",
            "badge": {
                "id": 1,
                "name": "First Steps",
                "description": "Complete your first challenge",
                "icon": "icon-badge-1.png"
            }
        }
    ],
    "message": "User badges fetched successfully",
    "code": 200
}
```

---

##  **CHALLENGES API**

### 1. Get All Challenges
**Endpoint:** `GET /challenges`

**Example:**
```
GET http://localhost:8000/api/challenges
```

**Response (200):**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "title": "30 Days Healthy Eating",
            "description": "Eat healthy for 30 days straight",
            "points": 100,
            "duration_days": 30,
            "created_at": "2025-12-04 19:56:20",
            "updated_at": "2025-12-04 19:56:20"
        }
    ],
    "message": "Challenges fetched successfully",
    "code": 200
}
```

---

### 2. Get Challenge by ID
**Endpoint:** `GET /challenges/{id}`

**Example:**
```
GET http://localhost:8000/api/challenges/1
```

---

### 3. Create New Challenge
**Endpoint:** `POST /challenges`

**Request Body:**
```json
{
    "title": "30 Days Healthy Eating",
    "description": "Eat healthy for 30 days straight",
    "points": 100,
    "duration_days": 30
}
```

**Response (201):**
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "title": "30 Days Healthy Eating",
        "description": "Eat healthy for 30 days straight",
        "points": 100,
        "duration_days": 30
    },
    "message": "Challenge created successfully",
    "code": 201
}
```

---

## **USER CHALLENGES API**

### 1. Get User Challenges
**Endpoint:** `GET /user-challenges`

**Query Parameters:**
- `user_id` (optional): Filter by user
- `status` (optional): Filter by status (active, completed, failed)

**Examples:**
```
GET http://localhost:8000/api/user-challenges?user_id=1
GET http://localhost:8000/api/user-challenges?status=active
GET http://localhost:8000/api/user-challenges?user_id=1&status=active
```

**Response (200):**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "challenge_id": 1,
            "status": "active",
            "progress": 50,
            "started_at": "2025-12-01 10:00:00",
            "completed_at": null,
            "challenge": {
                "id": 1,
                "title": "30 Days Healthy Eating",
                "description": "Eat healthy for 30 days straight",
                "points": 100,
                "duration_days": 30
            }
        }
    ],
    "message": "User challenges fetched successfully",
    "code": 200
}
```

---

### 2. Get User Challenge by ID
**Endpoint:** `GET /user-challenges/{id}`

**Example:**
```
GET http://localhost:8000/api/user-challenges/1
```

---

### 3. Join a Challenge (Create User Challenge)
**Endpoint:** `POST /user-challenges`

**Request Body:**
```json
{
    "user_id": 1,
    "challenge_id": 1,
    "status": "active",
    "progress": 0
}
```

**Response (201):**
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "user_id": 1,
        "challenge_id": 1,
        "status": "active",
        "progress": 0,
        "started_at": "2025-12-05 10:00:00"
    },
    "message": "User challenge created successfully",
    "code": 201
}
```

---

### 4. Update User Challenge Progress
**Endpoint:** `PUT /user-challenges/{id}`

**Request Body:**
```json
{
    "status": "completed",
    "progress": 100
}
```

**Response (200):**
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "user_id": 1,
        "challenge_id": 1,
        "status": "completed",
        "progress": 100,
        "started_at": "2025-12-01 10:00:00",
        "completed_at": "2025-12-05 10:00:00"
    },
    "message": "User challenge updated successfully",
    "code": 200
}
```

---

## **FOOD LOGS API**

### 1. Get Food Logs
**Endpoint:** `GET /food-logs`

**Query Parameters:**
- `user_id` (optional): Filter by user
- `start_date` (optional): Filter from date (YYYY-MM-DD)
- `end_date` (optional): Filter to date (YYYY-MM-DD)

**Examples:**
```
GET http://localhost:8000/api/food-logs?user_id=1
GET http://localhost:8000/api/food-logs?start_date=2025-12-01&end_date=2025-12-05
GET http://localhost:8000/api/food-logs?user_id=1&start_date=2025-12-01
```

**Response (200):**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "food_name": "Nasi Goreng",
            "calories": 400,
            "protein": 15.5,
            "carbs": 60.2,
            "fat": 10.5,
            "sugar": 5.0,
            "sodium": 800,
            "vit_c": 10,
            "vit_a": 500,
            "potassium": 300,
            "created_at": "2025-12-05 08:00:00",
            "updated_at": "2025-12-05 08:00:00"
        }
    ],
    "message": "Food logs fetched successfully",
    "code": 200
}
```

---

### 2. Get Food Log by ID
**Endpoint:** `GET /food-logs/{id}`

**Example:**
```
GET http://localhost:8000/api/food-logs/1
```

---

### 3. Create Food Log
**Endpoint:** `POST /food-logs`

**Request Body:**
```json
{
    "user_id": 1,
    "food_name": "Nasi Goreng",
    "calories": 400,
    "protein": 15.5,
    "carbs": 60.2,
    "fat": 10.5,
    "sugar": 5.0,
    "sodium": 800,
    "vit_c": 10,
    "vit_a": 500,
    "potassium": 300
}
```

**Response (201):**
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "user_id": 1,
        "food_name": "Nasi Goreng",
        "calories": 400,
        ...
    },
    "message": "Food log created successfully",
    "code": 201
}
```

---

### 4. Update Food Log
**Endpoint:** `PUT /food-logs/{id}`

**Request Body:**
```json
{
    "food_name": "Nasi Goreng Spesial",
    "calories": 450
}
```

**Response (200):**
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "food_name": "Nasi Goreng Spesial",
        "calories": 450,
        ...
    },
    "message": "Food log updated successfully",
    "code": 200
}
```

---

### 5. Delete Food Log
**Endpoint:** `DELETE /food-logs/{id}`

**Example:**
```
DELETE http://localhost:8000/api/food-logs/1
```

**Response (200):**
```json
{
    "status": "success",
    "data": null,
    "message": "Food log deleted successfully",
    "code": 200
}
```

---

## 📊 **COMPLETE API ROUTES SUMMARY**

### Badges
- `GET /badges` - Get all badges
- `GET /badges/{id}` - Get badge by ID

### User Badges
- `GET /user-badges?user_id={id}` - Get user's badges

### Challenges
- `GET /challenges` - Get all challenges
- `GET /challenges/{id}` - Get challenge by ID
- `POST /challenges` - Create new challenge

### User Challenges
- `GET /user-challenges` - Get user challenges (with filters)
- `GET /user-challenges/{id}` - Get user challenge by ID
- `POST /user-challenges` - Join a challenge
- `PUT /user-challenges/{id}` - Update progress

### Food Logs
- `GET /food-logs` - Get food logs (with filters)
- `GET /food-logs/{id}` - Get food log by ID
- `POST /food-logs` - Create food log
- `PUT /food-logs/{id}` - Update food log
- `DELETE /food-logs/{id}` - Delete food log

---


