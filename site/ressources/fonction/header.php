<?php

function genererHeader($menuButtons, $menuLinks, $loginButtons, $loginLinks) {
    echo "Test1";
    // Vérification que les tableaux ont le même nombre d'éléments
    if (count($menuButtons) !== count($menuLinks) || count($loginButtons) !== count($loginLinks)) {
        return "Erreur : Les titres et les liens doivent avoir le même nombre d'éléments.";
    }

    // Génération du menu
    $menuHtml = '<div name="menu" class="menu">';
    foreach ($menuButtons as $index => $title) {
        $menuHtml .= '<a href="' . htmlspecialchars($menuLinks[$index]) . '">' . htmlspecialchars($title) . '</a>';
    }
    $menuHtml .= '</div>';

    // Génération du login
    $loginHtml = '<div name="login" class="login">';
    foreach ($loginButtons as $index => $title) {
        $loginHtml .= '<a href="' . htmlspecialchars($loginLinks[$index]) . '">' . htmlspecialchars($title) . '</a>';
    }
    $loginHtml .= '</div>';

    // Génération complète du header
    $headerHtml = '
<header>
    <nav class="nav">
        <a href="../index.html">
            <div name="logo" class="logo">
                <img src="../ressources/img/logo.png" alt="logo du site">
            </div>
        </a>
        ' . $menuHtml . '
        ' . $loginHtml . '
    </nav>
</header>';

    echo "Test2";

    return $headerHtml;
}