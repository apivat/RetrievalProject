function selectFile(url)
{
	var tmp = url.split('/public');
	var mod = tmp[1].split('/');
	var img = url.split(mod[1]+'/');
    window.opener.document.getElementById(elementId).value = ''+img[1];
    window.close();
}



function cancelSelectFile()
{
  // close popup window
  window.close() ;
}

