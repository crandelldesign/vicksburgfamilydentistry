<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    //$this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.php', $args);
});

$app->get('/style-guide', function ($request, $response, $args) {
    // Render Style Guide view
    return $this->renderer->render($response, 'style-guide.php', $args);
});
