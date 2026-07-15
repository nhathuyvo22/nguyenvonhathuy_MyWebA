// File mặc định của Laravel (Axios, CSRF, cấu hình...)
import './bootstrap';

// Import thư viện Bootstrap từ node_modules (namespace import — dùng chung 1 instance)
import * as bootstrap from 'bootstrap';

// Import file JavaScript tự viết
import './preview-image';
// Admin sidebar: persist open submenu across HMR and handle toggle + chevron
document.addEventListener('DOMContentLoaded', function () {
    if (window.__adminSidebarInit) return;
    window.__adminSidebarInit = true;

    const collapses = document.querySelectorAll('.admin-sidebar .collapse');
    collapses.forEach(function (el) {
        el.addEventListener('show.bs.collapse', function (e) {
            console.log('[DEBUG] collapse SHOW', el.id, new Date().toISOString());
        });
        el.addEventListener('shown.bs.collapse', function (e) {
            console.log('[DEBUG] collapse SHOWN', el.id, new Date().toISOString());
            try { localStorage.setItem('adminSidebarOpen', el.id); } catch (err) { }
        });
        el.addEventListener('hide.bs.collapse', function (e) {
            console.log('[DEBUG] collapse HIDE', el.id, new Date().toISOString());
        });
        el.addEventListener('hidden.bs.collapse', function (e) {
            console.log('[DEBUG] collapse HIDDEN', el.id, new Date().toISOString());
            try {
                const cur = localStorage.getItem('adminSidebarOpen');
                if (cur === el.id) localStorage.removeItem('adminSidebarOpen');
            } catch (err) { }
        });
    });

    // Restore open submenu (helps when Vite HMR reloads modules)
    try {
        const openId = localStorage.getItem('adminSidebarOpen');
        if (openId) {
            const target = document.getElementById(openId);
            if (target) {
                bootstrap.Collapse.getOrCreateInstance(target, { toggle: false }).show();
            }
        }
    } catch (err) {
        console.log('[DEBUG] restore collapse error', err);
    }

    // Toggle handling: ensure clicking header toggles collapse and rotates chevron
    const toggles = document.querySelectorAll('.admin-sidebar .has-submenu > button[data-bs-target]');
    toggles.forEach(function (btn) {
        const selector = btn.getAttribute('data-bs-target');
        const target = document.querySelector(selector);
        const chevron = btn.querySelector('.chevron');

        // Initialize chevron state
        if (target && target.classList.contains('show')) {
            chevron && chevron.classList.add('rotate');
            btn.setAttribute('aria-expanded', 'true');
        } else {
            chevron && chevron.classList.remove('rotate');
            btn.setAttribute('aria-expanded', 'false');
        }

        // Rely on Bootstrap's data-api for toggling; do not call show/hide here to avoid duplicate toggles

        // Sync chevron on events
        target && target.addEventListener('shown.bs.collapse', function () {
            chevron && chevron.classList.add('rotate');
            btn.setAttribute('aria-expanded', 'true');
        });
        target && target.addEventListener('hidden.bs.collapse', function () {
            chevron && chevron.classList.remove('rotate');
            btn.setAttribute('aria-expanded', 'false');
        });
    });
});
