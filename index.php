<?php
/**
 * Sardanelli Produções - Página Principal Dinâmica (PHP + JSON)
 */

$CONTENT_FILE = file_exists(__DIR__ . '/data/content.json') ? __DIR__ . '/data/content.json' : __DIR__ . '/data/site_content.json';

// Ler dados dos arquivos JSON com fallback para defaults
$siteContent = [];
if (file_exists($CONTENT_FILE)) {
    $siteContent = json_decode(file_get_contents($CONTENT_FILE), true) ?: [];
}

// Extrair seções
$hero    = $siteContent['hero'] ?? [
    'tag' => 'Desde 2016 transformando momentos em',
    't1' => 'Experiências', 't2' => 'Inesquecíveis',
    'sub' => 'Casamentos, Chás Revelação, Formaturas e Eventos Corporativos com efeitos especiais que encantam e emocionam.',
    'btn' => 'Assista nossos Vídeos'
];

$sobre   = $siteContent['sobre'] ?? [
    'tag' => 'Quem Somos', 't1' => 'Uma história escrita ', 't2' => 'com emoção',
    'p1' => 'A Sardanelli Produções nasceu em <strong>2016</strong> com um propósito claro: transformar eventos em memórias que ficam para sempre gravadas na lembrança de cada convidado.',
    'p2' => 'Fundada por <strong>Murilo Sardanelli</strong>, a empresa cresceu a partir de uma paixão genuína por criar momentos de impacto. Hoje, somos referência em efeitos especiais para eventos na região, reconhecidos pela qualidade técnica, pela organização impecável e pelo cuidado em cada detalhe.',
    'p3' => 'Do chá revelação ao casamento dos sonhos, da formatura emocionante ao evento corporativo marcante, criamos o cenário perfeito para o seu momento especial.'
];

