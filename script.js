/* ============================================================
   PROVERBIDIOM LABS — script.js
   ============================================================ */

'use strict';


/* ------------------------------------------------------------
   1. HEADER SCROLL BEHAVIOR
   Adds .scrolled to the header when the page is scrolled,
   triggering the frosted-glass border style in CSS.
   EDIT: Adjust scroll threshold (default: 20px)
   ------------------------------------------------------------ */
const header = document.getElementById('site-header');

function onScroll() {
    header.classList.toggle('scrolled', window.scrollY > 20);
}

window.addEventListener('scroll', onScroll, { passive: true });
onScroll(); // Run once on load in case page is already scrolled


/* ------------------------------------------------------------
   2. MOBILE NAV
   Toggles the hamburger menu open/closed.
   Closes on link click, backdrop click, or Escape key.
   ------------------------------------------------------------ */
const hamburger   = document.getElementById('hamburger');
const mobileNav   = document.getElementById('mobile-nav');
const mobileLinks = mobileNav.querySelectorAll('a');

function openNav() {
    hamburger.classList.add('open');
    mobileNav.classList.add('open');
    hamburger.setAttribute('aria-expanded', 'true');
    mobileNav.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden'; // prevent background scroll
}

function closeNav() {
    hamburger.classList.remove('open');
    mobileNav.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    mobileNav.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
}

hamburger.addEventListener('click', () => {
    hamburger.classList.contains('open') ? closeNav() : openNav();
});

// Close when any mobile nav link is clicked
mobileLinks.forEach(link => link.addEventListener('click', closeNav));

// Close on Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && hamburger.classList.contains('open')) closeNav();
});


/* ------------------------------------------------------------
   3. SMOOTH SCROLL WITH HEADER OFFSET
   Intercepts clicks on all anchor links (#...) and scrolls
   smoothly, accounting for the fixed header height.
   ------------------------------------------------------------ */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const id = this.getAttribute('href');
        if (id === '#') return;

        const target = document.querySelector(id);
        if (!target) return;

        e.preventDefault();

        const offset = header.offsetHeight;
        const top    = target.getBoundingClientRect().top + window.scrollY - offset;

        window.scrollTo({ top, behavior: 'smooth' });
    });
});


/* ------------------------------------------------------------
   4. FOOTER — AUTO YEAR
   Automatically populates the copyright year.
   ------------------------------------------------------------ */
const yearEl = document.getElementById('footer-year');
if (yearEl) yearEl.textContent = new Date().getFullYear();


/* ------------------------------------------------------------
   5. SCROLL-TRIGGERED FADE-IN ANIMATIONS
   Uses IntersectionObserver to reveal .fade-in elements as
   they enter the viewport. Gracefully falls back if the API
   isn't available (all elements shown immediately).
   EDIT: Adjust threshold and rootMargin to change timing
   ------------------------------------------------------------ */
const fadeEls = document.querySelectorAll('.fade-in');

if ('IntersectionObserver' in window && fadeEls.length > 0) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('visible');
            observer.unobserve(entry.target); // animate once only
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -40px 0px'
    });

    fadeEls.forEach(el => observer.observe(el));
} else {
    // Fallback: show all immediately
    fadeEls.forEach(el => el.classList.add('visible'));
}


/* ------------------------------------------------------------
   6. HERO CANVAS ANIMATION
   Organic floating gradient orbs — slow, smooth, arty.
   Automatically pauses when the browser tab is hidden.
   Skipped entirely if user prefers reduced motion.

   EDIT: Adjust orb colors ([R, G, B]), count, speed, or opacity.
   ------------------------------------------------------------ */
(function () {
    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;

    // Respect prefers-reduced-motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        canvas.style.display = 'none';
        return;
    }

    const ctx = canvas.getContext('2d');
    let raf;
    let t = 0;

    // EDIT: Each orb — base position (0–1), radius multiplier, RGB color, speed, start phase
    const orbs = [
        { bx: 0.12, by: 0.45, r: 0.58, color: [46,  93, 75],  speed: 0.00033, phase: 0.0 },
        { bx: 0.82, by: 0.18, r: 0.46, color: [184,149,106], speed: 0.00026, phase: 2.1 },
        { bx: 0.52, by: 0.82, r: 0.52, color: [46,  93, 75],  speed: 0.00041, phase: 4.3 },
        { bx: 0.90, by: 0.65, r: 0.36, color: [139,110, 78],  speed: 0.00029, phase: 1.5 },
        { bx: 0.22, by: 0.88, r: 0.30, color: [184,149,106], speed: 0.00052, phase: 3.2 },
    ];

    function resize() {
        canvas.width  = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    }

    function draw() {
        t++;
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        const w = canvas.width;
        const h = canvas.height;

        orbs.forEach(({ bx, by, r, color, speed, phase }) => {
            // Sine/cosine gives natural, non-looping feel
            const x = (bx + Math.sin(t * speed          + phase) * 0.18) * w;
            const y = (by + Math.cos(t * speed * 0.71   + phase) * 0.14) * h;
            const radius = r * Math.max(w, h);

            const [red, green, blue] = color;
            const g = ctx.createRadialGradient(x, y, 0, x, y, radius);
            // EDIT: Change 0.20 to adjust orb brightness (0.10 = subtle, 0.30 = vivid)
            g.addColorStop(0,    `rgba(${red},${green},${blue},0.20)`);
            g.addColorStop(0.45, `rgba(${red},${green},${blue},0.07)`);
            g.addColorStop(1,    `rgba(${red},${green},${blue},0)`);

            ctx.fillStyle = g;
            ctx.fillRect(0, 0, w, h);
        });

        raf = requestAnimationFrame(draw);
    }

    // Debounced resize handler
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(resize, 150);
    }, { passive: true });

    // Pause when tab is hidden — saves CPU/battery
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            cancelAnimationFrame(raf);
        } else {
            draw();
        }
    });

    resize();
    draw();
})();


