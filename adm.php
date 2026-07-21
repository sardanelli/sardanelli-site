<?php
session_start();

$dataDir = __DIR__ . '/data';
$uploadsDir = __DIR__ . '/uploads';

if (!is_dir($dataDir)) {
    mkdir($dataDir, 0777, true);
}
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0777, true);
}

$usersFile = $dataDir . '/users.json';
if (!file_exists($usersFile)) {
    $initialUsers = [
        'murilo' => password_hash('2580', PASSWORD_DEFAULT)
    ];
    file_put_contents($usersFile, json_encode($initialUsers, JSON_PRETTY_PRINT));
}

$contentFile = $dataDir . '/content.json';
if (!file_exists($contentFile)) {
    $defaults = [
        'hero' => [
            'tag' => 'Desde 2016 transformando momentos em',
            't1' => 'Experiências', 't2' => 'Inesquecíveis',
            'sub' => 'Casamentos, Chás Revelação, Formaturas e Eventos Corporativos com efeitos especiais que encantam e emocionam.',
            'btn' => 'Assista nossos Vídeos'
        ],
        'sobre' => [
            'tag' => 'Quem Somos', 't1' => 'Uma história escrita ', 't2' => 'com emoção',
            'p1' => 'A Sardanelli Produções nasceu em <strong>2016</strong> com um propósito claro: transformar eventos em memórias que ficam para sempre gravadas na lembrança de cada convidado.',
            'p2' => 'Fundada por <strong>Murilo Sardanelli</strong>, a empresa cresceu a partir de uma paixão genuína por criar momentos de impacto. Hoje, somos referência em efeitos especiais para eventos na região, reconhecidos pela qualidade técnica, pela organização impecável e pelo cuidado em cada detalhe.',
            'p3' => 'Do chá revelação ao casamento dos sonhos, da formatura emocionante ao evento corporativo marcante, criamos o cenário perfeito para o seu momento especial.'
        ],
        'stats' => [ 'eventos' => '+500', 'anos' => '8+', 'satisf' => '100%' ],
        'efeitos' => [
            ['nome' => 'Rastro de Céu Noturno', 'desc' => 'Uso recomendado: Noturno, local aberto.', 'tag' => 'Noturno'],
            ['nome' => 'Rastro de Céu Diurno', 'desc' => 'Uso recomendado: Diurno, local aberto.', 'tag' => 'Diurno'],
            ['nome' => 'Disparador de Serpentina', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', 'tag' => 'Versátil'],
            ['nome' => 'Disparador de Papel Colorido', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', 'tag' => 'Versátil'],
            ['nome' => 'Fumaça Colorida', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto.', 'tag' => 'Impacto visual'],
            ['nome' => 'Disparador de Pó Colorido', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto.', 'tag' => 'Colorido'],
            ['nome' => 'Simulador de Faíscas', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', 'tag' => 'Premium'],
            ['nome' => 'Disparos de Comemoração', 'desc' => 'Efeito sonoro e visual para comemoração. Diurno ou noturno, aberto ou fechado.', 'tag' => 'Explosivo']
        ],
        'pacotes' => [
            [
                'badge' => 'Essencial', 'best' => false, 'nome' => 'Pacote Essencial', 'sub' => 'O essencial que já transforma o momento em espetáculo.',
                'itens' => ['02 Disparadores profissionais de Papel','02 Disparadores profissionais de Serpentina','01 Fumaça Grande'],
                'btnTxt' => 'Quero o Essencial', 'waMsg' => 'Olá! Quero o *Pacote Essencial* (Papel x2, Serpentina x2, Fumaça x1). Pode me enviar o orçamento?'
            ],
            [
                'badge' => 'Mais Escolhido', 'best' => true, 'nome' => 'Pacote Médio', 'sub' => 'Mais volume, mais efeito, mais emoção.',
                'itens' => ['04 Disparadores profissionais de Papel','04 Disparadores profissionais de Serpentina','02 Fumaças Grandes','02 Simuladores de Faíscas'],
                'btnTxt' => 'Quero o Médio', 'waMsg' => 'Olá! Quero o *Pacote Médio* (Papel x4, Serpentina x4, Fumaça x2, Faíscas x2). Pode me enviar o orçamento?'
            ],
            [
                'badge' => 'Completo', 'best' => false, 'nome' => 'Pacote Completo', 'sub' => 'O show completo para um momento inesquecível.',
                'itens' => ['06 Disparadores profissionais de Papel','06 Disparadores profissionais de Serpentina','04 Fumaças Grandes','01 Rastro de Céu Colorido','04 Simuladores de Faíscas','01 Tiro de Céu de Comemoração — 24 Disparos'],
                'btnTxt' => 'Quero o Completo', 'waMsg' => 'Olá! Quero o *Pacote Completo* (Papel x6, Serpentina x6, Fumaça x4, Rastro de Céu, Faíscas x4, Tiro de Céu). Pode me enviar o orçamento?'
            ]
        ],
        'videos' => ['nYcqAYoVNEg','WySiyUZ_TZ0','SrEQbd28EPo','1izdP3T-qGs','TWwZjAx42Uk','v2cInNWsd5A','KwutXIYu1fI','HUveuBzkBZw'],
        'contato' => [ 'wa' => '5516993950765', 'insta' => 'https://www.instagram.com/sardanelliproducoes/' ],
        'footer' => [ 'logo' => 'intro-logo.png', 'copyright' => '© 2026 Sardanelli Produções. Todos os direitos reservados.' ],
        'seo' => [
            'title' => 'Sardanelli Produções | Efeitos Especiais para Eventos',
            'desc' => 'Sardanelli Produções — Efeitos especiais para casamentos, chás revelação, formaturas e eventos corporativos. Transformamos momentos em experiências inesquecíveis desde 2016.',
            'kw' => 'efeitos especiais casamento, chá revelação, fumaça colorida, faíscas frias, serpentina, papel picado, eventos, Sardanelli Produções',
            'ogTitle' => 'Sardanelli Produções',
            'ogDesc' => 'Transformamos eventos em experiências inesquecíveis desde 2016. Efeitos especiais para casamentos, chás revelação, formaturas e mais.'
        ]
    ];
    file_put_contents($contentFile, json_encode($defaults, JSON_PRETTY_PRINT));
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function isLoggedIn() {
    return !empty($_SESSION['logged_in']);
}

if (isset($_GET['api']) || isset($_POST['api'])) {
    header('Content-Type: application/json');
    $action = $_REQUEST['action'] ?? '';
    
    if ($action === 'login') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        $users = json_decode(file_exists($usersFile) ? file_get_contents($usersFile) : '{}', true);
        if (isset($users[$username]) && password_verify($password, $users[$username])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            echo json_encode(['success' => true, 'csrf_token' => $_SESSION['csrf_token']]);
            exit;
        } else {
            echo json_encode(['success' => false, 'error' => 'Usuário ou senha incorretos']);
            exit;
        }
    }
    
    if (!isLoggedIn()) {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Não autorizado']);
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (!$token || $token !== $_SESSION['csrf_token']) {
            http_response_code(403);
            echo json_encode(['success' => false, 'error' => 'Erro CSRF de validação']);
            exit;
        }
    }
    
    if ($action === 'logout') {
        session_destroy();
        echo json_encode(['success' => true]);
        exit;
    }
    
    if ($action === 'list_users') {
        $users = json_decode(file_exists($usersFile) ? file_get_contents($usersFile) : '{}', true);
        echo json_encode(['success' => true, 'users' => array_keys($users)]);
        exit;
    }
    
    if ($action === 'register_user') {
        $newUsername = trim($_POST['new_username'] ?? '');
        $newPassword = $_POST['new_password'] ?? '';
        if (strlen($newUsername) < 3 || strlen($newPassword) < 4) {
            echo json_encode(['success' => false, 'error' => 'Usuário (mín. 3) ou senha (mín. 4) inválidos']);
            exit;
        }
        $users = json_decode(file_exists($usersFile) ? file_get_contents($usersFile) : '{}', true);
        $users[$newUsername] = password_hash($newPassword, PASSWORD_DEFAULT);
        file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true]);
        exit;
    }
    
    if ($action === 'delete_user') {
        $delUsername = trim($_POST['username'] ?? '');
        if ($delUsername === $_SESSION['username']) {
            echo json_encode(['success' => false, 'error' => 'Você não pode excluir a si mesmo']);
            exit;
        }
        $users = json_decode(file_exists($usersFile) ? file_get_contents($usersFile) : '{}', true);
        if (isset($users[$delUsername])) {
            unset($users[$delUsername]);
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
            echo json_encode(['success' => true]);
            exit;
        }
        echo json_encode(['success' => false, 'error' => 'Usuário não encontrado']);
        exit;
    }
    
    if ($action === 'save_content') {
        $page = trim($_POST['page'] ?? 'content');
        if (!preg_match('/^[a-zA-Z0-9_\-]+$/', $page)) {
            echo json_encode(['success' => false, 'error' => 'Nome de página inválido']);
            exit;
        }
        $payload = $_POST['content'] ?? '';
        $decoded = json_decode($payload, true);
        if ($decoded === null) {
            echo json_encode(['success' => false, 'error' => 'Payload JSON inválido']);
            exit;
        }
        $targetFile = $dataDir . '/' . $page . '.json';
        file_put_contents($targetFile, json_encode($decoded, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true]);
        exit;
    }
    
    if ($action === 'load_content') {
        $page = trim($_GET['page'] ?? 'content');
        if (!preg_match('/^[a-zA-Z0-9_\-]+$/', $page)) {
            echo json_encode(['success' => false, 'error' => 'Nome de página inválido']);
            exit;
        }
        $targetFile = $dataDir . '/' . $page . '.json';
        if (file_exists($targetFile)) {
            echo file_get_contents($targetFile);
        } else {
            if ($page === 'content') {
                echo json_encode($defaults);
            } else {
                echo json_encode(['error' => 'Página não encontrada']);
            }
        }
        exit;
    }
    
    if ($action === 'list_pages') {
        $files = glob($dataDir . '/*.json');
        $pages = [];
        foreach ($files as $file) {
            $name = basename($file, '.json');
            if ($name !== 'users') {
                $pages[] = $name;
            }
        }
        echo json_encode(['success' => true, 'pages' => $pages]);
        exit;
    }
    
    if ($action === 'delete_page') {
        $page = trim($_POST['page'] ?? '');
        if (!preg_match('/^[a-zA-Z0-9_\-]+$/', $page) || $page === 'content') {
            echo json_encode(['success' => false, 'error' => 'Nome de página inválido ou protegido']);
            exit;
        }
        $targetFile = $dataDir . '/' . $page . '.json';
        $phpFile = __DIR__ . '/' . $page . '.php';
        if (file_exists($targetFile)) {
            unlink($targetFile);
        }
        if (file_exists($phpFile)) {
            unlink($phpFile);
        }
        echo json_encode(['success' => true]);
        exit;
    }
    
    if ($action === 'create_page' || $action === 'duplicate_page') {
        $newPageName = trim($_POST['page'] ?? '');
        $newPageName = preg_replace('/[^a-zA-Z0-9_\-]/', '', $newPageName);
        if (strlen($newPageName) < 2 || $newPageName === 'users' || $newPageName === 'content') {
            echo json_encode(['success' => false, 'error' => 'Nome de página inválido ou reservado']);
            exit;
        }
        
        $sourcePage = trim($_POST['source_page'] ?? 'content');
        $sourceFile = $dataDir . '/' . $sourcePage . '.json';
        if (!file_exists($sourceFile)) {
            $sourceFile = $dataDir . '/content.json';
        }
        
        $destFile = $dataDir . '/' . $newPageName . '.json';
        copy($sourceFile, $destFile);
        
        $destPhpFile = __DIR__ . '/' . $newPageName . '.php';
        copy(__DIR__ . '/index.php', $destPhpFile);
        
        echo json_encode(['success' => true, 'page' => $newPageName]);
        exit;
    }
    
    if ($action === 'upload_file') {
        if (!isset($_FILES['file'])) {
            echo json_encode(['success' => false, 'error' => 'Nenhum arquivo enviado']);
            exit;
        }
        $file = $_FILES['file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'mp4', 'webm'];
        if (!in_array($ext, $allowed)) {
            echo json_encode(['success' => false, 'error' => 'Extensão não permitida']);
            exit;
        }
        if ($file['size'] > 25 * 1024 * 1024) {
            echo json_encode(['success' => false, 'error' => 'Arquivo muito grande (máx 25MB)']);
            exit;
        }
        $sanitize = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME));
        $newName = $sanitize . '_' . time() . '.' . $ext;
        $dest = $uploadsDir . '/' . $newName;
        
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            $url = 'uploads/' . $newName;
            echo json_encode(['success' => true, 'url' => $url, 'name' => $newName]);
            exit;
        } else {
            echo json_encode(['success' => false, 'error' => 'Falha ao mover arquivo']);
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>" />
  <title>Sardanelli · Painel ADM</title>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <style>
    :root {
      --bg:       #0d0b12;
      --bg2:      #130e1f;
      --bg3:      #1a1228;
      --bg4:      #211830;
      --gold:     #ffba00;
      --gold-l:   #ffd140;
      --gold-d:   #cc9500;
      --purple:   #4f1656;
      --purple-l: #7b2a87;
      --text:     #f0eaf8;
      --muted:    #a899c2;
      --glass:    rgba(255,255,255,0.04);
      --border:   rgba(255,255,255,0.08);
      --red:      #e05555;
      --green:    #4caf85;
      --font-d:   'Outfit', sans-serif;
      --font-b:   'Inter', sans-serif;
      --r:        12px;
      --r2:       18px;
      --tr:       all 0.3s cubic-bezier(0.4,0,0.2,1);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { font-size: 16px; }
    body {
      background: var(--bg);
      color: var(--text);
      font-family: var(--font-b);
      min-height: 100vh;
      overflow-x: hidden;
    }
    a { text-decoration: none; color: inherit; }
    ul { list-style: none; }
    input, textarea, select {
      font-family: var(--font-b);
      font-size: 0.9rem;
      color: var(--text);
      background: var(--bg3);
      border: 1px solid var(--border);
      border-radius: var(--r);
      padding: 10px 14px;
      width: 100%;
      transition: var(--tr);
      outline: none;
      resize: vertical;
    }
    input:focus, textarea:focus, select:focus {
      border-color: rgba(255,186,0,0.5);
      box-shadow: 0 0 0 3px rgba(255,186,0,0.1);
      background: var(--bg4);
    }
    button { cursor: pointer; font-family: var(--font-b); border: none; outline: none; }

    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg2); }
    ::-webkit-scrollbar-thumb { background: rgba(255,186,0,0.3); border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(255,186,0,0.5); }

    #login-wrap {
      position: fixed; inset: 0; z-index: 9999;
      display: flex; align-items: center; justify-content: center;
      background:
        radial-gradient(ellipse at 30% 50%, rgba(79,22,86,0.5) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(255,186,0,0.08) 0%, transparent 50%),
        var(--bg);
      overflow: hidden;
    }
    .login-grid {
      position: absolute; inset: -10%;
      background-image:
        linear-gradient(rgba(255,186,0,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(123,42,135,0.1) 1px, transparent 1px);
      background-size: 40px 40px;
      transform: perspective(600px) rotateX(55deg) scale(1.6);
      transform-origin: center 30%;
      animation: gridMove 8s linear infinite;
      opacity: 0.4;
    }
    @keyframes gridMove {
      0% { background-position: 0 0, 0 0; }
      100% { background-position: 0 80px, 80px 0; }
    }
    .login-box {
      position: relative; z-index: 2;
      width: 100%; max-width: 420px;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 48px 40px;
      box-shadow: 0 32px 80px rgba(0,0,0,0.6);
      animation: loginIn 0.6s cubic-bezier(0.16,1,0.3,1) both;
    }
    @keyframes loginIn {
      from { opacity: 0; transform: translateY(24px) scale(0.96); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .login-brand {
      text-align: center; margin-bottom: 36px;
    }
    .login-logo-wrap {
      position: relative; width: 88px; height: 88px; margin: 0 auto 18px;
      display: flex; align-items: center; justify-content: center;
    }
    .login-logo-glow {
      position: absolute; inset: -14px; border-radius: 50%;
      background: radial-gradient(circle, rgba(255,186,0,0.45) 0%, rgba(160,90,255,0.25) 45%, transparent 72%);
      filter: blur(10px);
      animation: logoPulse 2.6s ease-in-out infinite;
    }
    @keyframes logoPulse {
      0%, 100% { opacity: 0.55; transform: scale(0.94); }
      50%      { opacity: 1; transform: scale(1.08); }
    }
    @keyframes logoFloat {
      0%, 100% { transform: translateY(0px) rotate(0deg); filter: drop-shadow(0 8px 24px rgba(255,186,0,0.35)); }
      33%      { transform: translateY(-6px) rotate(-1.5deg); filter: drop-shadow(0 16px 32px rgba(255,186,0,0.55)); }
      66%      { transform: translateY(-3px) rotate(1deg); filter: drop-shadow(0 12px 28px rgba(79,22,86,0.4)); }
    }
    @keyframes logoReveal {
      from { opacity: 0; transform: translateY(10px) scale(0.88); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .login-logo-img {
      position: relative; width: 88px; height: 88px; object-fit: contain;
      border-radius: 20px;
      filter: drop-shadow(0 8px 24px rgba(255,186,0,0.35));
    }
    .login-brand-icon {
      width: 56px; height: 56px;
      background: linear-gradient(135deg, var(--gold), var(--purple-l));
      border-radius: 16px;
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 1.6rem; margin-bottom: 16px;
      box-shadow: 0 8px 24px rgba(255,186,0,0.3);
    }
    .login-brand h1 {
      font-family: var(--font-d); font-size: 1.5rem; font-weight: 800;
      color: #fff; letter-spacing: -0.02em;
    }
    .login-brand p {
      font-size: 0.82rem; color: var(--muted); margin-top: 4px;
    }
    .login-badge {
      display: inline-block; font-size: 0.7rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.12em;
      background: rgba(255,186,0,0.12); color: var(--gold);
      border: 1px solid rgba(255,186,0,0.3);
      padding: 3px 12px; border-radius: 100px; margin-bottom: 32px;
    }
    .login-field { margin-bottom: 18px; }
    .login-label {
      display: block; font-size: 0.78rem; font-weight: 600;
      color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em;
      margin-bottom: 8px;
    }
    .login-input-wrap { position: relative; }
    .login-input-wrap svg {
      position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
      width: 18px; height: 18px; color: var(--muted); pointer-events: none;
    }
    .login-input-wrap input {
      padding-left: 42px;
    }
    #login-error {
      display: none; background: rgba(224,85,85,0.1);
      border: 1px solid rgba(224,85,85,0.3); border-radius: var(--r);
      color: #ff8888; font-size: 0.83rem; padding: 10px 14px;
      margin-bottom: 16px; text-align: center;
    }
    .btn-login {
      width: 100%; padding: 14px;
      background: linear-gradient(135deg, var(--gold), var(--gold-d));
      color: #1a1228; font-weight: 700; font-size: 1rem;
      border-radius: var(--r); transition: var(--tr);
      box-shadow: 0 4px 16px rgba(255,186,0,0.3);
      display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-login:hover {
      background: linear-gradient(135deg, var(--gold-l), var(--gold));
      transform: translateY(-2px); box-shadow: 0 8px 24px rgba(255,186,0,0.4);
    }
    .btn-login:active { transform: translateY(0); }
    #login-spinner { display: none; }

    #adm {
      display: none;
      min-height: 100vh;
    }
    #adm.visible { display: flex; }

    #sidebar {
      width: 260px; min-width: 260px;
      background: var(--bg2);
      border-right: 1px solid var(--border);
      display: flex; flex-direction: column;
      position: fixed; left: 0; top: 0; bottom: 0;
      z-index: 100; overflow-y: auto;
    }
    .sb-brand {
      padding: 24px 20px 20px;
      border-bottom: 1px solid var(--border);
    }
    .sb-brand-row {
      display: flex; align-items: center; gap: 12px;
    }
    .sb-icon {
      width: 40px; height: 40px; min-width: 40px;
      background: linear-gradient(135deg, var(--gold), var(--purple-l));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.1rem;
    }
    .sb-brand-text h2 {
      font-family: var(--font-d); font-size: 1rem; font-weight: 800; color: #fff;
    }
    .sb-brand-text p { font-size: 0.72rem; color: var(--muted); margin-top: 1px; }
    .sb-site-link {
      margin-top: 12px;
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 0.75rem; color: var(--muted);
      background: var(--glass); border: 1px solid var(--border);
      padding: 5px 12px; border-radius: 8px;
      transition: var(--tr);
    }
    .sb-site-link:hover { color: var(--gold); border-color: rgba(255,186,0,0.3); }
    .sb-site-link svg { width: 12px; height: 12px; }

    .sb-nav { padding: 16px 12px; flex: 1; }
    .sb-nav-group { margin-bottom: 24px; }
    .sb-group-title {
      font-size: 0.65rem; font-weight: 700; text-transform: uppercase;
      letter-spacing: 0.12em; color: rgba(168,153,194,0.5);
      padding: 0 8px; margin-bottom: 6px;
    }
    .sb-link {
      display: flex; align-items: center; gap: 10px;
      padding: 9px 10px; border-radius: 10px;
      font-size: 0.875rem; font-weight: 500; color: var(--muted);
      transition: var(--tr); cursor: pointer; margin-bottom: 2px;
    }
    .sb-link svg { width: 18px; height: 18px; flex-shrink: 0; }
    .sb-link:hover { background: rgba(255,255,255,0.05); color: var(--text); }
    .sb-link.active {
      background: rgba(255,186,0,0.1); color: var(--gold);
      border: 1px solid rgba(255,186,0,0.2);
    }
    .sb-link .sb-badge {
      margin-left: auto; font-size: 0.65rem; font-weight: 700;
      background: rgba(255,186,0,0.15); color: var(--gold);
      padding: 2px 7px; border-radius: 100px;
    }

    .sb-footer {
      padding: 16px 12px;
      border-top: 1px solid var(--border);
    }
    .sb-user {
      display: flex; align-items: center; gap: 10px;
      padding: 10px; border-radius: 10px;
      background: var(--glass); border: 1px solid var(--border);
      margin-bottom: 10px;
    }
    .sb-avatar {
      width: 34px; height: 34px; border-radius: 50%;
      background: linear-gradient(135deg, var(--gold), var(--purple-l));
      display: flex; align-items: center; justify-content: center;
      font-size: 0.9rem; font-weight: 700; color: #1a1228; flex-shrink: 0;
    }
    .sb-user-info p { font-size: 0.8rem; font-weight: 600; color: var(--text); }
    .sb-user-info span { font-size: 0.7rem; color: var(--muted); }
    .btn-logout {
      width: 100%; padding: 9px;
      background: rgba(224,85,85,0.08);
      border: 1px solid rgba(224,85,85,0.2);
      color: #ff8888; border-radius: 10px; font-size: 0.82rem; font-weight: 600;
      display: flex; align-items: center; justify-content: center; gap: 6px;
      transition: var(--tr);
    }
    .btn-logout:hover { background: rgba(224,85,85,0.15); border-color: rgba(224,85,85,0.4); }
    .btn-logout svg { width: 16px; height: 16px; }

    #content {
      margin-left: 260px; flex: 1;
      padding: 32px 36px;
      min-height: 100vh;
    }

    .view { display: none; }
    .view.active { display: block; }

    .page-hd {
      margin-bottom: 32px;
      display: flex; align-items: flex-start; justify-content: space-between;
      gap: 16px; flex-wrap: wrap;
    }
    .page-hd-left h2 {
      font-family: var(--font-d); font-size: 1.6rem; font-weight: 800; color: #fff;
    }
    .page-hd-left p { font-size: 0.9rem; color: var(--muted); margin-top: 4px; }
    .page-tag {
      display: inline-block; font-size: 0.7rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.12em;
      color: var(--gold); background: rgba(255,186,0,0.08);
      border: 1px solid rgba(255,186,0,0.25);
      padding: 3px 12px; border-radius: 100px; margin-bottom: 8px;
    }

    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }

    .panel {
      background: var(--glass);
      border: 1px solid var(--border);
      border-radius: var(--r2);
      padding: 24px;
      transition: var(--tr);
    }
    .panel:hover { border-color: rgba(255,186,0,0.12); }
    .panel-hd {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 20px; padding-bottom: 16px;
      border-bottom: 1px solid var(--border);
    }
    .panel-hd-left { display: flex; align-items: center; gap: 10px; }
    .panel-hd-icon {
      width: 36px; height: 36px;
      background: rgba(255,186,0,0.1); border: 1px solid rgba(255,186,0,0.2);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: var(--gold);
    }
    .panel-hd-icon svg { width: 18px; height: 18px; }
    .panel-title { font-family: var(--font-d); font-size: 1rem; font-weight: 700; color: #fff; }
    .panel-sub { font-size: 0.78rem; color: var(--muted); margin-top: 2px; }

    .field { margin-bottom: 16px; }
    .field label {
      display: block; font-size: 0.75rem; font-weight: 600;
      color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em;
      margin-bottom: 7px;
    }
    .field-hint {
      font-size: 0.72rem; color: rgba(168,153,194,0.6); margin-top: 5px;
    }

    .btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 10px 18px; border-radius: var(--r); font-weight: 600;
      font-size: 0.85rem; transition: var(--tr); cursor: pointer;
    }
    .btn svg { width: 16px; height: 16px; }
    .btn-gold {
      background: var(--gold); color: #1a1228;
      box-shadow: 0 4px 12px rgba(255,186,0,0.25);
    }
    .btn-gold:hover {
      background: var(--gold-l); transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(255,186,0,0.35);
    }
    .btn-outline {
      background: transparent; color: var(--gold);
      border: 1px solid rgba(255,186,0,0.4);
    }
    .btn-outline:hover {
      background: rgba(255,186,0,0.08);
      border-color: var(--gold);
    }
    .btn-ghost {
      background: rgba(255,255,255,0.05);
      border: 1px solid var(--border);
      color: var(--muted);
    }
    .btn-ghost:hover { background: rgba(255,255,255,0.08); color: var(--text); }
    .btn-danger {
      background: rgba(224,85,85,0.1);
      border: 1px solid rgba(224,85,85,0.3);
      color: #ff8888;
    }
    .btn-danger:hover { background: rgba(224,85,85,0.18); }
    .btn-sm { padding: 7px 13px; font-size: 0.8rem; }
    .btn-full { width: 100%; justify-content: center; }

    .stat-card {
      background: var(--glass); border: 1px solid var(--border);
      border-radius: var(--r2); padding: 22px;
      transition: var(--tr); position: relative; overflow: hidden;
    }
    .stat-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
      background: linear-gradient(90deg, transparent, var(--gold), transparent);
      opacity: 0; transition: var(--tr);
    }
    .stat-card:hover { border-color: rgba(255,186,0,0.2); transform: translateY(-2px); }
    .stat-card:hover::before { opacity: 1; }
    .stat-card-num {
      font-family: var(--font-d); font-size: 2.2rem; font-weight: 900;
      color: var(--gold); line-height: 1; margin-bottom: 6px;
    }
    .stat-card-label { font-size: 0.85rem; color: var(--muted); font-weight: 500; }
    .stat-card-icon {
      position: absolute; right: 20px; top: 20px;
      width: 44px; height: 44px; border-radius: 12px;
      background: rgba(255,186,0,0.08); border: 1px solid rgba(255,186,0,0.15);
      display: flex; align-items: center; justify-content: center; color: var(--gold);
    }
    .stat-card-icon svg { width: 22px; height: 22px; }

    .quick-action {
      display: flex; align-items: center; gap: 12px;
      padding: 14px 18px; border-radius: var(--r);
      background: var(--glass); border: 1px solid var(--border);
      transition: var(--tr); cursor: pointer;
    }
    .quick-action:hover { border-color: rgba(255,186,0,0.25); background: rgba(255,186,0,0.04); }
    .qa-icon {
      width: 36px; height: 36px; border-radius: 10px;
      background: rgba(255,186,0,0.1);
      display: flex; align-items: center; justify-content: center;
      color: var(--gold); flex-shrink: 0;
    }
    .qa-icon svg { width: 18px; height: 18px; }
    .qa-text p { font-size: 0.88rem; font-weight: 600; color: var(--text); }
    .qa-text span { font-size: 0.75rem; color: var(--muted); }

    .divider { border: none; border-top: 1px solid var(--border); margin: 24px 0; }

    .action-bar {
      display: flex; align-items: center; justify-content: flex-end;
      gap: 10px; margin-top: 24px; padding-top: 20px;
      border-top: 1px solid var(--border);
    }

    .item-list { display: flex; flex-direction: column; gap: 10px; }
    .item-row {
      display: flex; align-items: center; gap: 10px;
      background: var(--bg3); border: 1px solid var(--border);
      border-radius: var(--r); padding: 10px 14px;
      transition: var(--tr);
    }
    .item-row:hover { border-color: rgba(255,186,0,0.2); }
    .item-row input { background: transparent; border: none; padding: 0; }
    .item-row input:focus { background: transparent; box-shadow: none; border: none; }
    .item-thumb {
      width: 80px; height: 45px; border-radius: 6px;
      object-fit: cover; flex-shrink: 0; background: var(--bg4);
    }
    .item-num {
      width: 24px; height: 24px; border-radius: 6px;
      background: rgba(255,186,0,0.1); color: var(--gold);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.75rem; font-weight: 700; flex-shrink: 0;
    }

    .field-with-btn { display: flex; gap: 8px; }
    .field-with-btn input { flex: 1; }

    .pacote-edit {
      border: 1px solid var(--border); border-radius: var(--r2);
      overflow: hidden; margin-bottom: 16px; transition: var(--tr);
    }
    .pacote-edit:hover { border-color: rgba(255,186,0,0.2); }
    .pacote-edit-header {
      background: var(--bg3); padding: 14px 20px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border);
    }
    .pacote-edit-header h4 {
      font-family: var(--font-d); font-size: 1rem; font-weight: 700; color: #fff;
    }
    .featured-badge {
      font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
      letter-spacing: 0.1em; padding: 3px 10px; border-radius: 100px;
      background: var(--gold); color: #1a1228;
    }
    .pacote-edit-body { padding: 20px; }

    .efeito-edit-grid {
      display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
    }
    .efeito-edit-card {
      background: var(--bg3); border: 1px solid var(--border);
      border-radius: var(--r); padding: 18px; transition: var(--tr);
    }
    .efeito-edit-card:hover { border-color: rgba(255,186,0,0.2); }
    .efeito-edit-card-hd {
      display: flex; align-items: center; gap: 8px; margin-bottom: 14px;
    }
    .efeito-num {
      width: 24px; height: 24px; border-radius: 6px;
      background: rgba(255,186,0,0.12); color: var(--gold);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.7rem; font-weight: 800; flex-shrink: 0;
    }

    .seo-preview {
      background: #fff; border-radius: var(--r); padding: 16px 18px;
      margin-top: 16px; color: #000;
    }
    .seo-prev-url { font-size: 0.78rem; color: #1a73e8; margin-bottom: 4px; }
    .seo-prev-title {
      font-size: 1.05rem; color: #1a0dab; font-weight: 400;
      margin-bottom: 4px; font-family: 'Arial', sans-serif;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .seo-prev-desc {
      font-size: 0.82rem; color: #4d5156;
      font-family: 'Arial', sans-serif; line-height: 1.5;
      display: -webkit-box; -webkit-line-clamp: 2;
      -webkit-box-orient: vertical; overflow: hidden;
    }

    #toast {
      position: fixed; bottom: 28px; right: 28px; z-index: 99999;
      display: flex; flex-direction: column; gap: 10px; pointer-events: none;
    }
    .toast-item {
      display: flex; align-items: center; gap: 10px;
      background: var(--bg3); border: 1px solid var(--border);
      border-radius: 12px; padding: 13px 18px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.4);
      animation: toastIn 0.4s cubic-bezier(0.16,1,0.3,1);
      font-size: 0.875rem; font-weight: 500;
      max-width: 320px;
    }
    @keyframes toastIn {
      from { opacity:0; transform: translateX(20px); }
      to { opacity:1; transform: translateX(0); }
    }
    .toast-item.success { border-color: rgba(76,175,133,0.4); }
    .toast-item.success .ti-dot { background: var(--green); }
    .toast-item.error { border-color: rgba(224,85,85,0.4); }
    .toast-item.error .ti-dot { background: var(--red); }
    .ti-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

    #export-modal {
      position: fixed; inset: 0; z-index: 9990;
      display: none; align-items: center; justify-content: center;
    }
    #export-modal.open { display: flex; }
    .modal-backdrop {
      position: absolute; inset: 0;
      background: rgba(0,0,0,0.7); backdrop-filter: blur(6px);
      cursor: pointer;
    }
    .modal-box {
      position: relative; z-index: 1;
      width: 90vw; max-width: 760px;
      background: var(--bg2); border: 1px solid var(--border);
      border-radius: var(--r2); padding: 32px;
      box-shadow: 0 40px 100px rgba(0,0,0,0.7);
      animation: modalIn 0.35s cubic-bezier(0.16,1,0.3,1);
      max-height: 85vh; display: flex; flex-direction: column;
    }
    @keyframes modalIn {
      from { opacity:0; transform: scale(0.94) translateY(12px); }
      to   { opacity:1; transform: scale(1) translateY(0); }
    }
    .modal-hd {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 20px;
    }
    .modal-hd h3 { font-family: var(--font-d); font-size: 1.2rem; font-weight: 700; color: #fff; }
    .modal-close-btn {
      width: 32px; height: 32px; border-radius: 8px;
      background: rgba(255,255,255,0.06); color: var(--muted);
      display: flex; align-items: center; justify-content: center;
      transition: var(--tr); font-size: 1rem;
    }
    .modal-close-btn:hover { background: rgba(255,255,255,0.1); color: #fff; }
    .modal-instructions {
      font-size: 0.83rem; color: var(--muted); line-height: 1.6;
      background: rgba(255,186,0,0.05); border: 1px solid rgba(255,186,0,0.15);
      border-radius: 10px; padding: 12px 16px; margin-bottom: 16px;
    }
    .modal-instructions strong { color: var(--gold); }
    .code-area {
      background: var(--bg3); border: 1px solid var(--border);
      border-radius: var(--r); padding: 16px;
      font-family: 'Courier New', monospace; font-size: 0.78rem;
      color: #c9d1d9; overflow-y: auto;
      flex: 1; white-space: pre-wrap; word-break: break-all;
      min-height: 200px; max-height: 360px;
    }
    .modal-actions { margin-top: 16px; display: flex; gap: 10px; }

    .info-box {
      background: rgba(255,186,0,0.05);
      border: 1px solid rgba(255,186,0,0.2);
      border-radius: var(--r); padding: 14px 16px;
      font-size: 0.84rem; color: var(--muted); line-height: 1.6;
      margin-bottom: 20px;
    }
    .info-box strong { color: var(--gold); }

    .wa-preview {
      background: rgba(37,211,102,0.08); border: 1px solid rgba(37,211,102,0.2);
      border-radius: var(--r); padding: 12px 16px;
      font-size: 0.82rem; color: #4caf85; word-break: break-all;
      margin-top: 8px;
    }

    .step-list { display: flex; flex-direction: column; gap: 12px; }
    .step {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 14px; background: var(--bg3); border: 1px solid var(--border);
      border-radius: var(--r);
    }
    .step-num {
      width: 28px; height: 28px; border-radius: 8px;
      background: var(--gold); color: #1a1228;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.8rem; font-weight: 800; flex-shrink: 0;
    }
    .step p { font-size: 0.85rem; color: var(--muted); line-height: 1.5; }
    .step p strong { color: var(--text); }
    .step code {
      font-family: monospace; background: var(--bg4);
      padding: 2px 6px; border-radius: 4px;
      font-size: 0.78rem; color: var(--gold);
    }

    @media (max-width: 1100px) {
      .grid-3 { grid-template-columns: 1fr 1fr; }
      .grid-4 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 900px) {
      #sidebar { width: 220px; min-width: 220px; }
      #content { margin-left: 220px; padding: 24px 20px; }
      .grid-2 { grid-template-columns: 1fr; }
      .efeito-edit-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 700px) {
      #sidebar { transform: translateX(-100%); }
      #sidebar.open { transform: translateX(0); }
      #content { margin-left: 0; padding: 16px; }
    }
  </style>
</head>
<body>

<div id="login-wrap" <?php if (isLoggedIn()) echo 'style="display: none;"'; ?>>
  <div class="login-grid"></div>
  <div class="login-box">
    <div class="login-brand">
      <div class="login-logo-wrap">
        <div class="login-logo-glow"></div>
        <img class="login-logo-img" src="logo-login.png" alt="Sardanelli Produções" style="animation: logoFloat 4s ease-in-out infinite, logoReveal 0.6s cubic-bezier(0.16,1,0.3,1) both;" />
      </div>
      <p>Painel de Administração</p>
    </div>
    <div style="text-align:center; margin-bottom:24px;">
      <span class="login-badge">🔒 Área Restrita</span>
    </div>
    <div id="login-error">E-mail ou senha incorretos. Tente novamente.</div>
    <form id="login-form" autocomplete="off">
      <div class="login-field">
        <label class="login-label">Usuário</label>
        <div class="login-input-wrap">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
          <input type="text" id="login-user" placeholder="usuário" autocomplete="off" required />
        </div>
      </div>
      <div class="login-field">
        <label class="login-label">Senha</label>
        <div class="login-input-wrap">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
          <input type="password" id="login-pass" placeholder="••••••••••••" autocomplete="new-password" required />
        </div>
      </div>
      <button type="submit" class="btn-login" id="btn-login">
        <svg id="login-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="18" height="18" style="animation:spin 0.8s linear infinite"><circle cx="12" cy="12" r="10" stroke="#1a1228" stroke-width="3" stroke-dasharray="31" stroke-dashoffset="10"/></svg>
        <span id="btn-login-txt">Entrar no Painel</span>
      </button>
    </form>
  </div>
</div>

<style>@keyframes spin { to { transform: rotate(360deg); } }</style>

<div id="adm" <?php if (isLoggedIn()) echo 'class="visible"'; ?>>
  <aside id="sidebar">
    <div class="sb-brand">
      <div class="sb-brand-row">
        <div class="sb-icon" style="background:transparent;padding:0;overflow:hidden;border-radius:10px;">
          <img src="logo-login.png" alt="Sardanelli" style="width:40px;height:40px;object-fit:contain;display:block;animation:logoFloat 5s ease-in-out infinite;" />
        </div>
        <div class="sb-brand-text">
          <h2>Sardanelli ADM</h2>
          <p>Painel de controle</p>
        </div>
      </div>
      <a href="https://www.sardanelli.com.br" target="_blank" rel="noopener" class="sb-site-link">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
        Ver o site ao vivo
      </a>
    </div>

    <nav class="sb-nav">
      <div class="sb-nav-group">
        <div class="sb-group-title">Geral</div>
        <div class="sb-link active" data-view="dashboard">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
          Dashboard
        </div>
      </div>
      <div class="sb-nav-group">
        <div class="sb-group-title">Conteúdo do Site</div>
        <div class="sb-link" data-view="hero">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
          Hero (Início)
        </div>
        <div class="sb-link" data-view="sobre">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
          Quem Somos
        </div>
        <div class="sb-link" data-view="efeitos">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
          Efeitos
        </div>
        <div class="sb-link" data-view="pacotes">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg>
          Pacotes
        </div>
        <div class="sb-link" data-view="videos">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg>
          Vídeos
          <span class="sb-badge" id="sb-videos-count">8</span>
        </div>
        <div class="sb-link" data-view="footer">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
          Rodapé
        </div>
      </div>
      <div class="sb-nav-group">
        <div class="sb-group-title">Configurações</div>
        <div class="sb-link" data-view="usuarios">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
          Usuários & Acesso
        </div>
        <div class="sb-link" data-view="paginas">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
          Páginas do Site
        </div>
        <div class="sb-link" data-view="contato">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
          Contato & Redes
        </div>
        <div class="sb-link" data-view="seo">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 10.607z"/></svg>
          SEO & Meta Tags
        </div>
        <div class="sb-link" data-view="guia">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
          Guia de Uso
        </div>
      </div>
    </nav>

    <div class="sb-footer">
      <div class="sb-user">
        <div class="sb-avatar" id="sb-avatar-char"><?php echo strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)); ?></div>
        <div class="sb-user-info">
          <p id="sb-username"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></p>
          <span>Administrador</span>
        </div>
      </div>
      <button class="btn-logout" id="btn-logout">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
        Sair
      </button>
    </div>
  </aside>

  <main id="content">
    <div class="view active" data-view="dashboard">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Bem-vindo de volta!</span>
          <h2>Dashboard</h2>
          <p>Visão geral do seu site sardanelli.com.br</p>
        </div>
        <a href="https://www.sardanelli.com.br" target="_blank" class="btn btn-ghost">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
          Ver site ao vivo
        </a>
      </div>

      <div class="grid-3" style="margin-bottom:24px;">
        <div class="stat-card">
          <div class="stat-card-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg></div>
          <div class="stat-card-num" id="dash-videos">8</div>
          <div class="stat-card-label">Vídeos no site</div>
        </div>
        <div class="stat-card">
          <div class="stat-card-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg></div>
          <div class="stat-card-num">3</div>
          <div class="stat-card-label">Pacotes ativos</div>
        </div>
        <div class="stat-card">
          <div class="stat-card-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg></div>
          <div class="stat-card-num">8</div>
          <div class="stat-card-label">Efeitos cadastrados</div>
        </div>
      </div>

      <div class="grid-2" style="margin-bottom:24px;">
        <div class="panel">
          <div class="panel-hd">
            <div class="panel-hd-left">
              <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg></div>
              <div>
                <div class="panel-title">Ações Rápidas</div>
                <div class="panel-sub">Acesse rapidamente as seções mais usadas</div>
              </div>
            </div>
          </div>
          <div style="display:flex; flex-direction:column; gap:8px;">
            <div class="quick-action" data-view="videos">
              <div class="qa-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg></div>
              <div class="qa-text"><p>Adicionar / Remover Vídeo</p><span>Gerencie os vídeos do YouTube</span></div>
            </div>
            <div class="quick-action" data-view="pacotes">
              <div class="qa-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg></div>
              <div class="qa-text"><p>Editar Pacotes</p><span>Atualize os itens dos pacotes</span></div>
            </div>
            <div class="quick-action" data-view="contato">
              <div class="qa-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg></div>
              <div class="qa-text"><p>Atualizar WhatsApp</p><span>Altere o número de contato</span></div>
            </div>
          </div>
        </div>

        <div class="panel">
          <div class="panel-hd">
            <div class="panel-hd-left">
              <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg></div>
              <div>
                <div class="panel-title">Como funciona</div>
                <div class="panel-sub">Fluxo de trabalho do painel</div>
              </div>
            </div>
          </div>
          <div class="step-list">
            <div class="step">
              <div class="step-num">1</div>
              <div><p><strong>Edite</strong> o conteúdo nas seções do painel (texto, vídeos, pacotes...)</p></div>
            </div>
            <div class="step">
              <div class="step-num">2</div>
              <div><p>Clique em <strong>"Salvar"</strong> para guardar as alterações localmente</p></div>
            </div>
            <div class="step">
              <div class="step-num">3</div>
              <div><p>Clique em <strong>"Exportar"</strong> para gerar o código/arquivo pronto</p></div>
            </div>
            <div class="step">
              <div class="step-num">4</div>
              <div><p>Substitua o arquivo na pasta <code>V4/</code> e faça <strong>push no GitHub</strong></p></div>
            </div>
            <div class="step">
              <div class="step-num">5</div>
              <div><p>O <strong>Cloudflare</strong> publica automaticamente em segundos ✅</p></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- HERO -->
    <div class="view" data-view="hero">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Seção de Início</span>
          <h2>Hero (Início)</h2>
          <p>Edite o texto principal que aparece na tela inicial do site</p>
        </div>
      </div>
      <div class="panel">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg></div>
            <div><div class="panel-title">Textos do Hero</div></div>
          </div>
        </div>
        <div class="grid-2">
          <div>
            <div class="field">
              <label>Tag de Topo (texto pequeno acima do título)</label>
              <input type="text" id="hero-tag" value="Desde 2016 transformando momentos em" />
            </div>
            <div class="field">
              <label>Título — Linha 1 (branco)</label>
              <input type="text" id="hero-t1" value="Experiências" />
            </div>
            <div class="field">
              <label>Título — Linha 2 (dourado)</label>
              <input type="text" id="hero-t2" value="Inesquecíveis" />
            </div>
            <div class="field">
              <label>Subtítulo</label>
              <textarea id="hero-sub" rows="3">Casamentos, Chás Revelação, Formaturas e Eventos Corporativos com efeitos especiais que encantam e emocionam.</textarea>
            </div>
            <div class="field">
              <label>Texto do Botão CTA</label>
              <input type="text" id="hero-btn" value="Assista nossos Vídeos" />
            </div>
          </div>
          <div>
            <div style="background: linear-gradient(135deg, #1a1228, #130e1f); border-radius: 14px; padding: 32px 24px; text-align:center; border: 1px solid var(--border); min-height: 280px; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:12px;">
              <span style="font-size:0.72rem; color:var(--gold); background:rgba(255,186,0,0.08); border:1px solid rgba(255,186,0,0.25); padding:4px 14px; border-radius:100px;" id="prev-hero-tag">Desde 2016 transformando momentos em</span>
              <div style="font-family:var(--font-d); font-size:1.8rem; font-weight:900; line-height:1.1; color:#fff;" id="prev-hero-title">Experiências<br><span style="color:var(--gold);" id="prev-hero-t2">Inesquecíveis</span></div>
              <p style="font-size:0.8rem; color:var(--muted); max-width:260px; line-height:1.6;" id="prev-hero-sub">Casamentos, Chás Revelação, Formaturas e Eventos Corporativos com efeitos especiais.</p>
              <span style="background:var(--gold); color:#1a1228; padding:8px 20px; border-radius:10px; font-size:0.85rem; font-weight:700;" id="prev-hero-btn">Assista nossos Vídeos</span>
            </div>
            <div class="field-hint" style="margin-top:8px;">👆 Pré-visualização em tempo real</div>
          </div>
        </div>
        <div class="action-bar">
          <button class="btn btn-ghost" onclick="resetSection('hero')">Restaurar padrão</button>
          <button class="btn btn-outline" onclick="exportSection('hero')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Exportar HTML
          </button>
          <button class="btn btn-gold" onclick="saveSection('hero')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>
    </div>

    <!-- SOBRE -->
    <div class="view" data-view="sobre">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Seção Quem Somos</span>
          <h2>Sobre / Quem Somos</h2>
          <p>Edite a história e os números da empresa</p>
        </div>
      </div>
      <div class="panel" style="margin-bottom:20px;">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg></div>
            <div><div class="panel-title">Texto da Seção</div></div>
          </div>
        </div>
        <div class="field"><label>Tag (texto pequeno acima do título)</label><input type="text" id="sobre-tag" value="Quem Somos" /></div>
        <div class="field"><label>Título — Parte 1 (branco)</label><input type="text" id="sobre-t1" value="Uma história escrita " /></div>
        <div class="field"><label>Título — Parte 2 (dourado)</label><input type="text" id="sobre-t2" value="com emoção" /></div>
        <div class="field"><label>Parágrafo 1</label><textarea id="sobre-p1" rows="3">A Sardanelli Produções nasceu em &lt;strong&gt;2016&lt;/strong&gt; com um propósito claro: transformar eventos em memórias que ficam para sempre gravadas na lembrança de cada convidado.</textarea></div>
        <div class="field"><label>Parágrafo 2</label><textarea id="sobre-p2" rows="3">Fundada por &lt;strong&gt;Murilo Sardanelli&lt;/strong&gt;, a empresa cresceu a partir de uma paixão genuína por criar momentos de impacto. Hoje, somos referência em efeitos especiais para eventos na região, reconhecidos pela qualidade técnica, pela organização impecável e pelo cuidado em cada detalhe.</textarea></div>
        <div class="field"><label>Parágrafo 3</label><textarea id="sobre-p3" rows="3">Do chá revelação ao casamento dos sonhos, da formatura emocionante ao evento corporativo marcante, criamos o cenário perfeito para o seu momento especial.</textarea></div>
        <div class="action-bar">
          <button class="btn btn-ghost" onclick="resetSection('sobre')">Restaurar padrão</button>
          <button class="btn btn-outline" onclick="exportSection('sobre')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Exportar HTML
          </button>
          <button class="btn btn-gold" onclick="saveSection('sobre')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>
      <div class="panel">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg></div>
            <div><div class="panel-title">Números / Estatísticas</div><div class="panel-sub">Aparecem na seção "Quem Somos"</div></div>
          </div>
        </div>
        <div class="grid-3">
          <div class="field"><label>Eventos realizados</label><input type="text" id="stat-eventos" value="+500" /></div>
          <div class="field"><label>Anos de experiência</label><input type="text" id="stat-anos" value="8+" /></div>
          <div class="field"><label>Clientes satisfeitos</label><input type="text" id="stat-satisf" value="100%" /></div>
        </div>
        <div class="action-bar">
          <button class="btn btn-gold" onclick="saveSection('stats')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar Números
          </button>
        </div>
      </div>
    </div>

    <!-- EFEITOS -->
    <div class="view" data-view="efeitos">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Nosso Arsenal</span>
          <h2>Efeitos</h2>
          <p>Edite os 8 cards de efeitos especiais</p>
        </div>
      </div>
      <div class="panel">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg></div>
            <div><div class="panel-title">Cards de Efeitos (8 cards)</div></div>
          </div>
        </div>
        <div class="efeito-edit-grid" id="efeitos-grid"></div>
        <div class="action-bar">
          <button class="btn btn-ghost" onclick="resetSection('efeitos')">Restaurar padrão</button>
          <button class="btn btn-outline" onclick="exportSection('efeitos')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Exportar HTML
          </button>
          <button class="btn btn-gold" onclick="saveSection('efeitos')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>
    </div>

    <!-- PACOTES -->
    <div class="view" data-view="pacotes">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">O Show Começa Agora</span>
          <h2>Pacotes</h2>
          <p>Edite os itens, nome e mensagem de cada pacote</p>
        </div>
      </div>
      <div id="pacotes-container"></div>
      <div class="action-bar" style="border-top:none; padding-top:0;">
        <button class="btn btn-ghost" onclick="resetSection('pacotes')">Restaurar padrão</button>
        <button class="btn btn-outline" onclick="exportSection('pacotes')">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
          Exportar HTML dos Pacotes
        </button>
        <button class="btn btn-gold" onclick="saveSection('pacotes')">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
          Salvar Tudo
        </button>
      </div>
    </div>

    <!-- VÍDEOS -->
    <div class="view" data-view="videos">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Eventos</span>
          <h2>Vídeos do YouTube</h2>
          <p>Gerencie os IDs dos vídeos exibidos no site</p>
        </div>
        <button class="btn btn-gold" onclick="addVideo()">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
          Adicionar Vídeo
        </button>
      </div>
      <div class="panel">
        <div class="info-box">
          <strong>Como encontrar o ID do vídeo:</strong> Acesse o vídeo no YouTube. O ID é a parte após <code>?v=</code> na URL. Ex: <code>youtube.com/watch?v=<strong>nYcqAYoVNEg</strong></code>
        </div>
        <div class="item-list" id="videos-list"></div>
        <div class="action-bar">
          <button class="btn btn-ghost" onclick="resetSection('videos')">Restaurar padrão</button>
          <button class="btn btn-outline" onclick="exportSection('videos')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Exportar HTML
          </button>
          <button class="btn btn-gold" onclick="saveSection('videos')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>
    </div>

    <!-- GITHUB CONFIG -->
    <!-- CONTATO -->
    <div class="view" data-view="contato">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Contato & Redes Sociais</span>
          <h2>Contato & Redes</h2>
          <p>Atualize o número de WhatsApp e o Instagram</p>
        </div>
      </div>
      <div class="panel" style="margin-bottom:20px;">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg></div>
            <div><div class="panel-title">WhatsApp</div><div class="panel-sub">Número usado em todos os botões do site</div></div>
          </div>
        </div>
        <div class="field">
          <label>Número do WhatsApp (com código do país, sem + e sem espaços)</label>
          <input type="text" id="wa-num" value="5516993950765" placeholder="5516999999999" />
          <div class="field-hint">Ex: 5516993950765 (55 = Brasil, 16 = DDD, 993950765 = número)</div>
        </div>
        <div>
          <div class="field-hint" style="margin-bottom:6px;">Prévia do link:</div>
          <div class="wa-preview" id="wa-preview">https://wa.me/5516993950765</div>
        </div>
        <div class="action-bar">
          <button class="btn btn-outline" onclick="exportSection('contato')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Ver links para atualizar
          </button>
          <button class="btn btn-gold" onclick="saveSection('contato')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>
      <div class="panel">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75"/></svg></div>
            <div><div class="panel-title">Instagram</div></div>
          </div>
        </div>
        <div class="field">
          <label>URL do Instagram</label>
          <input type="text" id="insta-url" value="https://www.instagram.com/sardanelliproducoes/" />
        </div>
        <div class="action-bar">
          <button class="btn btn-gold" onclick="saveSection('contato')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>
    </div>

    <!-- RODAPÉ -->
    <div class="view" data-view="footer">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Conteúdo</span>
          <h2>Rodapé</h2>
          <p>Edite a logo, o texto de direitos autorais e as redes sociais exibidas no rodapé do site</p>
        </div>
      </div>

      <div class="panel" style="margin-bottom:20px;">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 22.5H6a2.25 2.25 0 01-2.25-2.25V3.75A2.25 2.25 0 016 1.5h9.879a2.25 2.25 0 011.591.659l4.121 4.121a2.25 2.25 0 01.659 1.591V20.25A2.25 2.25 0 0118 22.5zM10.5 8.25a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg></div>
            <div><div class="panel-title">Logo do rodapé</div><div class="panel-sub">Imagem exibida acima do texto de direitos autorais</div></div>
          </div>
        </div>
        <div style="display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
          <div style="width:120px;height:80px;border-radius:10px;background:var(--bg3);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;">
            <img id="footer-logo-preview" src="intro-logo.png" alt="Logo do rodapé" style="max-width:100%;max-height:100%;object-fit:contain;" />
          </div>
          <div style="flex:1;min-width:200px;">
            <label class="btn btn-outline btn-sm" for="footer-logo-input" style="cursor:pointer;display:inline-flex;">
              <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M7.5 7.5L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
              Enviar nova logo
            </label>
            <input type="file" id="footer-logo-input" accept=".jpg,.jpeg,.png,.webp" style="display:none;" onchange="uploadFooterLogo(this)" />
            <div class="field-hint" id="footer-logo-status" style="margin-top:8px;">Formatos aceitos: JPG, PNG ou WEBP.</div>
          </div>
        </div>
      </div>

      <div class="panel" style="margin-bottom:20px;">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309a5.342 5.342 0 01-.018-.447z"/></svg></div>
            <div><div class="panel-title">Texto de direitos autorais</div><div class="panel-sub">Exibido logo abaixo da logo, no rodapé</div></div>
          </div>
        </div>
        <div class="field">
          <label>Texto de copyright</label>
          <input type="text" id="footer-copyright" value="© 2026 Sardanelli Produções. Todos os direitos reservados." placeholder="© 2026 Sardanelli Produções. Todos os direitos reservados." />
          <div class="field-hint">Dica: atualize o ano manualmente sempre que virar o ano.</div>
        </div>
        <div class="action-bar">
          <button class="btn btn-outline" onclick="exportSection('footer')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Ver código para o index.html
          </button>
          <button class="btn btn-gold" onclick="saveSection('footer')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>

      <div class="panel">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg></div>
            <div><div class="panel-title">Redes sociais</div><div class="panel-sub">Os mesmos links usados nos botões de WhatsApp do site inteiro</div></div>
          </div>
        </div>
        <div class="field">
          <label>Número do WhatsApp (com código do país, sem + e sem espaços)</label>
          <input type="text" id="footer-wa-num" value="5516993950765" placeholder="5516999999999" />
        </div>
        <div>
          <div class="field-hint" style="margin-bottom:6px;">Prévia do link:</div>
          <div class="wa-preview" id="footer-wa-preview">https://wa.me/5516993950765</div>
        </div>
        <div class="field" style="margin-top:16px;">
          <label>URL do Instagram</label>
          <input type="text" id="footer-insta-url" value="https://www.instagram.com/sardanelliproducoes/" />
        </div>
        <div class="action-bar">
          <button class="btn btn-gold" onclick="saveSection('footer')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>
    </div>

    <!-- SEO -->
    <div class="view" data-view="seo">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Otimização</span>
          <h2>SEO & Meta Tags</h2>
          <p>Controle como o site aparece no Google e redes sociais</p>
        </div>
      </div>
      <div class="panel" style="margin-bottom:20px;">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 10.607z"/></svg></div>
            <div><div class="panel-title">Google Search</div></div>
          </div>
        </div>
        <div class="field">
          <label>Título da Página (title)</label>
          <input type="text" id="seo-title" value="Sardanelli Produções | Efeitos Especiais para Eventos" maxlength="70" />
          <div class="field-hint">Ideal: 50–60 caracteres. <span id="seo-title-count">57</span>/70</div>
        </div>
        <div class="field">
          <label>Meta Descrição</label>
          <textarea id="seo-desc" rows="3" maxlength="165">Sardanelli Produções — Efeitos especiais para casamentos, chás revelação, formaturas e eventos corporativos. Transformamos momentos em experiências inesquecíveis desde 2016.</textarea>
          <div class="field-hint">Ideal: 120–160 caracteres. <span id="seo-desc-count">177</span>/165</div>
        </div>
        <div class="field">
          <label>Palavras-chave (keywords)</label>
          <textarea id="seo-kw" rows="2">efeitos especiais casamento, chá revelação, fumaça colorida, faíscas frias, serpentina, papel picado, eventos, Sardanelli Produções</textarea>
        </div>
        <div class="field-hint" style="margin-bottom:8px;">Pré-visualização no Google:</div>
        <div class="seo-preview">
          <div class="seo-prev-url">sardanelli.com.br</div>
          <div class="seo-prev-title" id="seo-prev-title">Sardanelli Produções | Efeitos Especiais para Eventos</div>
          <div class="seo-prev-desc" id="seo-prev-desc">Sardanelli Produções — Efeitos especiais para casamentos, chás revelação, formaturas e eventos corporativos. Transformamos momentos em experiências inesquecíveis desde 2016.</div>
        </div>
        <div class="action-bar">
          <button class="btn btn-outline" onclick="exportSection('seo')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Exportar Meta Tags
          </button>
          <button class="btn btn-gold" onclick="saveSection('seo')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar
          </button>
        </div>
      </div>
      <div class="panel">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"/></svg></div>
            <div><div class="panel-title">Open Graph (Redes Sociais)</div><div class="panel-sub">Aparece ao compartilhar o link no WhatsApp, Instagram etc.</div></div>
          </div>
        </div>
        <div class="field"><label>OG Título</label><input type="text" id="og-title" value="Sardanelli Produções" /></div>
        <div class="field"><label>OG Descrição</label><textarea id="og-desc" rows="2">Transformamos eventos em experiências inesquecíveis desde 2016. Efeitos especiais para casamentos, chás revelação, formaturas e mais.</textarea></div>
        <div class="action-bar">
          <button class="btn btn-gold" onclick="saveSection('seo')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            Salvar OG Tags
          </button>
        </div>
      </div>
    </div>

    <!-- GUIA -->
    <div class="view" data-view="guia">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Ajuda</span>
          <h2>Guia de Uso</h2>
          <p>Como publicar alterações no site</p>
        </div>
      </div>
      <div class="grid-2">
        <div class="panel">
          <div class="panel-hd">
            <div class="panel-hd-left">
              <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3"/></svg></div>
              <div><div class="panel-title">Publicar no GitHub</div></div>
            </div>
          </div>
          <div class="step-list">
            <div class="step"><div class="step-num">1</div><div><p>Edite o conteúdo aqui no painel e clique em <strong>"Salvar"</strong></p></div></div>
            <div class="step"><div class="step-num">2</div><div><p>Clique em <strong>"Exportar"</strong> — o código gerado aparece num modal</p></div></div>
            <div class="step"><div class="step-num">3</div><div><p>Abra o arquivo correspondente na pasta <code>V4/</code> no seu computador</p></div></div>
            <div class="step"><div class="step-num">4</div><div><p>Substitua o trecho indicado pelo código exportado. Salve o arquivo.</p></div></div>
            <div class="step"><div class="step-num">5</div><div><p>No GitHub Desktop ou terminal: <strong>commit + push</strong> para o repositório</p></div></div>
            <div class="step"><div class="step-num">6</div><div><p>O <strong>Cloudflare</strong> detecta a mudança e publica em segundos ✅</p></div></div>
          </div>
        </div>
        <div class="panel">
          <div class="panel-hd">
            <div class="panel-hd-left">
              <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg></div>
              <div><div class="panel-title">Adicionar Vídeo</div></div>
            </div>
          </div>
          <div class="step-list">
            <div class="step"><div class="step-num">1</div><div><p>Abra o vídeo no YouTube. Copie o ID da URL (ex: <code>nYcqAYoVNEg</code>)</p></div></div>
            <div class="step"><div class="step-num">2</div><div><p>Vá em <strong>Vídeos</strong> neste painel → clique em <strong>"Adicionar Vídeo"</strong></p></div></div>
            <div class="step"><div class="step-num">3</div><div><p>Cole o ID no campo. A thumbnail carrega automaticamente.</p></div></div>
            <div class="step"><div class="step-num">4</div><div><p>Clique em <strong>"Exportar HTML"</strong>, copie o código e substitua a seção de vídeos no <code>index.html</code></p></div></div>
          </div>
        </div>
        <div class="panel">
          <div class="panel-hd">
            <div class="panel-hd-left">
              <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/></svg></div>
              <div><div class="panel-title">Dúvidas Frequentes</div></div>
            </div>
          </div>
          <div style="display:flex;flex-direction:column;gap:14px;">
            <div><p style="font-size:0.875rem;font-weight:600;color:#fff;margin-bottom:4px;">O painel fica online permanentemente?</p><p style="font-size:0.82rem;color:var(--muted);line-height:1.6;">Sim. O arquivo <code>adm.html</code> está no GitHub junto com o site, então acessível em <strong>sardanelli.com.br/adm.html</strong> ou <strong>sardanelli.com.br/adm/</strong>.</p></div>
            <hr class="divider" style="margin:0;">
            <div><p style="font-size:0.875rem;font-weight:600;color:#fff;margin-bottom:4px;">As edições somem ao recarregar?</p><p style="font-size:0.82rem;color:var(--muted);line-height:1.6;">Não. O painel salva tudo no <strong>localStorage</strong> do seu navegador. As edições ficam salvas até você limpar o cache.</p></div>
            <hr class="divider" style="margin:0;">
            <div><p style="font-size:0.875rem;font-weight:600;color:#fff;margin-bottom:4px;">Como aplicar as mudanças no site de verdade?</p><p style="font-size:0.82rem;color:var(--muted);line-height:1.6;">Use o botão <strong>"Exportar"</strong> em cada seção → copie o código → substitua no arquivo → commit + push no GitHub.</p></div>
          </div>
        </div>
      </div>
    </div>

    <!-- USUÁRIOS E ACESSO -->
    <div class="view" data-view="usuarios">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Segurança</span>
          <h2>Usuários &amp; Acesso</h2>
          <p>Gerencie quem pode acessar o painel administrativo</p>
        </div>
        <button class="btn btn-gold" onclick="loadUsers()">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
          Atualizar Lista
        </button>
      </div>
      <div class="grid-2">
        <div class="panel">
          <div class="panel-hd">
            <div class="panel-hd-left">
              <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg></div>
              <div><div class="panel-title">Usuários cadastrados</div></div>
            </div>
          </div>
          <div id="users-list" style="display:flex;flex-direction:column;gap:8px;min-height:60px;"><p style="color:var(--muted);font-size:0.85rem;">Carregando...</p></div>
        </div>
        <div class="panel">
          <div class="panel-hd">
            <div class="panel-hd-left">
              <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg></div>
              <div><div class="panel-title">Adicionar novo usuário</div></div>
            </div>
          </div>
          <form id="add-user-form" onsubmit="addUser(event)" style="display:flex;flex-direction:column;gap:14px;">
            <div class="field">
              <label>Usuário</label>
              <input type="text" id="new-user-name" placeholder="ex: joao" minlength="3" required autocomplete="off" />
            </div>
            <div class="field">
              <label>Senha</label>
              <div class="field-with-btn">
                <input type="password" id="new-user-pass" placeholder="Mínimo 4 caracteres" minlength="4" required autocomplete="new-password" />
                <button type="button" class="btn btn-ghost btn-sm" onclick="togglePassVis('new-user-pass', this)">Mostrar</button>
              </div>
            </div>
            <div class="field">
              <label>Confirmar Senha</label>
              <input type="password" id="new-user-pass2" placeholder="Repita a senha" minlength="4" required autocomplete="new-password" />
            </div>
            <div id="add-user-error" style="display:none;color:#e74c3c;font-size:0.82rem;padding:8px 12px;background:rgba(231,76,60,0.1);border-radius:8px;"></div>
            <div class="action-bar" style="justify-content:flex-start;">
              <button type="submit" class="btn btn-gold">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Adicionar Usuário
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="panel" style="margin-top:20px;">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg></div>
            <div><div class="panel-title">Alterar minha senha</div></div>
          </div>
        </div>
        <form id="change-pass-form" onsubmit="changeMyPass(event)" style="display:flex;flex-direction:column;gap:14px;max-width:420px;">
          <div class="field">
            <label>Nova Senha</label>
            <div class="field-with-btn">
              <input type="password" id="my-new-pass" placeholder="Mínimo 4 caracteres" minlength="4" required autocomplete="new-password" />
              <button type="button" class="btn btn-ghost btn-sm" onclick="togglePassVis('my-new-pass', this)">Mostrar</button>
            </div>
          </div>
          <div class="field">
            <label>Confirmar Nova Senha</label>
            <input type="password" id="my-new-pass2" placeholder="Repita a senha" minlength="4" required autocomplete="new-password" />
          </div>
          <div class="action-bar" style="justify-content:flex-start;">
            <button type="submit" class="btn btn-outline">Alterar Minha Senha</button>
          </div>
        </form>
      </div>
    </div>

    <!-- PÁGINAS DO SITE -->
    <div class="view" data-view="paginas">
      <div class="page-hd">
        <div class="page-hd-left">
          <span class="page-tag">Gestão</span>
          <h2>Páginas do Site</h2>
          <p>Crie, duplique, edite e exclua páginas completas do site</p>
        </div>
        <button class="btn btn-gold" onclick="showCreatePageModal()">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
          Nova Página
        </button>
      </div>
      <div class="panel">
        <div class="panel-hd">
          <div class="panel-hd-left">
            <div class="panel-hd-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg></div>
            <div><div class="panel-title">Páginas existentes</div><div style="font-size:0.8rem;color:var(--muted);">Clique em uma página para carregar e editar seu conteúdo no painel</div></div>
          </div>
        </div>
        <div id="pages-list" style="display:flex;flex-direction:column;gap:10px;min-height:80px;"><p style="color:var(--muted);font-size:0.85rem;">Carregando...</p></div>
      </div>
      <div class="info-box" style="margin-top:20px;">
        <strong>💡 Como funciona:</strong> Cada página é um arquivo JSON em <code>/data/</code> e um arquivo PHP na raiz do site. Ao criar ou duplicar uma página, os dois arquivos são gerados automaticamente. Edite o conteúdo selecionando a página acima e usando as seções normais do painel.
      </div>
    </div>

    <!-- MODAL CRIAR/DUPLICAR PÁGINA -->
    <div id="page-modal" style="display:none;position:fixed;inset:0;z-index:9998;background:rgba(0,0,0,0.7);display:none;align-items:center;justify-content:center;">
      <div style="background:var(--bg2);border:1px solid var(--border);border-radius:16px;padding:32px;width:100%;max-width:460px;">
        <h3 id="page-modal-title" style="margin:0 0 20px;font-size:1.1rem;color:var(--text);">Nova Página</h3>
        <div class="field">
          <label>Nome da página <small style="color:var(--muted);">(sem espaços ou acentos)</small></label>
          <input type="text" id="page-modal-name" placeholder="ex: casamentos" pattern="[a-zA-Z0-9_-]+" required />
          <p class="field-hint">Ficará acessível em <code>seusite.com/<span id="page-modal-preview">casamentos</span>.php</code></p>
        </div>
        <div class="field" id="page-modal-source-wrap">
          <label>Duplicar a partir de</label>
          <select id="page-modal-source" style="width:100%;background:var(--bg3);border:1px solid var(--border);border-radius:8px;padding:10px 12px;color:var(--text);font-size:0.9rem;"></select>
        </div>
        <div class="action-bar" style="margin-top:20px;">
          <button class="btn btn-ghost" onclick="document.getElementById('page-modal').style.display='none'">Cancelar</button>
          <button class="btn btn-gold" onclick="createPage()">Criar Página</button>
        </div>
      </div>
    </div>

  </main>
