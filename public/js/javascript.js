function changeStatus(num)
{

 elem = dojo.byId("arrow"+num);
 path = 'http://www.chip.in.th/cms/public/img/icon/';

 if(elem.src == path+'resultset_down.png') {
	elem.src = path+'resultset_up.png';
	dojo.byId('nav-msg-body'+num).className = '';
 } else {
	elem.src = path+'resultset_down.png';
	dojo.byId('nav-msg-body'+num).className = 'hide';

 }
}

function del(guid){
	if(confirm('คุณต้องการลบ ? ใช่ หรือ ไม่')==true){
		window.location = '/maichailen/dinsorworks/index.php/webboard/del/'+guid;
	}else {
		window.location = 'webboard';
	}
}

var htmlText = null;
var magad;
function addElement() 
{
    if(htmlText ==null) {
        magad = parseInt(dojo.byId('total-magad').value);
        
        htmlText = '<div style="height:30px;" id="magad-'+magad+'">'+dojo.byId('magad-'+magad).innerHTML+'</div>';
        //alert(htmlText)
    }
  
    next = magad + 1;
    while(htmlText.search('magad-'+magad) >-1) {
        htmlText = htmlText.replace('magad-'+magad, 'magad-'+next);
        //alert(htmlText)
    }
    dojo.byId('fmagad-list').innerHTML += htmlText;
    dojo.byId('fmagad-'+next).value = '';
    magad = next;
}

var htmlTextT = null;
var magadT;
function addElementT()
{
    if(htmlTextT ==null) {
        magadT = parseInt(dojo.byId('total-magadT').value);

        htmlTextT = '<div style="height:30px;" id="magadT-'+magadT+'">'+dojo.byId('magadT-'+magadT).innerHTML+'</div>';
        //alert(htmlText)
    }

    next = magadT + 1;
    while(htmlTextT.search('magadT-'+magadT) >-1) {
        htmlTextT = htmlTextT.replace('magadT-'+magadT, 'magadT-'+next);
        //alert(htmlText)
    }
    dojo.byId('fmagadT-list').innerHTML += htmlTextT;
    dojo.byId('fmagadT-'+next).value = '';
    magadT = next;
}

var htmlTextF = null;
var magadF;
function addElementF()
{
    if(htmlTextF ==null) {
        magadF = parseInt(dojo.byId('total-magadF').value);

        htmlTextF = '<div style="height:30px;" id="magadF-'+magadF+'">'+dojo.byId('magadF-'+magadF).innerHTML+'</div>';
        //alert(htmlText)
    }

    next = magadF + 1;
    while(htmlTextF.search('magadF-'+magadF) >-1) {
        htmlTextF = htmlTextF.replace('magadF-'+magadF, 'magadF-'+next);
        //alert(htmlText)
    }
    dojo.byId('fmagadF-list').innerHTML += htmlTextF;
    dojo.byId('fmagadF-'+next).value = '';
    magadF = next;
}


function resetValues(id)
{
    dojo.byId(id).value = '';
}

function removeElement(id)
{
    dojo.destroy(id);
}