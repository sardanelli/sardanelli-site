/* ===========================
   SCRIPT.JS — Sardanelli Produções
   =========================== */

// ====== PARTICLES (HERO) ======
(function createParticles() {
  const container = document.getElementById('particles');
  if (!container) return;
  const colors = ['#ffba00', '#ffd140', '#ff8c00', '#ffffff', '#cc9500', '#ffba00', '#7b2a87'];
  const count = window.innerWidth < 768 ? 70 : 160;

  for (let i = 0; i < count; i++) {
    const p = document.createElement('div');
    p.classList.add('particle');
    const size = 1.5 + Math.random() * 5;
    const color = colors[Math.floor(Math.random() * colors.length)];
    const left = Math.random() * 100;
    const duration = 6 + Math.random() * 16;
    const delay = Math.random() * 12;

    p.style.cssText = `
      width: ${size}px;
      height: ${size}px;
      left: ${left}%;
      bottom: -10px;
      background: ${color};
      animation-duration: ${duration}s;
      animation-delay: ${delay}s;
      box-shadow: 0 0 ${size * 3}px ${color};
    `;
    container.appendChild(p);
  }
})();

// ====== MOUSE TRAILING PARTICLES ======
(function initMouseTrail() {
  const canvas = document.createElement('canvas');
  canvas.id = 'mouse-trail-canvas';
  canvas.style.cssText = `
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    z-index: 9998;
    mix-blend-mode: screen;
  `;
  document.body.appendChild(canvas);

  const ctx = canvas.getContext('2d');
  let W = window.innerWidth;
  let H = window.innerHeight;
  canvas.width = W;
  canvas.height = H;

  window.addEventListener('resize', () => {
    W = window.innerWidth;
    H = window.innerHeight;
    canvas.width = W;
    canvas.height = H;
  });

  const mouse = { x: W / 2, y: H / 2, active: false };
  const trailParticles = [];

  const COLORS = ['#ffba00', '#ffd140', '#ff8c00', '#cc9500', '#7b2a87', '#ffffff'];

  class TrailParticle {
    constructor(x, y) {
      this.x = x + (Math.random() - 0.5) * 12;
      this.y = y + (Math.random() - 0.5) * 12;
      this.vx = (Math.random() - 0.5) * 1.8;
      this.vy = (Math.random() - 0.5) * 1.8 - 0.6;
      this.size = 1 + Math.random() * 3.5;
      this.alpha = 0.85 + Math.random() * 0.15;
      this.color = COLORS[Math.floor(Math.random() * COLORS.length)];
      this.life = 0;
      this.maxLife = 28 + Math.random() * 28;
      this.shrink = 0.94 + Math.random() * 0.04;
    }
    update() {
      this.x += this.vx;
      this.y += this.vy;
      this.vy += 0.02;
      this.vx *= 0.97;
      this.size *= this.shrink;
      this.alpha *= 0.93;
      this.life++;
    }
    draw() {
      ctx.save();
      ctx.globalAlpha = this.alpha;
      ctx.shadowBlur = this.size * 4;
      ctx.shadowColor = this.color;
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(this.x, this.y, Math.max(0.1, this.size), 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
    }
    isDead() {
      return this.life > this.maxLife || this.size < 0.15 || this.alpha < 0.01;
    }
  }

  window.addEventListener('mousemove', (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
    mouse.active = true;

    // spawn particles on move
    const spawnCount = 2 + Math.floor(Math.random() * 2);
    for (let i = 0; i < spawnCount; i++) {
      trailParticles.push(new TrailParticle(mouse.x, mouse.y));
    }
  });

  let frame = 0;
  function animateTrail() {
    ctx.clearRect(0, 0, W, H);

    // Idle glimmer: spawn a few particles at cursor even without movement
    if (mouse.active && frame % 4 === 0) {
      trailParticles.push(new TrailParticle(mouse.x, mouse.y));
    }

    for (let i = trailParticles.length - 1; i >= 0; i--) {
      trailParticles[i].update();
      trailParticles[i].draw();
      if (trailParticles[i].isDead()) trailParticles.splice(i, 1);
    }

    // cap to avoid unbounded growth
    if (trailParticles.length > 300) trailParticles.splice(0, trailParticles.length - 300);

    frame++;
    requestAnimationFrame(animateTrail);
  }
  animateTrail();
})();

// ====== HEADER SCROLL ======
const header = document.getElementById('header');
let lastScroll = 0;

window.addEventListener('scroll', () => {
  const currentScroll = window.scrollY;
  if (currentScroll > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
  lastScroll = currentScroll;
}, { passive: true });

// ====== MOBILE NAV TOGGLE ======
const navToggle = document.getElementById('nav-toggle');
const mainNav = document.getElementById('main-nav');

navToggle.addEventListener('click', () => {
  mainNav.classList.toggle('open');
  const isOpen = mainNav.classList.contains('open');
  navToggle.setAttribute('aria-expanded', isOpen);
  const spans = navToggle.querySelectorAll('span');
  if (isOpen) {
    spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
    spans[1].style.opacity = '0';
    spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
  } else {
    spans[0].style.transform = '';
    spans[1].style.opacity = '';
    spans[2].style.transform = '';
  }
});

document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', () => {
    mainNav.classList.remove('open');
    const spans = navToggle.querySelectorAll('span');
    spans[0].style.transform = '';
    spans[1].style.opacity = '';
    spans[2].style.transform = '';
  });
});

