<?php

function lwbio_fa_icon($service) {
    $result = '';

    switch ($service) {
        case 'instagram':
            $result = 'bi bi-instagram';
            break;
        case 'facebook':
            $result = 'bi bi-facebook';
            break;
        case 'youtube':
            $result = 'bi bi-youtube';
            break;
        case 'twitter':
            $result = 'bi bi-twitter';
            break;
        case 'linkedin':
            $result = 'bi bi-linkedin';
            break;
        case 'tiktok':
            $result = 'bi bi-tiktok';
            break;
        case 'github':
            $result = 'bi bi-github';
            break;
        case 'wordpress':
            $result = 'bi bi-wordpress';
            break;
        default:
            $result = 'bi bi-globe2';   
    }

    return $result;
}