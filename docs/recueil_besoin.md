<div align="center">

<img height="95" width="400" src="img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5 - Recueil des besoins

<br><br>
Ce document rassemble toutes les informations importantes que nous devrons respecter pour mener à bien ce projet.

</div>


<br><br><br><br><br><br><br>

## Plan

### [I – Objectif et portée](#p1)
- <b>[a) Quels sont la portée et les objectifs généraux ?](#p1a)</b>
- <b>[b) Lecture du cahier des charges](#p1b) </b>
    - <u>[i. Liste des objets, acteurs et actions](#p1bi) </u>
    - <u>[ii. Les différents niveaux](#p1bii) </u>
    - <u>[iii. Un schéma descriptif des niveaux](#p1biii) </u>
    - <u>[iiii. Le diagramme des cas d'utilisation](#p1biiii) </u>
### [II – Terminologie employée / Glossaire](#p2)
### [III – Les cas d’utilisation](#p3)
- <b>[a) Les acteurs principaux et leurs objectifs généraux](#p3a).</b>
- <b>[b) Les cas d’utilisation métier (concepts opérationnels).](#p3b)</b>
- <b>[c) Les cas d’utilisation stratégique.](#p3c)</b>
- <b>[d) Les cas d’utilisation utilisateur et système.](#p3d)</b>
### [IV – La technologie employée](#p4)
- <b>[a) Quelles sont les exigences technologiques pour ce système ?](#p4a)</b>
- <b>[b) Avec quels systèmes ce système s’interfacera-t-il et avec quelles exigences ?](#p4b)</b>
### [V – Autres exigences](#p5)
- <b>[a) Processus de développement](#p5a)</b>
    - <u>[i. Qui sont les participants au projet ?](#p5ai)</u>
    - <u>[ii. Quelles valeurs devront être privilégiées ? (exemple : simplicité, disponibilité, rapi-
      dité, souplesse etc... )](#p5aii)</u>
    - <u>[iii. Quels retours ou quelle visibilité sur le projet les utilisateurs et commanditaires
      souhaitent-ils ?](#p5aiii)</u>
    - <u>[iv. Que peut-on acheter ? Que doit-on construire ? Qui sont nos concurrents ?](#p5aiv)</u>
    - <u>[v. Quels sont les autres exigences du processus ? (exemple : tests, installation, etc...)](#p5av)</u>
    - <u>[vi. À quelle dépendance le projet est-il soumis ?](#p5avi)</u>
- <b>[c) Performances](#p5c)</b>
- <b>[d) Opérations, sécurité, documentation](#p5d)</b>
- <b>[e) Utilisation et utilisabilité](#p5e)</b>
- <b>[f) Maintenance et portabilité](#p5f)</b>
- <b>[g) Questions non résolues ou reportées à plus tard](#p5g)</b>
### [VI – Recours humain, questions juridiques, politiques, organisationnelles.](#p6)
- <b>[a) Quel est le recours humain au fonctionnement du système ?](#p6a)
- <b>[b) Quelles sont les exigences juridiques et politiques ?](#p6b)</b>
- <b>[c) Quelles sont les conséquences humaines de la réalisation du système ?](#p6c)</b>
- <b>[d) Quels sont les besoins en formation ?](#p6d)</b>
- <b>[e) Quelles sont les hypothèses et les dépendances affectant l’environnement humain ?](#p6e)</b>
### [VII - Gestion et organisation du projet.](#p7)
- <b>[a) Rôles de chacun](#p7a)
- <b>[b) Cycles de vie](#p7b)</b>
- <b>[c) Bilan répartition des tâches S3](#p7c)</b>
- <b>[d) Bilan répartition des tâches S4](#p7d)</b>

### [Annexe 1 : Cas d'utilisation](#a1)


<br><br><br><br><br><br><br>

------------------------------------------------------------------------------------------------------------------------
### <a name="p1"></a>I – Objectif et portée

- <b><a name="p1a"></a>a) Quels sont la portée et les objectifs généraux ?</b><br>

La portée de l'utilisation de l'application s'arrête au réseau internet de l'IUT. Aucun utilisateur ne peut l'utiliser en dehors de ce réseau.

- <b><a name="p1b"></a>b) La lecture du cahier des charges </b>

    - i)<a name="p1bi"></a> Liste des objets, acteurs et actions


<table>
<colgroup>
<col span="1" style="background-color: dimgray">
<col span="1" style="background-color: darkslateblue">
<col span="1" style="background-color: rebeccapurple">

</colgroup>
<tr>
    <th>Objets</th>
    <th>Acteurs</th>
    <th>Actions</th>
</tr>

</table>
<br>

- - <a name="p1bii"></a>ii) Les différents niveaux


| Niveau stratégique (au-dessus de la mer) | Niveau utilisateur (de la mer) | Niveau sous-fonctions (en-dessous de la mer) |
|------------------------------------------|--------------------------------|----------------------------------------------|
|                                          |                                |                                              |
|                                          |                                |                                              |
|                                          |                                |                                              |
|                                          |                                |                                              |


<br>

- - <a name="p1biii"></a>iii) Un schéma descriptif des niveaux


- - <a name="p1biiii"></a>iiii) Le diagramme des cas d'utilisation


<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------
### <a name="p2"></a>II – Terminologie employée / Glossaire

Par ordre alphabétique.

| Mots             | Définition                                                                                                                                                                                                                              |
|:-----------------|:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Kit Cluster Hat  | Accessoire pour Raspberry Pi permettant de créer un mini-cluster de Pi Zeros connectés via USB. Il est utilisé pour tester des concepts de calcul distribué, d'orchestration de conteneurs et de clustering à faible coût.              |
| Calcul distribué |                                                                                                                                                                                                                                         |
| Calcul pallèle   |                                                                                                                                                                                                                                         |
| Carte micro SD   |                                                                                                                                                                                                                                         |
| Injection SQL    | Technique permettant d’injecter des éléments de type SQL dans les champs des formulaires web ou dans les liens des pages afin de les envoyer au serveur web dans l'objectif de modifier des éléments présents dans une base de données. |
| Pi Zero          | Raspberry Pi 4 un ordinateur monocarte de petite taille développé par la Fondation Raspberry Pi.                                                                                                                                        |
| SGBD             | Système de Gestion de Base de Données.                                                                                                                                                                                                  |
| W3C              | World Wide Web Consortium. Organisme international définissant les standards techniques liés au web et les règles à respecter pour tous les développeurs du monde.                                                                      |
| Wave             | Extension de navigateur internet permettant d'évaluer l'accessibilité d'une page web pour les personnes souffrant de handicap.                                                                                                          |


<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------
### <a name="p3"></a>III – Les cas d’utilisation

- <b>a) Les acteurs principaux et leurs objectifs généraux.</b><br>
  <br>

- <b>b) <a name="p3b"></a> Les cas d’utilisation métier (concepts opérationnels).</b>

- <b>c) <a name="p3c"></a> Les cas d'utilisation stratégique <b>


- <b>d) <a name="p3d"></a> Les cas d’utilisation utilisateur et système.</b>


<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------

### <a name="p4"></a>IV – La technologie employée
- <b><a name="p4a"></a>a) Quelles sont les exigences technologiques pour ce système ?</b>
<br><br>
  Pour mettre en place le système les différentes exigences sont l'utilisation d'un OS linux, Apache, MariaDB, PHP, Python, R, Java, C
