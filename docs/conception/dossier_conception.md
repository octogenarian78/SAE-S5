<div align="center">

<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5  Dossier de conception
</div>

<br><br><br><br><br><br><br>

## Plan

### [I – Conception Architecturale](#p1)
- <b>[Figure 1 : Diagramme de déploiement ](#fg1)</b>

### [II – Conception Détaillée](#p2)


<br><br><br><br><br><br><br>


------------------------------------------------------------------------------------------------------------------------
## <a name="p1"></a>I – Conception Architecturale
<br>

### Introduction
Ce document expose en détail la mise en œuvre et la conception du projet.
Il explore les différentes perspectives de la structure du projet et les comportements associés à son utilisation.


### Conception Architecturale

<img height="400" width="700" src="../img/diagramme_deploiement.png" title="Diagramme"/>

<i><a name="fg1"></a>Figure 1 : Diagramme de déploiement.</i>

### Explication :

Nous avons 6 noeuds représentant les 6 composants que l'on possède : Les 4 PI Zero, le cluster et le RPI4. 
<br>
Les Pi zero communiquent entre eux pour échanger des informations ou des données. Cette communication est représenté par le trait continu. Ces PI Zero dépendent du cluster hat car c'est lui qui établit la connexion et fournit l'interface pour communiquer avec le RPI4. Cette dépendance est représentée par une flèche discontinue. <br>
Le cluster hat quant à lui communique directement avec les PI Zero et le RPI4. <br>
Le RPI4 communique avec les PI Zero indirectement par l'intermédiaire du cluster, c'est pour cela que le cluster est caractérisé comme étant la source de communication et que le RPI4 dépend de lui.
------------------------------------------------------------------------------------------------------------------------
### <a name="p2"></a>I – Conception Détaillée


