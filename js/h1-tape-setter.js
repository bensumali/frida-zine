document.querySelectorAll("h1, h2").forEach((el, i) => {
    const index = (i % 5) + 1; //
    el.style.backgroundImage = `url('/wp-content/themes/frida-zinema/img/tape-${index}.png')`;
});