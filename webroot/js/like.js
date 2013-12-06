window.onload = function() {
	if ( insertButton() ) {
		var params = getParams();
		var url = '<?php echo FULL_BASE_URL ?>/activities/activities/ping/like/'+params.m+'/'+params.id;
		var button = document.getElementById('buildrrLikeButton');
		button.onclick = function(e) {
			e.stopPropagation();
			var liked = httpGet(url);
			if ( liked === 'true' ) {
				// change color and remove link action
				button.style.background = '#ccc';
				button.style.cursor = 'not-allowed';
				button.onclick = null;
			} else {
				//alert('fail');
			}
		};
	}
};

function insertButton() {
	var scriptBlock = document.getElementById('buildrrLiker');
	var likeButton = document.createElement('div');
	likeButton.id = 'buildrrLikeButton';
	likeButton.style.background = '#FF7F00';
	likeButton.style.width = '50px';
	likeButton.style.padding = '5px';
	likeButton.style.borderRadius = '5px';
	likeButton.style.cursor = 'pointer';
	likeButton.style.fontFamily = '"Open Sans",Helvetica,Arial,sans-serif';
	likeButton.style.color = '#fff';
	likeButton.style.fontSize = '16px';
	likeButton.innerHTML = 'Like';
	document.body.insertBefore(likeButton, scriptBlock);
	return true;
}

function getParams() {
	var requestURL = document.getElementById("buildrrLiker").getAttribute("src");
	var queryString = requestURL.substring(requestURL.indexOf("?") + 1, requestURL.length);
	var params = queryString.split("&");
	var cleanParams = [];
	for (var i = 0; i < params.length; i++) {
 		var name  = params[i].substring(0,params[i].indexOf("="));
 		var value = params[i].substring(params[i].indexOf("=") + 1, params[i].length);
 		cleanParams[name] = value;
	}
	return cleanParams;
}
function httpGet(theUrl) {
	var xmlHttp = null;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET", theUrl, false );
	xmlHttp.send( null );
	return xmlHttp.responseText;
}
