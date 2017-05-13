<?php

$relationships = getenv("PLATFORM_RELATIONSHIPS");
if (!$relationships) {
    echo 'No Relationships variable set! Database connection won\'t work!!!';
    return;
}

$relationships = json_decode(base64_decode($relationships), true);

foreach ($relationships['database'] as $endpoint) {
    if (empty($endpoint['query']['is_master'])) {
        continue;
    }

    putenv('DATABASE_NAME=' . $endpoint['path']);
    putenv('DATABASE_PORT=' . $endpoint['port']);
    putenv('DATABASE_USER=' . $endpoint['username']);
    putenv('DATABASE_PASSWORD=' . $endpoint['password']);
    putenv('DATABASE_HOST=' . $endpoint['host']);

    echo 'Successfully set environment variables for database connection.\n';
}

$output_flush = `php flow flow:cache:flush --force`;
echo $output_flush;
$output_warmup = `php flow flow:cache:warmup`;
echo $output_warmup;

?>