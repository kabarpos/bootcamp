import './bootstrap';

if (typeof document !== 'undefined') {
    const body = document.body;
    if (body && body.classList.contains('public-layout')) {
        import('./public');
    }
}
