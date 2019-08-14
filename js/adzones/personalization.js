$j = jQuery.noConflict();
$j(document).ready(function() {

	var segmentaionType = $j('#segmentation_type').val();
	if(segmentaionType)
	{
		
		document.getElementById('segmentation_values_tr_'+segmentaionType).style.display="block";
		if(segmentaionType==4)
		{
			$j("#segmentation_values_"+segmentaionType).addClass("required-entry required-entry select");
		}
		else if(segmentaionType==2 || segmentaionType==3 || segmentaionType==7)
		{
			var textType = document.getElementsByName('segmentation_values_'+segmentaionType+'[]');
			for(var textValue=1;textValue<=textType.length;textValue++)
			{
				$j("#segmentation_values_"+segmentaionType+"_"+textValue).addClass("required-entry input-text required-entry");
			}
		}
		else{
			$j("#segmentation_values_"+segmentaionType).addClass("required-entry required-entry multiselect");
		}
	}
 });
function showAjax(step)
{
	var currentStep = document.getElementById('currentstep').value;
	var formToValidate = $('personalization_step'+currentStep);
	var validator = new Validation(formToValidate);
	if(validator.validate()) 
	{
		document.getElementById('loading-mask').style.display="block";
		if(step=="next")
		{
			setTimeout(function(){nxtStep()},900);
		}
		else if(step=="prev"){
			setTimeout(function(){prevStep()},900);
		}
	}
}
function nxtStep()
{
	var personalizationInfo = {'5':'Personalization information - A/B Testing','2':'Personalization information - Segmentation Type','3':'Personalization information - Content','4':'Personalization information - Status'};
	document.getElementById('loading-mask').style.display="none";
	var currentStep = document.getElementById('currentstep').value;
	var	nxtStep = (parseInt(currentStep))+1;
	var progress = ((parseInt(currentStep))*16)+"%";
	var progressValue = ((parseInt(currentStep))*20)+"%";
	document.getElementById('personalization_step'+nxtStep).style.display="block";
	document.getElementById('personalization_step'+currentStep).style.display="none";
	document.getElementById('currentstep').value = nxtStep;
	document.getElementById('progressbar').style.width = progress;
	document.getElementById('progressbar_value').innerHTML = "Progress "+progressValue;
	for (x in personalizationInfo)
	{
		if(x==nxtStep)
			document.getElementById('personalization_info_current').innerHTML = personalizationInfo[x];
	}	
	buttonStatus();
}
function prevStep()
{
	var personalizationInfo = {'1':'Personalization information - Name','2':'Personalization information - Segmentation Type','3':'Personalization information - Content','4':'Personalization information - Status'};
	document.getElementById('loading-mask').style.display="none";
	var currentStep = document.getElementById('currentstep').value;
	var	prvStep = (parseInt(currentStep))-1;
	var progress = (prvStep-1)*16+"%";
	var progressValue = (prvStep-1)*20+"%";
	document.getElementById('personalization_step'+prvStep).style.display="block";
	document.getElementById('personalization_step'+currentStep).style.display="none";
	document.getElementById('currentstep').value = prvStep;
	document.getElementById('progressbar').style.width = progress;
	document.getElementById('progressbar_value').innerHTML = "Progress "+progressValue;
	for (x in personalizationInfo)
	{
		if(x==prvStep)
			document.getElementById('personalization_info_current').innerHTML = personalizationInfo[x];
	}
	
	buttonStatus();
}
function buttonStatus()
{
	var currentStep = document.getElementById('currentstep').value;
	if(currentStep=="1")
	{
		document.getElementById('personalization_prev').style.display="none";
	}
	else{
		document.getElementById('personalization_prev').style.display="block";
	}
	if(currentStep=="5")
	{
		document.getElementById('personalization_next').style.display="none";
	}
	else{
		document.getElementById('personalization_next').style.display="block";
	}
}
function setAdzonesGrid(url)
{
	$j = jQuery.noConflict();
	new Ajax.Request(url,
	  {
		  parameters: {form_key: FORM_KEY},
          evalScripts: true,
		  onSuccess: function(transport){
			if(transport.responseText)
			{
				 $j('#personalization_adzones_content').html(transport.responseText);
			}
		},
		onFailure: function(error_msg){ alert(error_msg);}
	  });
}
function changeTestingStatus(url,anchor)
{
	new Ajax.Request(url,
	  {
		  parameters: {form_key: FORM_KEY},
          evalScripts: true,
		  onSuccess: function(transport){
			if(transport.responseText)
			{
				alert(transport.responseText);
			}
			else{
				anchor.innerHTML = "<span style='color:#ff0000;'>Hold by Admin</span>";
				anchor.setAttribute('onclick', ''); 
			}
		},
		onFailure: function(error_msg){ alert(error_msg);}
	  });
}
function showSegmentationValues(value)
{
	document.getElementById('segmentation_values_tr_'+value).style.display="block";
	if(value==4)
	{
		$j("#segmentation_values_"+value).addClass("required-entry required-entry select");
	}
	else if(value==2 || value==3 || value==7)
	{
		
		for(j=1;j<=7;j++)
		{
			var textType = document.getElementsByName('segmentation_values_'+j+'[]');
			
			for(var textValue=1;textValue<=textType.length;textValue++)
			{
				if(value == j)
				{
					$j("#segmentation_values_"+j+"_"+textValue).addClass("required-entry input-text required-entry");
				}
				else
				{
					$j("#segmentation_values_"+j+"_"+textValue).removeClass();
					$j("#country_"+textValue).removeClass();
					$j("#region_"+textValue).removeClass();
				}
			}
		}	
	}
	else if(value==1)
	{
		var textType = document.getElementsByName('country[]');
			
			for(var textValue=1;textValue<=textType.length;textValue++)
			{
				$j("#country_"+textValue).addClass("required-entry select");
				$j("#region_"+textValue).addClass("required-entry select");
			}
	}
	else{
		$j("#segmentation_values_"+value).addClass("required-entry required-entry multiselect select");
	}
	for(i=1;i<=7;i++)
	{
		if(value!=i)
		{
			document.getElementById('segmentation_values_tr_'+i).style.display="none";
			if(value!=1 && value!=2 && value!=3 && value!=7)
			{
				$j("#segmentation_values_"+i).removeClass();
				$j("#country_"+i).removeClass();
					$j("#region_"+i).removeClass();
			}
			var textType = document.getElementsByName('segmentation_values_'+i+'[]');
			if(i==1 || i==2 || i==3 || i==7)
			for(var textValue=1;textValue<=textType.length;textValue++)
			{
				
					$j("#segmentation_values_"+i+"_"+textValue).removeClass();
					$j("#country_"+i).removeClass();
					$j("#region_"+i).removeClass();
				
			}
		}
	}
}
function deleteRow(value)
{
	var id = value.split('_');
	var tbody = document.getElementById('segmentation_values_tr_'+id[0]).getElementsByTagName('tbody')[0];
	var tr = document.getElementById('segmentation_default_'+value);
	tbody.removeChild(tr);
	var currentRow = document.getElementById('segmentaion_hide_'+id[0]).value;
	currentRow = parseInt(currentRow)-1;
	document.getElementById('segmentaion_hide_'+id[0]).value = currentRow;
	
	if(currentRow == 0 && !(document.getElementById('segmentation_values_'+value)))
	{
		var newRow =addNewRow(id[0]);
		$j(tbody).append(newRow);	
	}
}
function addNewRow(id)
{
	var row = '<tr><td class="label"><label for="segmentation_values_'+id+'">Segmentation Values <span class="required">*</span></label></td><td class="value"><input type="textfield" class="required-entry input-text required-entry" name="segmentation_values_'+id+'[]" id="segmentation_values_'+id+'_1" value=""></td></tr>"';
	return row;
}
function addNewValueRow(id)
{
	var tbody = document.getElementById('segmentation_values_tr_'+id).getElementsByTagName('tbody')[0];
	var currentRow = document.getElementById('segmentaion_hide_'+id).value;
	currentRow = parseInt(currentRow)+1;
	var row = '<tr id="segmentation_default_'+id+'_'+currentRow+'"><td class="label"><label for="segmentation_values_'+id+'">Segmentation Values <span class="required">*</span></label></td><td class="value"><input type="textfield" class="required-entry input-text required-entry" name="segmentation_values_'+id+'[]" id="segmentation_values_'+id+'_'+currentRow+'" value=""></td><td><button style="" onclick="deleteRow(this.value)" value="'+id+'_'+currentRow+'" class="scalable delete" type="button" title="Delete"><span><span><span>Delete</span></span></span></button></td></tr>"';
	document.getElementById('segmentaion_hide_'+id).value = currentRow;
	$j(tbody).append(row);	
	
}
function addNewLocation()
{
	var country = document.getElementById('country_tr_0').innerHTML;

	var region = document.getElementById('region_tr_0').innerHTML;
	var tbody = document.getElementById('segmentation_values_tr_1').getElementsByTagName('tbody')[0];
	var currentRow = document.getElementById('segmentaion_hide_1').value;
	currentRow = parseInt(currentRow)+1;
	country = country.replace("showRegion(this.value,'0')","showRegion(this.value,'"+currentRow+"')");
	country = country.replace("selected","");
	country = country.replace("country_0","country_"+currentRow+"");
	country = country.replace("*","");
	country = country.replace("required-entry","");
	country = country.replace("button_remove",currentRow);
	
	country = '<tr id="country_tr_'+currentRow+'">'+country+'</tr>';
	region = region.replace("region_0","region_"+currentRow+"");
	
	region = '<tr id="region_tr_'+currentRow+'" style="display:none;">'+region+'</tr>';
	$j(tbody).append(country);
	$j(tbody).append(region);
	document.getElementById('segmentaion_hide_1').value = currentRow;
}
function showRegion(country,id)
{
	
	if(country=="US")
	{
		document.getElementById('region_tr_'+id).style.display="";
		document.getElementById('region_'+id).style.display="";
		$j("#region_"+id).addClass("required-entry select required-entry");
		
	}
	else{
		document.getElementById('region_tr_'+id).style.display="none";
		$j("#region_"+id).removeClass();
	}
}
function deleteLocation(value)
{
	var currentRow = document.getElementById('segmentaion_hide_1').value;
	if(currentRow == '1')
	{
		document.getElementById('country_'+value).value = "";
		document.getElementById('region_'+value).style.display = "none";
		$j("#region_"+value).removeClass();
	}
	else
	{
		var tbody = document.getElementById('segmentation_values_tr_1').getElementsByTagName('tbody')[0];
		var trCountry = document.getElementById('country_tr_'+value);
		var trRegion = document.getElementById('region_tr_'+value);
		tbody.removeChild(trCountry);
		tbody.removeChild(trRegion);
	
		currentRow = parseInt(currentRow)-1;
		document.getElementById('segmentaion_hide_1').value = currentRow;
	
	}
}
function trafficCompare(personalizationid,url)
{
	if(personalizationid > 0)
	{
		url = url+"personalization_id/"+personalizationid;
		new Ajax.Request(url,
	  	{
		  methos : "post",
		  onSuccess: function(transport){
			if(transport.responseText)
			{
				var content = document.getElementById('compare_form');
				if(document.getElementById('compareDiv') == null)
				{
					var comparediv = document.createElement('div');
					comparediv.setAttribute('id', 'compareDiv'); 
					content.appendChild(comparediv);
				}
				document.getElementById('compareDiv').innerHTML = transport.responseText;
				
			}
		},
		onFailure: function(error_msg){ alert(error_msg);}
	  });
	}
}
function createpersonalization()
{
	$('personalization_tabs_create_section').click();
}
function changeDomain(url)
{
	var licenseKey = $('license_key').value;
	var currentDomain = $('current_domain').value;
	var newDomain = $('new_domain').value;
	if(!(licenseKey && currentDomain && newDomain))
	{
		alert("All fields are required");
		return false;
	}
	if(!(checkPerDomain(currentDomain) && checkPerDomain(newDomain)))
	{
		alert("Please enter a valid URL. For example www.example.com");
		return false;
	}
	url = url+"license/"+licenseKey+"/current_domain/"+currentDomain+"/new_domain/"+newDomain;
	new Ajax.Request(url,
	  {
		  parameters: {form_key: FORM_KEY},
          evalScripts: true,
		  method: 'post',
		  onSuccess: function(transport){
			if(transport.responseText)
			{
				alert(transport.responseText);
			}
		},
		onFailure: function(error_msg){ alert(error_msg);}
	  });
}
function checkPerDomain(nname)
			{
				var arr = new Array('.com','.net','.org','.biz','.coop','.info','.museum','.name','.pro','.edu','.gov','.int','.mil','.ac','.ad','.ae','.af','.ag',
'.ai','.al','.am','.an','.ao','.aq','.ar','.as','.at','.au','.aw','.az','.ba','.bb','.bd','.be','.bf','.bg','.bh','.bi','.bj','.bm',
'.bn','.bo','.br','.bs','.bt','.bv','.bw','.by','.bz','.ca','.cc','.cd','.cf','.cg','.ch','.ci','.ck','.cl','.cm','.cn','.co','.cr',
'.cu','.cv','.cx','.cy','.cz','.de','.dj','.dk','.dm','.do','.dz','.ec','.ee','.eg','.eh','.er','.es','.et','.fi','.fj','.fk','.fm',
'.fo','.fr','.ga','.gd','.ge','.gf','.gg','.gh','.gi','.gl','.gm','.gn','.gp','.gq','.gr','.gs','.gt','.gu','.gv','.gy','.hk','.hm',
'.hn','.hr','.ht','.hu','.id','.ie','.il','.im','.in','.io','.iq','.ir','.is','.it','.je','.jm','.jo','.jp','.ke','.kg','.kh','.ki',
'.km','.kn','.kp','.kr','.kw','.ky','.kz','.la','.lb','.lc','.li','.lk','.lr','.ls','.lt','.lu','.lv','.ly','.ma','.mc','.md','.mg',
'.mh','.mk','.ml','.mm','.mn','.mo','.mp','.mq','.mr','.ms','.mt','.mu','.mv','.mw','.mx','.my','.mz','.na','.nc','.ne','.nf','.ng',
'.ni','.nl','.no','.np','.nr','.nu','.nz','.om','.pa','.pe','.pf','.pg','.ph','.pk','.pl','.pm','.pn','.pr','.ps','.pt','.pw','.py',
'.qa','.re','.ro','.rw','.ru','.sa','.sb','.sc','.sd','.se','.sg','.sh','.si','.sj','.sk','.sl','.sm','.sn','.so','.sr','.st','.sv',
'.sy','.sz','.tc','.td','.tf','.tg','.th','.tj','.tk','.tm','.tn','.to','.tp','.tr','.tt','.tv','.tw','.tz','.ua','.ug','.uk','.um',
'.us','.uy','.uz','.va','.vc','.ve','.vg','.vi','.vn','.vu','.ws','.wf','.ye','.yt','.yu','.za','.zm','.zw');
 
				var mai = nname;
				var val = true;
				var dot = mai.lastIndexOf(".");
				var dname = mai.substring(0,dot);
				var ext = mai.substring(dot,mai.length);
				if(dot>2 && dot<57)
				{
					for(var i=0; i<arr.length; i++)
					{
	  					if(ext == arr[i])
	  					{
	 						val = true;
							break;
	  					}	
	  					else
	  					{
	 						val = false;
						}
					}
					if(val == false)
					{
	  	 				
		 				return false;
					}
					else
					{
						for(var j=0; j<dname.length; j++)
						{
		  					var dh = dname.charAt(j);
		  					var hh = dh.charCodeAt(0);
		  					if((hh > 47 && hh<59) || (hh > 64 && hh<91) || (hh > 96 && hh<123) || hh==45 || hh==46)
		  					{
			 					if((j==0 || j==dname.length-1) && hh == 45)	
		  	 					{
		 	  	 					
			      					return false;
		 	 					}
		  					}
							else	
							{
		  	 					
			 					return false;
		  					}
						}
					}
				}
				else
				{
 					
 					return false;
				}	
				return true;
			}
document.observe('dom:loaded', function() {
   
	if($('ab_test').value == 2)
	{
		$('start_date').removeClassName('required-entry');
		$('end_date').removeClassName('required-entry');
		$('ab_test_criteria').removeClassName('required-entry');
	}
	$$("#ab_test").invoke('observe', 'change', function(el) {
    	if($('ab_test').value == 1)
		{
				$('start_date').addClassName('required-entry');
				$('end_date').addClassName('required-entry');
				$('ab_test_criteria').addClassName('required-entry');
		}
		if($('ab_test').value == 2)
		{
			$('start_date').removeClassName('required-entry');
			$('end_date').removeClassName('required-entry');
			$('ab_test_criteria').removeClassName('required-entry');
		}
	});
});
