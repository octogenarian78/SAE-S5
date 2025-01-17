Assia GOUABI, Enzo Guignolle, Maaz NORAT, Loan QUILLET, Pierre JAUFFRES, Teddy DEGAT<br>
INF3

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5 - Dossier de test
## Site dynamique (profil)

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

Le document suivant a pour but de tester la page profil.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester l'affichage des élements de la page profil étant donné qu'aucunes erreurs ne peuvent être retournées. 
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                   |
|------------------------------------|--------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                     |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)         |
| Date de début                      | 17/01/2025                                                               |
| Date de finalisation               |   17/01/2025                                                             |
| Test à appliquer                   | Vérification du bon fonctionnement de la page profil                  |
| Responsable de la campagne de test | Gouabi Assia                       |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence 

Afin d'avoir accès aux élements de profil d'un utilisateur il faut d'abord que celui-ci soit connecté à la plateforme sinon on retourne KO. La page de connexion sera retournée en cas de tentative d'accès à la page profil sans connexion. 
Si l'utilisateur est connecté, il aura accès à ses informations personnelles de connexion et aux calculs des modules. 

### Tests

| n°cas | Critère             | Résultat attendu          | Résultat obtenu           |
|-------|---------------------|---------------------------|---------------------------|
| 1     | Si l'utilisateur n'est pas connecté   | KO           | KO          |
| 2     | Si l'utilisateur est connecté   | - L'affichage du login et mot de passe de l'utilisateur <br> - L'affichage des entrées et sorties pour les différents modules <br> - La possibilité de modifier son mot de passe      | - L'affichage du login et mot de passe de l'utilisateur <br> - L'affichage des entrées et sorties pour les différents modules <br> - La possibilité de modifier son mot de passe         |

