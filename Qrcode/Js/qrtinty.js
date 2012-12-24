(function() {
    tinymce.create('tinymce.plugins.qrcodeplugin', {
        init : function(ed, url) {
			ed.addCommand('ar_code', function() {
				ed.windowManager.open({
					url :  url+'/../QRlib/QR_popup.php',
					width : 450,
					height : 220,
					inline : 1
				});
			});
            ed.addButton('qrcodeplugin', {
                title : 'QR Code',
                image : url+'/qrcode_what_icon_20x20.png',
                cmd : 'ar_code'
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('qrcodeplugin', tinymce.plugins.qrcodeplugin);
})();
