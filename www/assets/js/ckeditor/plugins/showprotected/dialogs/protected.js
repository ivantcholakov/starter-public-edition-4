
CKEDITOR.dialog.add( 'showProtectedDialog', function( editor ) {

	return {
		title: 'Edit Protected Source',
		minWidth: 300,
		minHeight: 60,
		onOk: function() {
			var newSourceValue = this.getContentElement( 'info', 'txtProtectedSource' ).getValue();
			
			var encodedSourceValue = CKEDITOR.plugins.showprotected.encodeProtectedSource( newSourceValue );
			
			CKEDITOR.plugins.showprotected.selectedElement.$.previousSibling.nodeValue = encodedSourceValue;
			CKEDITOR.plugins.showprotected.selectedElement.setAttribute('title', newSourceValue);
			CKEDITOR.plugins.showprotected.selectedElement.setAttribute('alt', newSourceValue);
		},

		onHide: function() {
			CKEDITOR.plugins.showprotected.selectedElement = undefined;
		},

		onShow: function() {
			var encodedSourceValue = CKEDITOR.plugins.showprotected.selectedElement.$.previousSibling.nodeValue;
			var decodedSourceValue = CKEDITOR.plugins.showprotected.decodeProtectedSource( encodedSourceValue );

			this.setValueOf( 'info', 'txtProtectedSource', decodedSourceValue );
		},
		contents: [
			{
			id: 'info',
			label: 'Edit Protected Source',
			accessKey: 'I',
			elements: [
				{
				type: 'text',
				id: 'txtProtectedSource',
				label: 'Value',
				required: true,
				validate: function() {
					if ( !this.getValue() ) {
						alert( 'The value cannot be empty' );
						return false;
					}
					return true;
				}
			}
			]
		}
		]
	};
} );