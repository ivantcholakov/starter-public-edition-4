
// highlight.js - Turbolinks compatibility.

if (turbolinksSupported()) {

    var hljsEventsInitialized = false;

    if (typeof hljs !== 'undefined') {

        hljs.ArrayProto = [];

        hljs.initHighlighting = function() {

            var blocks = document.querySelectorAll('pre code');
            hljs.ArrayProto.forEach.call(blocks, hljs.highlightBlock);
        }

        hljs.initHighlightingOnLoad = function() {

            if (hljsEventsInitialized) {
                return;
            }

            addEventListener('turbolinks:render', hljs.initHighlighting, false);

            hljsEventsInitialized = true;
        }
    }
}

if (typeof hljs !== 'undefined') {

    hljs.initHighlightingOnLoad();
}
