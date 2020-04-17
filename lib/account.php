<?php
class Account
{
	public $idAccount;
	public $password;
	public $email;
	public $nameAccount;
	function addParams()
	{
		$this->password=$_POST['password'];
		$this->email=$_POST['email'];
		$this->nameAccount=$_POST['name'];
	}
	function regAccount()
	{
		if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name']) && $_POST['agree']) {
        if (!preg_match("/^[а-яА-я_\-%\s]+$/iu", $_POST['name'])) {
            throw new Exception('В имени допустимы только русские буквы, пробелы и дефисы!');
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Введите корректный email!');
        }
        if (strlen($_POST['password']) < 6) {
            throw new Exception('Минимальная длина пароля - 6 символов!');
        } elseif (!preg_match("/[^0-9]/", $_POST['password'])) {
            throw new Exception('Пароль не может состоять только из одних цифр!');
        }
        if (strcasecmp($_POST['password_replay'], $_POST['password']) != 0) {
            throw new Exception('Пароли не совпадают!');
        }
        if ($this->nameVerification()) {
            throw new Exception('Пользователь с таким именем уже существует!');
        }
        if ($this->emailVerification()) {
            throw new Exception('Пользователь с такой почтой уже существует!');
				}
			} else {
				throw new Exception('Пожалуйста, заполните все поля');
			}
			
	}
	function nameVerification()
	{
		global $pdo;
		$sql = 'SELECT nameaccount FROM account WHERE nameaccount = :nameaccount';
		$params = [':nameaccount' =>  $this->nameAccount];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchObject();
		return $data;
	}
	function emailVerification()
	{
		global $pdo;
		$sql = 'SELECT email FROM account WHERE email = :email';
		$params = [':email' =>  $this->email];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchObject();
		return $data;
	}

	function setAccount()
	{
		global $pdo;
		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO account(email, password, nameaccount)
		VALUES(:email, :password, :nameaccount) RETURNING idaccount';
		$params = [
			':email' =>  $this->email,
			':password' => $this->password,
			':nameaccount' => $this->nameAccount
		];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$this->idAccount = $data->idaccount;
	}
	function getPassword()
	{
		global $pdo;
		$sql = 'SELECT password, idaccount, nameaccount FROM account WHERE email = :email';
		$params = [':email' =>  $this->email];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$this->password=$data->password;
		$this->idAccount=$data->idaccount;
		$this->nameAccount=$data->nameaccount;
	}

	function verifyPassword($passwordCheck)
	{
		$this->getPassword();
		if(password_verify($passwordCheck, $this->password))
			return (true);
		else
			return (false);
	}

	function getNameAccount($idPhoto)
	{
		global $pdo;
		$sql = 'SELECT A.nameaccount FROM account A INNER JOIN photo P ON A.idaccount=P.idaccount WHERE P.idphoto = :idPhoto';
		$params = [':idPhoto' =>  $idPhoto];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		return $data->nameaccount;
	}

	function checkAccountProfile($nameAccount)
	{
		global $pdo;
		$sql = 'SELECT nameaccount, idaccount FROM account WHERE nameaccount = :nameAccount';
		$params = [':nameAccount' =>  $nameAccount];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		return $data;
	}
} 