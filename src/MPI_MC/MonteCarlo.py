from mpi4py import MPI
import random


comm = MPI.COMM_WORLD  # Communicateur global
rank = comm.Get_rank()  # Rang du processus
size = comm.Get_size()  # Nombre total de processus


numIter = 1000000


if rank != 0:
    cpt = 0  # Compteur pour les points en dehors du cercle
    for _ in range(numIter):
        x = random.random()  # Coordonnée x
        y = random.random()  # Coordonnée y

        
        if (x**2 + y**2) >= 1: # Vérification si le point est en dehors du cercle unité
            cpt += 1

    
    comm.send(cpt, dest=0, tag=rank) # Chaque processus envoie son résultat partiel au processus maître


else: # Collecte des résultats par le processus maître (rang 0)
    total_cpt = 0  # Compteur total
    for i in range(1, size):  # Récupération des résultats des processus esclaves
        partial_cpt = comm.recv(source=i, tag=i)
        total_cpt += partial_cpt

    pi = 4 * partial_cpt/total_cpt

    print(f"nombre de processus {size} \n nombre de point {total_cpt} \n valeur approchee de Pi {pi}")
