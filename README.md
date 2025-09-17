## Catalog API - Laravel Project

## Overview

This is a Catalog API built using Laravel. The API supports the following features:

- User Registration and Login with Laravel Sanctum for authentication.
- CRUD operations for managing categories and items.
- Data Seeding: Realistic sample data for testing the API
- Filters and Sorting: API supports querying items with filtering and sorting options like `q`, `min_price`, `max_price`, and `sort`.



## Features

- User Authentication: Register, login, and logout functionality.
- Categories: Create, list, and view categories.
- Items: Create, list, and filter items by category with options to search, sort, and filter by price.
- Database Seeding**: Predefined categories and items to help with testing.



## Installation

Clone the Repository

Clone the repository to your local machine:


git clone https://github.com/anupchaudhari86-collab/catalogAPI


cp .env.example .env


## Run Migrations and Seed Data


php artisan migrate --seed


php artisan serve



## API Endpoints

Authentication Endpoints

The Application Will be available at http://127.0.0.1:8000

1) Register User

URL : http://127.0.0.1:8000/api/auth/register
Method : POST
Body : Json

{
  "name": "Anup Chaudhari",
  "email": "anupchaudhari86@gmail.com",
  "password": "anupchaudhari123",
  "password_confirmation": "anupchaudhari123"
}

Response : Json

{"status":"success","token":"1|wKfHDDb2QNakGntHHW81qxYBlOvRkMEBDK50N1rUea49ca79","user":{"id":1,"name":"Anup Chaudhari","email":"anupchaudhari86@gmail.com"}}


2) Login User

URL : http://127.0.0.1:8000/api/auth/login
Method : POST
Body : Json

{
  "email": "anupchaudhari86@gmail.com",
  "password": "anupchaudhari123"
}

Response : Json

{"status":"success","token":"1|wKfHDDb2QNakGntHHW81qxYBlOvRkMEBDK50N1rUea49ca79","user":{"id":1,"name":"Anup Chaudhari","email":"anupchaudhari86@gmail.com"}}


3) Logout User

URL : http://127.0.0.1:8000/api/auth/logout
Method : POST
Authorization : Bearer Token (From Login)

Headers : 
Authorization : Bearer Token (From Login)

4) Categories Endpoints

List Categories
URL : http://127.0.0.1:8000/api/categories
Method : GET
Authorization : Bearer Token (From Login)

Response : Json
{
  "data": [
    {
      "id": 1,
      "name": "Labore",
      "slug": "labore"
    },
    {
      "id": 2,
      "name": "Maxime",
      "slug": "maxime"
    },
    {
      "id": 3,
      "name": "Minima",
      "slug": "minima"
    },
    {
      "id": 4,
      "name": "Minus",
      "slug": "minus"
    },
    {
      "id": 5,
      "name": "Modi",
      "slug": "modi"
    }
  ]
}


5) Lists Items By Category

URL : http://127.0.0.1:8000/api/categories/minima/items?per_page=5&q=Iste%20impedit&min_price=100&max_price=500&sort=price_desc
Method : GET
Authorization : Bearer Token (From Login)
Query Parameters :
per_page : (default 10, max 50)
q : (search term) (optional)
min_price : (optional)
max_price : (optional)
sort : (optional : price_asc, price_desc, name_asc, name_desc)

Response : Json

{
  "data": [
    {
      "id": 2,
      "name": "Iste impedit",
      "price": 412.86,
      "description": "Facilis est vitae dolores dolore est possimus ut qui aliquam sunt maiores temporibus.",
      "category": {
        "id": 1,
        "name": "Minima",
        "slug": "minima"
      },
      "created_at": "2025-09-16T10:36:26+00:00"
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8000/api/categories/minima/items?per_page=5&q=Iste%20impedit&min_price=100&max_price=500&sort=price_desc&page=1",
    "last": "http://127.0.0.1:8000/api/categories/minima/items?per_page=5&q=Iste%20impedit&min_price=100&max_price=500&sort=price_desc&page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/api/categories/minima/items?per_page=5&q=Iste%20impedit&min_price=100&max_price=500&sort=price_desc&page=1",
        "label": "1",
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "path": "http://127.0.0.1:8000/api/categories/minima/items",
    "per_page": 5,
    "to": 1,
    "total": 1
  }
}