</div>

<div id="export-modal">
  <div class="modal-backdrop" onclick="closeModal()"></div>
  <div class="modal-box">
    <div class="modal-hd">
      <h3 id="modal-title">Exportar</h3>
      <button class="modal-close-btn" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-instructions" id="modal-instructions"></div>
    <div class="code-area" id="modal-code"></div>
    <div class="modal-actions">
      <button class="btn btn-gold" onclick="copyModalCode()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.337c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/></svg>
        Copiar Código
      </button>
      <button class="btn btn-ghost" onclick="downloadModalCode()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
        Baixar Arquivo
      </button>
      <button class="btn btn-ghost" onclick="closeModal()">Fechar</button>
    </div>
  </div>
</div>

<div id="toast"></div>

<script>
const _ea=[118,115,112,121];
const _eb=[124,116];
const _pa=[55,63];
const _pb=[60,57];
function _r(a,b){return[...a,...b].reverse().map(c=>String.fromCharCode(c-7)).join('');}
function _chk(e,p){return e.trim().toLowerCase()===_r(_ea,_eb)&&p===_r(_pa,_pb);}

const DEFAULTS = {
  hero: {
    tag: 'Desde 2016 transformando momentos em',
    t1: 'Experiências', t2: 'Inesquecíveis',
    sub: 'Casamentos, Chás Revelação, Formaturas e Eventos Corporativos com efeitos especiais que encantam e emocionam.',
    btn: 'Assista nossos Vídeos'
  },
  sobre: {
    tag:'Quem Somos', t1:'Uma história escrita ', t2:'com emoção',
    p1:'A Sardanelli Produções nasceu em <strong>2016</strong> com um propósito claro: transformar eventos em memórias que ficam para sempre gravadas na lembrança de cada convidado.',
    p2:'Fundada por <strong>Murilo Sardanelli</strong>, a empresa cresceu a partir de uma paixão genuína por criar momentos de impacto. Hoje, somos referência em efeitos especiais para eventos na região, reconhecidos pela qualidade técnica, pela organização impecável e pelo cuidado em cada detalhe.',
    p3:'Do chá revelação ao casamento dos sonhos, da formatura emocionante ao evento corporativo marcante, criamos o cenário perfeito para o seu momento especial.',
  },
  stats: { eventos:'+500', anos:'8+', satisf:'100%' },
  efeitos: [
    {nome:'Rastro de Céu Noturno', desc:'Uso recomendado: Noturno, local aberto.', tag:'Noturno'},
    {nome:'Rastro de Céu Diurno', desc:'Uso recomendado: Diurno, local aberto.', tag:'Diurno'},
    {nome:'Disparador de Serpentina', desc:'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', tag:'Versátil'},
    {nome:'Disparador de Papel Colorido', desc:'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', tag:'Versátil'},
    {nome:'Fumaça Colorida', desc:'Uso recomendado: Diurno ou noturno, local aberto.', tag:'Impacto visual'},
    {nome:'Disparador de Pó Colorido', desc:'Uso recomendado: Diurno ou noturno, local aberto.', tag:'Colorido'},
    {nome:'Simulador de Faíscas', desc:'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', tag:'Premium'},
    {nome:'Disparos de Comemoração', desc:'Efeito sonoro e visual para comemoração. Diurno ou noturno, aberto ou fechado.', tag:'Explosivo'}
  ],
  pacotes: [
    {badge:'Essencial', best:false, nome:'Pacote Essencial', sub:'O essencial que já transforma o momento em espetáculo.',
     itens:['02 Disparadores profissionais de Papel','02 Disparadores profissionais de Serpentina','01 Fumaça Grande'],
     btnTxt:'Quero o Essencial', waMsg:'Olá! Quero o *Pacote Essencial* (Papel x2, Serpentina x2, Fumaça x1). Pode me enviar o orçamento?'},
    {badge:'Mais Escolhido', best:true, nome:'Pacote Médio', sub:'Mais volume, mais efeito, mais emoção.',
     itens:['04 Disparadores profissionais de Papel','04 Disparadores profissionais de Serpentina','02 Fumaças Grandes','02 Simuladores de Faíscas'],
     btnTxt:'Quero o Médio', waMsg:'Olá! Quero o *Pacote Médio* (Papel x4, Serpentina x4, Fumaça x2, Faíscas x2). Pode me enviar o orçamento?'},
    {badge:'Completo', best:false, nome:'Pacote Completo', sub:'O show completo para um momento inesquecível.',
     itens:['06 Disparadores profissionais de Papel','06 Disparadores profissionais de Serpentina','04 Fumaças Grandes','01 Rastro de Céu Colorido','04 Simuladores de Faíscas','01 Tiro de Céu de Comemoração — 24 Disparos'],
     btnTxt:'Quero o Completo', waMsg:'Olá! Quero o *Pacote Completo* (Papel x6, Serpentina x6, Fumaça x4, Rastro de Céu, Faíscas x4, Tiro de Céu). Pode me enviar o orçamento?'}
  ],
  videos: ['nYcqAYoVNEg','WySiyUZ_TZ0','SrEQbd28EPo','1izdP3T-qGs','TWwZjAx42Uk','v2cInNWsd5A','KwutXIYu1fI','HUveuBzkBZw'],
  contato: { wa:'5516993950765', insta:'https://www.instagram.com/sardanelliproducoes/' },
  footer: { logo:'intro-logo.png', copyright:'© 2026 Sardanelli Produções. Todos os direitos reservados.' },
  seo: {
    title:'Sardanelli Produções | Efeitos Especiais para Eventos',
    desc:'Sardanelli Produções — Efeitos especiais para casamentos, chás revelação, formaturas e eventos corporativos. Transformamos momentos em experiências inesquecíveis desde 2016.',
    kw:'efeitos especiais casamento, chá revelação, fumaça colorida, faíscas frias, serpentina, papel picado, eventos, Sardanelli Produções',
    ogTitle:'Sardanelli Produções',
    ogDesc:'Transformamos eventos em experiências inesquecíveis desde 2016. Efeitos especiais para casamentos, chás revelação, formaturas e mais.'
  }
};

