<?php

namespace ProcessWire;

/**
 * Project-specific configuration
 * This file contains project-specific settings and should not be synced between projects
 * Copy this file to your project and customize as needed
 */

// Project-specific CSS classes and styles
$projectConfig = [
    
    // Home page configuration
    'home' => [
        'default_class' => 'py-5 mb-5 mb-xl-6 min-vh-25',
        'custom_hosts' => [
            'filipok.koriphey.ru' => 'py-5 min-vh-20',
            // Add more host-specific classes here
            // 'another-domain.com' => 'custom-class-here',
        ]
    ],
    
    // Add other page-specific configurations here
    'page-default' => [
        // Page-specific settings
    ],
    
    // Cover section configuration
    'cover' => [
        'default_params' => [
            'class' => 'sectionCover-image min-vh-60 min-vh-sm-80 overflow-hidden rounded-4',
            'image_params' => []
        ],
        'custom_hosts' => [
            'filipok.koriphey.ru' => [
                'class' => 'sectionCover-image min-vh-40 min-vh-sm-60 rounded-4',
                'image_params' => [
                    'width' => null,
                    'height' => 900,
                    'css_class' => 'position-absolute w-100 h-100 top-0 left-0 object-fit-scale'
                ]
            ]
        ]
    ],
    
    // Site-specific features
    'features' => [
        'enable_special_header' => false,
        'custom_footer' => false,
        // Add feature flags here
    ]
];

// Helper function to get home class based on current host
function getHomeClass() {
    global $config, $projectConfig;
    
    $currentHost = $config->httpHost;
    
    // Check if current host has custom class
    if (isset($projectConfig['home']['custom_hosts'][$currentHost])) {
        return $projectConfig['home']['custom_hosts'][$currentHost];
    }
    
    // Return default class
    return $projectConfig['home']['default_class'];
}

// Helper function to get cover config based on current host
function getCoverConfig() {
    global $config, $projectConfig;
    
    $currentHost = $config->httpHost;
    
    // Check if current host has custom config
    if (isset($projectConfig['cover']['custom_hosts'][$currentHost])) {
        return $projectConfig['cover']['custom_hosts'][$currentHost];
    }
    
    // Return default config
    return $projectConfig['cover']['default_params'];
}

// Helper function to check if feature is enabled
function isFeatureEnabled($feature) {
    global $projectConfig;
    return isset($projectConfig['features'][$feature]) && $projectConfig['features'][$feature];
}

// Helper function to get project config value
function getProjectConfig($key, $default = null) {
    global $projectConfig;
    
    $keys = explode('.', $key);
    $value = $projectConfig;
    
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $default;
        }
    }
    
    return $value;
} 