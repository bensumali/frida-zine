function applyTapeBackgrounds() {
    document.querySelectorAll("h1, h2").forEach((el, i) => {
        const index = (i % 5) + 1;
        el.style.backgroundImage = `url('/wp-content/themes/frida-zinema/img/tape-${index}.png')`;
    });
}

document.addEventListener("DOMContentLoaded", () => {
    // Initial run
    applyTapeBackgrounds();

    // Observe a stable wrapper that contains the content that gets replaced
    const parent = document.querySelector(".filter-results")
        || document.querySelector(".wpc-filter-wrapper")
        || document.body; // fallback if needed

    const observer = new MutationObserver(() => {
        applyTapeBackgrounds();
    });

    observer.observe(parent, {
        childList: true,
        subtree: true,
    });
});