let state = {};
let _modalFilename = 'export.txt';
let _modalContent = '';

function getCsrfToken() {
  const meta = document.querySelector('meta[name="csrf-token"]');
  return meta ? meta.getAttribute('content') : '';
}

let currentPage = 'content';

function loadState() {
  try {
    state = <?php 
      $contentFile = __DIR__ . '/data/content.json';
      if (file_exists($contentFile)) {
          echo file_get_contents($contentFile);
      } else {
          echo 'JSON.parse(JSON.stringify(DEFAULTS))';
      }
    ?>;
  } catch(e) { state = JSON.parse(JSON.stringify(DEFAULTS)); }
}

async function loadPage(pageName) {
  currentPage = pageName;
  try {
    const res = await fetch(`adm.php?api=1&action=load_content&page=${pageName}`);
    if (!res.ok) throw new Error('Não foi possível carregar a página');
    state = await res.json();
    if (state.error) {
      toast('❌ ' + state.error, 'error');
      return;
    }
  } catch (e) {
    toast('❌ Erro ao carregar página: ' + e.message, 'error');
    state = JSON.parse(JSON.stringify(DEFAULTS));
  }
  initPanel();
}

function saveState() {
  const formData = new FormData();
  formData.append('api', '1');
  formData.append('action', 'save_content');
  formData.append('csrf_token', getCsrfToken());
  formData.append('page', currentPage);
  formData.append('content', JSON.stringify(state));
  
  fetch('adm.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      toast('✅ Alterações salvas!', 'success');
    } else {
      toast('❌ Erro ao salvar: ' + data.error, 'error');
    }
  })
  .catch(err => {
    toast('❌ Erro de rede ao salvar', 'error');
  });
}
function get(key) { return state[key] ?? DEFAULTS[key]; }

