<?php
function popupNombresPremiers() {
    return '
        <div class="popup" id="popup-NombresPremiers">
            <form method="post" action="">
                <div class="popup-title">Entrée(s) du programme</div>
                <p>Entrez un nombre sous lequel calculer tous les nombres premiers :</p>
                <input type="number" placeholder="Exemple : 42069">
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
                <input type="text" placeholder="Exemple : Hello">
                <div class="popup-buttons">
                    <a href="#" class="btn-ok">OK</a>
                    <a href="#" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    ';
}