// ====== ACTIVE NAV LINK ON SCROLL ======
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-link');

const sectionObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const id = entry.target.id;
      navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${id}`) {
          link.classList.add('active');
        }
      });
    }
  });
}, { rootMargin: '-40% 0px -55% 0px', threshold: 0 });

sections.forEach(s => sectionObserver.observe(s));

// ====== FUTURISTIC SCROLL ANIMATIONS ======
// Assign animation types to elements
function assignScrollAnimations() {
  // Hero elements — already visible
  document.querySelectorAll('.hero-tag, .hero-title, .hero-subtitle, .hero-cta-group').forEach((el, i) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(32px)';
    el.style.transition = `opacity 0.8s cubic-bezier(0.16,1,0.3,1) ${i * 0.12}s, transform 0.8s cubic-bezier(0.16,1,0.3,1) ${i * 0.12}s`;
    setTimeout(() => {
      el.style.opacity = '1';
      el.style.transform = 'translateY(0)';
    }, 200 + i * 120);
  });

  // Cards — staggered slide + fade
  document.querySelectorAll('.efeito-card').forEach((el, i) => {
    el.classList.add('scroll-reveal', 'reveal-up');
    el.style.transitionDelay = `${(i % 4) * 80}ms`;
  });

  document.querySelectorAll('.pacote-card').forEach((el, i) => {
    el.classList.add('scroll-reveal', 'reveal-scale');
    el.style.transitionDelay = `${i * 100}ms`;
  });

  document.querySelectorAll('.sobre-card').forEach((el, i) => {
    el.classList.add('scroll-reveal', i % 2 === 0 ? 'reveal-left' : 'reveal-right');
    el.style.transitionDelay = `${i * 80}ms`;
  });

  document.querySelectorAll('.video-thumb').forEach((el, i) => {
    el.classList.add('scroll-reveal', 'reveal-up');
    el.style.transitionDelay = `${(i % 4) * 90}ms`;
  });

  document.querySelectorAll('.personalizado-card').forEach(el => {
    el.classList.add('scroll-reveal', 'reveal-up');
  });

  document.querySelectorAll('.contato-inner').forEach(el => {
    el.classList.add('scroll-reveal', 'reveal-scale');
  });

  // Section headers
  document.querySelectorAll('.section-header').forEach(el => {
    el.classList.add('scroll-reveal', 'reveal-up');
  });

  document.querySelectorAll('.sobre-text').forEach(el => {
    el.classList.add('scroll-reveal', 'reveal-left');
  });

  document.querySelectorAll('.sobre-visual').forEach(el => {
    el.classList.add('scroll-reveal', 'reveal-right');
  });

  // Stats
  document.querySelectorAll('.stat').forEach((el, i) => {
    el.classList.add('scroll-reveal', 'reveal-up');
    el.style.transitionDelay = `${i * 100}ms`;
  });
}

function initScrollObserver() {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
        // Particle burst when section title becomes visible
        if (entry.target.classList.contains('section-header')) {
          spawnSectionBurst(entry.target);
        }
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.12,
    rootMargin: '0px 0px -60px 0px'
  });

  document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
}

// Mini particle burst effect when a section title appears
function spawnSectionBurst(el) {
  const rect = el.getBoundingClientRect();
  const cx = rect.left + rect.width / 2;
  const cy = rect.top + rect.height / 2;
  const canvas = document.getElementById('mouse-trail-canvas');
  if (!canvas) return;
  // Dispatch a synthetic burst via a custom event the trail system picks up
  window.dispatchEvent(new CustomEvent('section-burst', { detail: { x: cx, y: cy } }));
}

assignScrollAnimations();
initScrollObserver();

// ====== VIDEO MODAL ======
const modal = document.getElementById('video-modal');
const modalIframe = document.getElementById('modal-iframe');
const modalCloseBtn = document.getElementById('modal-close-btn');
const modalBackdrop = document.getElementById('modal-backdrop');

function openModal(videoId) {
  modalIframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
  modal.classList.add('active');
  document.body.style.overflow = 'hidden';
  modalCloseBtn.focus();
}

function closeModal() {
  modal.classList.remove('active');
  setTimeout(() => { modalIframe.src = ''; }, 300);
  document.body.style.overflow = '';
}

document.querySelectorAll('.video-thumb').forEach(thumb => {
  thumb.addEventListener('click', () => { openModal(thumb.dataset.id); });
  thumb.setAttribute('tabindex', '0');
  thumb.setAttribute('role', 'button');
  thumb.setAttribute('aria-label', 'Reproduzir vídeo');
  thumb.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openModal(thumb.dataset.id); }
  });
});

modalCloseBtn.addEventListener('click', closeModal);
modalBackdrop.addEventListener('click', closeModal);
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

// ====== SMOOTH SCROLL OFFSET ======
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', (e) => {
    const target = document.querySelector(anchor.getAttribute('href'));
    if (!target) return;
    e.preventDefault();
    const headerH = header.offsetHeight;
    const top = target.getBoundingClientRect().top + window.scrollY - headerH - 16;
    window.scrollTo({ top, behavior: 'smooth' });
  });
});

// ====== PACKAGES HOVER GLOW ======
document.querySelectorAll('.pacote-card').forEach(card => {
  card.addEventListener('mousemove', (e) => {
    const rect = card.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width) * 100;
    const y = ((e.clientY - rect.top) / rect.height) * 100;
    card.style.setProperty('--mouse-x', `${x}%`);
    card.style.setProperty('--mouse-y', `${y}%`);
  });
});

// ====== STAT NUMBER COUNTER ANIMATION ======
function animateCounter(el) {
  const text = el.textContent.trim();
  const prefix = text.match(/^[+]?/)?.[0] || '';
  const suffix = text.match(/[^0-9]+$/)?.[0] || '';
  const num = parseInt(text.replace(/[^0-9]/g, ''), 10);
  if (isNaN(num)) return;

  let start = 0;
  const duration = 1400;
  const startTime = performance.now();

  function step(now) {
    const elapsed = now - startTime;
    const progress = Math.min(elapsed / duration, 1);
    // Ease out cubic
    const eased = 1 - Math.pow(1 - progress, 3);
    const current = Math.round(eased * num);
    el.textContent = prefix + current + suffix;
    if (progress < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      animateCounter(entry.target);
      counterObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('.stat-num').forEach(el => counterObserver.observe(el));

console.log('🎆 Sardanelli Produções — carregado com sucesso!');
