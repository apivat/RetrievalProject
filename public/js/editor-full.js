// Default skin
var root = location.href.split('/cms');
var webroot = root[0];
var temp = root[1].split('/');
var module = temp[1];

//alert(webroot+"/cms/public/css/content.css");

tinyMCE.init({
	// General options
	mode : "textareas",
	elements : "detail",
	theme : "advanced",
	//media_strict: false,
	plugins : "preview,safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",

	// Theme options
	theme_advanced_buttons1 : "undo,cut,copy,paste,pasteword,|,bullist,numlist,fontsizeselect,bold,italic,underline,justifyleft,justifycenter,justifyright,justifyfull,|,outdent,indent,|,sub,sup,code,preview",
	theme_advanced_buttons2 : "link,unlink,cleanup,|,forecolor,backcolor,hr,removeformat,visualaid,charmap,image,media,|,tablecontrols",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",//"styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,
	theme_advanced_font_sizes : "8px,10px,11px,12px,13px,14px,16px,18px,24px",


	extended_valid_elements : "hr[class|width|size|noshade],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder]",
	//extended_valid_elements : "hr[class|width|size|noshade]",
	file_browser_callback : "ajaxfilemanager",
	paste_use_dialog : false,
	theme_advanced_resize_horizontal : true,
	apply_source_formatting : true,
	force_br_newlines : true,
	force_p_newlines : false,	
	relative_urls : false,
				
	// Example content CSS (should be your site CSS)
	content_css : webroot+"/cms/public/css/content.css",
	convert_fonts_to_spans : false,

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : webroot+"/cms/lists/template_list.js",
	external_link_list_url : webroot+"/cms/lists/link_list.js",
	external_image_list_url : webroot+"/cms/lists/image_list.js",
	media_external_list_url : webroot+"/cms/lists/media_list.js"

	// Replace values for the template plugin
	//template_replace_values : {
		//username : "Some User",
		//staffid : "991234"
	//}
});

function ajaxfilemanager(field_name, url, type, win) {
	//var root = location.href.split('/dinsorworks');
	//var webroot = root[0];
	//alert(webroot)
	switch (type) {
		case "image":
			type="img";
			break;
		case "media":
			break;
		case "flash": 
			break;
		case "file":
			break;
		default:
			return false;
	}
	var ajaxfilemanagerurl = webroot+"/cms/plugins/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?editor=tinymce&type="+type+"&mod="+module;
  	tinyMCE.activeEditor.windowManager.open({
  		url: ajaxfilemanagerurl,
  		width: 782,
   		height: 400,
   		inline : "yes",
   		close_previous : "yes"
  	},{
    	window : win,
     	input : field_name
   	});
}

function setFile(elementId, type)
{
    switch (type) {
		case "file":
			type = 'file';
			break;
        case "tape":
            type = 'tape';
            module = '';
            break;
		default:
			type = 'img';
	}

	var win = winOpen(webroot+'/cms/plugins/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?editor=form&type='+type+'&mod='+module+'&elementId='+elementId, 'ajaxFileImageManager', '600', '940');	
	return win;
}

function winOpen(windowUri, windowName, windowHeight, windowWidth)
{
    var centerWidth = (window.screen.width - windowWidth) / 2;
    var centerHeight = (window.screen.height - windowHeight) / 2;

    newWindow = window.open(windowUri, windowName, 'resizable=0,width=' + windowWidth + 
        ',height=' + windowHeight + 
        ',left=' + centerWidth + 
        ',top=' + centerHeight
		);

    newWindow.focus();
    return newWindow;
}