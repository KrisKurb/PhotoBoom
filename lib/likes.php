<?php
class Likes
{
	public $idLikes;
	public $markLikes;
	public $idPhoto;
	public $idAccount;

	public $countLikes;

	function setLikes()
	{
		$this->markLikes = $_POST['markLikes'];
		$this->idPhoto = $_SESSION['photo']->idPhoto;
		$this->idAccount = $_SESSION['account']->idAccount;

		global $pdo;
		$sql = 'INSERT INTO likes(marklikes, idphoto, idaccount) 
		VALUES(:marklikes, :idphoto, :idaccount) RETURNING idlikes';
		$params = [
			':marklikes' =>  $this->markLikes,
			':idphoto' => $this->idPhoto,
			':idaccount' => $this->idAccount
		];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$this->idLikes = $data->idlikes;
	}

	function getIdPhotoLike($idPhoto, $idAccount)
	{
		global $pdo;
		$sql = 'SELECT idlikes FROM likes WHERE idphoto = :idPhoto AND idaccount = :idAccount';
		$params = [':idPhoto' =>  $idPhoto,
								':idAccount' =>  $idAccount	];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchObject();
		if($data)
			return true;
		else
			return false;
	}
	
	function getCountLikes($idPhoto)
	{
		global $pdo;
		$sql = 'SELECT COUNT(idlikes) AS countlikes FROM likes WHERE idphoto = :idPhoto';
		$params = [':idPhoto' =>  $idPhoto];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchObject();
		if($data->countlikes)
			$this->countLikes = $data->countlikes;
		else
			$this->countLikes = 0;
		return $this->countLikes;
	}

	function getAvarageMarkLikes($idPhoto)
	{
		global $pdo;
		$sql = 'SELECT marklikes FROM likes WHERE idphoto = :idPhoto';
		$params = [':idPhoto' =>  $idPhoto];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchAll();
		$sumLikes = 0;
		for($i=0; $i < count($data); $i++){
			$sumLikes+=$data[$i]['marklikes'];
		}
		$this->countLikes = $this->getCountLikes($idPhoto);
		if($this->countLikes == 0)
			$sumLikes = 0;
		else 
			$sumLikes = round(( float ) $sumLikes / ( float ) $this->countLikes,2);
		return $sumLikes;
	}
}