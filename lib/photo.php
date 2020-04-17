<?php
class Photo
{
	public $idAccount;
	public $idPhoto;
	public $description;
	public $datePhoto;
	public $imgPhoto = 'photoBoom/';

	function createImage($path)
	{
		$size = getimagesize($path);

		header("Content-type: {$size['mime']}");

		list($width_orig, $height_orig) = getimagesize($path);

		$width = $width_orig;
		$height = $height_orig;

		if ($width && ($width_orig < $height_orig)) {
			$width = ($height / $height_orig) * $width_orig;
		} else {
			$height = ($width / $width_orig) * $height_orig;
		}

		$image_p = imagecreatetruecolor($width, $height);
		$image = imagecreatefromjpeg($path);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

		imagejpeg($image_p, $path, 82);
	}

	function addPhoto()
	{
		if (isset($_FILES['file'])) {
			if (!preg_match('/[.](JPG)|(jpg)|(png)|(PNG)/', $_FILES['file']['name'])) {
				throw new Exception('Файл имел неверный формат либо вы не добавили фото.<br> Можно загружать только .jpg и.png файлы');
			}
			$this->imgPhoto = $this->imgPhoto . time() . $_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], '../' . $this->imgPhoto);
			$this->createImage('../' . $this->imgPhoto);
			$_SESSION['file'] = $this->imgPhoto;
		} else {
			throw new Exception('Файл не найден');
		}
	}

	function checkParams($idacc)
	{
		// проверяем корректность нашего файла
		$this->addPhoto(); 
		$this->description = trim($_POST['description']);
		if(trim($_POST['description'])){
			$this->datePhoto = $_POST['datephoto'];
			$this->idAccount = $idacc;
		} else {
			throw new Exception('Пожалуйста, заполните все поля.');
		}
	}

	function setPhoto()
	{
		global $pdo;
		$sql = 'INSERT INTO photo(idaccount, description, imgphoto, datephoto) 
		VALUES(:idaccount, :description, :imgphoto, CURRENT_DATE) RETURNING idphoto, datephoto';
		$params = [
			':idaccount' =>  $this->idAccount,
			':description' => $this->description,
			':imgphoto' => $this->imgPhoto
		];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$this->idPhoto = $data->idphoto;
		$this->daePhoto = $data->datephoto;
	}

	function getPhotoProfile($idAccount)
	{
		global $pdo;
		$sql = 'SELECT P.idphoto, P.datephoto, P.imgphoto
		FROM photo P
		WHERE P.idaccount= :idAccount
		ORDER BY P.datephoto DESC';
		$params = [':idAccount' => $idAccount];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchAll();
		return $data;
	}

	function getPhotoIndex()
	{
		global $pdo;
		$sql = 'SELECT idphoto, datephoto, imgphoto
		FROM photo
		ORDER BY datephoto DESC
		LIMIT 20';
		$request = $pdo->query($sql);
		$data = $request->fetchAll();
		return $data;
	}

	function getPhoto($idPhoto)
	{
		global $pdo;
		$sql = 'SELECT * FROM photo WHERE idphoto = :idPhoto';
		$params = [':idPhoto' =>  $idPhoto];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchObject();

		$this->idAccount = $data->idaccount;
		$this->idPhoto = $data->idphoto;
		$this->description = $data->description;
		$this->datePhoto = $data->datephoto;
		$this->imgPhoto = $data->imgphoto;
	}
}