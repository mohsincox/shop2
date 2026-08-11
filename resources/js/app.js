document.querySelectorAll('[data-mobile-menu-toggle]').forEach((toggle) => {
    toggle.addEventListener('click', () => {
        document.querySelectorAll('[data-mobile-menu]').forEach((menu) => menu.classList.toggle('hidden'));
    });
});

document.querySelectorAll('[data-dropdown-toggle]').forEach((toggle) => {
    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const dropdown = toggle.closest('[data-dropdown]');
        if (!dropdown) return;
        const menu = dropdown.querySelector('[data-dropdown-menu]');
        if (!menu) return;
        const hidden = menu.classList.toggle('hidden');
        if (!hidden) {
            setTimeout(() => {
                document.addEventListener('click', (ev) => {
                    if (!dropdown.contains(ev.target)) {
                        menu.classList.add('hidden');
                    }
                }, { once: true });
            }, 0);
        }
    });
});

document.querySelectorAll('[data-admin-menu-toggle]').forEach((toggle) => {
    toggle.addEventListener('click', () => {
        document.querySelectorAll('[data-admin-menu]').forEach((menu) => menu.classList.toggle('hidden'));
    });
});