document.getElementById('login-form').addEventListener('submit', async (e) => {
  e.preventDefault();
  const username = document.getElementById('login-user').value;
  const pass  = document.getElementById('login-pass').value;
  const err   = document.getElementById('login-error');
  const spinner = document.getElementById('login-spinner');
  const btnTxt = document.getElementById('btn-login-txt');
  
  spinner.style.display = 'block';
  btnTxt.textContent = 'Verificando...';
  
  try {
    const formData = new FormData();
    formData.append('api', '1');
    formData.append('action', 'login');
    formData.append('username', username);
    formData.append('password', pass);
    
    const res = await fetch('adm.php', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    if (data.success) {
      window.location.reload();
    } else {
      err.style.display = 'block';
      err.textContent = data.error || 'Usuário ou senha incorretos.';
      spinner.style.display = 'none';
      btnTxt.textContent = 'Entrar no Painel';
      document.getElementById('login-pass').value = '';
    }
  } catch (err) {
    err.style.display = 'block';
    err.textContent = 'Erro de rede. Tente novamente.';
    spinner.style.display = 'none';
    btnTxt.textContent = 'Entrar no Painel';
    document.getElementById('login-pass').value = '';
  }
});

document.getElementById('btn-logout').addEventListener('click', async () => {
  try {
    const formData = new FormData();
    formData.append('api', '1');
    formData.append('action', 'logout');
    formData.append('csrf_token', getCsrfToken());
    
    await fetch('adm.php', {
      method: 'POST',
      body: formData
    });
  } catch(e) {}
  window.location.reload();
});

// Check if user is already logged in (persistence on F5)
<?php if (isLoggedIn()): ?>
  loadState();
  initPanel();
<?php endif; ?>

function navigate(viewName) {
  document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
  document.querySelectorAll('.sb-link').forEach(l => l.classList.remove('active'));
  const view = document.querySelector(`.view[data-view="${viewName}"]`);
  if (view) view.classList.add('active');
  const link = document.querySelector(`.sb-link[data-view="${viewName}"]`);
  if (link) link.classList.add('active');
  if (viewName === 'usuarios') loadUsers();
  if (viewName === 'paginas') loadPages();
}

document.querySelectorAll('.sb-link[data-view], .quick-action[data-view]').forEach(el => {
  el.addEventListener('click', () => navigate(el.dataset.view));
});

// ─── USERS MANAGEMENT ─────────────────────────────────────────────────────────
function togglePassVis(inputId, btn) {
  const inp = document.getElementById(inputId);
  if (!inp) return;
  if (inp.type === 'password') { inp.type = 'text'; btn.textContent = 'Ocultar'; }
  else { inp.type = 'password'; btn.textContent = 'Mostrar'; }
}

async function loadUsers() {
  const list = document.getElementById('users-list');
  if (!list) return;
  list.innerHTML = '<p style="color:var(--muted);font-size:0.85rem;">Carregando...</p>';
  try {
    const res = await fetch('adm.php?api=1&action=list_users');
    const data = await res.json();
    const currentUser = '<?php echo htmlspecialchars($_SESSION["username"] ?? ""); ?>';
    if (!data.users || !data.users.length) {
      list.innerHTML = '<p style="color:var(--muted);font-size:0.85rem;">Nenhum usuário cadastrado.</p>';
      return;
    }
    list.innerHTML = data.users.map(u => `
      <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 16px;background:var(--bg3);border-radius:10px;border:1px solid var(--border);">
        <div style="display:flex;align-items:center;gap:12px;">
          <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--purple),var(--gold));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.9rem;color:#fff;">${u[0].toUpperCase()}</div>
          <div>
            <div style="font-weight:600;color:var(--text);">${esc(u)}</div>
            <div style="font-size:0.75rem;color:var(--muted);">${u === currentUser ? '👤 Você' : 'Administrador'}</div>
          </div>
        </div>
        ${u !== currentUser ? `<button class="btn btn-danger btn-sm" onclick="deleteUser('${esc(u)}')">Remover</button>` : '<span style="font-size:0.75rem;color:var(--muted);">Conta atual</span>'}
      </div>
    `).join('');
  } catch (e) {
    list.innerHTML = '<p style="color:#e74c3c;font-size:0.85rem;">Erro ao carregar usuários.</p>';
  }
}

async function addUser(e) {
  e.preventDefault();
  const errEl = document.getElementById('add-user-error');
  errEl.style.display = 'none';
  const name = document.getElementById('new-user-name').value.trim();
  const pass = document.getElementById('new-user-pass').value;
  const pass2 = document.getElementById('new-user-pass2').value;
  if (pass !== pass2) { errEl.textContent = 'As senhas não coincidem.'; errEl.style.display = 'block'; return; }
  const fd = new FormData();
  fd.append('api','1'); fd.append('action','register_user');
  fd.append('csrf_token', getCsrfToken());
  fd.append('new_username', name); fd.append('new_password', pass);
  try {
    const res = await fetch('adm.php', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      toast('✅ Usuário "' + name + '" criado!', 'success');
      document.getElementById('add-user-form').reset();
      loadUsers();
    } else {
      errEl.textContent = data.error || 'Erro ao criar usuário.';
      errEl.style.display = 'block';
    }
  } catch (err) {
    errEl.textContent = 'Erro de rede.'; errEl.style.display = 'block';
  }
}

async function deleteUser(username) {
  if (!confirm(`Remover o usuário "${username}"? Esta ação é irreversível.`)) return;
  const fd = new FormData();
  fd.append('api','1'); fd.append('action','delete_user');
  fd.append('csrf_token', getCsrfToken());
  fd.append('username', username);
  try {
    const res = await fetch('adm.php', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) { toast('✅ Usuário removido!', 'success'); loadUsers(); }
    else toast('❌ ' + (data.error || 'Erro ao remover.'), 'error');
  } catch (err) { toast('❌ Erro de rede.', 'error'); }
}

async function changeMyPass(e) {
  e.preventDefault();
  const pass = document.getElementById('my-new-pass').value;
  const pass2 = document.getElementById('my-new-pass2').value;
  if (pass !== pass2) { toast('❌ As senhas não coincidem.', 'error'); return; }
  const currentUser = '<?php echo htmlspecialchars($_SESSION["username"] ?? ""); ?>';
  const fd = new FormData();
  fd.append('api','1'); fd.append('action','register_user');
  fd.append('csrf_token', getCsrfToken());
  fd.append('new_username', currentUser); fd.append('new_password', pass);
  try {
    const res = await fetch('adm.php', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      toast('✅ Senha alterada com sucesso!', 'success');
      document.getElementById('change-pass-form').reset();
    } else toast('❌ ' + (data.error || 'Erro ao alterar senha.'), 'error');
  } catch (err) { toast('❌ Erro de rede.', 'error'); }
}

// ─── PAGES MANAGEMENT ─────────────────────────────────────────────────────────
let _allPages = [];

async function loadPages() {
  const list = document.getElementById('pages-list');
  if (!list) return;
  list.innerHTML = '<p style="color:var(--muted);font-size:0.85rem;">Carregando...</p>';
  try {
    const res = await fetch('adm.php?api=1&action=list_pages');
    const data = await res.json();
    _allPages = data.pages || ['content'];
    if (!_allPages.length) {
      list.innerHTML = '<p style="color:var(--muted);font-size:0.85rem;">Nenhuma página encontrada.</p>';
      return;
    }
    const pageLabels = { content: '🏠 Página Principal (content)' };
    list.innerHTML = _allPages.map(p => `
      <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;background:var(--bg3);border-radius:10px;border:1px solid ${currentPage===p ? 'var(--gold)' : 'var(--border)'}; ${currentPage===p ? 'box-shadow:0 0 0 2px rgba(255,186,0,0.2);' : ''}">
        <div>
          <div style="font-weight:600;color:var(--text);">${pageLabels[p] || '📄 ' + p + '.php'}</div>
          <div style="font-size:0.75rem;color:var(--muted);">JSON: /data/${p}.json ${currentPage===p ? '• <span style="color:var(--gold);">Editando agora</span>' : ''}</div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;justify-content:flex-end;">
          <button class="btn btn-outline btn-sm" onclick="switchPage('${esc(p)}')">✏️ Editar</button>
          <button class="btn btn-ghost btn-sm" onclick="showDuplicateModal('${esc(p)}')">📋 Duplicar</button>
          ${p !== 'content' ? `<button class="btn btn-danger btn-sm" onclick="deletePage('${esc(p)}')">🗑️ Excluir</button>` : ''}
        </div>
      </div>
    `).join('');
  } catch (err) {
    list.innerHTML = '<p style="color:#e74c3c;font-size:0.85rem;">Erro ao carregar páginas.</p>';
  }
}

async function switchPage(pageName) {
  toast('⏳ Carregando "' + pageName + '"...', 'success');
  await loadPage(pageName);
  navigate('dashboard');
  toast('✅ Editando página: ' + pageName, 'success');
  loadPages();
}

function showCreatePageModal() {
  document.getElementById('page-modal-title').textContent = 'Nova Página';
  document.getElementById('page-modal-name').value = '';
  document.getElementById('page-modal-preview').textContent = 'nova-pagina';
  const sel = document.getElementById('page-modal-source');
  sel.innerHTML = (_allPages.length ? _allPages : ['content']).map(p => `<option value="${p}">${p}</option>`).join('');
  document.getElementById('page-modal-source-wrap').style.display = 'block';
  const modal = document.getElementById('page-modal');
  modal.style.display = 'flex';
  document.getElementById('page-modal-name').focus();
}

function showDuplicateModal(sourcePage) {
  document.getElementById('page-modal-title').textContent = 'Duplicar "' + sourcePage + '"';
  document.getElementById('page-modal-name').value = sourcePage + '-copia';
  document.getElementById('page-modal-preview').textContent = sourcePage + '-copia';
  const sel = document.getElementById('page-modal-source');
  sel.innerHTML = `<option value="${sourcePage}">${sourcePage}</option>`;
  document.getElementById('page-modal-source-wrap').style.display = 'none';
  const modal = document.getElementById('page-modal');
  modal.style.display = 'flex';
  document.getElementById('page-modal-name').focus();
}

document.getElementById('page-modal-name').addEventListener('input', e => {
  document.getElementById('page-modal-preview').textContent = e.target.value || 'nova-pagina';
});

async function createPage() {
  const name = document.getElementById('page-modal-name').value.trim();
  const source = document.getElementById('page-modal-source').value || 'content';
  if (!name || !/^[a-zA-Z0-9_-]+$/.test(name)) { toast('❌ Nome inválido (sem espaços ou acentos).', 'error'); return; }
  const fd = new FormData();
  fd.append('api','1'); fd.append('action','create_page');
  fd.append('csrf_token', getCsrfToken());
  fd.append('page', name); fd.append('source_page', source);
  try {
    const res = await fetch('adm.php', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      document.getElementById('page-modal').style.display = 'none';
      toast('✅ Página "' + name + '" criada!', 'success');
      loadPages();
    } else toast('❌ ' + (data.error || 'Erro ao criar página.'), 'error');
  } catch (err) { toast('❌ Erro de rede.', 'error'); }
}

async function deletePage(pageName) {
  if (!confirm(`Excluir a página "${pageName}" permanentemente? Esta ação não pode ser desfeita.`)) return;
  const fd = new FormData();
  fd.append('api','1'); fd.append('action','delete_page');
  fd.append('csrf_token', getCsrfToken());
  fd.append('page', pageName);
  try {
    const res = await fetch('adm.php', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      toast('✅ Página "' + pageName + '" excluída!', 'success');
      if (currentPage === pageName) { currentPage = 'content'; loadState(); initPanel(); }
      loadPages();
    } else toast('❌ ' + (data.error || 'Erro.'), 'error');
  } catch (err) { toast('❌ Erro de rede.', 'error'); }
}

function renderEfeitos() {
  const efeitos = get('efeitos');
  const grid = document.getElementById('efeitos-grid');
  grid.innerHTML = efeitos.map((e, i) => `
    <div class="efeito-edit-card">
      <div class="efeito-edit-card-hd">
        <div class="efeito-num">${i+1}</div>
        <strong style="font-size:0.82rem; color:var(--muted);">Efeito ${i+1}</strong>
      </div>
      <div class="field"><label>Nome</label><input type="text" data-efeito="${i}" data-field="nome" value="${esc(e.nome)}" /></div>
      <div class="field"><label>Descrição</label><input type="text" data-efeito="${i}" data-field="desc" value="${esc(e.desc)}" /></div>
      <div class="field"><label>Tag / Badge</label><input type="text" data-efeito="${i}" data-field="tag" value="${esc(e.tag)}" /></div>
    </div>
  `).join('');
}

function renderPacotes() {
  const pacotes = get('pacotes');
  document.getElementById('pacotes-container').innerHTML = pacotes.map((p, i) => `
    <div class="pacote-edit" style="margin-bottom:16px;">
      <div class="pacote-edit-header">
        <h4>📦 ${p.nome}</h4>
        ${p.best ? '<span class="featured-badge">⭐ Mais Escolhido</span>' : ''}
      </div>
      <div class="pacote-edit-body">
        <div class="grid-2">
          <div>
            <div class="field"><label>Badge / Etiqueta</label><input type="text" data-pac="${i}" data-field="badge" value="${esc(p.badge)}" /></div>
            <div class="field"><label>Nome do Pacote</label><input type="text" data-pac="${i}" data-field="nome" value="${esc(p.nome)}" /></div>
            <div class="field"><label>Subtítulo</label><input type="text" data-pac="${i}" data-field="sub" value="${esc(p.sub)}" /></div>
            <div class="field"><label>Texto do Botão</label><input type="text" data-pac="${i}" data-field="btnTxt" value="${esc(p.btnTxt)}" /></div>
          </div>
          <div>
            <div class="field">
              <label>Itens inclusos (um por linha)</label>
              <textarea data-pac="${i}" data-field="itens" rows="6">${p.itens.join('\n')}</textarea>
            </div>
            <div class="field">
              <label>Mensagem WhatsApp (texto do botão)</label>
              <textarea data-pac="${i}" data-field="waMsg" rows="3">${esc(p.waMsg)}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  `).join('');
}

function renderVideos() {
  const videos = get('videos');
  document.getElementById('videos-list').innerHTML = videos.map((id, i) => `
    <div class="item-row" id="vrow-${i}">
      <div class="item-num">${i+1}</div>
      <img class="item-thumb" src="https://img.youtube.com/vi/${id}/mqdefault.jpg" alt="thumb" onerror="this.style.background='#1a1228'" />
      <input type="text" value="${id}" placeholder="ID do YouTube" onchange="updateVideo(${i}, this.value)" style="flex:1;" />
      <a href="https://youtube.com/watch?v=${id}" target="_blank" rel="noopener" style="color:var(--gold); font-size:0.75rem; white-space:nowrap; flex-shrink:0;">▶ Ver</a>
      <button class="btn btn-danger btn-sm" onclick="removeVideo(${i})">✕</button>
    </div>
  `).join('');
  document.getElementById('sb-videos-count').textContent = videos.length;
  document.getElementById('dash-videos').textContent = videos.length;
}

function addVideo() {
  const videos = get('videos');
  videos.push('');
  state.videos = videos;
  saveState();
  renderVideos();
  toast('Vídeo adicionado. Cole o ID do YouTube.', 'success');
}
function updateVideo(i, val) {
  state.videos[i] = val.trim();
  saveState();
  const thumb = document.querySelector(`#vrow-${i} .item-thumb`);
  if (thumb && val.trim()) thumb.src = `https://img.youtube.com/vi/${val.trim()}/mqdefault.jpg`;
}
function removeVideo(i) {
  state.videos.splice(i, 1);
  saveState(); renderVideos();
  toast('Vídeo removido', 'success');
}

function saveSection(sec) {
  if (sec === 'hero') {
    state.hero = {
      tag: v('hero-tag'), t1: v('hero-t1'), t2: v('hero-t2'),
      sub: v('hero-sub'), btn: v('hero-btn')
    };
  } else if (sec === 'sobre') {
    state.sobre = {
      tag: v('sobre-tag'), t1: v('sobre-t1'), t2: v('sobre-t2'),
      p1: v('sobre-p1'), p2: v('sobre-p2'), p3: v('sobre-p3')
    };
  } else if (sec === 'stats') {
    state.stats = { eventos: v('stat-eventos'), anos: v('stat-anos'), satisf: v('stat-satisf') };
  } else if (sec === 'efeitos') {
    const inputs = document.querySelectorAll('[data-efeito]');
    inputs.forEach(inp => {
      const i = parseInt(inp.dataset.efeito);
      const field = inp.dataset.field;
      if (!state.efeitos) state.efeitos = JSON.parse(JSON.stringify(DEFAULTS.efeitos));
      state.efeitos[i][field] = inp.value;
    });
  } else if (sec === 'pacotes') {
    document.querySelectorAll('[data-pac]').forEach(inp => {
      const i = parseInt(inp.dataset.pac);
      const field = inp.dataset.field;
      if (!state.pacotes) state.pacotes = JSON.parse(JSON.stringify(DEFAULTS.pacotes));
      if (field === 'itens') {
        state.pacotes[i][field] = inp.value.split('\n').map(l => l.trim()).filter(Boolean);
      } else {
        state.pacotes[i][field] = inp.value;
      }
    });
  } else if (sec === 'contato') {
    state.contato = { wa: v('wa-num'), insta: v('insta-url') };
    syncContatoFields();
  } else if (sec === 'footer') {
    if (!state.footer) state.footer = JSON.parse(JSON.stringify(DEFAULTS.footer));
    state.footer.copyright = v('footer-copyright');
    state.contato = { wa: v('footer-wa-num'), insta: v('footer-insta-url') };
    syncContatoFields();
  } else if (sec === 'seo') {
    state.seo = {
      title: v('seo-title'), desc: v('seo-desc'), kw: v('seo-kw'),
      ogTitle: v('og-title'), ogDesc: v('og-desc')
    };
  }
  saveState();
  toast('✅ Alterações salvas!', 'success');
}

function syncContatoFields() {
  const c = get('contato');
  setVal('wa-num', c.wa); setVal('insta-url', c.insta);
  setVal('footer-wa-num', c.wa); setVal('footer-insta-url', c.insta);
  const p1 = document.getElementById('wa-preview');
  if (p1) p1.textContent = `https://wa.me/${c.wa}`;
  const p2 = document.getElementById('footer-wa-preview');
  if (p2) p2.textContent = `https://wa.me/${c.wa}`;
}

function uploadFooterLogo(input) {
  const file = input.files && input.files[0];
  if (!file) return;

  const status = document.getElementById('footer-logo-status');
  status.textContent = 'Enviando...';

  const formData = new FormData();
  formData.append('api', '1');
  formData.append('action', 'upload_file');
  formData.append('csrf_token', getCsrfToken());
  formData.append('file', file);

  fetch('adm.php', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        if (!state.footer) state.footer = JSON.parse(JSON.stringify(DEFAULTS.footer));
        state.footer.logo = data.url;
        document.getElementById('footer-logo-preview').src = data.url;
        status.textContent = 'Formatos aceitos: JPG, PNG ou WEBP.';
        saveState();
        toast('✅ Logo do rodapé atualizada!', 'success');
      } else {
        status.textContent = 'Formatos aceitos: JPG, PNG ou WEBP.';
        toast('❌ Erro ao enviar logo: ' + (data.error || ''), 'error');
      }
    })
    .catch(() => {
      status.textContent = 'Formatos aceitos: JPG, PNG ou WEBP.';
      toast('❌ Erro de rede ao enviar logo', 'error');
    })
    .finally(() => { input.value = ''; });
}

