import sys
import json

print("proyecto de computacion. Ruta temporal: ")

file = open(sys.argv[1])
data = json.load(file)

print(data)
