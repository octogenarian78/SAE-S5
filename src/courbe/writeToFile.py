import os
import csv
import random


def write(nbProcessor, duration):
    file_exists = os.path.isfile('test.csv')

    with open('test.csv', 'a', newline='') as fichier:
        writer = csv.writer(fichier)
        if not file_exists:
            writer.writerow(['NbProcessor', 'Duration'])
        writer.writerow([ nbProcessor, duration])

for i in range(0, 4):
    for j in range(0, 10):
        write(i, random.randint(50, 1000))
