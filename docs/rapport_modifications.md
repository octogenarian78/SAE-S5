Assia GOUABI, Enzo Guignolle, Maaz NORAT, Loan QUILLET, Pierre JAUFFRES, Teddy DEGAT<br>
INF3
<div align="center">

<img height="95" width="400" src="img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S6 - Modifications sur le site dynamique

<br><br>
Ce document énumère toutes les modifications qui ont été apportées au site dynamique suite à l'entretien avec notre client
</div>


<br><br><br>

---

<br><br><br><br>

## Plan

### [I – Modifications apportées au site dynamique](#p1)


<br><br><br><br><br><br><br>

---
### <a name="p1"></a>I – Modifications apportées au site dynamique

- Nous avons commencé par ajouté des restrictions sur tout les champs du formulaire d'inscription. 
Pour s'inscrire il faut un minimum et maximum de caractères. Le login, prénom et nom nécessitent un minimum de 5 caractères pour être valide et un manimum de 12.  

- Concernant l'email il faut minimum 4 caractères après le @ et 2 après le . pour éviter d'entrer des emails farfelus. 
Enfin, pour avoir un mot de passe correct, une majuscule, minuscule, un chiffre et un caractère spécial sont nécessaires. 
Il faut minimum 12 caractères et maximum 32 pour valider l'inscription

- Nous avons corrigé des problèmes de CSS notamment pour le formulaire d'inscription. Dès qu'un message d'erreur apparaissait, un bout de formulaire se retrouvait en dehors de l'encadré

- Les titres pour chaque page ont été ajouté dans les balises HTML "title"

- "Mot de passe oublié" dans la page de connexion redirige vers une page de maintenance maintenant

- Nous avons enfin réussi à mettre en place notre système d'état des RPI0. Pour cela, nous avons permis à l'utilisateur d'exécuter des commandes SSH en se connectant à Pi, ce qui lui a permis de récupérer les résultats réels des commandes executées permettant de récupérer l'état du raspberry.

- Le bug que nous avions concernant MonteCarlo, à savoir qu'il s'exécutait parfois plusieurs fois, a été corrigé. Le problème venait du fait que si on lançait plusieurs tests successifs, le bouton "Ok" du popup gagnait un nouvel EventListener à chaque fois. Concrètement, cela voulait dire qu'il lançait le module plusieurs fois en même temps.
Pour corriger ce bug, nous avons simplement fait en sorte que le programme n'ajoute un EventListener au bouton uniquement si ce dernier n'en possède déjà un.

- MonteCarlo affiche maintenant la valeur de Pi au lieu de l'Erreur, et affiche le nombre de RPI utilisés.
