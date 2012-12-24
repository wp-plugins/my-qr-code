tinyMCEPopup.requireLangPack();

var PasteTextDialog = {
	init : function() {},

	insert : function() {
		var arcode = tinyMCEPopup.dom.encode(document.getElementById('ar_code').value);
		tinyMCEPopup.editor.execCommand('mceInsertClipboardContent', false, {content : '[qrcode codeID='+ arcode +']'});
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(PasteTextDialog.init, PasteTextDialog);
