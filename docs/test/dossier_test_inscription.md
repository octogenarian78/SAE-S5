Assia GOUABI, Enzo Guignolle, Maaz NORAT, Loan QUILLET, Pierre JAUFFRES, Teddy DEGAT<br>
INF3

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5 - Dossier de test boite noire 
## Site dynamique (inscription)

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

Le document suivant a pour but de tester la page inscription.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester tous les cas d'erreurs possibles lors de l'inscription ainsi que les cas où elle fonctionne. 
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                   |
|------------------------------------|--------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                     |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)         |
| Date de début                      | 17/01/2025                                                               |
| Date de finalisation               |   17/01/2025                                                             |
| Test à appliquer                   | Vérification du bon fonctionnement de la page inscription                  |
| Responsable de la campagne de test | Gouabi Assia                       |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence 

Afin de s'inscrire sur la plateforme l'utilisateur a besoin de renseigner plusieurs informations telles que son login, mot de passe, la confirmation de ce mot de passe, son email, son prénom, nom et répondre au captcha. S'il parvient à s'inscrire le résultat obtenu sera OK, ce qui veut dire que l'inscription a bien été effectué et celle ci retournera la page de profil. 
<br>
Cependant, s'il échoue parce qu'un des champs ou les deux sont vides ou incorrects, des erreurs seront déclenchés. L'erreur id=1 sera retournée si le mot de passe et sa confirmation sont différents, l'id=2 si les données sont déjà présentes dans la base de données, l'id=5 si le captcha est incorrect et KO si un champ ou plusieurs sont vides. 

### Conception des tests


| Cas | $login       | $mdp         | $confirm_mdp        | $prenom   | $nom      | $email       | $captcha   | Résultat attendu | Résultat obtenu | Commentaires                                                                                                                          |
|-----|--------------|--------------|---------------------|-----------|-----------|--------------|------------|------------------|-----------------|---------------------------------------------------------------------------------------------------------------------------------------|
| P1  | Correct      | Correct      | Correct             | Correct   | Correct   | Correct      | Correct    | OK               | OK              | Toutes les données sont correctes                                                                                                               |
| P2  | Correct      | Correct      | Incorrect           | Correct   | Correct   | Correct      | Correct    | id=1             | id=1            | Le mot de passe et sa confirmation sont différents                                                                                                        |
| P3  | Correct      | Correct      | Correct             | Correct   | Correct   | Correct      | Correct    | id=2             | id=2            | Les données sont déjà présentes dans la base de données                                                                                     |
| P4  | Correct      | Correct      | Correct             | Correct   | Correct   | Vide         | Correct    | KO               | KO              | Le champ email est vide                                                                                                                  |
| P5  | Correct      | Correct      | Correct             | Correct   | Correct   | Correct         | vide    | KO               | KO              | Le captcha est manquant                                                                                                                  |
| P6  | Correct      | Correct      | Correct             | Correct   | Correct   | Correct         | Incorrect    | id=5               | id=5              | Le captcha est incorrect                                                                                                                  |


### Exécution des tests 


| Cas  | $login       | $mdp         | $confirm_mdp        | $prenom   | $nom      | $email       | captcha | Résultat attendu | Résultat obtenu | Commentaires                                                                                                                          |
|------|--------------|--------------|---------------------|-----------|-----------|--------------|---------|------------------|-----------------|---------------------------------------------------------------------------------------------------------------------------------------|
| P1   | e            | e            | e                   | e         | e         | e@e.e        | 8 + 8 = 16     | OK               | OK              | Toutes les données sont correctes                                                                                                       |
| P2   | e            | e            | eee                 | e         | e         | e@e.e        |  8 + 8 = 16       | id=1             | id=1            | Le mot de passe et sa confirmation sont différents                                                                                      |
| P3   | e            | e            | e                   | e         | e         | e@e.e        |  8 + 8 = 16       | id=2             | id=2            | Les données sont déjà présentes dans la base de données                                                                                 |
| P4   | e            | e            | e                   | e         | e         | " "           |  8 + 8 = 16       | KO               | KO              | Le champ email est vide                                                                                                                 |
| P5   | e            | e            | e                   | e         | e         | e@e.e         |  " "       | KO               | KO              | Le captcha est manquant                                                                                         |
| P6   | e            | e            | e                   | e         | e         | e@e.e         |  8 + 8 = 45      | id=5               | id=5              | Le captcha est incorrect                                                                                         |