<?php
/**
 * Sardanelli Produções - API Backend PHP
 * Leitura pública de conteúdo do site
 */

header('Content-Type: application/json; charset=utf-8');

$DATA_DIR    = __DIR__ . '/data';
$CONTENT_FILE = $DATA_DIR . '/site_content.json';

function respond($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

function readJson($filePath, $default = []) {
    if (!file_exists($filePath)) return $default;
    $content = file_get_contents($filePath);
    $data = json_decode($content, true);
    return is_array($data) ? $data : $default;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'get_content':
        $content = readJson($CONTENT_FILE, []);
        respond(['success' => true, 'content' => $content]);
        break;

    default:
        respond(['success' => false, 'message' => 'Ação não reconhecida.'], 404);
        break;
}
