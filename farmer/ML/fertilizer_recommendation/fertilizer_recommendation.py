import pandas as pd
import sys
from sklearn.preprocessing import LabelEncoder
from sklearn.tree import DecisionTreeClassifier

# Load the dataset
data = pd.read_csv("ML/fertilizer_recommendation/fertilizer_recommendation.csv")

# Label encoding for categorical features
le_soil = LabelEncoder()
data['Soil Type'] = le_soil.fit_transform(data['Soil Type'])

# Split the data into input and output variables
X = data.iloc[:, :7]  # Only using the first 7 columns (excluding Crop Type)
y = data.iloc[:, -1]

# Training the Decision Tree Classifier model
dtc = DecisionTreeClassifier(random_state=0)
dtc.fit(X, y)

# Get the input parameters as command line arguments
jsonn = sys.argv[1]
jsonp = sys.argv[2]
jsonk = sys.argv[3]
jsont = sys.argv[4]
jsonh = sys.argv[5]
jsonsm = sys.argv[6]
jsonsoil = sys.argv[7]

# Label encoding for soil type
soil_enc = le_soil.transform([jsonsoil])[0]

# Get the user inputs and store them in a numpy array - Urea
user_input = [[jsont, jsonh, jsonsm, soil_enc, jsonn, jsonk, jsonp]]

# Predict the fertilizer type
fertilizer_name = dtc.predict(user_input)

# Return the prediction as a string
print(str(fertilizer_name[0]))
