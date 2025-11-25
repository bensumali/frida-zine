let ps;

function initPS() {
    const el = document.querySelector(".wpc-filters-ul-list");
    if (!el) return;

    if (ps) ps.destroy();
    ps = new PerfectScrollbar(el, { suppressScrollX: true });
}

document.addEventListener("DOMContentLoaded", () => {
    initPS();

    const list = document.querySelector(".wpc-filters-ul-list");
    if (!list) return;

    const observer = new MutationObserver(() => {
        initPS();
    });

    observer.observe(list, { childList: true, subtree: true });
});
