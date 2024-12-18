import pandas as pd
import matplotlib.pyplot as plt

def scalabilite_forte(ax, csv_file, group_size=10, title=""):
    df = pd.read_csv(csv_file, sep=",")
    df_duree = df["Duration"].tolist()
    durees = [int(duree) for duree in df_duree]

    # Calculer les durées moyennes
    meanDuration = []
    for i in range(0, len(durees), group_size):
        group = durees[i:i + group_size]
        avg = int(sum(group) / len(group))
        meanDuration.append(avg)

    # Liste des processeurs
    nbProcessor = sorted(list(set(df["NbProcessor"].tolist())))

    print(nbProcessor)

    # Calculer le speedup
    duree_1_processeur = meanDuration[0]  # Temps avec 1 processeur
    speedup = [duree_1_processeur / duree for duree in meanDuration]

    # Tracer le graphique
    ax.plot(nbProcessor, speedup, label="Droite de SpeedUp", color='r', marker='o')
    ax.plot(nbProcessor, nbProcessor, label="SpeedUP idéal", color='b', linestyle='--')

    # Configuration du graphique
    ax.set_title(title, fontsize=14)  # Utilisation du titre personnalisé
    ax.set_xlabel("Nombre de processeurs", fontsize=12)
    ax.set_ylabel("Speedup", fontsize=12)
    ax.legend()
    ax.grid(True)

fig, axes = plt.subplots(3, 2, figsize=(15, 10))

scalabilite_forte(axes[0,0], "test.csv")

plt.show()