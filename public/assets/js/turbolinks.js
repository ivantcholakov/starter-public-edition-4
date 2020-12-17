
function turbolinksInstalled() {

    return (typeof Turbolinks !== 'undefined');
}

function turbolinksSupported() {

    return turbolinksInstalled() && Turbolinks.supported;
}
