<?php
class User {
  private $name;
  private $id;
  private $createdAt;
  private $email;
  private $password;

  public function __construct($data = []) {
    if ($data) {
      $this->id = $data['id'];
      $this->name = $data['name'];
      $this->password = $data['password'];
      $this->email = $data['email'];
      $this->createdAt = $data['created_at'];
    }  
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName(string $name) {
    $this->name = $name;
  }

  public function getId() {
    return $this->id;
  }

  public function setId(int $id): self {
    $this->id = $id;
    return $this;
  }

  public function getCreatedAt(): string {
    return $this->createdAt;
  }

  public function setCreatedAt(string $createdAt) {
    $this->createdAt = $createdAt;
  }

  public function getEmail() {
    return $this->email;
  }  

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getPassword(): self {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function save() {
    $db = Db::getInstance();
    $insert = "INSERT INTO users (`name`, `password`, `email`) VALUES (
            :name, :password, :email )";
    $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':password' => $this->password,
            ':email' => $this->getEmail()
    ]);

    $id = $db->lastInsertId();
    $this->id = $id;

    return $id;
  }

  public static function getByName(string $name): ?self {
    $db = Db::getInstance();
    $select = "SELECT * FROM users WHERE `name` = :name";
    $data = $db->fetchOne($select, __METHOD__, [
        ':name' => $name
    ]);

    if (!$data) {
        return null;
    }

    return new self($data);
  }

  public static function getById(int $id): ?self {
    $db = Db::getInstance();
    $select = "SELECT * FROM users WHERE id = $id";
    $data = $db->fetchOne($select, __METHOD__);

    if (!$data) {
        return null;
    }

    return new self($data);
  }

  public static function getPasswordHash(string $password) {
    return sha1(',.lskfjl' . $password);
  }
}