<?php

function lwbio_fa_icon($service) {
    $result = '';

    switch ($service) {
        case 'instagram':
            $result = 'fab fa-instagram';
            break;
        case 'facebook':
            $result = 'fab fa-facebook';
            break;
        case 'youtube':
            $result = 'fab fa-youtube';
            break;
        case 'twitter':
            $result = 'fab fa-twitter';
            break;
        case 'linkedin':
            $result = 'fab fa-linkedin';
            break;
        case 'tiktok':
            $result = 'fab fa-tiktok';
            break;
        case 'github':
            $result = 'fab fa-github';
            break;
        case 'wordpress':
            $result = 'fab fa-wordpress-simple';
            break;
        default:
            $result = 'fas fa-globe';   
    }

    return $result;
}