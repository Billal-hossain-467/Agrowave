# AgroWava

- AgroWave is a machine learning-based project designed to provide predictions and recommendations for farmers. The system uses different algorithms to predict crops, recommend fertilizers, and provide rainfall to help farmers make informed decisions about their crops.
- IT also has direct crop sales to customer with real payment interface.
- Other supporting features are Weather Forecast upto 5 days using Weather API, Agriculture realetd news.


## Installation

- Setup Instructions Prerequisites 
	• PHP installed on your system. 
	• A MySQL database instance. 
	• A local server environment (e.g., XAMPP or WAMP). Steps
- Clone the repository: bash git clone https://github.com/IIT-NSTU/agrowave.git
- Import the database schema: bash mysql -u username -p database_name < agriculture_portal.sql
- Start your local server (e.g., using XAMPP Control Panel).Launch the application using your local server.
- Access the project in your browser: http://localhost/agrowave/index.php
- Admin Login Credentials To access the admin panel, use the following credentials:
- Mobile Number: admin Password: password
- Farmer and Customer can log in through Registraton.


## Features
- Crop Mapping
- Crop Recommendation
- Fertilizer Recommendation
- Agricultural Tool Hire 
- Rainfall Prediction
- Agriculture realetd news using News
- Weather Forecast upto 5 days using OpenWeatherMap API
- Direct crop sales to customer with real time payment interface


## Technologies Used
- Python
- PHP
- Pandas
- NumPy
- JavaScript
- HTML/CSS
- Scikit-learn

## Dataset
The Crop Management System dataset includes the following features:

### Crop Mapping Dataset
- Upazilla_Name
- District_Name
- Season

### Crop Recommendation Dataset
- N
- P
- K
- Temperature
- Humidity
- pH
- Rainfall

### Fertilizer Recommendation Dataset
- Temparature
- Humidity
- Soil Moisture
- Soil Type
- Crop Type
- Nitrogen
- Phosphorous
- Potassium
- Fertilizer Name

### Rainfall Prediction Dataset
- YEAR
- JAN
- FEB
- MAR
- APR
- MAY
- JUN
- JUL
- AUG
- SEP
- OCT
- NOV
- DEC

## How to Use
- Crop Prediction: Input `Upazilla_Name`, `District_Name`, and `Season` to get the predicted crop for that location.
- Crop Recommendation: Input `N`, `P`, `K`, `Temperature`, `Humidity`, `pH`, and `Rainfall` for that location to get recommended crops for that location.
- Fertilizer Recommendation: Input `Temperature`, `Humidity`, `Soil Moisture`, `Soil Type`, `Crop Type`, `Nitrogen`, `Phosphorous`, and `Potassium` to get recommended fertilizer for that crop and location.
- Rainfall Prediction: Input `District_Name` and `Month` to get rainfall prediction for that year.

Slide: http://surl.li/pyjcow