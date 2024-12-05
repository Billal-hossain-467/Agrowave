#!/usr/bin/env python
# coding: utf-8

import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from collections import Counter
from sklearn.externals import joblib

# Load the updated dataset
data = pd.read_csv('preprocessed2.csv')

# Clean the dataset
data['Season'] = data['Season'].str.strip()

# Remove unnecessary columns
if 'Unnamed: 0' in data.columns:
    del data['Unnamed: 0']

# Convert the dataset to a list of rows
training_data = list(np.array(data))

# Split the data into training and testing sets
testing_data = training_data[100:120]  # Example testing data

# Update the headers to reflect the updated dataset
header = ['District_name', 'Upazilla_name', 'Season', 'Predicted_crops']

# Helper functions
def unique_vals(Data, col):
    return set([row[col] for row in Data])

def class_counts(Data):
    counts = {}
    for row in Data:
        label = row[-1]
        if label not in counts:
            counts[label] = 0
        counts[label] += 1
    return counts

class Question:
    def __init__(self, column, value):
        self.column = column
        self.value = value

    def match(self, example):
        val = example[self.column]
        return val == self.value

    def __repr__(self):
        return "Is %s %s %s?" % (header[self.column], "==", str(self.value))

def partition(Data, question):
    true_rows, false_rows = [], []
    for row in Data:
        if question.match(row):
            true_rows.append(row)
        else:
            false_rows.append(row)
    return true_rows, false_rows

def gini(Data):
    counts = class_counts(Data)
    impurity = 1
    for lbl in counts:
        prob_of_lbl = counts[lbl] / float(len(Data))
        impurity -= prob_of_lbl ** 2
    return impurity

def info_gain(left, right, current_uncertainty):
    p = float(len(left)) / (len(left) + len(right))
    return current_uncertainty - p * gini(left) - (1 - p) * gini(right)

def find_best_split(Data):
    best_gain = 0
    best_question = None
    current_uncertainty = gini(Data)
    n_features = len(Data[0]) - 1
    for col in range(n_features):
        values = unique_vals(Data, col)
        for val in values:
            question = Question(col, val)
            true_rows, false_rows = partition(Data, question)
            if len(true_rows) == 0 or len(false_rows) == 0:
                continue
            gain = info_gain(true_rows, false_rows, current_uncertainty)
            if gain > best_gain:
                best_gain, best_question = gain, question
    return best_gain, best_question

# Classes for decision tree structure
class Leaf:
    def __init__(self, Data):
        self.predictions = class_counts(Data)

class Decision_Node:
    def __init__(self, question, true_branch, false_branch):
        self.question = question
        self.true_branch = true_branch
        self.false_branch = false_branch

# Build the tree
def build_tree(Data):
    gain, question = find_best_split(Data)
    if gain == 0:
        return Leaf(Data)
    true_rows, false_rows = partition(Data, question)
    true_branch = build_tree(true_rows)
    false_branch = build_tree(false_rows)
    return Decision_Node(question, true_branch, false_branch)

# Train the decision tree
my_tree = build_tree(training_data)

# Save the decision tree model
joblib.dump(my_tree, 'filetest2.pkl')

# Helper functions for tree visualization and prediction
def print_tree(node, spacing=""):
    if isinstance(node, Leaf):
        print(spacing + "Predict", node.predictions)
        return
    print(spacing + str(node.question))
    print(spacing + "--> True:")
    print_tree(node.true_branch, spacing + " ")
    print(spacing + "--> False:")
    print_tree(node.false_branch, spacing + " ")

def print_leaf(counts):
    total = sum(counts.values()) * 1.0
    probs = {}
    for lbl in counts.keys():
        probs[lbl] = str(int(counts[lbl] / total * 100)) + "%"
    return probs

def classify(row, node):
    if isinstance(node, Leaf):
        return node.predictions
    if node.question.match(row):
        return classify(row, node.true_branch)
    else:
        return classify(row, node.false_branch)

# Test the decision tree
for row in testing_data:
    print("Actual: %s. Predicted: %s" % (row[-1], print_leaf(classify(row, my_tree))))
