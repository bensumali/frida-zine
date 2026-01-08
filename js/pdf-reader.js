import * as pdfjsLib from '/wp-content/themes/frida-zinema/js/pdfjs/build/pdf.mjs';

pdfjsLib.GlobalWorkerOptions.workerSrc =
    '/wp-content/themes/frida-zinema/js/pdfjs/build/pdf.worker.mjs';




var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1,
    canvas = document.getElementById('pdf-reader__canvas'),
    ctx = canvas.getContext('2d');

const url = canvas.dataset.pdf;

// const loadingTask = pdfjsLib.getDocument(url);

pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById('pdf-reader__page-info__total-pages').textContent = pdfDoc.numPages;

    // Initial/first page rendering
    renderPage(pageNum);
});


function calculatePageDimensions(canvas, page) {
    let containerWidth = canvas.parentElement.getBoundingClientRect().width;

    // Base viewport at scale = 1 (PDF’s natural size)
    let baseViewport = page.getViewport({ scale: 3 });

    // Only scale down if PDF is wider than viewport
    let scale = baseViewport.width > containerWidth
        ? containerWidth / baseViewport.width * 3
        : 3;
    let viewport = page.getViewport({scale: scale});



    canvas.height = viewport.height;
    canvas.width = viewport.width;

    const pageWidthScale = canvas.parentElement.getBoundingClientRect().width / page.view[2];
    const pageHeightScale = canvas.parentElement.getBoundingClientRect().height / page.view[3];

    var displayWidth =  Math.min(pageWidthScale, pageHeightScale);
    canvas.style.width = `${(viewport.width * displayWidth) / scale}px`;
    canvas.style.height = `${(viewport.height * displayWidth) / scale}px`;



    return viewport;
}

function renderPage(num) {
    pageRendering = true;
    // Using promise to fetch the page
    pdfDoc.getPage(num).then(function(page) {

        var viewport = calculatePageDimensions(canvas, page);



        var renderContext = {
            canvasContext: ctx,
            viewport: viewport
        };
        var renderTask = page.render(renderContext);

        // Wait for rendering to finish
        renderTask.promise.then(function() {
            pageRendering = false;
            if (pageNumPending !== null) {
                // New page rendering is pending
                renderPage(pageNumPending);
                pageNumPending = null;
            }
        });
    });

     document.getElementById('pdf-reader__page-info__current-page').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
    if (pageRendering) {
        pageNumPending = num;
    } else {
        renderPage(num);
    }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
    if (pageNum <= 1) {
        return;
    }
    pageNum--;
    queueRenderPage(pageNum);
}
document.getElementById('pdf-reader__controls__button__prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
    if (pageNum >= pdfDoc.numPages) {
        return;
    }
    pageNum++;
    queueRenderPage(pageNum);
}
document.getElementById('pdf-reader__controls__button__next').addEventListener('click', onNextPage);

document.addEventListener('keydown', (event) => {
    if (event.key === 'ArrowLeft')
        onPrevPage();
    else if (event.key === 'ArrowRight')
        onNextPage();
});
