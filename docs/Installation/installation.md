<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S5 - Rapport d'installation

<br><br>
Ce document décrit en détail les étapes d'installation<br>
<br>
<img height="550" width="500" src="../img/cluster.jpg" title="cluster"/>
</div>

<br><br><br><br><br><br><br>

---

## Plan

- ### [I – Présentation](#p1)
    - [**a) Présentation du Cluster**](#p1a)
    - [**b) Présentation du RaspberryPi 4**](#p1b)
    - [**c) Présentation des RaspberryPi Zero**](#p1b)
    

- ### [II – Préparatif](#p2)
    - [**a) Matériels nécessaires**](#p2a)

- ### [III - Installation ](#p3)
    - [**a) Présentation des différents OS installés**](#p1c)
    - [**a) Mise en place de SSH**](#p1c)
    - [**a) Installation de python et ses modules**](#p1c)

  <br><br><br>

---

## <a name="p1"></a> I - Présentation

- ### <a name="p1b"></a> b) Présentation du RaspberryPi 4
  Le RaspberryPi est un micro-ordinateur monocarte apparu en février 2012. Excepté l'alimentation et un support de stockage,
  nous y retrouvons tout le nécessaire pour le faire fonctionner comme un processeur et de la mémoire vive.<br>
  Comme pour la majorité des ordinateurs, celui-ci propose des ports pour y brancher un écran, des périphériques, une alimentation, une caméra ou encore un câble ethernet.<br>
  <br>
  Cependant, le RPi 4 comporte des différences avec les anciens modèles de RPi.<br>
  En termes de processeur, son CPU possède des cœurs plus récents (les Cortex-A72) et son GPU est 25% plus rapide que les précédents modèles :
  désormais sa résolution d'écran maximal est de la 4K UltraHD. Son port HDMI/Mini-HDMI a laissé place à deux ports micro HDMI.<br>
  Concernant la mémoire vive passant de LPDDR2 à LPDDR4 d'ailleurs, il y a quatre versions du RPi4 : une 1Go, une 2Go, 8Go et une à 4Go, la nôtre.<br>
  Deux de ses ports USB 2 ont laissé place à deux ports USB 3, et en termes de connectique réseau, le RPi4 possède un meilleur port LAN, un meilleur Wi-Fi et un meilleur Bluetooth.<br>
  <br>
  Nous pouvons en apprendre plus sur les caractéristiques de notre Raspberry Pi 4 en exécutant la commande Raspberry OS : `pinout`<br>
  <br>
  <div align="center">
  <img width=350px src="img/I_presentation/pinout.png" title="résultat de la commande pinout avec les différents ports, un dessin de la carte et une descriptions des pins"/><br>
  <i>résultat de la commande pinout</i>
  </div>
  <br>
  <br>
  Comme précédemment dit, Le RPi 4 possède un processeur ARM Cortex-A72. Même si c'est un processeur 64bits, c'est un processeur faisant partie de la famille ARMv8 et non des x86 comme on le retrouve souvent sur nos PC.<br>
  Les processeurs ARM sont principalement utilisé pour "les appareils compacts et tendent à optimiser l'autonomie, la taille, le refroidissement et surtout, les coûts" selon RedHat. Ce qui correspond aux critères du RPi 4 : être un micro-ordinateur abordable<br>
  On remarque cependant que selon RedHat, l'architecture x86 est plutôt utilisé pour les serveurs pour leur vitesse. Ainsi, en dehors du cadre de cette SAÉ, utiliser RaspberryPi comme serveur n'est pas le mieux.<br>
  <br>
  On remarque aussi le préfixe "LP" de "LPDDR4" comme type de mémoire vive du RPi4. "LP" pour "Low Power" est une version plus petite et moins consommatrice en termes de ressources que le simple DDR "Double Data Rate".<br>
  La DDR a remplacé la SDRAM au début des années 2000 par sa rapidité : "La DDR transfère les données au processeur à la fois dans la phase montante et descendante des signaux d’horloge" selon Crucial.<br>
  Encore une fois, c'est un composant adapté pour les appareils compacts comme le RaspberryPi.<br>

  <br><br>
  **Sources :**
    - https://www.jmdoudoux.fr/raspberry/raspberry_pi_4_modele_B.htm
    - https://www.conrad.fr/fr/guides/materiel-educatif-kits-de-developpement/raspberry-pi.html
    - https://fr.wikipedia.org/wiki/Raspberry_Pi
    - https://www.raspberrypi.com/products/raspberry-pi-4-model-b/
    - https://fr.wikipedia.org/wiki/ARM_Cortex-A72
    - https://www.redhat.com/fr/topics/linux/ARM-vs-x86
    - https://www.hardware.fr/news/13047/quelques-details-lpddr4-ddr4-wide-i-o.html
    - https://fr.msi.com/blog/ultra-thin-business-and-productivity-laptop-with-lpddr4x-memory
    - https://www.crucial.fr/articles/about-memory/difference-among-ddr2-ddr3-ddr4-and-ddr5-memory
    - https://fr.wikipedia.org/wiki/LPDDR

---

## <a name="p2"></a> II - Préparatif

- ### <a name="p2a"></a> a) Matériels nécessaires
<img height="600" width="500" src="../img/cluster2.jpg" title="cluster"/>

Le matériel nécessaire nous a été fourni par Monsieur Hoguin et est constitué des éléments suivants : 

  * Câble HDMI &rarr; Fait la connexion entre l'écran et le raspberry Pi 4
  * Adapteur HDMI-VGA &rarr; Fait la connexion entre l'écran et le raspberry Pi 4
  * Adaptateur microHDMI &rarr; Pour permettre la connexion entre l'adaptateur HDMI-VGA et le RPI4
  * Raspberry Pi 4
  * 4x Raspberry Pi Zero
  * ClusterHat &rarr; Permet la liaison entre lui-même et les RPI0
  * 5x Carte SD &rarr; Permet de flasher les images dessus
  * Câble USB-microUSB &rarr; Permet la liaison entre le RPI4 et le clusterHat
  * Alimentation &rarr; Donné du courant au RaspBerry Pi 4

<br>

## <a name="p3"></a> III - Installation 

Pour l'installation, nous nous sommes principalement appuyé sur la documentation que nous avions sur le site web suivant : 

https://xaviergeerinck.com/2021/01/23/creating-a-raspberry-pi-cluster--1-raspberry-pi---4-pi-zeros--with-cluster-hat/

### <a name="p3a"></a> a) Flash des images

Nous avons commencé par télécharger les images nécessaires au déploiement en accédant aux liens fournis sur le site. Chaque lien 
correspond à une image spécifique, associée à un élement de l'architecture du projet (le premier lien fourni l'image pour le RPi4 
et les 4 autres liens sont destinés aux Pi0).
Ces images contiennent les systèmes d'exploitation préconfigurés. 

Pour chaque RaspBerry Pi, il est nécessaire d'avoir une carte DS distincte, car chaque appareil va exécuter un système indépendant.
Nous avons procédé à l'association de chaque carte SD, une carte SD pour le Raspberry Pi 4 et une pour chaque Raspberry Pi Zero. 

Une fois les cartes SD associées à leurs images respectives, en utilisant Pi Imager, nous avons flasher les images. 

<div align="center">
<img height="372" width="500" src="../img/PiImager.png" title="pi imager"/>
</div>

Dans l'icône *Raspberry Pi Device*, nous avons indiqué le type de matériel cible pour lequel on flashe l'image. 
Pour la première image associée à la première carte SD, nous avons sélectionné *Raspberry Pi 4* et pour les autres *Raspberry Pi Zero*. 

Dans l'icône *operating system,* on a sélectionné l'image du système d'exploitation à flasher sur la carte SD que nous avions téléchargé et dans *Storage,* on a choisi la carte SD. 

Une fois cette étape réalisée, les cartes SD ont été inséré dans le Cluster pour poursuivre le déploiement.

### <a name="p3b"></a> a) Activation et Connexion au SSH 




---