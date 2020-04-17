function clickOnPhoto(id) {
	var data = {
		idPhoto: id
	};
	var xhr = new XMLHttpRequest();
	var body = "idPhoto=" + data.idPhoto;
	xhr.open("GET", "../openphoto.php?" + body, true);
	xhr.send();
	document.location.href = "../openphoto.php?" + body;
}