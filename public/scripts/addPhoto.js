document.getElementById('file').addEventListener('change', function () {
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				document.getElementById('image1').setAttribute('src', e.target.result);
			};
			reader.readAsDataURL(this.files[0]);
		}
	}
);
