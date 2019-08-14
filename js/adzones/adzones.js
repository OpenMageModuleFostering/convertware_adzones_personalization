function hideContentHeader()
{
	var classValue=document.getElementsByClassName('content-header');
	for (var i=0; i < classValue.length; i++) {
		if(i==2){
			classValue[i].style.display = 'none';
		}
	}
}
function deleteContent(url)
{
	 new Ajax.Request(url,
	  {
		method:'get',
		onSuccess: function(transport){
			if(transport.responseText)
			{
				alert(transport.responseText);
			}
			else			
			{
				contentGridJsObject.resetFilter();
			}
		},
		onFailure: function(error_msg){ alert(error_msg);}
	  });
}

