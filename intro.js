/* ===========================
   INTRO.JS — Sardanelli Produções
   Abertura de Efeitos Especiais (5 Segundos de Revelação)
   Efeitos: Fumaça Colorida (Roxa/Dourada), Fogo Frio (Prata), Serpentina & Papel Picado
   Cores do site: Dourado (#ffba00), Roxo (#7b2a87), Fogo Frio (Prata #ffffff)
   Duração: 5 segundos exatos
   =========================== */
(function () {
  var docEl = document.documentElement;
  var preloader = document.getElementById('intro-preloader');
  if (!preloader) return;

  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (reduceMotion) {
    preloader.classList.add('intro-hidden');
    preloader.setAttribute('aria-hidden', 'true');
    return;
  }

  docEl.classList.add('intro-lock');

  // ===== CANVAS SIMULATOR =====
  var canvas = document.getElementById('intro-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');

  var W = window.innerWidth;
  var H = window.innerHeight;
  canvas.width = W;
  canvas.height = H;

  window.addEventListener('resize', function () {
    W = window.innerWidth;
    H = window.innerHeight;
    canvas.width = W;
    canvas.height = H;
  });

  // Colors Palette (NO PINK, NO BLUE)
  var GOLD_COLORS = ['#ffba00', '#ffd140', '#cc9500', '#ff8c00'];
  var PURPLE_COLORS = ['#7b2a87', '#4f1656', '#9c38ab', '#370d3e'];
  var SILVER_COLORS = ['#ffffff', '#f0f4f8', '#e2e8f0', '#cbd5e1'];

  // PARTICLE COLLECTIONS
  var smokeClouds = [];
  var silverSparks = [];
  var confettiList = [];
  var streamerRibbons = [];

  // 1. FUMAÇA COLORIDA (Roxa & Dourada)
  function SmokeCloud(x, y, colorType) {
    this.x = x;
    this.y = y;
    this.radius = 40 + Math.random() * 80;
    this.vx = (Math.random() - 0.5) * 1.5;
    this.vy = - (0.8 + Math.random() * 1.5);
    this.alpha = 0.01;
    this.maxAlpha = 0.15 + Math.random() * 0.22;
    this.colorType = colorType; // 'purple' or 'gold'
    this.growth = 0.4 + Math.random() * 0.8;
    this.life = 0;
    this.maxLife = 180 + Math.random() * 120;
  }
  SmokeCloud.prototype.update = function () {
    this.x += this.vx;
    this.y += this.vy;
    this.radius += this.growth;
    this.life++;
    var progress = this.life / this.maxLife;
    if (progress < 0.3) {
      this.alpha = (progress / 0.3) * this.maxAlpha;
    } else {
      this.alpha = (1 - (progress - 0.3) / 0.7) * this.maxAlpha;
    }
  };
  SmokeCloud.prototype.draw = function () {
    ctx.save();
    ctx.globalAlpha = Math.max(0, this.alpha);
    var grad = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.radius);
    if (this.colorType === 'purple') {
      grad.addColorStop(0, 'rgba(123, 42, 135, 0.6)');
      grad.addColorStop(0.5, 'rgba(79, 22, 86, 0.3)');
      grad.addColorStop(1, 'rgba(13, 11, 18, 0)');
    } else {
      grad.addColorStop(0, 'rgba(255, 186, 0, 0.5)');
      grad.addColorStop(0.6, 'rgba(204, 149, 0, 0.2)');
      grad.addColorStop(1, 'rgba(13, 11, 18, 0)');
    }
    ctx.fillStyle = grad;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
  };

  // 2. FOGO FRIO / FAÍSCAS PRATA (Cold Sparklers)
  function SilverSpark(x, y, vx, vy) {
    this.x = x;
    this.y = y;
    this.vx = vx;
    this.vy = vy;
    this.size = 1.2 + Math.random() * 2.8;
    this.alpha = 0.9 + Math.random() * 0.1;
    this.color = SILVER_COLORS[Math.floor(Math.random() * SILVER_COLORS.length)];
    this.gravity = 0.08 + Math.random() * 0.06;
    this.life = 0;
    this.maxLife = 35 + Math.random() * 35;
  }
  SilverSpark.prototype.update = function () {
    this.x += this.vx;
    this.y += this.vy;
    this.vy += this.gravity;
    this.vx *= 0.98;
    this.alpha *= 0.95;
    this.life++;
  };
  SilverSpark.prototype.draw = function () {
    ctx.save();
    ctx.globalAlpha = Math.max(0, this.alpha);
    ctx.shadowBlur = this.size * 5;
    ctx.shadowColor = '#ffffff';
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
    ctx.fill();
    // Spark tail/line
    ctx.strokeStyle = 'rgba(255, 255, 255, 0.7)';
    ctx.lineWidth = this.size * 0.7;
    ctx.beginPath();
    ctx.moveTo(this.x, this.y);
    ctx.lineTo(this.x - this.vx * 2.5, this.y - this.vy * 2.5);
    ctx.stroke();
    ctx.restore();
  };

  // 3. PAPEL PICADO (Confetti Explosão)
  function Confetti(x, y, color) {
    this.x = x;
    this.y = y;
    this.w = 6 + Math.random() * 8;
    this.h = 10 + Math.random() * 12;
    this.vx = (Math.random() - 0.5) * 16;
    this.vy = - (8 + Math.random() * 14);
    this.rotX = Math.random() * Math.PI * 2;
    this.rotY = Math.random() * Math.PI * 2;
    this.rotZ = Math.random() * Math.PI * 2;
    this.rotSpeedX = (Math.random() - 0.5) * 0.2;
    this.rotSpeedY = (Math.random() - 0.5) * 0.2;
    this.rotSpeedZ = (Math.random() - 0.5) * 0.1;
    this.color = color;
    this.alpha = 1;
    this.gravity = 0.22 + Math.random() * 0.12;
    this.drag = 0.96;
  }
  Confetti.prototype.update = function () {
    this.vx *= this.drag;
    this.vy *= this.drag;
    this.vy += this.gravity;
    this.x += this.vx;
    this.y += this.vy;
    this.rotX += this.rotSpeedX;
    this.rotY += this.rotSpeedY;
    this.rotZ += this.rotSpeedZ;
  };
  Confetti.prototype.draw = function () {
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.rotate(this.rotZ);
    var scaleY = Math.cos(this.rotY);
    var scaleX = Math.sin(this.rotX);
    ctx.scale(scaleX, scaleY);
    ctx.fillStyle = this.color;
    ctx.shadowBlur = 6;
    ctx.shadowColor = this.color;
    ctx.fillRect(-this.w / 2, -this.h / 2, this.w, this.h);
    ctx.restore();
  };

  // 4. SERPENTINA (Ribbon Streams)
  function Streamer(startX, startY, color) {
    this.color = color;
    this.points = [];
    var currX = startX;
    var currY = startY;
    var vx = (Math.random() - 0.5) * 14;
    var vy = - (10 + Math.random() * 12);
    var segs = 35;
    for (var i = 0; i < segs; i++) {
      this.points.push({ x: currX, y: currY });
      currX += vx;
      currY += vy;
      vy += 0.45;
      vx += (Math.random() - 0.5) * 0.8;
    }
    this.width = 4 + Math.random() * 4;
    this.progress = 0;
    this.maxProgress = this.points.length;
    this.alpha = 1;
  }
  Streamer.prototype.update = function () {
    if (this.progress < this.maxProgress) {
      this.progress += 1.5;
    }
    for (var i = 0; i < this.points.length; i++) {
      this.points[i].y += 1.8 + (i * 0.05);
      this.points[i].x += Math.sin((i + this.progress) * 0.15) * 1.5;
    }
  };
  Streamer.prototype.draw = function () {
    var count = Math.min(Math.floor(this.progress), this.points.length);
    if (count < 2) return;
    ctx.save();
    ctx.strokeStyle = this.color;
    ctx.lineWidth = this.width;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    ctx.shadowBlur = 8;
    ctx.shadowColor = this.color;
    ctx.beginPath();
    ctx.moveTo(this.points[0].x, this.points[0].y);
    for (var i = 1; i < count; i++) {
      var p0 = this.points[i - 1];
      var p1 = this.points[i];
      var midX = (p0.x + p1.x) / 2;
      var midY = (p0.y + p1.y) / 2;
      ctx.quadraticCurveTo(p0.x, p0.y, midX, midY);
    }
    ctx.stroke();
    ctx.restore();
  };

  // TIMELINE TRIGGER LOGIC (5 SECONDS)
  var startTime = Date.now();
  var DURATION = 5000; // 5.0 seconds
  var confettiFired = false;
  var streamerFired = false;

  function loop() {
    var elapsed = Date.now() - startTime;
    ctx.clearRect(0, 0, W, H);

    // Phase 1 (0s - 4.5s): Fumaça Roxa & Dourada constante
    if (elapsed < 4200) {
      if (Math.random() < 0.4) {
        var sideX = Math.random() * W;
        var colorType = Math.random() < 0.6 ? 'purple' : 'gold';
        smokeClouds.push(new SmokeCloud(sideX, H + 40, colorType));
      }
    }

    // Phase 1 & 2 (0.3s - 4.2s): Fogo Frio Prata Emitters (Fontes nos dois cantos inferiores)
    if (elapsed > 300 && elapsed < 4200) {
      // Esquerda
      for (var k = 0; k < 4; k++) {
        var angleL = -Math.PI / 2 + (Math.random() - 0.5) * 0.45;
        var speedL = 9 + Math.random() * 9;
        silverSparks.push(new SilverSpark(W * 0.15, H, Math.cos(angleL) * speedL, Math.sin(angleL) * speedL));
      }
      // Direita
      for (var j = 0; j < 4; j++) {
        var angleR = -Math.PI / 2 + (Math.random() - 0.5) * 0.45;
        var speedR = 9 + Math.random() * 9;
        silverSparks.push(new SilverSpark(W * 0.85, H, Math.cos(angleR) * speedR, Math.sin(angleR) * speedR));
      }
      // Centro (após 1.8s)
      if (elapsed > 1800) {
        for (var m = 0; m < 3; m++) {
          var angleC = -Math.PI / 2 + (Math.random() - 0.5) * 0.6;
          var speedC = 10 + Math.random() * 8;
          silverSparks.push(new SilverSpark(W * 0.5, H, Math.cos(angleC) * speedC, Math.sin(angleC) * speedC));
        }
      }
    }

    // Phase 3 (3.0s): DISPARO DE REVELAÇÃO - Papel Picado & Serpentinas!
    if (elapsed > 2800 && !confettiFired) {
      confettiFired = true;
      // Explosão de Papel Picado Dourado, Roxo e Prata
      var confettiColors = GOLD_COLORS.concat(PURPLE_COLORS).concat(SILVER_COLORS);
      for (var c = 0; c < 180; c++) {
        var posX = W * 0.2 + Math.random() * (W * 0.6);
        var posY = H * 0.4 + Math.random() * (H * 0.3);
        confettiList.push(new Confetti(posX, posY, confettiColors[Math.floor(Math.random() * confettiColors.length)]));
      }
    }

    if (elapsed > 3200 && !streamerFired) {
      streamerFired = true;
      // Disparo de Serpentinas do topo
      for (var s = 0; s < 24; s++) {
        var strX = (W * 0.05) + (s / 24) * (W * 0.9);
        var strColor = (s % 2 === 0) ? GOLD_COLORS[s % GOLD_COLORS.length] : PURPLE_COLORS[s % PURPLE_COLORS.length];
        streamerRibbons.push(new Streamer(strX, -20, strColor));
      }
    }

    // UPDATE & DRAW ALL EFFECTS
    // Render Smoke
    for (var i = smokeClouds.length - 1; i >= 0; i--) {
      smokeClouds[i].update();
      smokeClouds[i].draw();
      if (smokeClouds[i].life >= smokeClouds[i].maxLife) {
        smokeClouds.splice(i, 1);
      }
    }

    // Render Cold Sparks
    for (var i = silverSparks.length - 1; i >= 0; i--) {
      silverSparks[i].update();
      silverSparks[i].draw();
      if (silverSparks[i].life >= silverSparks[i].maxLife || silverSparks[i].alpha <= 0.02) {
        silverSparks.splice(i, 1);
      }
    }

    // Render Streamer Ribbons
    for (var i = 0; i < streamerRibbons.length; i++) {
      streamerRibbons[i].update();
      streamerRibbons[i].draw();
    }

    // Render Confetti
    for (var i = 0; i < confettiList.length; i++) {
      confettiList[i].update();
      confettiList[i].draw();
    }

    if (elapsed < DURATION + 800) {
      requestAnimationFrame(loop);
    }
  }

  requestAnimationFrame(loop);

  // TIMEOUT FINAL PARA SAÍDA DA INTRO AOS 5 SEGUNDOS (5000ms)
  setTimeout(function () {
    preloader.classList.add('intro-exit');
    setTimeout(function () {
      preloader.classList.add('intro-hidden');
      docEl.classList.remove('intro-lock');
      preloader.setAttribute('aria-hidden', 'true');
    }, 750);
  }, DURATION);
})();
