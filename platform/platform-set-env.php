<?php

$relationships = getenv("PLATFORM_RELATIONSHIPS");
if (!$relationships) {
    echo 'No Relationships variable set! Database connection won\'t work!!!';
    return;
}

$relationships = json_decode(base64_decode($relationships), true);

$settings = '/app/Configuration/Settings.yaml';
$settingsContent = file_get_contents($settings);

foreach ($relationships['database'] as $endpoint) {
    if (empty($endpoint['query']['is_master'])) {
        continue;
    }
    $settingsContent = str_replace("%env:DATABASE_NAME%", $endpoint['path'], $settingsContent);
    $settingsContent = str_replace("%env:DATABASE_PORT%", $endpoint['port'], $settingsContent);
    $settingsContent = str_replace("%env:DATABASE_USER%", $endpoint['username'], $settingsContent);
    $settingsContent = str_replace("%env:DATABASE_PASSWORD%", $endpoint['password'], $settingsContent);
    $settingsContent = str_replace("%env:DATABASE_HOST%", $endpoint['host'], $settingsContent);

    file_put_contents($settings, $settingsContent);

    echo 'Successfully set environment variables for database connection.\n';
}

?>