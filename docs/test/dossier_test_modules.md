Assia GOUABI, Enzo Guignolle, Maaz NORAT, Loan QUILLET, Pierre JAUFFRES, Teddy DEGAT<br>
INF3

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5 - Dossier de test boite noire 
## Site dynamique (modules)

<br><br>

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test](#IV)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant a pour but de tester la page de modules.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester tous les cas où les fonctionnalités de la page tournent.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                   |
|------------------------------------|--------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                     |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)         |
| Date de début                      | 23/01/2025                                                               |
| Date de finalisation               | 23/01/2025                                                               |
| Test à appliquer                   | Vérification du bon fonctionnement de la page modules                  |
| Responsable de la campagne de test | Gouabi Assia                       |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence 

Peu de tests on était effectué puisqu'il s'agissait de simplement voir si chaque module fonctionnait. On renvoie OK si un résultat et le bon résultat est renvoyé.

### Tests pour le module Nombre premier

| n°cas | Nombre | Résultat | Temps | Processeurs utilisés | Résultat attendu | Résultat obtenu | Commentaires |
|-------|--------|----------|-------|----------------------|------------------|-----------------|--------------|
| 1     | 21     | 8        | 0     | 2                   | OK               | OK              | Le nombre 21 a 8 nombres premiers |

### Tests pour le module Monte Carlo

| n°cas | Nombre de points | Temps  | Processeurs utilisés | Résultat attendu | Résultat obtenu |
|-------|------------------|--------|----------------------|------------------|-----------------|
| 1     | 1000             | 20.82  | 2                    | OK               | OK              |