function resetSection(sec) {
  if (!confirm('Restaurar os valores padrão desta seção? As edições serão perdidas.')) return;
  state[sec] = JSON.parse(JSON.stringify(DEFAULTS[sec]));
  saveState();
  initPanel();
  toast('Seção restaurada para o padrão', 'success');
}

function exportSection(sec) {
  let title, instructions, code, filename;
  const wa = (get('contato').wa || DEFAULTS.contato.wa);

  if (sec === 'hero') {
    const h = get('hero');
    title = 'Exportar — Seção Hero';
    instructions = 'Substitua o bloco <strong>&lt;section id="inicio"&gt;</strong> no arquivo <code>index.html</code> por este código:';
    filename = 'hero_section.html';
    code = `<!-- ===== HERO ===== -->
<section id="inicio" class="hero">
  <div class="hero-bg">
    <div class="particles" id="particles"></div>
    <div class="hero-overlay"></div>
  </div>
  <div class="container hero-content">
    <p class="hero-tag"><svg class="hero-tag-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg> ${h.tag}</p>
    <h1 class="hero-title">${h.t1}<br /><span class="gold">${h.t2}</span></h1>
    <p class="hero-subtitle">${h.sub}</p>
    <div class="hero-cta-group">
      <a href="#pacotes" class="btn btn-primary">${h.btn}</a>
    </div>
  </div>
  <div class="hero-scroll-hint">
    <span>Role para baixo</span>
    <div class="scroll-arrow"></div>
  </div>
</section>`;
  } else if (sec === 'sobre') {
    const s = get('sobre');
    const st = get('stats');
    title = 'Exportar — Seção Sobre';
    instructions = 'Substitua o bloco <strong>&lt;section id="sobre"&gt;</strong> no arquivo <code>index.html</code>:';
    filename = 'sobre_section.html';
    code = `<!-- ===== SOBRE ===== -->
<section id="sobre" class="section sobre">
  <div class="container">
    <div class="sobre-grid">
      <div class="sobre-text">
        <span class="section-tag">${s.tag}</span>
        <h2 class="section-title">${s.t1}<span class="gold">${s.t2}</span></h2>
        <p>${s.p1}</p>
        <p>${s.p2}</p>
        <p>${s.p3}</p>
        <div class="sobre-stats">
          <div class="stat"><span class="stat-num">${st.eventos}</span><span class="stat-label">Eventos realizados</span></div>
          <div class="stat"><span class="stat-num">${st.anos}</span><span class="stat-label">Anos de experiência</span></div>
          <div class="stat"><span class="stat-num">${st.satisf}</span><span class="stat-label">Clientes satisfeitos</span></div>
        </div>
        <a href="https://wa.me/${wa}" target="_blank" rel="noopener" class="btn btn-primary" id="sobre-whatsapp-btn">Falar com a equipe</a>
      </div>
    </div>
  </div>
</section>`;
  } else if (sec === 'efeitos') {
    const ef = get('efeitos');
    title = 'Exportar — Efeitos';
    instructions = 'Substitua apenas o conteúdo de <strong>&lt;div class="efeitos-grid"&gt;</strong> no <code>index.html</code>:';
    filename = 'efeitos_grid.html';
    code = ef.map(e => `  <div class="efeito-card glass">
    <div class="efeito-icon"><!-- ícone SVG --></div>
    <h3>${e.nome}</h3>
    <p>${e.desc}</p>
    <span class="efeito-tag">${e.tag}</span>
  </div>`).join('\n');
  } else if (sec === 'pacotes') {
    const pac = get('pacotes');
    title = 'Exportar — Pacotes';
    instructions = 'Substitua os 3 cards dentro de <strong>&lt;div class="pacotes-grid"&gt;</strong> no <code>index.html</code>:';
    filename = 'pacotes_cards.html';
    const checkSVG = `<svg class="check-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>`;
    const waSVG = `<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>`;
    code = pac.map((p, i) => {
      const waEncoded = encodeURIComponent(p.waMsg);
      const featured = p.best ? ' featured' : '';
      const btnClass = p.best ? 'btn-primary' : 'btn-outline';
      const badgeClass = p.best ? ' best' : '';
      return `<div class="pacote-card glass${featured}" id="pacote-${i}">
  <div class="pacote-header">
    <span class="pacote-badge${badgeClass}">${p.badge}</span>
    <h3>${p.nome}</h3>
    <p class="pacote-sub">${p.sub}</p>
  </div>
  <ul class="pacote-itens">
${p.itens.map(item => `    <li>${checkSVG} ${item}</li>`).join('\n')}
  </ul>
  <a href="https://wa.me/${wa}?text=${waEncoded}" target="_blank" rel="noopener" class="btn ${btnClass} btn-full">
    ${waSVG}
    ${p.btnTxt}
  </a>
</div>`;
    }).join('\n\n');
  } else if (sec === 'videos') {
    const vids = get('videos');
    title = 'Exportar — Vídeos';
    instructions = 'Substitua o conteúdo de <strong>&lt;div class="videos-grid"&gt;</strong> no <code>index.html</code>:';
    filename = 'videos_grid.html';
    code = vids.map(id => `  <div class="video-thumb" id="yt-${id}" data-id="${id}">
    <img src="https://img.youtube.com/vi/${id}/mqdefault.jpg" alt="Vídeo de evento Sardanelli Produções" loading="lazy" />
    <div class="play-btn"><div class="play-icon"></div></div>
  </div>`).join('\n');
  } else if (sec === 'contato') {
    const c = get('contato');
    title = 'Exportar — Links WhatsApp';
    instructions = 'Substitua todas as ocorrências de números no <code>index.html</code> pelo novo número:';
    filename = 'whatsapp_links.txt';
    code = `NOVO NÚMERO: ${c.wa}\nLINK BASE: https://wa.me/${c.wa}\nINSTAGRAM: ${c.insta}`;
  } else if (sec === 'footer') {
    const f = get('footer');
    const c2 = get('contato');
    title = 'Exportar — Rodapé';
    instructions = 'Substitua o bloco <strong>&lt;footer class="footer"&gt;</strong> no arquivo <code>index.html</code> por este código:';
    filename = 'footer_section.html';
    code = `<!-- ===== FOOTER ===== -->
<footer class="footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <img src="${f.logo}" alt="Sardanelli Produções" class="footer-logo-img" />
    </div>
    <p class="footer-copy">${esc(f.copyright)}</p>
    <div class="footer-links">
      <a href="${c2.insta}" target="_blank" rel="noopener" id="footer-instagram">Instagram</a>
      <a href="https://wa.me/${c2.wa}" target="_blank" rel="noopener" id="footer-whatsapp">WhatsApp</a>
    </div>
  </div>
</footer>`;
  } else if (sec === 'seo') {
    const s = get('seo');
    title = 'Exportar — Meta Tags SEO';
    instructions = 'Substitua as tags no <code>head</code> do <code>index.html</code>:';
    filename = 'meta_tags.html';
    code = `  <meta name="description" content="${s.desc}" />
  <meta name="keywords" content="${s.kw}" />
  <meta property="og:title" content="${s.ogTitle}" />
  <meta property="og:description" content="${s.ogDesc}" />
  <title>${s.title}</title>`;
  }

  openModal(title, instructions, code, filename);
}

