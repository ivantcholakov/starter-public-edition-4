
/*
https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/webfont-optimization
https://developers.google.com/fonts/docs/webfont_loader
https://github.com/typekit/webfontloader
https://github.com/typekit/fvd
https://google-webfonts-helper.herokuapp.com
*/

WebFont.load({
    custom: {
        families: [
            'Open Sans',
            'Open Sans Condensed',
            'Icons', 'outline-icons', 'brand-icons'
        ],
        urls: [
            DEFAULT_BASE_URI + 'assets/css/lib/open-sans/open-sans.min.css',
            DEFAULT_BASE_URI + 'assets/css/lib/open-sans-condensed/open-sans-condensed.min.css',
            DEFAULT_BASE_URI + 'assets/css/lib/semantic-icons-default/icons.css'
        ]
    },
    timeout: 2000
});
