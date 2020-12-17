
// highlight.js - Turbolinks compatibility.

if (turbolinksSupported) {

    var hljsEventsInitialized = false;

    if (typeof hljs !== 'undefined') {

        hljs.ArrayProto = [];

        hljs.initHighlighting = function() {

            var blocks = document.querySelectorAll('pre code');
            hljs.ArrayProto.forEach.call(blocks, hljs.highlightBlock);
        }

        hljs.initHighlightingOnLoad = function() {

            addEventListener('turbolinks:load', hljs.initHighlighting, false);
        }
    }
}

if (typeof hljs !== 'undefined') {

    hljs.initHighlightingOnLoad();
}
