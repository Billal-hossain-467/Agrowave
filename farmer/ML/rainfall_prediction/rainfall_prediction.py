import pandas as pd
import random

# List of all upazilas in Bangladesh
upazilas_full = [
    "Bagerhat", "Bandarban", "Barguna", "Barisal", "Bhola", "Bogra", "Brahmanbaria", "Chandpur", "Chattogram", 
    "Chuadanga", "Cox's Bazar", "Dhaka", "Dinajpur", "Faridpur", "Feni", "Gaibandha", "Gazipur", "Gopalganj",
    "Habiganj", "Jamalpur", "Jessore", "Jhalokati", "Jhenaidah", "Khagrachari", "Khulna", "Kishoreganj",
    "Kurigram", "Kushtia", "Lakshmipur", "Lalmonirhat", "Madaripur", "Magura", "Manikganj", "Meherpur", 
    "Moulvibazar", "Munshiganj", "Mymensingh", "Naogaon", "Narail", "Narayanganj", "Narsingdi", "Natore", 
    "Netrokona", "Nilphamari", "Noakhali", "Pabna", "Panchagarh", "Patuakhali", "Pirojpur", "Rajbari", 
    "Rajshahi", "Rangamati", "Rangpur", "Satkhira", "Shariatpur", "Sherpur", "Sirajganj", "Sunamganj", 
    "Sylhet", "Tangail", "Thakurgaon"
]

# Generate synthetic data
data_full = {
    "Region": [random.choice(upazilas_full) for _ in range(10000)],
    "Month": [random.randint(1, 12) for _ in range(10000)],
    "Rainfall_Quantity": [round(random.uniform(0, 500), 2) for _ in range(10000)]  # Rainfall in mm
}

# Create the dataset
rainfall_dataset_full = pd.DataFrame(data_full)

# Save the dataset to a CSV file
rainfall_dataset_full.to_csv("rainfall_dataset_full.csv", index=False)

print("Dataset with 10,000 rows saved as 'rainfall_dataset_full.csv'")
