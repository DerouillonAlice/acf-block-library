<?php

/**
 * Enregistre automatiquement tous les blocs (un sous-dossier = un bloc avec block.json)
 */
add_action('init', function () {
    $base = get_theme_file_path('.');
    if (!is_dir($base)) {
        return;
    }

    foreach (glob($base . '/*/block.json') as $json) {
        register_block_type(dirname($json)); 
    }
}, 5);
