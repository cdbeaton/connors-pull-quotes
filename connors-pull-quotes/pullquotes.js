(function() {
	tinymce.PluginManager.add('pullquotes', function( editor, url ) {
		editor.addButton('pullquotes', {
			image: url + '/icon.png',
			tooltip: 'Insert Pull Quote',
			onclick: function(){
				var text = editor.selection.getContent({ 'format': 'html' });
				var refnode = editor.selection.getNode();
				
				editor.windowManager.open({
					title: 'Insert Pull Quote',
					body: [{
							type: 'container',
							layout: 'flow',
							items: [ {type: 'textbox', name: 'quote', label: 'textbox', value: text, style: 'width:280px;'} ]
						},
						{
						type: 'container',
						label: 'Align',
						layout: 'flow',
						items: [
							{type: 'listbox', name: 'align', values: [
									{ text: 'Centre', value: 'centre' },
									{ text: 'Right', value: 'right' },
									{ text: 'Left', value: 'left' }
							]}
						]},
						{
							type: 'container',
							label: 'Author (optional)',
							layout: 'flow',
							items: [ {type: 'textbox', name: 'author', label: 'textbox', value: ''} ]
						}
					],
					onsubmit: function(e){
						var quote = editor.dom.create('p', null, '[pullquote' + (e.data.author !== '' ?  ' author=\'' + e.data.author + '\'' : '') + ' align=\'' + e.data.align + '\'' + ']"' + e.data.quote + '"[/pullquote]');
						editor.dom.add(refnode, quote);
					}
				},);
			}
		}); 
	});
})();