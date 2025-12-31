let ps;

function initPS() {
    const el = document.querySelector(".wpc-filters-ul-list");
    if (!el) return;

    // destroy old instance if it exists
    if (ps) ps.destroy();

    // recreate perfect scrollbar
    ps = new PerfectScrollbar(el, { suppressScrollX: true });
}

document.addEventListener("DOMContentLoaded", () => {
    initPS();

    // Observe a parent wrapper that NEVER gets replaced
    const parent = document.querySelector(".filter-results");
    if (!parent) return;

    const observer = new MutationObserver(() => {
        // If the library replaced .wpc-filters-ul-list, re-init PS
        initPS();
    });

    // Watch for changes inside the parent
    observer.observe(parent, {
        childList: true,
        subtree: true,
    });
});