<br><br>
    Le matériel mis à disposition : 
- RPI 4 : 1
- Câble HDMI
- Alimentation 
- RPI0 : 4
- Câble de connexion 
- Carte SD 5
<br><br>
- <b><a name="p4b"></a>b) Avec quels systèmes ce système s’interfacera-t-il et avec quelles exigences ?</b>


<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------

### <a name="p5"></a>V – Autres exigences


- <b><a name="p5a"></a>a) Processus de développement</b>

    - <u><a name="p5ai"></a>i. Qui sont les participants au projet ?</u><br>

      Les membres de notre équipe sont les principaux participants au projet.
      Notre équipe est constituée de Maaz NORAT, Assia GOUABI, Pierre JAUFFRES et Enzo GUIGNOLLE.<br>
      <br>
    - <u><a name="p5aii"></a>ii. Quelles valeurs devront être privilégiées ? (exemple : simplicité, disponibilité,    rapidité, souplesse etc... )</u><br>

      Nous privilégierons l'efficacité de nos algorithmes. Un point d'honneur sera également mis sur la disponibilité de notre application web et, plus généralement, sur sa simplicité de prise en main. Nous favoriserons au mieux la compréhension et la communication entre les utilisateurs, techniciens et administrateurs.<br>
      <br>
      Enfin, la plateforme se doit être accessible peu importe le handicape. 
      <br>
      La plateforme se doit être simple d'utilisation, disponible à tout moment, accessible et sécurisé.

      <br>
    - <u><a name="p5aiii"></a>iii. Quels retours ou quelle visibilité sur le projet les utilisateurs et commanditaires
      souhaitent-ils ?</u><br>

      Ce projet représentant un travail universitaire évalué, les commanditaires de ce projet sont nos enseignants. Ces derniers ont une grande visibilité sur l'avancée du projet et recevront à certaines dates des documents concernant le projet et son avancée. La communication entre les membres de l'équipe et les enseignants est recommandée afin d'assurer le rendu d'un projet fidèle aux attentes de ces derniers.<br>
      La communication avec nos professeurs (les clients du projet) se fera principalement à l'oral durant les heures d'SAE mais pourra se prolonger par email.<br>
      Nos clients, M. HOGUIN et M. DUFAUD doivent avoir un accès général sur l'avancé du projet notamment par le recours de GitHub.<br>
      <br>
    - <u><a name="p5aiv"></a>iv. Que peut-on acheter ? Que doit-on construire ? Qui sont nos concurrents ?</u><br>

      Le projet consiste à mettre en réseau une architecture. Aucun achat n'est nécessaire puisque l'ensemble du matériel nous a été fourni par M.hoguin.
      <br><br>

    - <u><a name="p5av"></a>v. Quels sont les autres exigences du processus ? (exemple : tests, installation, etc...)</u><br>

      Nous pouvons noter en exigences sur le projet, l'exécution d'une phase de test assurant le bon fonctionnement de l'application et de la communication entre les composants architecturaux. <br>
      Les clients doivent avoir accès au dépôt Git afin de juger de l'évolution du projet et faire des critiques si nécessaire.
      <br>
    - <u><a name="p5avi"></a>vi. À quelle dépendance le projet est-il soumis ?</u><br>
      
