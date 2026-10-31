// Dark mode toggle: the choice is remembered in localStorage.
document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');

        try {
            localStorage.theme = isDark ? 'dark' : 'light';
        } catch (e) {
            // Storage blocked: the toggle still works for this page.
        }
    });
});
