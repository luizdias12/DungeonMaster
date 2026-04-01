document.addEventListener('DOMContentLoaded', () => {
    const bars = document.querySelectorAll('.attr-fill');

    bars.forEach((bar, index) => {
        const width = bar.dataset.width;

        setTimeout(() => {
            bar.style.width = width + '%';
        }, index * 120);
    });
});