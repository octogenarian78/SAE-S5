Assia GOUABI, Enzo Guignolle, Maaz NORAT, Loan QUILLET, Pierre JAUFFRES, Teddy DEGAT<br>
INF3

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5 - Dossier de test
## Site statique

<br><br>
Ce document permet de s'assurer que les pages web statiques soient conformes à ce qui est attendu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Pages HTML](#IV)
- ### [V - Fichier CSS](#V)


## <a name="IV"></a>Pages HTML
- ### [index.html](#a)
- ### [login/index.html](#b)
- ### [signup/index.html](#c)
- ### [profil/index.html](#d)
- ### [modules/index.html](#e)
- ### [administration/index.html](#f)

## <a name="V"></a>Fichier CSS
- ### [style.css](#1)

<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester les différentes pages du site HTML statique réalisé. Les pages seront chacune testées les unes après les autres afin de visualiser si elles respectent les contraintes dimensionnelles de l’écran, si elles correspondent bien aux pages de la maquette choisie au niveau conceptuel ou graphique. De plus, les pages HTML doivent respectées et vérifiées l’accessibilité avec l’outil Wave ainsi que le validateur HTML W3C installé sur les machines.  
<br>

## <a name="II"></a>II - Description de la procédure de test

L’application qui sera conçue nécessite de réaliser dans un premier temps des maquettes afin de visualiser et décrire ce que doit contenir et à quoi doit ressembler le site web final. Par la suite, nous nous appuierons sur les maquettes proposées pour la réalisation du site web final mais pour cela il faut que les pages HTML soient opérationnelles et ne contiennent pas d’erreurs pour éviter de les décupler. 
Nous allons pour chaque page HTML construite, les comparer avec la maquette choisie. Il s’agit d’indiquer si les éléments de l’application sont placés au même endroit que ceux de la maquette, si elles peuvent être affichées sur n’importe quel écran d’ordinateurs et qu'elles sont validées et vérifiées par les outils HTML W3C et Wave. 
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site statique (HTML et CSS)                                      |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 15/01/2025                                                       |
| Date de finalisation               | 15/01/2025                                                       |
| Test à appliquer                   | Vérification de la validité du site                              |
| Responsable de la campagne de test |Gouabi Assia                                     |

<br><br><br>

----------

<br><br><br>

## IV - Pages HTML

### <a name="a"></a>index.html

| Cas n° | Critère                                   | Résultat attendu                                                                                                        | Résultat obtenu                            |
|:-------|-------------------------------------------|-------------------------------------------------------------------------------------------------------------------------|--------------------------------------------|
| 1      | Comparaison Maquette - Résultat           | Les éléments sont placés au même endroit                                                                                | OK (maquette V2) |
| 2      | Adaptation à la dimension de l'écran (PC) | La page s'affiche correctement aux formats :<br/> - 1360\*768 (16/9)<br/> - 1920\*1080 (16/9)<br/> - Ecrans plus larges | OK                                         |
| 3      | Validateur HTML W3C                       | Aucune erreur                                                                                                           | OK                                    |
| 4      | Vérification de l'accessibilité (Wave)    | Aucune erreur ou alerte                                                                                                 | 2 alertes                                        |

### <a name="b"></a>login/index.html

| Cas n° | Critère                                   | Résultat attendu                                                                                                        | Résultat obtenu                            |
|:-------|-------------------------------------------|-------------------------------------------------------------------------------------------------------------------------|--------------------------------------------|
| 1      | Comparaison Maquette - Résultat           | Les éléments sont placés au même endroit                                                                                | OK (maquette V2) |
| 2      | Adaptation à la dimension de l'écran (PC) | La page s'affiche correctement aux formats :<br/> - 1360\*768 (16/9)<br/> - 1920\*1080 (16/9)<br/> - Ecrans plus larges | OK                                         |
| 3      | Validateur HTML W3C                       | Aucune erreur                                                                                                           | OK                                         |
| 4      | Vérification de l'accessibilité (Wave)    | Aucune erreur ou alerte                                                                                                 | 2 alertes                                         |

