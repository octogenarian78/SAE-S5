# Algorithme de découverte de nombres premiers avec MPI

## Sommaire :

- ### [MPI (Message Passing Interface)](#p1)
- ### [Recherche de nombres premiers](#p2)
- ### [Implémentation de la recherche de nombres premiers en Python avec MPI4PY](#p3)
    - #### [Paradigme Master-Worker](#p3.1)
    - #### [Modèle MPI](#p3.2)
    - #### [Explication du code Python](#p3.3)
- ### [Amélioration de la recherche de nombres premiers](#p4)

## <a name="p1"></a> MPI (Message Passing Interface) :

MPI est une bibliothèque de communication pour les programmes parallèles. Elle permet de créer des programmes parallèles dans lesquels les processus peuvent communiquer entre eux.<br>
Dans une approche de type Master-Worker, le processus **Master** envoie des tâches aux processus **Workers**, qui les exécutent et renvoient les résultats au **Master**, bien souvent le processus **Master** peut agir comme un processus **Worker** et donc réaliser des tâches.<br>

Pour différencier les processus, MPI attribue un **rank** à chaque processus. Le **Master** a toujours le **rank 0**, et les **Workers** ont des **ranks supérieurs à 0**.<br>

## <a name="p2"></a> Recherche de nombres premiers :

L'objectif est de trouver tous les nombres premiers jusqu'à une limite donnée, `end_number`, en divisant le travail entre plusieurs processus MPI. Chaque processus évaluera un sous-ensemble des nombres, ce qui permet d'accélérer la recherche grâce à la parallélisation.

La recherche s'effectue selon les étapes suivantes :
1. Chaque processus calcule les nombres à tester selon son `rank`.
2. Pour chaque nombre, il vérifie s'il est divisible par un nombre précédent (autre que 1 et lui-même).
3. Si aucun diviseur n'est trouvé, le nombre est considéré comme premier.

## <a name="p3"></a> Implémentation de la recherche de nombres premiers en Python avec MPI4PY :

Pour réaliser cette implémentation, on utilise le paradigme de programmation parallèle Master-Worker et le modèle MPI.

### <a name="p3.1"></a> **Paradigme Master-Worker**  
1. **Rôle du processus Master (rank 0)** :  
    - Il effectue le calcul principal : tester si les nombres attribués sont premiers.
   - Collecte les résultats des processus **Workers**.
   - Affiche les résultats finaux, y compris le temps d'exécution et le nombre total de nombres premiers trouvés.

2. **Rôle des processus Workers (rank > 0)** :  
   - Ils effectuent le calcul principal : tester si les nombres attribués sont premiers.
   - Envoient leurs résultats partiels au **Master** via `comm.gather`.

### <a name="p3.2"></a> **Modèle MPI**  
1. **Initialisation MPI** :  
   - Le programme utilise `MPI.COMM_WORLD` pour créer un communicateur global permettant la communication entre les processus.  
   - Chaque processus obtient son `rank` et le nombre total de processus, `cluster_size`.

2. **Division des tâches** :  
   - Chaque processus teste une partie des nombres à partir de `start_number`, un nombre dépendant de son `rank`.  
   - Les processus sautent les nombres en fonction de `cluster_size` pour s'assurer qu'il n'y a pas de chevauchement dans le travail.

3. **Communication des résultats** :  
   - Les processus **Workers** envoient leurs listes de nombres premiers au processus **Master** via `comm.gather`.
   - Le processus **Master** fusionne les résultats et les affiche.

### <a name="p3.3"></a> **Explication du code Python** :

1. **Initialisation MPI** :
   - Le communicateur MPI est créé :
     ```python
     comm = MPI.COMM_WORLD
     my_rank = comm.Get_rank()
     cluster_size = comm.Get_size()
     ```
   - Chaque processus calcule son `start_number` en fonction de son `rank` :
     ```python
     start_number = (my_rank * 2) + 1
     ```

2. **Recherche des nombres premiers** :
   - Chaque processus teste les nombres attribués et les compare à tous les nombres inférieur pour savoir s'ils sont premiers :
     ```python
     for candidate_number in range(start_number, end_number, cluster_size * 2):
         found_prime = True
         for div_number in range(2, candidate_number):
             if candidate_number % div_number == 0:
                 found_prime = False
                 break
         if found_prime:
             primes.append(candidate_number)
     ```

3. **Communication des résultats** :
   - Les processus envoient leurs listes de nombres premiers au processus **Master** qui va les fusionner :
     ```python
     results = comm.gather(primes, root=0)
     ```

4. **Traitement des résultats par le Master (rank == 0)** :
   - Le processus **Master** fusionne les listes de nombres premiers reçues :
     ```python
     merged_primes = [item for sublist in results for item in sublist]
     merged_primes.sort()
     ```
   - Il calcule le temps d'exécution et affiche les résultats :
     ```python
     end = round(time.time() - start, 2)
     print('Find all primes up to: ' + str(end_number))
     print('Nodes: ' + str(cluster_size))
     print('Time elasped: ' + str(end) + ' seconds')
     print('Primes discovered: ' + str(len(merged_primes)))
     ```

## <a name="p4"></a> Amélioration de la recherche de nombres premiers :

Bien que le programme fourni donne des résultats corrects, il n'est pas très efficace pour trouver des nombres premiers. Une amélioration possible serait de changer la ligne suivante :
```python
for div_number in range(2, candidate_number):
```
par :
```python
for div_number in range(2, int(math.sqrt(candidate_number)) + 1):
```
Cela permet de réduire le nombre de divisions nécessaires pour déterminer si un nombre est premier. En effet, si un nombre `n` n'est pas premier, il doit avoir un diviseur inférieur ou égal à sa racine carrée. En conséquence, on peut diviser par tous les nombres inférieurs à la racine carrée de `n` pour vérifier s'il est premier. Ce changement nous évite de diviser par des nombres inutiles et améliore les performances de l'algorithme.

## Conclusion :

L'algorithme illustre comment utiliser MPI pour répartir efficacement des tâches entre plusieurs processus. Bien que la méthode employée ici pour déterminer si un nombre est premier ne soit pas la plus efficace, l'objectif principal est de montrer l'utilisation de la parallélisation avec MPI4PY.