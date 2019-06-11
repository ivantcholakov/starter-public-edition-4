/*
 *  "showprotected" CKEditor plugin
 *  
 *  Created by Matthew Lieder (https://github.com/IGx89)
 *  
 *  Licensed under the MIT, GPL, LGPL and MPL licenses
 *  
 *  Icon courtesy of famfamfam: http://www.famfamfam.com/lab/icons/mini/
 */

// TODO: configuration settings
// TODO: show the actual text inline, not just an icon?
// TODO: improve copy/paste behavior (tooltip is wrong after paste)

CKEDITOR.plugins.add( 'showprotected', {
	requires: 'dialog',
	onLoad: function() {
		// Add the CSS styles for protected source placeholders.
		var iconPath = CKEDITOR.getUrl( this.path + 'images' + '/code.gif' ),
			baseStyle = 'background:url(' + iconPath + ') no-repeat %1 center;border:1px dotted #00f;background-size:16px;';

		var template = '.%2 showprotected-img.cke_protected' +
			'{' +
				baseStyle +
				'display:block;' +
				'width:16px;' +
				'min-height:15px;' +
				'line-height:1.6em;' +
				'height:1.15em;' +
				'cursor:default;' +
				// Opera works better with "middle" (even if not perfect)
				'vertical-align:' + ( CKEDITOR.env.opera ? 'middle' : 'text-bottom' ) + ';' +
			'}';

		// Styles with contents direction awareness.
		function cssWithDir( dir ) {
			return template.replace( /%1/g, dir == 'rtl' ? 'right' : 'left' ).replace( /%2/g, 'cke_contents_' + dir );
		}

		CKEDITOR.addCss( cssWithDir( 'ltr' ) + cssWithDir( 'rtl' ) );
	},

	init: function( editor ) {
		CKEDITOR.dialog.add( 'showProtectedDialog', this.path + 'dialogs/protected.js' );
		
		editor.on( 'doubleclick', function( evt ) {
			var element = evt.data.element;

			if ( element.is( 'showprotected-img' ) ) {
				CKEDITOR.plugins.showprotected.selectedElement = element;
				evt.data.dialog = 'showProtectedDialog';
			}
		} );
	},

	afterInit: function( editor ) {
		// Register a filter to displaying placeholders after mode change.

		var dataProcessor = editor.dataProcessor,
			dataFilter = dataProcessor && dataProcessor.dataFilter,
			htmlFilter = dataProcessor && dataProcessor.htmlFilter;

		// add a rule to put a placeholder image next to every protected source region
		if ( dataFilter ) {
			dataFilter.addRules( {
				comment: function( commentText, commentElement, abc ) {
					if(commentText.indexOf(CKEDITOR.plugins.showprotected.protectedSourceMarker) == 0) {
						commentElement.attributes = [];

						var cleanedCommentText = CKEDITOR.plugins.showprotected.decodeProtectedSource( commentText );
						
						var fakeElement = new CKEDITOR.htmlParser.element( 'showprotected-img', {
							'class': 'cke_protected',
							'data-cke-showprotected-temp': true,
							alt: cleanedCommentText,
							title: cleanedCommentText
						} );
						fakeElement.insertAfter(commentElement);
						
						return commentText;
					}
					
					return null;
				}
			} );
		}
		
		// add a rule to remove the placeholder image from the raw HTML
		if ( htmlFilter ) {
			htmlFilter.addRules( {
				elements: {
					'showprotected-img': function( element ) {
						// remove the placeholder image so it doesn't show in the source code
						return false;
					}
				}
			}, -10 );
		}
	}
} );

/**
 * Set of showprotected plugin's helpers.
 *
 * @class
 * @singleton
 */
CKEDITOR.plugins.showprotected = {
		
	protectedSourceMarker: '{cke_protected}',
		
	decodeProtectedSource: function( protectedSource ) {
		if(protectedSource.indexOf('%3C!--') == 0) {
			return decodeURIComponent(protectedSource).replace( /<!--\{cke_protected\}([\s\S]+?)-->/g, function( match, data ) {
                return decodeURIComponent( data );
			} );
		} else {
			return decodeURIComponent(protectedSource.substr(CKEDITOR.plugins.showprotected.protectedSourceMarker.length));
		}
	},
	
	encodeProtectedSource: function( protectedSource ) {
		return CKEDITOR.plugins.showprotected.protectedSourceMarker +
        	encodeURIComponent( protectedSource ).replace( /--/g, '%2D%2D' );
	}
	
};