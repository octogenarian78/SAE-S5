<img height="95" width="400" src="img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# Cahier des charges -  Projet "Mise en place d'une architecture Cluster HAT + Raspberry Pi Zero pour le calcul distribué ou parallèle"

---

## Plan
- ### [I - Introduction](#p1)
  - #### [a) Information générale sur le document et ses parties](#p1a)
  - #### [b) Objectifs du document](#p1b)
  - #### [c) Les documents référencés](#p1c)
- ### [II - Enoncé](#p2)
  - #### [a) Description détaillée du problème à résoudre et du contexte](#p2a)
  - #### [b) Les objectifs du projet](#p2b)
- ### [III - Pré-requis](#p3)
  - #### [a) Connaissances et compétences requises](#p3a)
  - #### [b) Ressources matérielles et logicielles](#p3b)
- ### [IV - Priorités](#p4)

---

## <a name="p1"></a> I - Introduction

### <a name="p1a"></a> a) Information générale sur le document et ses parties

Ce document est un cahier des charges pour un projet consistant à utiliser un **kit Cluster HAT** et plusieurs **Raspberry Pi Zero** pour mettre en place une architecture de **calcul distribué ou parallèle**. Le but final est de développer des programmes capables d'exploiter cette architecture pour exécuter des tâches de manière efficace en répartissant les calculs entre les différents nœuds du cluster.

Le cahier des charges se divise en plusieurs sections :
1. Une introduction générale expliquant le contexte et les objectifs du document.
2. Un énoncé détaillant le problème à résoudre ainsi que les objectifs techniques du projet.
3. Les pré-requis nécessaires en termes de compétences, connaissances, ressources matérielles et logicielles.
4. Une section consacrée aux priorités du projet.

### <a name="p1b"></a> b) Objectifs du document

Ce document a pour objectif de définir clairement les attentes techniques et fonctionnelles du projet. Le but est de :
1. Configurer un cluster composé de plusieurs Raspberry Pi Zero à l'aide d'un Cluster HAT.
2. Développer des programmes capables de répartir les tâches de calcul sur plusieurs nœuds, utilisant ainsi pleinement l'architecture pour effectuer du **calcul parallèle ou distribué**.
3. Optimiser les performances pour tirer le meilleur parti des ressources matérielles limitées du Raspberry Pi Zero tout en maximisant l'efficacité des calculs.

Ce cahier des charges servira à aligner les attentes entre les développeurs, les utilisateurs finaux et toutes les parties prenantes du projet.

### <a name="p1c"></a> c) Les documents référencés

- Documentation du **Cluster HAT** et du **Raspberry Pi Zero**.
- Guides d'installation et de configuration pour la création de clusters avec des Raspberry Pi.
- Documentation des bibliothèques pour le calcul parallèle et distribué
- Documentation technique sur les algorithmes de **calcul parallèle**
---

## <a name="p2"></a> II - Enoncé

### <a name="p2a"></a> a) Description détaillée du problème à résoudre et du contexte

Dans le cadre de ce projet scolaire, l'objectif est de mettre en place une infrastructure simple mais efficace de **calcul distribué ou parallèle** en utilisant un **Cluster HAT** et des **Raspberry Pi Zero**. Ce type de calcul est utilisé dans des contextes nécessitant un traitement rapide de grandes quantités de données ou de calculs intensifs, comme la simulation scientifique ou la modélisation mathématique.

Le problème à résoudre ici est de concevoir et de configurer une infrastructure permettant d'exécuter des programmes de calcul répartis sur plusieurs nœuds (les Raspberry Pi Zero), en optimisant les échanges de données et la répartition des tâches entre ces nœuds. En tant que projet éducatif, l’accent sera mis sur la maîtrise des concepts fondamentaux du calcul distribué et parallèle, ainsi que sur l'optimisation de l'utilisation des ressources limitées des Raspberry Pi Zero.



### <a name="p2b"></a> b) Les objectifs du projet