### <a name="c"></a>signup/index.html

| Cas n° | Critère                                   | Résultat attendu                                                                                                        | Résultat obtenu                            |
|:-------|-------------------------------------------|-------------------------------------------------------------------------------------------------------------------------|--------------------------------------------|
| 1      | Comparaison Maquette - Résultat           | Les éléments sont placés au même endroit                                                                                | OK (maquette V2) |
| 2      | Adaptation à la dimension de l'écran (PC) | La page s'affiche correctement aux formats :<br/> - 1360\*768 (16/9)<br/> - 1920\*1080 (16/9)<br/> - Ecrans plus larges | OK                                         |
| 3      | Validateur HTML W3C                       | Aucune erreur                                                                                                           | OK                                         |
| 4      | Vérification de l'accessibilité (Wave)    | Aucune erreur ou alerte                                                                                                 | 2 alertes                                         |

### <a name="d"></a>profil/index.html

| Cas n° | Critère                                   | Résultat attendu                                                                                                        | Résultat obtenu                            |
|:-------|-------------------------------------------|-------------------------------------------------------------------------------------------------------------------------|--------------------------------------------|
| 1      | Comparaison Maquette - Résultat           | Les éléments sont placés au même endroit                                                                                | OK (maquette V2) |
| 2      | Adaptation à la dimension de l'écran (PC) | La page s'affiche correctement aux formats :<br/> - 1360\*768 (16/9)<br/> - 1920\*1080 (16/9)<br/> - Ecrans plus larges | OK                                         |
| 3      | Validateur HTML W3C                       | Aucune erreur                                                                                                           | OK                                          |
| 4      | Vérification de l'accessibilité (Wave)    | Aucune erreur ou alerte                                                                                                 | 1 alerte                                         |

### <a name="e"></a>modules/index.html

| Cas n° | Critère                                   | Résultat attendu                                                                                                        | Résultat obtenu                            |
|:-------|-------------------------------------------|-------------------------------------------------------------------------------------------------------------------------|--------------------------------------------|
| 1      | Comparaison Maquette - Résultat           | Les éléments sont placés au même endroit                                                                                | OK (maquette V2) |
| 2      | Adaptation à la dimension de l'écran (PC) | La page s'affiche correctement aux formats :<br/> - 1360\*768 (16/9)<br/> - 1920\*1080 (16/9)<br/> - Ecrans plus larges | OK                                         |
| 3      | Validateur HTML W3C                       | Aucune erreur                                                                                                           | OK                                        |
| 4      | Vérification de l'accessibilité (Wave)    | Aucune erreur ou alerte                                                                                                 | 2 alertes                                         |

### <a name="f"></a>administration/index.html

| Cas n° | Critère                                   | Résultat attendu                                                                                                        | Résultat obtenu                            |
|:-------|-------------------------------------------|-------------------------------------------------------------------------------------------------------------------------|--------------------------------------------|
| 1      | Comparaison Maquette - Résultat           | Les éléments sont placés au même endroit                                                                                | OK (maquette V2) |
| 2      | Adaptation à la dimension de l'écran (PC) | La page s'affiche correctement aux formats :<br/> - 1360\*768 (16/9)<br/> - 1920\*1080 (16/9)<br/> - Ecrans plus larges | OK                                         |
| 3      | Validateur HTML W3C                       | Aucune erreur                                                                                                           | OK                                         |
| 4      | Vérification de l'accessibilité (Wave)    | Aucune erreur ou alerte                                                                                                 | 2 alertes                                         |

<br><br><br>

-------

<br><br><br>

## V - Fichier CSS

### <a name="1"></a>style.css

<a href="https://jigsaw.w3.org/css-validator/validator">Validateur CSS</a>
<br/>
<br/>
Le validateur du CSS a trouvé aucune erreur
