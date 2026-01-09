import * as pdfjsLib from '/wp-content/themes/frida-zinema/js/pdfjs/build/pdf.mjs';

pdfjsLib.GlobalWorkerOptions.workerSrc =
    '/wp-content/themes/frida-zinema/js/pdfjs/build/pdf.worker.mjs';


var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    pageTotal= 0,
    scale = 1,
    canvases = {
        current: document.getElementById('pdf-reader__canvas__current'),
        prev: document.getElementById('pdf-reader__canvas__prev'),
        next: document.getElementById('pdf-reader__canvas__next'),
    }
    // canvas = document.getElementById('pdf-reader__canvas'),
    // canvas_prev = document.getElementById('pdf-reader__canvas__prev'),
    // canvas_next = document.getElementById('pdf-reader__canvas_next'),

let ctx = {};
for (const [key, canvas] of Object.entries(canvases)) {
    ctx[key] = canvas.getContext('2d');
}


const url = canvases.current.dataset.pdf;

pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    pageTotal = pdfDoc.numPages;
    document.getElementById('pdf-reader__page-info__total-pages').textContent = pageTotal;

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

    for (const [key, canvas] of Object.entries(canvases)) {
        let render_page_number = num;
        if(key === 'prev')
            render_page_number = Math.max(num - 1, 0);
        else if(key === 'next')
            render_page_number = Math.min(pageTotal, num + 1)

        pdfDoc.getPage(render_page_number).then(function(page) {

            var viewport = calculatePageDimensions(canvas, page);



            var renderContext = {
                canvasContext: ctx[key],
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

            if(key === 'current')
                document.getElementById('pdf-reader__page-info__current-page').textContent = render_page_number;
        });
    }
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