<br>

- <b><a name="p5c"></a>c) Performances</b><br>


<br>

- <b><a name="p5d"></a>d) Opérations, sécurité, documentation</b><br>



<br>

- <b><a name="p5e"></a>e) Utilisation et utilisabilité</b><br>

<br>

- <b><a name="p5f"></a>f) Maintenance et portabilité</b><br>

<br>

- <b><a name="p5g"></a>g) Questions non résolues ou reportées à plus tard</b><br>

 
  <br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------

### <a name="p6"></a>VI – Recours humain, questions juridiques, politiques, organisationnelles.
- <b><a name="p6a"></a>a) Quel est le recours humain au fonctionnement du système ?</b><br>
  <br>
- <b><a name="p6b"></a>b) Quelles sont les exigences juridiques et politiques ?</b><br>
  <br>
- <b><a name="p6c"></a>c) Quelles sont les conséquences humaines de la réalisation du système ?</b><br>
  <br>

- <b><a name="p6d"></a>d) Quels sont les besoins en formation ?</b><br>
<br>

- <b><a name="p6e"></a>e) Quelles sont les hypothèses et les dépendances affectant l’environnement humain ?</b><br>
  <br>
### <a name="p7"></a>VII - Gestion et organisation du projet.
- <b><a name="p7a"></a>a) Rôles de chacun</b><br>
  L'équipe est composé de :
    - **Maaz Norat**
      Chef de projet
    - **Assia Gouabi**
    - **Enzo Guignolle**
    - **Pierre Jauffres**
      <br><br>


- <b><a name="p7b"></a>b) Cycles de vie</b><br>
  Dans le cadre du projet, nous suivions un cycle en V itératif.<br>
  Entre autre, nous suivions le schéma : Conception -> Développement -> Tests. Cependant, nous pouvons revenir à des tâches antérieures et elles peuvent être développées et testées à plusieurs reprises.<br>
  <br>
  
  Voici les différents cycles de vie du projet. 
  <br><br><br>
  **Cycle de vie V0.1 : Mise en place du système 24/09/2024 -> **

  | Tâche                    | Temps | Attribution               |
  |--------------------------|-------|---------------------------|
  | Cahier des charges       |       | Maaz                      |
  | Recueil de besoins       |       | Assia, Maaz, Pierre, Enzo |
  | Système                  |       |                           |
  | Dossier conception       |       | Assia                     |
  | Diagramme de déploiement |       | Enzo, Assia, Pierre       |

  <br><br>

### <a name="a1"></a>Annexe 1 – Cas d'utilisation
