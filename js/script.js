
function confirmDelete(){
	if (confirm("Вы подтверждаете удаление?")){
		return true;
	}else{
		return false;
	}
}

function ajaxFunction(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	var search1 = document.getElementsByName('dep_list')[0].value;
	var search2 = document.getElementsByName('cat_list')[0].value;
	var search3 = document.getElementsByName('active_list')[0].value;
	
	var queryString1 = "?search1=" + search1;
	var queryString2 = "search2=" + search2;
	var queryString3 = "search3=" + search3;
	
	ajaxRequest.open("GET", "search_all.php" + queryString1 + "&" + queryString2 + 
	                                                          "&" + queryString3, true);
	ajaxRequest.send(null);

}

function res(){
	document.getElementsByName('dep_list')[0].value = '';
	document.getElementsByName('cat_list')[0].value = '';
	document.getElementsByName('active_list')[0].value = '';
	document.getElementById('ajaxDiv').innerHTML = '';
}

