import sys
import joblib
import pandas as pd

# Load the trained model
model_path = 'C:/xampp/htdocs/agriculture-portal-main/farmer/ML/rainfall_prediction/rainfall_model.pkl'
model = joblib.load(model_path)

# Accept inputs
region = sys.argv[1]  # Station name
month = int(sys.argv[2])  # Month as a number

# Prepare data for prediction
region_map = {'Bogra': 0, 'Dhaka': 1, 'Chittagong': 2}  # Map station names to numeric codes
if region not in region_map:
    print("Error: Invalid region")
    sys.exit(1)

station_code = region_map[region]
input_data = pd.DataFrame({'Station': [station_code], 'Month': [month]})

# Make prediction
prediction = model.predict(input_data)
print(prediction[0])  # Output the predicted rainfall
