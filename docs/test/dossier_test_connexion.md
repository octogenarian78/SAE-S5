Assia GOUABI, Enzo Guignolle, Maaz NORAT, Loan QUILLET, Pierre JAUFFRES, Teddy DEGAT<br>
INF3

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5 - Dossier de test boite noire 
## Site dynamique (connexion)

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

Le document suivant a pour but de tester la page connexion.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester tous les cas d'erreurs possibles lors de la connexion ainsi que les cas où elle fonctionne. 
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                   |
|------------------------------------|--------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                     |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)         |
| Date de début                      | 10/01/2025                                                               |
| Date de finalisation               | 13/01/2025                                                               |
| Test à appliquer                   | Vérification du bon fonctionnement de la page connexion                  |
| Responsable de la campagne de test | Gouabi Assia                       |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence 

Afin de se connecter à la plateforme l'utilisateur a besoin de renseigner son login et son mot de passe. S'il parvient à se connecter le résultat obtenu sera OK, ce qui veut dire que la connexion a bien été effectué et celle ci retournera la page de profil. 
<br>
Cependant, s'il échoue parce qu'un des champs ou les deux sont vides ou incorrects, des erreurs seront déclenchés. KO est renvoyé si il est impossible de se connecter suite au manque d'une valeur dans les champs et renvoie id=2 en cas de champs incorrect. 

### Conception des tests

| Cas | $login                | $mdp               | Résultat attendu   | Résultat obtenu    | Commentaires                                               |
|:----|---------------------------|---------------------------|--------------------|--------------------|------------------------------------------------------------|
| P1  | Correct                      | Correct                   | OK | OK | $login et $mdp sont corrects                     |
| P2  | Correct                   | Vide                      | id=1b | id=1b | $login correct et $mdp vide                     |
| P3  | Vide                   | Correct                      | id=1a | id=1a | $login vide et $mdp correct                     |
| P4  | Correct                   | Incorrect                      | id=2 | id=2 | $login vide et $mdp incorrect                     |
| P5  | Incorrect                   | Correct                      | id=2 | id=2 | $login incorrect et $mdp correct                     |
| P6  | Incorrect                   | Incorrect                      | id=2 | id=2 | $login et $mdp sont incorrectes                     |
| P7  | Vide                   | Vide                      | KO | KO | $login et $mdp sont vides                     |


### Exécution des tests 

| Cas n° | $login | $mdp      | Résultat attendu   | Résultat obtenu    |
|:-------|------------|------------------|--------------------|--------------------|
| P1      | e        | e  | OK | OK |
| P2      | e      | " "              | id=1b | id=1b |
| P3      | " "        | e              | id=1a | id=1a |
| P4      | e      | adqi    | id=2      |id=2           |
| P5      | eevf      | e  | id=2       | id=2          |
| P6      | eere      | reer  | id=2     | id=2          |
| P7      | " "      | " "  | KO     | KO          |