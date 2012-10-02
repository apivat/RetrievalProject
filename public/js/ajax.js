/* Ajax script */
function voteClick(id)
{
    vote = confirm('ยีนยันการ Vote ของคุณ');
    if(vote) {
        dojo.xhrPost ({
            url: '/webboard/vote/'+id,
            handle: function(data) {
                //alert(data)
                if(parseInt(data) >0) {
                    dojo.byId('post-'+id).innerHTML = data;
                } else {
                    msg = 'ไม่สามารถ Vote ได้ในขณะนี้';
                    alert(msg);
                }
            }
        }); 
    }    
}

function gotoStep(from, to)
{  
    dojo.byId('step-'+from).className = '';
    dojo.byId('step-'+to).className = 'current'; 
    dojo.byId('apply-'+from).className = 'hide';
    dojo.byId('apply-'+to).className = ''; 
    window.scrollTo(0,0);
    if(to=='3')
        preview();      
}

function preview()
{
    copyValue('movie-name', 'movie_name');
    copyValue('embed-code', 'embed', 'html');
}

function copyValue(to, from, type)
{
    if(type=='html')
        dojo.byId(to).innerHTML = dojo.byId(from).innerHTML;
    else
        dojo.byId(to).innerHTML = dojo.byId(from).value;
}



/*
function uploadCard() 
{
	uri = '/index.php/happycard/upload_card';
	id = 'test';
		dojo.xhrPost({
			url: uri,
			form: "regis",
			handleAs: "text",
			handle: function(content) {
				//alert(content);
				dojo.byId(id).innerHTML = content;	
			}
		});


}
*/
function memberInput(id)
{
    for(var i=1; i<7; i++) {
        if(i<=id)
            dojo.byId('member-'+i).className = '';
        else
            dojo.byId('member-'+i).className = 'hide'; 
    }
}


// vote Card
function voteCard(guidCard)
{
	vote = confirm('คุณต้องการ Vote ใช่หรือไม่');

	if(vote) {
  uri = '/index.php/happycard/vote/'+guidCard;
	//alert(uri);
  dojo.xhrPost({
    url: uri,
    handleAs: 'text',
    handle: function(data) {
			//alert(data);
			if(data=='timeLimit') {
				alert('โหวตได้ทุกๆ 1 ช.ม.');
			} else {
				alert("เพิ่มคะแนนโหวต +1");
				dojo.byId('showVote').innerHTML = data;
			}


   }
 });
 }
}

function confirmDel2(id, table)
{

    uri = '/cms/confirm/index2/'+id+'/'+table;
	//alert(uri);
    dojo.xhrPost({
        url: uri,
        handleAs: 'text',
        handle: function(data) {
					//alert(data);
					dojo.byId('confirm2Popup').innerHTML = data;
        }
    });

	dijit.byId('confirm2Popup').show();
}

function delData2(id, table)
{
	uri = '/cms/confirm/dodelete2/'+id+'/'+table;
	//alert(uri);
	dojo.xhrPost({
		url: uri,
		handleAs: 'text',
		handle: function(data) {
			//alert(data);
			dijit.byId('confirm2Popup').hide();
			window.location.reload();
		 }
  });
}

function confirmDel(id, table)
{
    uri = '/cms/confirm/index/'+id+'/'+table;
	//alert(uri);
    dojo.xhrPost({
        url: uri,
        handleAs: 'text',
        handle: function(data) {
					//alert(data);
					dojo.byId('confirmPopup').innerHTML = data;
        }
    });

	dijit.byId('confirmPopup').show();
}

function delData(id, table)
{

	uri = '/cms/confirm/dodelete/'+id+'/'+table;
	//alert(uri);
	dojo.xhrPost({
		url: uri,
		handleAs: 'text',
		handle: function(data) {
			//alert(data);
			dijit.byId('confirmPopup').hide();
			window.location.reload();
		 }
  });
}
