<?php
function popupNombresPremiers() {
    return '
        <div class="popup" id="popup-NombresPremiers">
            <form method="post" action="">
                <div class="popup-title">Entrée(s) du programme</div>
                <p>Entrez un nombre sous lequel calculer tous les nombres premiers :</p>
                <input type="number" id="number" placeholder="Exemple : 42069">
                <input type="number" id="nbRPI" placeholder="Entre 1 et 4" max="4" min="1">
                <div class="popup-buttons">
                    <a href="#" class="btn-ok">OK</a>
                    <a href="#" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    ';
}

function popupMonteCarlo() {
    return '
        <div class="popup" id="popup-MonteCarlo">
            <form method="post" action="">
                <div class="popup-title">Entrée(s) du programme</div>
                <p>Entrez un texte :</p>
                <input type="number" id="number" placeholder="Exemple : 1000000">
                <input type="number" id="nbRPI" placeholder="Entre 1 et 4" max="4" min="1">
                <div class="popup-buttons">
                    <a href="#" class="btn-ok">OK</a>
                    <a href="#" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    ';
}
