
/* ══════════════════════════════════════════════
   MAIN.JS — bEdge Tech Services
   Enhanced animation & interaction layer
══════════════════════════════════════════════ */

/* ══════════════════════════════════════════════
   PAGE TRANSITION SYSTEM — SPLIT PANELS
══════════════════════════════════════════════ */
(function () {
  // ── Build the transition DOM ──
  function buildTransition() {
    const wrap = document.createElement('div');
    wrap.className = 'page-transition';
    wrap.id = 'pageTransition';

    const top = document.createElement('div');
    top.className = 'pt-panel pt-top';

    const bottom = document.createElement('div');
    bottom.className = 'pt-panel pt-bottom';

    const logo = document.createElement('div');
    logo.className = 'pt-logo';
    logo.innerHTML = 'CLOUD<span>edge</span><span class="pt-logo-dot"></span>';

    wrap.appendChild(top);
    wrap.appendChild(bottom);
    document.body.prepend(wrap);
    document.body.prepend(logo);    // stays above panels in fixed stacking
    logo.id = 'ptLogo';

    return { wrap, logo };
  }

  // ── PAGE ENTER (on load) ──
  const { wrap, logo } = buildTransition();
  wrap.classList.add('pt-enter');
  logo.classList.add('pt-logo'); // already set

  // Remove once animation is done (0.55 delay + 0.75 anim = 1.3s)
  setTimeout(() => {
    wrap.remove();
    logo.remove();
  }, 1400);


  // ── PAGE LEAVE (on navigation click) ──
  function triggerLeave(href) {
    const { wrap: leaveWrap, logo: leaveLogo } = buildTransition();
    leaveWrap.classList.add('pt-leave');

    // Logo fades in after panels meet (0.3s delay)
    setTimeout(() => {
      leaveLogo.style.opacity = '1';
    }, 300);

    // Navigate after panels have fully covered the page (0.55s)
    setTimeout(() => {
      window.location.href = href;
    }, 600);
  }

  // Intercept all internal page-to-page links (not hash anchors, not external)
  document.addEventListener('click', function (e) {
    const link = e.target.closest('a[href]');
    if (!link) return;

    const href = link.getAttribute('href');
    if (!href) return;

    const isHash = href.startsWith('#');
    const isExternal = href.startsWith('http') && !href.includes(window.location.hostname);
    const isNewTab = link.target === '_blank';
    const isMailto = href.startsWith('mailto:') || href.startsWith('tel:');

    if (isHash || isExternal || isNewTab || isMailto) return;

    e.preventDefault();
    triggerLeave(href);
  });
})();


/* ── CUSTOM CURSOR ── */
const cursor = document.getElementById('cursor');
const ring = document.getElementById('cursorRing');
let mx = 0, my = 0, rx = 0, ry = 0;

document.addEventListener('mousemove', e => {
  mx = e.clientX; my = e.clientY;
  cursor.style.left = mx + 'px';
  cursor.style.top = my + 'px';
});

function animateRing() {
  rx += (mx - rx) * 0.12;
  ry += (my - ry) * 0.12;
  ring.style.left = rx + 'px';
  ring.style.top = ry + 'px';
  requestAnimationFrame(animateRing);
}
animateRing();

document.querySelectorAll('a, button, .service-card').forEach(el => {
  el.addEventListener('mouseenter', () => {
    cursor.style.width = '20px'; cursor.style.height = '20px';
    ring.style.width = '60px'; ring.style.height = '60px';
    ring.style.borderColor = 'rgba(168,85,247,0.55)';
  });
  el.addEventListener('mouseleave', () => {
    cursor.style.width = '10px'; cursor.style.height = '10px';
    ring.style.width = '40px'; ring.style.height = '40px';
    ring.style.borderColor = 'rgba(168,85,247,0.35)';
  });
});


/* ── NAVBAR ── */
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 50);
});

