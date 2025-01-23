Assia GOUABI, Enzo Guignolle, Maaz NORAT, Loan QUILLET, Pierre JAUFFRES, Teddy DEGAT<br>
INF3

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5 - Dossier de test boite noire 
## Site dynamique (modification mot de passe)

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

Le document suivant a pour but de tester la page de modification de mot de passe.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester tous les cas d'erreurs possibles lors de la modification du mot de passe ainsi que les cas où elle fonctionne. 
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                   |
|------------------------------------|--------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                     |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)         |
| Date de début                      | 23/01/2025                                                               |
| Date de finalisation               | 23/01/2025                                                               |
| Test à appliquer                   | Vérification du bon fonctionnement de la page modification mot de passe                   |
| Responsable de la campagne de test | Gouabi Assia                       |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence 

Afin de modifier son mot de passe, l'utilisateur doit renseigner l'ancien mot de passe, le nouveau et sa confirmation. S'il parvient à le modifier le résultat obtenu sera OK, ce qui veut dire que la modification a bien été effectué et celle ci retournera la page de profil. 
<br>
Cependant, s'il échoue parce qu'un des champs ou les deux sont vides ou incorrects, des erreurs seront déclenchés. les id 1d, 1a et 1b seront déclenchés si les champs ancien mot de passe, nouveau mot de passe et sa confirmation sont vides. Si l'ancien mot de passe est incorrect on renvoie l'id 3. L'id 1c est renvoyé si le nouveau mot de passe et sa confirmation sont différents. Enfin, l'id 2 est renvoyé si le nouveau mot de passe et l'ancien sont similaires. 

### Conception des tests

| Cas  | $ancien_password              | $password              | $confirmed_password        | Résultat attendu   | Résultat obtenu    | Commentaires                                               |
|:---- |----------------------|--------------------|-------------------|--------------------|--------------------|------------------------------------------------------------|
| P1   | Correct              | Correct            | Correct      | OK                 | OK                 | Les données sont correctes                             |
| P2   | Vide              | Correct               | Correct     | id=1d              | id=1d              | $ancien_password est vide                                |
| P3   | Correct                 | Vide            | Correct     | id=1a              | id=1a              | $password est vide                               |
| P4   | Correct              | Correct         | Vide      | id=1b               | id=1b             | $confirmed_password est vide                         |
| P5   | Incorrect            | Correct            | Correct      | id=3              | id=3               | $ancien_password est incorrect                           |
| P6   | Correct            | Correct          | Correct      | id=2               | id=2               | le nouveau mot de passe est similaire à l'ancien                            |
| P7   | Vide                 | Vide               | Vide      | KO                 | KO                 | Les données sont vides                               |
| P8  | Correct                 | Correct               | Incorrect      | id=1c                 | id=1c            | le nouveau mot de passe et sa confirmation sont différents          |

### Exécution des tests 

| Cas  | $ancien_password              | $password              | $confirmed_password        | Résultat attendu   | Résultat obtenu    | Commentaires                                               |
|:---- |----------------------|--------------------|-------------------|--------------------|--------------------|------------------------------------------------------------|
| P1   | bonjour              | bonjour12            | bonjour12      | OK                 | OK                 | Les données sont correctes                             |
| P2   | " "              | bonjour12               | bonjour12     | id=1d              | id=1d              | $ancien_password est vide                                |
| P3   | bonjour                 | " "            | bonjour12     | id=1a              | id=1a              | $password est vide                               |
| P4   | bonjour              | bonjour12         | " "      | id=1b               | id=1b             | $confirmed_password est vide                         |
| P5   | bonj            | bonjour12            | bonjour12      | id=3              | id=3               | $ancien_password est incorrect                           |
| P6   | bonjour            | bonjour          | bonjour      | id=2               | id=2               | le nouveau mot de passe est similaire à l'ancien                            |
| P7   | " "                 | " "               | " "      | KO                 | KO                 | Les données sont vides                               |
| P8  | bonjour                 | bonjour12               | bonjour34      | id=1c                 | id=1c            | le nouveau mot de passe et sa confirmation sont différents             |