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
   6. HERO VIDEO BACKGROUND
   Respects prefers-reduced-motion — pauses the video if the
   user has that accessibility setting enabled.
   EDIT: Adjust opacity in styles.css (.hero-video-bg)
   ------------------------------------------------------------ */
const heroVideo = document.querySelector('.hero-video-bg');
if (heroVideo && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    heroVideo.pause();
    heroVideo.style.display = 'none';
}


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
