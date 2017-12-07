(function() {
	tinymce.PluginManager.add('pullquotes', function( editor, url ) {
		editor.addButton('pullquotes', {
			title: 'Insert Pull Quote',
			cmd: 'pullquotes',
			image: url + '/icon.png',
		}); 
		
		editor.addCommand('pullquotes', function() {
			var text = editor.selection.getContent({ 'format': 'html' });
			if ( text.length === 0 ) { alert( 'Please select some text to link.' ); return; }
			
			var result = prompt('Author name');
			if ( !result ) { return; }
			if (result.length === 0) { return; }
		 
			editor.execCommand('mceReplaceContent', false, '[pullquote author=\'' + result + '\']' + text + '[/pullquote]');
		});
	});
})();