Les objectifs concrets du projet sont les suivants :
1. **Configurer et déployer un cluster de Raspberry Pi Zero** : Utiliser un Cluster HAT pour interconnecter plusieurs Raspberry Pi Zero et les configurer en tant que nœuds dans une architecture distribuée.
2. **Développer des programmes de calcul parallèle ou distribué** : Créer des programmes capables de réaliser des calculs scientifiques (par exemple, résolution d'équations différentielles, simulation numérique) en parallèle.
3. **Optimiser la gestion des ressources** : Minimiser l’utilisation de la bande passante, maximiser le temps d’exécution des processeurs, et équilibrer la charge de travail entre les nœuds du cluster pour éviter des goulets d'étranglement.
4. **Mesurer et analyser les performances** : Tester et analyser les gains de performance obtenus grâce au calcul parallèle, et comparer ces résultats à ceux obtenus sur une machine unique.
5. **Documenter l'architecture et les processus** : Fournir une documentation claire sur la configuration du cluster, le développement des programmes, et les résultats des tests de performance.

---

## <a name="p3"></a> III - Pré-requis

### <a name="p3a"></a> a) Connaissances et compétences requises

Pour mener à bien ce projet, il est nécessaire de maîtriser les compétences suivantes :
- **Administration système et réseaux** : Connaissances en configuration de systèmes Linux, gestion de clusters, réseaux, et optimisation des communications entre nœuds.
- **Programmation** : Maîtrise du langage Python et de ses bibliothèques scientifiques comme **Numpy**
- **Calcul parallèle et distribué** : Connaissance des algorithmes de calcul parallèle.
- **Modélisation mathématique** : Savoir structurer les problèmes en plusieurs sous-tâches (par exemple, résoudre une équation différentielle en parallèle).

### <a name="p3b"></a> b) Ressources matérielles et logicielles

- **Matériel** :
  - **Cluster HAT** : Un boîtier permettant d'héberger plusieurs Raspberry Pi Zero pour former un mini-cluster.
  - 4 x **Raspberry Pi Zero** : Chaque Raspberry Pi Zero servira de nœud dans le cluster, hébergeant une partie des calculs.
  - **Cartes microSD** pour chaque Raspberry Pi, contenant les systèmes d’exploitation et les logiciels nécessaires.
  - **Câblage réseau et alimentation** : Assurer la connectivité entre les nœuds et l’alimentation adéquate.

- **Logiciel** :
  - **Raspberry Pi OS** : Système d'exploitation basé sur Linux pour chaque Raspberry Pi.
  - **Python 3.x** avec les bibliothèques **mpi4py**, **Numpy**.

---

## <a name="p4"></a> IV - Priorités

1. **Configurer le Cluster HAT et les Raspberry Pi Zero** : La première priorité est d’assurer que les Raspberry Pi Zero sont correctement configurés, connectés entre eux via le Cluster HAT, et capables de communiquer. Cela inclut l’installation des systèmes d’exploitation, la configuration réseau et la mise en place des outils de gestion de clusters comme **MPI**.

2. **Développer les programmes de calcul parallèle ou distribué** : Une fois l'infrastructure en place, la prochaine étape consiste à développer les algorithmes et programmes capables de répartir les calculs entre les différents nœuds. Le but est de maximiser l’utilisation des ressources des Raspberry Pi en exploitant au mieux leur capacité de calcul parallèle.

3. **Optimisation et gestion des ressources** : Une fois les programmes fonctionnels, il sera crucial de tester et d’optimiser l’efficacité des calculs. Cela inclut la gestion des communications entre les nœuds, l'équilibrage des charges, et la réduction des goulets d'étranglement.

4. **Validation et analyse des performances** : Les résultats du calcul distribué seront comparés avec ceux obtenus sur un seul Raspberry Pi, afin d'évaluer les gains en termes de rapidité et d'efficacité. Des tests de performance seront effectués en fonction du nombre de nœuds utilisés et de la complexité des calculs.



