<?php

function genererHeader($img, $menuButtons, $menuLinks, $loginButtons, $loginLinks, $logoLink) {

    // Vérification que les tableaux ont le même nombre d'éléments
    if (count($menuButtons) !== count($menuLinks) || count($loginButtons) !== count($loginLinks)) {
        return "Erreur : Les titres et les liens doivent avoir le même nombre d'éléments.";
    }

    // Génération du menu
    if (count($menuButtons) == 0){
        $menuHtml = '';
    } else {
        $menuHtml = '<div class="menu">';
        foreach ($menuButtons as $index => $title) {
            $menuHtml .= '<a href="' . htmlspecialchars($menuLinks[$index]) . '">' . htmlspecialchars($title) . '</a>';
        }
        $menuHtml .= '</div>';
    }

    // Génération du login
    $loginHtml = '<div class="login">';
    foreach ($loginButtons as $index => $title) {
        $loginHtml .= '<a href="' . htmlspecialchars($loginLinks[$index]) . '">' . htmlspecialchars($title) . '</a>';
    }
    $loginHtml .= '</div>';

    // Génération complète du header
    $headerHtml = '
<header>
    <nav class="nav">
        <a href="'.$logoLink.'">
            <div class="logo">
                <img src="'. $img .'" alt="logo du site">
            </div>
        </a>
        ' . $menuHtml . '
        ' . $loginHtml . '
    </nav>
</header>';

    return $headerHtml;
}