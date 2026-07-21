<?php
/**
 * Sardanelli Produções - API Backend PHP
 * Gerenciamento de Conteúdo, Uploads e Autenticação Segura
 */

// Configurações de Segurança de Sessão
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

session_start();

header('Content-Type: application/json; charset=utf-8');

$DATA_DIR = __DIR__ . '/data';
$UPLOADS_DIR = __DIR__ . '/uploads';

// Garantir que as pastas existem
if (!is_dir($DATA_DIR)) {
    mkdir($DATA_DIR, 0755, true);
}
if (!is_dir($UPLOADS_DIR)) {
    mkdir($UPLOADS_DIR, 0755, true);
}

// Arquivos JSON
$CONTENT_FILE = $DATA_DIR . '/site_content.json';
$USERS_FILE   = $DATA_DIR . '/users.json';

// Inicializar Usuários Padrão se não existir
if (!file_exists($USERS_FILE)) {
    $defaultUsers = [
        [
            'id' => 1,
            'username' => 'admin',
            'email' => 'sardanelli@adm',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ]
    ];
    file_put_contents($USERS_FILE, json_encode($defaultUsers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Gerar Token CSRF se necessário
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Funções Auxiliares
function respond($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

function verifyCsrfToken() {
    $headers = getallheaders();
    $token = $_POST['csrf_token'] ?? $_GET['csrf_token'] ?? $headers['X-CSRF-Token'] ?? $headers['x-csrf-token'] ?? '';
    if (empty($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
        respond(['success' => false, 'message' => 'Token CSRF inválido ou ausente.'], 403);
    }
}

function checkAuth() {
    if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])) {
        respond(['success' => false, 'message' => 'Não autorizado. Faça login.'], 401);
    }
}

function readJson($filePath, $default = []) {
    if (!file_exists($filePath)) return $default;
    $content = file_get_contents($filePath);
    $data = json_decode($content, true);
    return is_array($data) ? $data : $default;
}

function writeJson($filePath, $data) {
    return file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Rotas da API
$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'get_csrf_token':
        respond(['success' => true, 'csrf_token' => $_SESSION['csrf_token']]);
        break;

    case 'check_session':
        if (!empty($_SESSION['logged_in']) && !empty($_SESSION['user_username'])) {
            respond([
                'success' => true,
                'logged_in' => true,
                'user' => [
                    'username' => $_SESSION['user_username'],
                    'email' => $_SESSION['user_email'] ?? ''
                ],
                'csrf_token' => $_SESSION['csrf_token']
            ]);
        } else {
            respond(['success' => true, 'logged_in' => false]);
        }
        break;

    case 'login':
        $usernameOrEmail = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($usernameOrEmail) || empty($password)) {
            respond(['success' => false, 'message' => 'Preencha todos os campos.'], 400);
        }

        $users = readJson($USERS_FILE, []);
        $foundUser = null;

        foreach ($users as $u) {
            if (strcasecmp($u['username'], $usernameOrEmail) === 0 || strcasecmp($u['email'] ?? '', $usernameOrEmail) === 0) {
                $foundUser = $u;
                break;
            }
        }

        if ($foundUser && password_verify($password, $foundUser['password'])) {
            session_regenerate_id(true);
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $foundUser['id'];
            $_SESSION['user_username'] = $foundUser['username'];
            $_SESSION['user_email'] = $foundUser['email'] ?? '';
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

            respond([
                'success' => true,
                'message' => 'Login realizado com sucesso.',
                'user' => [
                    'username' => $foundUser['username'],
                    'email' => $foundUser['email'] ?? ''
                ],
                'csrf_token' => $_SESSION['csrf_token']
            ]);
        } else {
            respond(['success' => false, 'message' => 'Usuário ou senha incorretos.'], 401);
        }
        break;

    case 'logout':
        session_unset();
        session_destroy();
        respond(['success' => true, 'message' => 'Sessão encerrada.']);
        break;

    case 'get_content':
        $content = readJson($CONTENT_FILE, []);
        respond([
            'success' => true,
            'content' => $content
        ]);
        break;

    case 'save_content':
        checkAuth();
        verifyCsrfToken();

        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (!$inputData || !isset($inputData['content'])) {
            $inputData = ['content' => $_POST['content'] ?? null];
        }

        $newContent = $inputData['content'] ?? null;
        if (!$newContent || !is_array($newContent)) {
            respond(['success' => false, 'message' => 'Dados de conteúdo inválidos.'], 400);
        }

        if (writeJson($CONTENT_FILE, $newContent) !== false) {
            respond(['success' => true, 'message' => 'Conteúdo salvo com sucesso!']);
        } else {
            respond(['success' => false, 'message' => 'Erro ao escrever no arquivo data/site_content.json.'], 500);
        }
        break;

    case 'update_user':
        checkAuth();
        verifyCsrfToken();

        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $currentPass = $_POST['current_password'] ?? '';
        $newPass     = $_POST['new_password'] ?? '';

        if (empty($username)) {
            respond(['success' => false, 'message' => 'O nome de usuário não pode estar em branco.'], 400);
        }

        $users = readJson($USERS_FILE, []);
        $currentUserId = $_SESSION['user_id'];
        $userIndex = -1;

        foreach ($users as $i => $u) {
            if ($u['id'] == $currentUserId) {
                $userIndex = $i;
                break;
            }
        }

        if ($userIndex === -1) {
            respond(['success' => false, 'message' => 'Usuário não encontrado.'], 404);
        }

        // Se informou nova senha, deve validar a senha atual
        if (!empty($newPass)) {
            if (empty($currentPass) || !password_verify($currentPass, $users[$userIndex]['password'])) {
                respond(['success' => false, 'message' => 'Senha atual incorreta.'], 400);
            }
            if (strlen($newPass) < 6) {
                respond(['success' => false, 'message' => 'A nova senha deve ter no mínimo 6 caracteres.'], 400);
            }
            $users[$userIndex]['password'] = password_hash($newPass, PASSWORD_DEFAULT);
        }

        $users[$userIndex]['username'] = $username;
        if (!empty($email)) {
            $users[$userIndex]['email'] = $email;
        }

        if (writeJson($USERS_FILE, $users) !== false) {
            $_SESSION['user_username'] = $username;
            $_SESSION['user_email'] = $email;
            respond(['success' => true, 'message' => 'Dados de acesso atualizados com sucesso!']);
        } else {
            respond(['success' => false, 'message' => 'Erro ao salvar credenciais.'], 500);
        }
        break;

    case 'register_user':
        checkAuth();
        verifyCsrfToken();

        $newUsername = trim($_POST['username'] ?? '');
        $newEmail    = trim($_POST['email'] ?? '');
        $newPassword = $_POST['password'] ?? '';

        if (empty($newUsername) || empty($newPassword)) {
            respond(['success' => false, 'message' => 'Usuário e senha são obrigatórios.'], 400);
        }
        if (strlen($newPassword) < 6) {
            respond(['success' => false, 'message' => 'A senha deve ter no mínimo 6 caracteres.'], 400);
        }

        $users = readJson($USERS_FILE, []);
        foreach ($users as $u) {
            if (strcasecmp($u['username'], $newUsername) === 0) {
                respond(['success' => false, 'message' => 'Já existe um usuário com esse nome.'], 400);
            }
        }

        $newUser = [
            'id' => time(),
            'username' => $newUsername,
            'email' => $newEmail,
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $users[] = $newUser;

        if (writeJson($USERS_FILE, $users) !== false) {
            respond(['success' => true, 'message' => 'Novo administrador cadastrado com sucesso!']);
        } else {
            respond(['success' => false, 'message' => 'Erro ao registrar usuário.'], 500);
        }
        break;

    case 'upload_file':
        checkAuth();
        verifyCsrfToken();

        if (empty($_FILES['file'])) {
            respond(['success' => false, 'message' => 'Nenhum arquivo enviado.'], 400);
        }

        $file = $_FILES['file'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            respond(['success' => false, 'message' => 'Erro no upload do arquivo.'], 400);
        }

        // Validar Extensões permitidas (imagens e vídeos)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'mp4', 'webm', 'mov'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExtensions)) {
            respond(['success' => false, 'message' => 'Extensão não permitida. Envie apenas imagens (JPG, PNG, WEBP) ou vídeos (MP4, WEBM).'], 400);
        }

        // Sanitizar Nome do Arquivo
        $cleanName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME));
        $finalFilename = date('Ymd_His') . '_' . $cleanName . '.' . $ext;
        $targetPath = $UPLOADS_DIR . '/' . $finalFilename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $webPath = 'uploads/' . $finalFilename;
            respond([
                'success' => true,
                'message' => 'Upload realizado com sucesso!',
                'file' => [
                    'name' => $finalFilename,
                    'path' => $webPath,
                    'type' => in_array($ext, ['mp4', 'webm', 'mov']) ? 'video' : 'image'
                ]
            ]);
        } else {
            respond(['success' => false, 'message' => 'Falha ao salvar arquivo no servidor.'], 500);
        }
        break;

    case 'delete_file':
        checkAuth();
        verifyCsrfToken();

        $filename = basename($_POST['filename'] ?? '');
        if (empty($filename)) {
            respond(['success' => false, 'message' => 'Nome do arquivo não informado.'], 400);
        }

        $filePath = $UPLOADS_DIR . '/' . $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
            respond(['success' => true, 'message' => 'Arquivo removido com sucesso.']);
        } else {
            respond(['success' => false, 'message' => 'Arquivo não encontrado.'], 444);
        }
        break;

    default:
        respond(['success' => false, 'message' => 'Ação não reconhecida.'], 404);
        break;
}
