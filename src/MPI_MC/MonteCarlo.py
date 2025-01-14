from mpi4py import MPI
import random
import sys
import math
import time


numIter = int(sys.argv[1])

comm = MPI.COMM_WORLD  # Communicateur global
rank = comm.Get_rank()  # Rang du processus
size = comm.Get_size()  # Nombre total de processus

if rank != 0:
    cpt = 0  # Compteur pour les points en dehors du cercle
    for _ in range(numIter):
        x = random.random()  # Coordonnée x
        y = random.random()  # Coordonnée y

        if (x**2 + y**2) <= 1:  # Vérification si le point est en dehors du cercle unité
            cpt += 1

    
    comm.send(cpt, dest=0, tag=rank) # Chaque processus envoie son résultat partiel au processus maître

else:  # Collecte des résultats par le processus maître (rang 0)

    start = time.time()

    total_cpt = 0  # Compteur total
    total_points = numIter * (size - 1)
    for i in range(1, size):  # Récupération des résultats des processus esclaves
        partial_cpt = comm.recv(source=i, tag=i)
        total_cpt += partial_cpt

    pi = 4 * total_cpt / total_points
    end = time.time()

    print(f"Processus: {size}")
    print(f"Points: {total_points}")
    print(f"Pi: {pi}")
    print(f"Erreur: {math.pi - pi}")
    print(f"Temps : {end - start}")

