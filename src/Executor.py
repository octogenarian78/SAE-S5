import csv
import os
import subprocess
import sys
from typing import List, Optional


def call_python(folder: str, file: str, args: Optional[List[str]] = None) -> Optional[str]:
    """
        Exécute un script Python et capture sa sortie.

        :param folder: Le dossier contenant le script.
        :param file: Le nom du fichier du script Python.
        :param args: Liste optionnelle d'arguments à passer au script.
        :return: La sortie standard capturée sous forme de chaîne de caractères, ou None en cas d'erreur.
    """
    script_path = os.path.join(folder, file)

    if not os.path.exists(script_path):
        print(f"Fichier Python non trouvé : {script_path}")
        return None

    command = ["mpirun", "-np", "4", "python3", script_path]
    if args:
        command.extend(args)

    try:
        print(f"Exécution de : {' '.join(command)}")
        process = subprocess.Popen(command, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
        stdout, stderr = process.communicate()

        if process.returncode != 0:
            print(f"Erreur lors de l'exécution du programme Python : {stderr.decode('utf-8', errors='replace')}")
            return None
        else:
            print("Sortie du programme capturée.")
            return stdout.decode('utf-8', errors='replace')
    except Exception as e:
        print(f"Erreur inattendue : {e}")
        return None


def write_to_file(output_file: str, output_lines: List[str]):
    """
        Écrit les lignes de sortie traitées dans un fichier CSV.

        :param output_file: Le fichier CSV dans lequel écrire.
        :param output_lines: Une liste de lignes à traiter et à écrire.
    """
    file_exists = os.path.exists(output_file)

    data = {}
    for line in output_lines:
        if ":" in line:
            key, value = line.split(":", 1)
            key = key.strip()
            value = value.strip()

            if key in data:
                data[key].append(value)
            else:
                data[key] = [value]

    with open(output_file, "a", newline='') as file:
        writer = csv.DictWriter(file, fieldnames=data.keys())

        if not file_exists:
            writer.writeheader()

        rows = zip(*data.values())
        for row in rows:
            writer.writerow(dict(zip(data.keys(), row)))

        print(f"Résultat écrit dans : {output_file}")


def main():
    if len(sys.argv) != 6:
        print("Usage : script.py <folder> <file> <args> <iterations> <output_file>")
        sys.exit(1)

    folder = sys.argv[1]
    file = sys.argv[2]
    args = sys.argv[3].split(",")
    iterations = int(sys.argv[4])
    output_file = sys.argv[5]

    for i in range(1, iterations + 1):
        print(f"Exécution de l'itération {i}...")
        script_output = call_python(folder, file, args)

        if script_output:
            output_lines = script_output.splitlines()
            output_file = f"{output_file}.csv"
            write_to_file(output_file, output_lines)
        else:
            print("Aucune sortie à écrire.")


if __name__ == "__main__":
    main()