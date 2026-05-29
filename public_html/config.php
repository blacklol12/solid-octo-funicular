<?php
// config.php
header('Content-Type: application/json');

// Solo responder a peticiones AJAX/Fetch legítimas
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !isset($_SERVER['HTTP_REFERER'])) {
    http_response_code(403);
    exit;
}

$ruta_privada = dirname(__DIR__) . '/claves.json';

if (file_exists($ruta_privada)) {
    $data = json_decode(file_get_contents($ruta_privada), true);
    // Añadimos una capa de codificación simple
    echo json_encode([
        "t" => base64_encode($data['token']),
        "c" => base64_encode($data['chat_id'])
    ]);
}
?>