/* ── MOBILE NAV ── */
const toggle = document.getElementById('navToggle');
const navLinks = document.getElementById('navLinks');
toggle.addEventListener('click', () => {
  navLinks.classList.toggle('open');
  const bars = toggle.querySelectorAll('.bar');
  if (navLinks.classList.contains('open')) {
    bars[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
    bars[1].style.opacity = '0';
    bars[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
  } else {
    bars.forEach(b => { b.style.transform = ''; b.style.opacity = ''; });
  }
});
navLinks.querySelectorAll('a').forEach(a => {
  a.addEventListener('click', () => {
    navLinks.classList.remove('open');
    toggle.querySelectorAll('.bar').forEach(b => { b.style.transform = ''; b.style.opacity = ''; });
  });
});


/* ── PARTICLE CANVAS ── */
(function () {
  const hero = document.querySelector('.hero');
  if (!hero) return;

  const canvas = document.createElement('canvas');
  canvas.id = 'particle-canvas';
  hero.appendChild(canvas);
  const ctx = canvas.getContext('2d');

  function resize() {
    canvas.width = hero.offsetWidth;
    canvas.height = hero.offsetHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  const particles = [];
  const count = 60;

  class Particle {
    constructor() { this.reset(); }
    reset() {
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
      this.r = Math.random() * 1.5 + 0.3;
      this.vx = (Math.random() - 0.5) * 0.3;
      this.vy = -(Math.random() * 0.4 + 0.15);
      this.life = 0;
      this.max = Math.random() * 200 + 100;
      this.color = Math.random() > 0.5
        ? `rgba(59,130,246,`
        : `rgba(200,241,53,`;
    }
    update() {
      this.x += this.vx;
      this.y += this.vy;
      this.life++;
      if (this.life > this.max) this.reset();
    }
    draw() {
      const alpha = Math.sin((this.life / this.max) * Math.PI) * 0.5;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
      ctx.fillStyle = this.color + alpha + ')';
      ctx.fill();
    }
  }

  for (let i = 0; i < count; i++) {
    const p = new Particle();
    p.life = Math.random() * p.max; // stagger starts
    particles.push(p);
  }

  // Connection lines between nearby particles
  function drawConnections() {
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 80) {
          const alpha = (1 - dist / 80) * 0.08;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(59,130,246,${alpha})`;
          ctx.lineWidth = 0.5;
          ctx.stroke();
        }
      }
    }
  }

  function loop() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawConnections();
    particles.forEach(p => { p.update(); p.draw(); });
    requestAnimationFrame(loop);
  }
  loop();
})();


/* ── MAGNETIC BUTTONS ── */
document.querySelectorAll('.btn-main, .btn-ghost').forEach(btn => {
  btn.addEventListener('mousemove', e => {
    const rect = btn.getBoundingClientRect();
    const cx = rect.left + rect.width / 2;
    const cy = rect.top + rect.height / 2;
    const dx = (e.clientX - cx) * 0.25;
    const dy = (e.clientY - cy) * 0.25;
    btn.style.transform = `translate(${dx}px, ${dy}px) translateY(-2px)`;
  });
  btn.addEventListener('mouseleave', () => {
    btn.style.transform = '';
  });
});


/* ── COUNTERS ── */
function countTo(el, target, suffix, decimals = 0) {
  const dur = 2200;
  const start = performance.now();
  function step(now) {
    const t = Math.min((now - start) / dur, 1);
    const ease = 1 - Math.pow(1 - t, 4); // stronger ease-out
    const val = target * ease;
    const disp = decimals ? val.toFixed(decimals) : Math.floor(val);
    const sym = target >= 99 ? '%' : '+';
    el.innerHTML = disp + suffix + '<span class="plus">' + sym + '</span>';

    // scale pop on completion
    if (t >= 1) {
      el.style.transform = 'scale(1.12)';
      setTimeout(() => { el.style.transform = ''; }, 200);
    } else {
      requestAnimationFrame(step);
    }
  }
  requestAnimationFrame(step);
}

const countersTriggered = { stat1: false, stat2: false, stat3: false };
const counterObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting && !countersTriggered[e.target.id]) {
      countersTriggered[e.target.id] = true;
      if (e.target.id === 'stat1') countTo(e.target, 500, '', 0);
      if (e.target.id === 'stat2') countTo(e.target, 99.9, '', 1);
      if (e.target.id === 'stat3') countTo(e.target, 3, '', 0);
    }
  });
}, { threshold: 0.5 });
['stat1', 'stat2', 'stat3'].forEach(id => {
  const el = document.getElementById(id);
  if (el) counterObs.observe(el);
});


/* ── SCROLL REVEAL (enhanced) ── */
const revealObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('visible');
      revealObs.unobserve(e.target); // fire once
    }
  });
}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
  revealObs.observe(el);
});


/* ── STAGGERED SERVICE CARDS ── */
(function () {
  const cards = document.querySelectorAll('.service-card');
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const idx = Array.from(cards).indexOf(e.target);
        setTimeout(() => e.target.classList.add('visible'), idx * 80);
        obs.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });
  cards.forEach(c => obs.observe(c));
})();


/* ── SMOOTH SECTION TRANSITIONS (active nav highlight) ── */
(function () {
  const sections = document.querySelectorAll('section[id]');
  const links = document.querySelectorAll('.nav-links a[href^="#"]');

  const sectionObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        links.forEach(l => l.classList.remove('active-link'));
        const link = document.querySelector(`.nav-links a[href="#${e.target.id}"]`);
        if (link) link.classList.add('active-link');
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(s => sectionObs.observe(s));

  // Add active-link style dynamically
  const style = document.createElement('style');
  style.textContent = `.nav-links a.active-link { color: var(--accent) !important; }
  .nav-links a.active-link::after { width: 100% !important; }`;
  document.head.appendChild(style);
})();


/* ── TILT EFFECT ON SERVICE CARDS ── */
document.querySelectorAll('.service-card').forEach(card => {
  card.addEventListener('mousemove', e => {
    const rect = card.getBoundingClientRect();
    const x = (e.clientX - rect.left) / rect.width - 0.5;
    const y = (e.clientY - rect.top) / rect.height - 0.5;
    card.style.transform = `translateY(-6px) rotateY(${x * 6}deg) rotateX(${-y * 6}deg)`;
    card.style.transition = 'transform 0.1s ease';
  });
  card.addEventListener('mouseleave', () => {
    card.style.transform = '';
    card.style.transition = 'transform 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
  });
});


/* ── MARQUEE INTERACTION ── */
// Single row marquee — no clone needed


/* ── CONTACT FORM ── */
function updateCount(el) {
  const counter = document.getElementById('charCount');
  if (counter) counter.textContent = el.value.length + ' / 600';
}

function clearErrors() {
  ['nameErr', 'emailErr', 'messageErr'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.textContent = '';
  });
  ['name', 'email', 'message'].forEach(id => {
    document.getElementById(id)?.classList.remove('error');
  });
}

function showError(fieldId, errId, msg) {
  const field = document.getElementById(fieldId);
  const err = document.getElementById(errId);
  if (field) {
    field.classList.add('error');
    field.style.animation = 'shake 0.4s ease';
    setTimeout(() => { field.style.animation = ''; }, 400);
  }
  if (err) err.textContent = msg;
  return false;
}

// Shake keyframe
(function () {
  const s = document.createElement('style');
  s.textContent = `@keyframes shake {
    0%,100%{transform:translateX(0)}
    20%{transform:translateX(-6px)}
    40%{transform:translateX(6px)}
    60%{transform:translateX(-4px)}
    80%{transform:translateX(4px)}
  }`;
  document.head.appendChild(s);
})();

const form = document.getElementById('contactForm');
if (form) {
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    clearErrors();

    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const message = document.getElementById('message');
    const agree = document.getElementById('agree');
    let valid = true;

    if (!name.value.trim())
      valid = showError('name', 'nameErr', 'Please enter your full name.');
    const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim() || !emailRe.test(email.value))
      valid = showError('email', 'emailErr', 'Please enter a valid email address.');
    if (!message.value.trim() || message.value.trim().length < 10)
      valid = showError('message', 'messageErr', 'Please describe your needs (at least 10 characters).');
    if (!agree.checked) { alert('Please agree to our Privacy Policy to proceed.'); valid = false; }
    if (!valid) return;

    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = 'Sending… <i class="fas fa-spinner fa-spin"></i>';

    fetch('contact.php', { method: 'POST', body: new FormData(this) })
      .then(r => r.json())
      .then(data => {
        btn.disabled = false;
        btn.innerHTML = 'Send Message <i class="fas fa-paper-plane"></i>';
        const msg = document.getElementById('formMessage');
        if (data.success) {
          msg.style.color = '';
          msg.innerHTML = '<i class="fas fa-circle-check"></i> Message sent — we\'ll be in touch within 1 business day.';
          msg.classList.add('show');
          this.reset();
          document.getElementById('charCount').textContent = '0 / 600';
          clearErrors();
          setTimeout(() => msg.classList.remove('show'), 6000);
        } else {
          msg.style.color = '#e74c3c';
          msg.innerHTML = '<i class="fas fa-circle-xmark"></i> ' + (data.message || 'Something went wrong. Please try again.');
          msg.classList.add('show');
          setTimeout(() => msg.classList.remove('show'), 6000);
        }
      })
      .catch(() => {
        btn.disabled = false;
        btn.innerHTML = 'Send Message <i class="fas fa-paper-plane"></i>';
        alert('Network error. Please try again.');
      });
  });

  ['name', 'email', 'message'].forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener('blur', () => {
      if (el.value.trim()) {
        el.classList.remove('error');
        const errEl = document.getElementById(id + 'Err');
        if (errEl) errEl.textContent = '';
      }
    });
  });
}


/* ── SMOOTH SCROLL PROGRESS BAR ── */
(function () {
  const bar = document.createElement('div');
  bar.style.cssText = `
    position: fixed; top: 0; left: 0; height: 2px; width: 0%;
    background: linear-gradient(90deg, var(--accent), #a78bfa);
    z-index: 9999; pointer-events: none;
    transition: width 0.1s linear;
    box-shadow: 0 0 8px rgba(200,241,53,0.4);
  `;
  document.body.appendChild(bar);

  window.addEventListener('scroll', () => {
    const scrollTop = document.documentElement.scrollTop;
    const scrollMax = document.documentElement.scrollHeight - window.innerHeight;
    const pct = scrollMax > 0 ? (scrollTop / scrollMax) * 100 : 0;
    bar.style.width = pct + '%';
  });
})();


/* ── JOINUS FEATURE ICONS — STAGGER ── */
(function () {
  const feats = document.querySelectorAll('.joinus-feat');
  feats.forEach((f, i) => {
    f.style.opacity = '0';
    f.style.transform = 'translateY(30px)';
    f.style.transition = `opacity 0.6s ease ${i * 0.1 + 0.2}s, transform 0.6s cubic-bezier(0.16,1,0.3,1) ${i * 0.1 + 0.2}s`;
  });

  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        feats.forEach(f => {
          f.style.opacity = '1';
          f.style.transform = 'translateY(0)';
        });
        obs.disconnect();
      }
    });
  }, { threshold: 0.2 });

  const joinSection = document.querySelector('.joinus');
  if (joinSection) obs.observe(joinSection);
})();


/* ── FAQ ACCORDION ── */
(function () {
  const faqItems = document.querySelectorAll('.faq-item');
  if (!faqItems.length) return;

  function setOpen(item, open) {
    const btn = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer');
    if (!btn || !answer) return;

    if (open) {
      item.classList.add('active');
      btn.setAttribute('aria-expanded', 'true');
      answer.style.maxHeight = answer.scrollHeight + 'px';
    } else {
      item.classList.remove('active');
      btn.setAttribute('aria-expanded', 'false');
      answer.style.maxHeight = '0px';
    }
  }

  let hasOpen = false;
  faqItems.forEach((item, idx) => {
    const btn = item.querySelector('.faq-question');
    if (!btn) return;

    const shouldOpen = item.classList.contains('active') && !hasOpen;
    if (shouldOpen) {
      hasOpen = true;
      setOpen(item, true);
    } else {
      setOpen(item, false);
    }

    if (!hasOpen && idx === faqItems.length - 1) {
      const first = faqItems[0];
      setOpen(first, true);
    }
  });

  faqItems.forEach(item => {
    const btn = item.querySelector('.faq-question');
    if (!btn) return;

    btn.addEventListener('click', () => {
      const isOpen = item.classList.contains('active');

      faqItems.forEach(i => setOpen(i, false));

      if (!isOpen) {
        setOpen(item, true);
      }
    });
  });

  window.addEventListener('resize', () => {
    const openItem = document.querySelector('.faq-item.active');
    if (!openItem) return;
    const answer = openItem.querySelector('.faq-answer');
    if (answer) answer.style.maxHeight = answer.scrollHeight + 'px';
  });
})();


/* ══════════════════════════════════════════════
   THEME TOGGLE — Night / Day
══════════════════════════════════════════════ */
(function () {
  const THEMES = ['night', 'day'];
  const ICONS = {
    night: '<i class="fas fa-moon"></i>',
    day: '<i class="fas fa-sun"></i>'
  };
  const LABELS = { night: 'Night', day: 'Day' };

  // Restore saved theme
  const storedTheme = localStorage.getItem('ce-theme');
  const savedTheme = THEMES.includes(storedTheme) ? storedTheme : 'night';
  applyTheme(savedTheme, false);

  // Build toggle pill and inject into every .theme-toggle placeholder
  document.querySelectorAll('.theme-toggle').forEach(mount => {
    THEMES.forEach(t => {
      const btn = document.createElement('button');
      btn.className = 'theme-btn' + (t === savedTheme ? ' active' : '');
      btn.setAttribute('aria-label', LABELS[t] + ' mode');
      btn.setAttribute('title', LABELS[t]);
      btn.setAttribute('data-theme-btn', t);
      btn.innerHTML = ICONS[t];
      btn.addEventListener('click', () => setTheme(t));
      mount.appendChild(btn);
    });
  });

  function setTheme(theme) {
    if (!THEMES.includes(theme)) theme = 'night';
    applyTheme(theme, true);
    localStorage.setItem('ce-theme', theme);
    document.querySelectorAll('[data-theme-btn]').forEach(b => {
      b.classList.toggle('active', b.getAttribute('data-theme-btn') === theme);
    });
  }

  function applyTheme(theme, animate) {
    if (!THEMES.includes(theme)) theme = 'night';
    const html = document.documentElement;
    if (theme === 'night') {
      html.removeAttribute('data-theme');
    } else {
      html.setAttribute('data-theme', theme);
    }

    // Update particle canvas colours
    if (animate) updateParticleColors(theme);

    // Day: sparkles + sun rays
    manageDayEffects(theme);
  }

  function updateParticleColors(theme) {
    // done via CSS filter on canvas (see animation.css)
  }

  /* ── DAY EFFECTS ── */
  function manageDayEffects(theme) {
    // Sun rays
    let sunRays = document.querySelector('.sun-rays');
    if (!sunRays) {
      sunRays = document.createElement('div');
      sunRays.className = 'sun-rays';
      const inner = document.createElement('div');
      inner.className = 'sun-rays-inner';
      for (let i = 0; i < 18; i++) {
        const ray = document.createElement('div');
        ray.className = 'sun-ray';
        ray.style.transform = `rotate(${i * 20}deg)`;
        inner.appendChild(ray);
      }
      sunRays.appendChild(inner);
      const hero = document.querySelector('.hero');
      if (hero) hero.appendChild(sunRays);
    }

    // Sparkles
    if (!document.querySelector('.day-sparkle')) {
      const sparkles = ['✦', '✧', '⋆', '·', '✺', '❋', '✿'];
      for (let i = 0; i < 10; i++) {
        const sp = document.createElement('div');
        sp.className = 'day-sparkle';
        sp.textContent = sparkles[Math.floor(Math.random() * sparkles.length)];
        sp.style.cssText = `
          left:${Math.random() * 100}vw;
          --pf-dur:${(Math.random() * 8 + 6).toFixed(1)}s;
          --pf-delay:${(Math.random() * 10).toFixed(1)}s;
          opacity:${(Math.random() * 0.5 + 0.3).toFixed(2)};
        `;
        document.body.appendChild(sp);
      }
    }
  }
})();