function openModal(title, instructions, code, filename) {
  _modalContent = code;
  _modalFilename = filename || 'export.txt';
  document.getElementById('modal-title').textContent = title;
  document.getElementById('modal-instructions').innerHTML = instructions;
  document.getElementById('modal-code').textContent = code;
  document.getElementById('export-modal').classList.add('open');
}
function closeModal() {
  document.getElementById('export-modal').classList.remove('open');
}
function copyModalCode() {
  navigator.clipboard.writeText(_modalContent).then(() => toast('✅ Código copiado!', 'success'));
}
function downloadModalCode() {
  const blob = new Blob([_modalContent], { type: 'text/plain;charset=utf-8' });
  const a = document.createElement('a');
  a.href = URL.createObjectURL(blob);
  a.download = _modalFilename;
  a.click();
  toast('📥 Download iniciado!', 'success');
}

function toast(msg, type = 'success') {
  const container = document.getElementById('toast');
  const el = document.createElement('div');
  el.className = `toast-item ${type}`;
  el.innerHTML = `<div class="ti-dot"></div><span>${msg}</span>`;
  container.appendChild(el);
  setTimeout(() => el.remove(), 3500);
}

function bindHeroPreview() {
  const binds = [
    ['hero-tag', 'prev-hero-tag'],
    ['hero-t1', null, el => document.getElementById('prev-hero-title').innerHTML = el.value + '<br><span style="color:var(--gold);" id="prev-hero-t2">' + (document.getElementById('hero-t2')?.value || '') + '</span>'],
    ['hero-t2', null, el => {
      const t2 = document.getElementById('prev-hero-t2');
      if (t2) t2.textContent = el.value;
    }],
    ['hero-sub', 'prev-hero-sub'],
    ['hero-btn', 'prev-hero-btn'],
  ];
  binds.forEach(([srcId, dstId, fn]) => {
    const src = document.getElementById(srcId);
    if (!src) return;
    src.addEventListener('input', () => {
      if (fn) { fn(src); return; }
      const dst = document.getElementById(dstId);
      if (dst) dst.textContent = src.value;
    });
  });
}