$stats   = $siteContent['stats'] ?? ['eventos' => '+500', 'anos' => '8+', 'satisf' => '100%'];
$efeitos = $siteContent['efeitos'] ?? [
    ['nome' => 'Rastro de Céu Noturno', 'desc' => 'Uso recomendado: Noturno, local aberto.', 'tag' => 'Noturno'],
    ['nome' => 'Rastro de Céu Diurno', 'desc' => 'Uso recomendado: Diurno, local aberto.', 'tag' => 'Diurno'],
    ['nome' => 'Disparador de Serpentina', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', 'tag' => 'Versátil'],
    ['nome' => 'Disparador de Papel Colorido', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', 'tag' => 'Versátil'],
    ['nome' => 'Fumaça Colorida', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto.', 'tag' => 'Impacto visual'],
    ['nome' => 'Disparador de Pó Colorido', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto.', 'tag' => 'Colorido'],
    ['nome' => 'Simulador de Faíscas', 'desc' => 'Uso recomendado: Diurno ou noturno, local aberto ou fechado.', 'tag' => 'Premium'],
    ['nome' => 'Disparos de Comemoração', 'desc' => 'Efeito sonoro e visual para comemoração. Diurno ou noturno, aberto ou fechado.', 'tag' => 'Explosivo']
];

$pacotes = $siteContent['pacotes'] ?? [];
$videos  = $siteContent['videos'] ?? ['nYcqAYoVNEg','WySiyUZ_TZ0','SrEQbd28EPo','1izdP3T-qGs','TWwZjAx42Uk','v2cInNWsd5A','KwutXIYu1fI','HUveuBzkBZw'];
$contato = $siteContent['contato'] ?? ['wa' => '5516993950765', 'insta' => 'https://www.instagram.com/sardanelliproducoes/'];
$footer  = $siteContent['footer'] ?? [
    'logo' => 'intro-logo.png',
    'copyright' => '© ' . date('Y') . ' Sardanelli Produções. Todos os direitos reservados.'
];
$seo     = $siteContent['seo'] ?? [
    'title' => 'Sardanelli Produções | Efeitos Especiais para Eventos',
    'desc' => 'Sardanelli Produções — Efeitos especiais para casamentos, chás revelação, formaturas e eventos corporativos. Transformamos momentos em experiências inesquecíveis desde 2016.',
    'kw' => 'efeitos especiais casamento, chá revelação, fumaça colorida, faíscas frias, serpentina, papel picado, eventos, Sardanelli Produções',
    'ogTitle' => 'Sardanelli Produções',
    'ogDesc' => 'Transformamos eventos em experiências inesquecíveis desde 2016.'
];

$waLink = "https://wa.me/" . htmlspecialchars($contato['wa'] ?? '5516993950765');
$instaLink = htmlspecialchars($contato['insta'] ?? 'https://www.instagram.com/sardanelliproducoes/');
$footerLogo = htmlspecialchars($footer['logo'] ?? 'intro-logo.png');
$footerCopy = htmlspecialchars($footer['copyright'] ?? ('© ' . date('Y') . ' Sardanelli Produções. Todos os direitos reservados.'));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= htmlspecialchars($seo['desc']) ?>" />
  <meta name="keywords" content="<?= htmlspecialchars($seo['kw']) ?>" />
  <meta property="og:title" content="<?= htmlspecialchars($seo['ogTitle']) ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($seo['ogDesc']) ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.sardanelli.com.br/" />
  <title><?= htmlspecialchars($seo['title']) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/png" href="favicon.png" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="intro.css" />
</head>
<body>

  <!-- ===== INTRO / PRELOADER REVELAÇÃO ===== -->
  <div id="intro-preloader">
    <canvas id="intro-canvas"></canvas>
    <div class="intro-grid"></div>
    <div class="intro-content">
      <div class="intro-rings">
        <div class="intro-ring intro-ring-1"></div>
        <div class="intro-ring intro-ring-2"></div>
        <div class="intro-ring intro-ring-3"></div>
        <div class="intro-logo-wrap">
          <div class="intro-logo-glow"></div>
          <img src="intro-logo.png" alt="Sardanelli Produções" class="intro-logo-img" />
        </div>
      </div>
    </div>
  </div>

  <!-- ===== HEADER / NAV ===== -->
  <header id="header">
    <div class="container header-inner">
      <a href="#inicio" class="logo"><img src="logo.png" alt="Sardanelli Produções"></a>
      <button class="nav-toggle" id="nav-toggle" aria-label="Abrir menu">
        <span></span><span></span><span></span>
      </button>
      <nav id="main-nav">
        <ul>
          <li><a href="#inicio" class="nav-link">Início</a></li>
          <li><a href="#sobre" class="nav-link">Quem Somos</a></li>
          <li><a href="#videos" class="nav-link">Vídeos</a></li>
          <li><a href="#efeitos" class="nav-link">Efeitos</a></li>
          <li><a href="#pacotes" class="nav-link">Pacotes</a></li>
          <li><a href="#contato" class="nav-link" id="cta-nav-btn">Orçamento</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- ===== HERO ===== -->
  <section id="inicio" class="hero">
    <div class="hero-bg">
      <div class="particles" id="particles"></div>
      <div class="hero-overlay"></div>
    </div>
    <div class="container hero-content">
      <p class="hero-tag"><svg class="hero-tag-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg> <?= htmlspecialchars($hero['tag']) ?></p>
      <h1 class="hero-title"><?= htmlspecialchars($hero['t1']) ?><br /><span class="gold"><?= htmlspecialchars($hero['t2']) ?></span></h1>
      <p class="hero-subtitle"><?= htmlspecialchars($hero['sub']) ?></p>
      <div class="hero-cta-group">
        <a href="#videos" class="btn btn-primary"><?= htmlspecialchars($hero['btn']) ?></a>
      </div>
    </div>
    <div class="hero-scroll-hint">
      <span>Role para baixo</span>
      <div class="scroll-arrow"></div>
    </div>
  </section>

  <!-- ===== SOBRE ===== -->
  <section id="sobre" class="section sobre">
    <div class="container">
      <div class="sobre-grid">
        <div class="sobre-text">
          <span class="section-tag"><?= htmlspecialchars($sobre['tag']) ?></span>
          <h2 class="section-title"><?= htmlspecialchars($sobre['t1']) ?><span class="gold"><?= htmlspecialchars($sobre['t2']) ?></span></h2>
          <p><?= $sobre['p1'] ?></p>
          <p><?= $sobre['p2'] ?></p>
          <p><?= $sobre['p3'] ?></p>
          <div class="sobre-stats">
            <div class="stat">
              <span class="stat-num"><?= htmlspecialchars($stats['eventos']) ?></span>
              <span class="stat-label">Eventos realizados</span>
            </div>
            <div class="stat">
              <span class="stat-num"><?= htmlspecialchars($stats['anos']) ?></span>
              <span class="stat-label">Anos de experiência</span>
            </div>
            <div class="stat">
              <span class="stat-num"><?= htmlspecialchars($stats['satisf']) ?></span>
              <span class="stat-label">Clientes satisfeitos</span>
            </div>
          </div>
          <a href="<?= $waLink ?>" target="_blank" rel="noopener" class="btn btn-primary" id="sobre-whatsapp-btn">Falar com a equipe</a>
        </div>
        <div class="sobre-visual">
          <div class="sobre-card glass">
            <div class="sobre-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/></svg></div>
            <h3>Efeitos Especiais</h3>
            <p>Faíscas frias, fumaça colorida, serpentinas e muito mais para criar o impacto visual perfeito.</p>
          </div>
          <div class="sobre-card glass">
            <div class="sobre-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg></div>
            <h3>Casamentos</h3>
            <p>Entradas, saídas e momentos únicos que ficam eternizados nas fotos e na memória dos convidados.</p>
          </div>
          <div class="sobre-card glass">
            <div class="sobre-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg></div>
            <h3>Chá Revelação</h3>
            <p>O grande momento da revelação com efeitos de fumaça e pó colorido que encantam a todos.</p>
          </div>
          <div class="sobre-card glass">
            <div class="sobre-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg></div>
            <h3>Formaturas</h3>
            <p>Comemore cada conquista com um show de luzes, serpentinas e efeitos que marcam essa vitória.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== VÍDEOS ===== -->
  <section id="videos" class="section videos">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Em Ação</span>
        <h2 class="section-title">Veja a magia <span class="gold">acontecer</span></h2>
        <p class="section-desc">Assista aos nossos vídeos e sinta a energia de um show de efeitos especiais Sardanelli Produções.</p>
      </div>
      <div class="videos-grid" id="videos-grid">
        <?php foreach ($videos as $vId): if (empty(trim($vId))) continue; ?>
        <div class="video-card glass" data-video-id="<?= htmlspecialchars(trim($vId)) ?>">
          <div class="video-thumb-wrap">
            <img src="https://img.youtube.com/vi/<?= htmlspecialchars(trim($vId)) ?>/hqdefault.jpg" alt="Vídeo Sardanelli Produções" loading="lazy" />
            <button class="video-play-btn" aria-label="Reproduzir vídeo">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
            </button>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ===== EFEITOS ===== -->
  <section id="efeitos" class="section efeitos">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Nosso Arsenal</span>
        <h2 class="section-title">Efeitos que <span class="gold">encantam</span></h2>
        <p class="section-desc">Cada efeito é escolhido com precisão para criar o impacto visual certo no momento certo.</p>
      </div>
      <div class="efeitos-grid">
        <?php foreach ($efeitos as $e): ?>
        <div class="efeito-card glass">
          <div class="efeito-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg></div>
          <h3><?= htmlspecialchars($e['nome']) ?></h3>
          <p><?= htmlspecialchars($e['desc']) ?></p>
          <span class="efeito-tag"><?= htmlspecialchars($e['tag']) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ===== PACOTES ===== -->
  <section id="pacotes" class="section pacotes">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Opções</span>
        <h2 class="section-title">Escolha o seu <span class="gold">Show</span></h2>
        <p class="section-desc">Pacotes montados para atender desde momentos mais intimos até grandes comemorações.</p>
      </div>
      <div class="pacotes-grid">
        <?php foreach ($pacotes as $p): ?>
        <div class="pacote-card glass <?= !empty($p['best']) ? 'featured' : '' ?>">
          <?php if (!empty($p['badge'])): ?>
          <span class="pacote-badge"><?= htmlspecialchars($p['badge']) ?></span>
          <?php endif; ?>
          <h3 class="pacote-title"><?= htmlspecialchars($p['nome']) ?></h3>
          <p class="pacote-desc"><?= htmlspecialchars($p['sub']) ?></p>
          <ul class="pacote-features">
            <?php foreach (($p['itens'] ?? []) as $item): ?>
            <li><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg> <?= htmlspecialchars($item) ?></li>
            <?php endforeach; ?>
          </ul>
          <?php 
            $waMsg = urlencode($p['waMsg'] ?? 'Olá! Quero mais informações sobre os pacotes.');
            $pWaLink = "https://wa.me/" . htmlspecialchars($contato['wa'] ?? '5516993950765') . "?text=" . $waMsg;
          ?>
          <a href="<?= $pWaLink ?>" target="_blank" rel="noopener" class="btn <?= !empty($p['best']) ? 'btn-primary' : 'btn-outline' ?>"><?= htmlspecialchars($p['btnTxt'] ?? 'Quero este Pacote') ?></a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>


  <!-- ===== VÍDEO MODAL ===== -->
  <div id="video-modal" class="video-modal" role="dialog" aria-modal="true" aria-label="Reprodutor de vídeo">
    <div class="modal-backdrop" id="modal-backdrop"></div>
    <div class="modal-content">
      <button class="modal-close" id="modal-close" aria-label="Fechar vídeo">&times;</button>
      <div class="iframe-wrap">
        <iframe id="modal-iframe" src="" title="Vídeo do YouTube" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <!-- ===== CONTATO / CTA ===== -->
  <section id="contato" class="section contato">
    <div class="container">
      <div class="contato-box glass">
        <span class="section-tag">Orçamento</span>
        <h2 class="section-title">Pronto para transformar seu <span class="gold">evento?</span></h2>
        <p>Entre em contato pelo WhatsApp e solicite um orçamento personalizado para o seu momento especial.</p>
        <div class="contato-cta">
          <a href="<?= $waLink ?>" target="_blank" rel="noopener" class="btn btn-primary" id="contato-whatsapp-btn">
            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M12.012 2c-5.508 0-9.989 4.481-9.989 9.989 0 1.764.459 3.483 1.332 5.002l-1.417 5.176 5.297-1.389c1.472.803 3.134 1.226 4.777 1.226 5.507 0 9.988-4.481 9.988-9.989 0-5.508-4.481-9.989-9.988-9.989zm5.82 14.221c-.246.691-1.434 1.321-1.984 1.365-.506.04-1.161.181-3.774-.871-3.328-1.339-5.467-4.722-5.632-4.945-.166-.223-1.348-1.796-1.348-3.424 0-1.628.847-2.427 1.152-2.756.305-.33.666-.413.888-.413.222 0 .444.002.639.01.207.008.486-.078.761.583.282.677.96 2.348 1.043 2.518.083.17.139.37.028.591-.111.222-.167.36-.333.555-.167.195-.351.436-.501.586-.167.167-.341.348-.147.681.194.333.864 1.426 1.854 2.308 1.272 1.134 2.345 1.485 2.678 1.652.333.167.528.139.722-.083.194-.222.833-.972 1.055-1.305.222-.333.444-.278.749-.167.305.111 1.944.917 2.277 1.083.333.167.555.25.639.389.083.139.083.805-.163 1.496z"/></svg>
            Chamar no WhatsApp
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
  <footer id="footer" class="footer">
    <div class="container footer-inner">
      <div class="footer-brand">
        <img src="<?= $footerLogo ?>" alt="Sardanelli Produções" class="footer-logo-img" />
      </div>
      <p class="footer-copy"><?= $footerCopy ?></p>
      <div class="footer-links">
        <a href="<?= $instaLink ?>" target="_blank" rel="noopener" id="footer-instagram">Instagram</a>
        <a href="<?= $waLink ?>" target="_blank" rel="noopener" id="footer-whatsapp">WhatsApp</a>
      </div>
    </div>
  </footer>

  <!-- Botão Flutuante do WhatsApp -->
  <a href="<?= $waLink ?>" target="_blank" rel="noopener" class="whatsapp-float" id="whatsapp-float" aria-label="Conversar no WhatsApp">
    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.012 2c-5.508 0-9.989 4.481-9.989 9.989 0 1.764.459 3.483 1.332 5.002l-1.417 5.176 5.297-1.389c1.472.803 3.134 1.226 4.777 1.226 5.507 0 9.988-4.481 9.988-9.989 0-5.508-4.481-9.989-9.988-9.989zm5.82 14.221c-.246.691-1.434 1.321-1.984 1.365-.506.04-1.161.181-3.774-.871-3.328-1.339-5.467-4.722-5.632-4.945-.166-.223-1.348-1.796-1.348-3.424 0-1.628.847-2.427 1.152-2.756.305-.33.666-.413.888-.413.222 0 .444.002.639.01.207.008.486-.078.761.583.282.677.96 2.348 1.043 2.518.083.17.139.37.028.591-.111.222-.167.36-.333.555-.167.195-.351.436-.501.586-.167.167-.341.348-.147.681.194.333.864 1.426 1.854 2.308 1.272 1.134 2.345 1.485 2.678 1.652.333.167.528.139.722-.083.194-.222.833-.972 1.055-1.305.222-.333.444-.278.749-.167.305.111 1.944.917 2.277 1.083.333.167.555.25.639.389.083.139.083.805-.163 1.496z"/></svg>
  </a>

  <script src="intro.js"></script>
  <script src="script.js"></script>
</body>
</html>