/* ------------------------------------------------------------
   7. CONTACT FORM — VALIDATION & SUBMISSION
   ------------------------------------------------------------ */

/* -- Validation helpers -- */

function validateName(val) {
    if (!val.trim())         return 'Please enter your name.';
    if (val.trim().length < 2) return 'Name must be at least 2 characters.';
    return null;
}

function validateEmail(val) {
    if (!val.trim()) return 'Please enter your email address.';
    // Basic email pattern
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val.trim())) {
        return 'Please enter a valid email address.';
    }
    return null;
}

function validateProject(val) {
    if (!val.trim())            return 'Please tell us about your project.';
    if (val.trim().length < 20) return 'Please provide a bit more detail (at least 20 characters).';
    return null;
}

function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errEl = document.getElementById(fieldId + '-error');
    if (field) field.classList.add('invalid');
    if (errEl) errEl.textContent = message;
}

function clearError(fieldId) {
    const field = document.getElementById(fieldId);
    const errEl = document.getElementById(fieldId + '-error');
    if (field) field.classList.remove('invalid');
    if (errEl) errEl.textContent = '';
}

/* -- Wire up inline clearing on input -- */
['name', 'email', 'project'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('input', () => clearError(id));
});

/* -- Form submission -- */
const form       = document.getElementById('contact-form');
const submitBtn  = document.getElementById('submit-btn');
const successMsg = document.getElementById('form-success');
const errorMsg   = document.getElementById('form-error');

if (form) {
    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Hide any previous status messages
        successMsg.classList.remove('visible');
        errorMsg.classList.remove('visible');

        // Read values
        const name    = document.getElementById('name').value;
        const email   = document.getElementById('email').value;
        const project = document.getElementById('project').value;

        // Validate all fields
        const nameErr    = validateName(name);
        const emailErr   = validateEmail(email);
        const projectErr = validateProject(project);

        if (nameErr)    showError('name',    nameErr);
        if (emailErr)   showError('email',   emailErr);
        if (projectErr) showError('project', projectErr);

        if (nameErr || emailErr || projectErr) return; // stop here if invalid

        // Disable button and show loading state
        submitBtn.disabled    = true;
        submitBtn.textContent = 'Sending\u2026';

        try {
            /* --------------------------------------------------
               BACKEND INTEGRATION POINT

               This block currently simulates a submission.
               Replace it with one of the options below:

               ── Option A: Formspree ──────────────────────────
               Add action="https://formspree.io/f/YOUR_FORM_ID"
               and method="POST" to the <form> in index.html.
               Formspree will handle submission natively.
               You can remove this entire try/catch block.

               ── Option B: Netlify Forms ──────────────────────
               Add the netlify attribute to your <form> tag
               in index.html. Netlify handles it on deploy.
               You can remove this try/catch block.

               ── Option C: Custom API endpoint ────────────────
               Replace the simulated delay below with a real
               fetch call to your backend:

               const res = await fetch('https://your-api.com/contact', {
                   method: 'POST',
                   headers: { 'Content-Type': 'application/json' },
                   body: JSON.stringify({ name, email, project })
               });
               if (!res.ok) throw new Error('Network error');
               -------------------------------------------------- */

            // PLACEHOLDER — remove this when connecting a real backend
            console.log('Form data (not yet submitted):', { name, email, project });
            await new Promise(resolve => setTimeout(resolve, 900)); // simulated delay

            // Show success, reset form
            successMsg.classList.add('visible');
            form.reset();

            // Scroll success message into view
            successMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        } catch (err) {
            console.error('Submission error:', err);
            errorMsg.classList.add('visible');
        } finally {
            submitBtn.disabled    = false;
            submitBtn.textContent = 'Send Message';
        }
    });
}