function bindSeoPreview() {
  const title = document.getElementById('seo-title');
  const desc = document.getElementById('seo-desc');
  if (title) title.addEventListener('input', () => {
    document.getElementById('seo-prev-title').textContent = title.value;
    document.getElementById('seo-title-count').textContent = title.value.length;
  });
  if (desc) desc.addEventListener('input', () => {
    document.getElementById('seo-prev-desc').textContent = desc.value;
    document.getElementById('seo-desc-count').textContent = desc.value.length;
  });
}

function bindWaPreview() {
  const wa = document.getElementById('wa-num');
  if (!wa) return;
  wa.addEventListener('input', () => {
    document.getElementById('wa-preview').textContent = `https://wa.me/${wa.value}`;
  });
}

function initPanel() {
  const h = get('hero');
  setVal('hero-tag', h.tag); setVal('hero-t1', h.t1); setVal('hero-t2', h.t2);
  setVal('hero-sub', h.sub); setVal('hero-btn', h.btn);

  const s = get('sobre');
  setVal('sobre-tag', s.tag); setVal('sobre-t1', s.t1); setVal('sobre-t2', s.t2);
  setVal('sobre-p1', s.p1); setVal('sobre-p2', s.p2); setVal('sobre-p3', s.p3);

  const st = get('stats');
  setVal('stat-eventos', st.eventos); setVal('stat-anos', st.anos); setVal('stat-satisf', st.satisf);

  const f = get('footer');
  setVal('footer-copyright', f.copyright);
  const flp = document.getElementById('footer-logo-preview');
  if (flp) flp.src = f.logo;

  syncContatoFields();

  const seo = get('seo');
  setVal('seo-title', seo.title); setVal('seo-desc', seo.desc); setVal('seo-kw', seo.kw);
  setVal('og-title', seo.ogTitle); setVal('og-desc', seo.ogDesc);
  document.getElementById('seo-title-count').textContent = seo.title.length;
  document.getElementById('seo-desc-count').textContent = seo.desc.length;

  renderEfeitos();
  renderPacotes();
  renderVideos();

  bindHeroPreview();
  bindSeoPreview();
  bindWaPreview();

  navigate('dashboard');
}

function v(id) { const el = document.getElementById(id); return el ? el.value : ''; }
function setVal(id, val) { const el = document.getElementById(id); if (el) el.value = val || ''; }
function esc(str) { return String(str).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeModal();
});
</script>
</body>
</html>
