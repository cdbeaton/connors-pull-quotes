(function() {
	tinymce.PluginManager.add('pullquotes', function( editor, url ) {
		editor.addButton('pullquotes', {
			image: url + '/icon.png',
			tooltip: 'Insert Pull Quote',
			onclick: function(){
				var text = editor.selection.getContent({ 'format': 'html' });
				if ( text.length === 0 ) { alert( 'Please highlight some text.' ); return; }
				
				editor.windowManager.open({
					title: 'Insert Pull Quote',
					body: [{
						type: 'container',
						label: 'Align',
						layout: 'flow',
						items: [
							{type: 'listbox', name: 'align', values: [
									{ text: 'Centre', value: 'centre' },
									{ text: 'Right', value: 'right' },
									{ text: 'Left', value: 'left' }
								]
							}
						]
					},
					{
						type: 'container',
						label: 'Attribution (optional)',
						layout: 'flow',
						items: [
							{type: 'textbox', name: 'author', label: 'textbox', value: ''},
						]
					}],
					onsubmit: function(e){
						editor.execCommand('mceReplaceContent', false, '[pullquote' + (e.data.author !== '' ?  ' author=\'' + e.data.author + '\'' : '') + ' align=\'' + e.data.align + '\'' + ']' + text + '[/pullquote]');
					}
				},);
			}
		}); 
	});
})();