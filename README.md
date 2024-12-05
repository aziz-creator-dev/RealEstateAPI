# Real Estate API

## Overview

This project provides a RESTful API to manage real estate properties for a fictional real estate agency. It allows for the creation of properties, searching for properties based on various filters, and includes a bonus feature to find properties near a specified geolocation.

The API supports the following functionalities:
- CRUD properties (House or Apartment)
- Search properties based on filters (type, address, size, number of bedrooms, price)
- Nearby: Search for properties within a specific area defined by latitude, longitude, and radius.

## Features

- **Create Property**: Adds a new real estate property to the database with its type, address, size, number of bedrooms, price, and geolocation.
- **Get All Properties**: Retrieve a list of all properties in the database.
- **Update Property**: Modify details of an existing property by its ID.
- **Delete Property**: Remove a property from the database by its ID
- **Search Properties**: Allows for searching properties by type, address, size, number of bedrooms, and price.
- **Nearby Feature**: Search for properties within a specified radius from a given latitude and longitude.

## Tech Stack

- **Backend**: PHP (Laravel)
- **Database**: MySQL (or any relational database of your choice)
- **API Documentation**: Swagger UI via L5-Swagger

## Installation

### Prerequisites

Make sure you have the following installed on your system:
- PHP >= 7.4
- Composer (for dependency management)
- Laravel >= 8.x
- MySQL (or a compatible database)

### Steps to Install

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/real-estate-api.git
   cd RealEstateAPI
2. **Install the required dependencies**:
    composer install
3. **Create the .env**:
    cp .envexample .env
4. **Run the database migrations**:
    php artisan migrate

5. **Start the development server**:
    php artisan serve

### Access Swagger UI

    Visit http://localhost:8000/api/documentation

### Improvements for Backlog
    Authentication: Implement token-based authentication (e.g., JWT) for secure API access.
    Geospatial Indexing: Use geospatial indexing for faster proximity searches (e.g. MySQL spatial extensions).
    Rate Limiting: Implement rate limiting to prevent abuse of the API.


