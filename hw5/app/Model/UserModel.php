<?php
namespace App\Model;

use Base\Db;

class UserModel {
  private $name;
  private $id;
  private $createdAt;
  private $email;
  private $password;

  public function __construct(array $data) {
    if ($data) {
      $this->id = $data['id'];
      $this->name = $data['name'];
      $this->password = $data['password'];
      $this->email = $data['email'];
      $this->createdAt = $data['created_at'];
    }  
  }

  public function save() {
    $db = Db::getInstance();
    $insert = "INSERT INTO users (`name`, `password`, `email`, `created_at`) VALUES (
            :name, :password, :email, :created_at )";
    $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':password' => $this->password,
            ':email' => $this->getEmail(),
            ':created_at' => $this->createdAt
    ]);

    $id = $db->lastInsertId();
    $this->id = $id;

    return $id;
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

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public static function getByIds(array $userIds)
    {
        $db = Db::getInstance();
        $idsString = implode(',', $userIds);
        $data = $db->fetchAll(
            "SELECT * fROM users WHERE id IN($idsString)",
            __METHOD__
        );
        if (!$data) {
            return [];
        }

        $users = [];
        foreach ($data as $elem) {
            $user = new self($elem);
            $user->id = $elem['id'];
            $users[$user->id] = $user;
        }

        return $users;
    }
  

  public static function getByEmail(string $email): ?self {
    $db = Db::getInstance();
    $select = "SELECT * FROM users WHERE `email` = :email";
    $data = $db->fetchOne($select, __METHOD__, [
        ':email' => $email
    ]);

    if (!$data) {
        return null;
    }
    $user = new self($data);
    $user->id = $data['id'];
    return $user;

    //return new self($data);
  }

  public static function getById(int $id): ?self {
    $db = Db::getInstance();
    $select = "SELECT * FROM users WHERE id = $id";
    $data = $db->fetchOne($select, __METHOD__, [':id' => $id]);

    if (!$data) {
        return null;
    }

    //return new self($data);
    $user = new self($data);
    $user->id = $id;
    return $user;
  }

  public static function getList(int $limit = 10, int $offset = 0): array
    {
        $db = Db::getInstance();
        $data = $db->fetchAll(
            "SELECT * fROM users LIMIT $limit OFFSET $offset",
            __METHOD__
        );
        if (!$data) {
            return [];
        }

        $users = [];
        foreach ($data as $elem) {
            $user = new self($elem);
            $user->id = $elem['id'];
            $users[] = $user;
        }

        return $users;
    }

  public static function getPasswordHash(string $password) {
    return sha1(',.lskfjl' . $password);
  }

  public function isAdmin(): bool
    {
        return in_array($this->id, ADMIN_IDS);
    }
}

// class UserModel
// {
//     private $id;
//     private $name;
//     private $createdAt;
//     private $password;
//     private $email;

//     public function __construct(array $data)
//     {
//         $this->name = $data['name'];
//         $this->password = $data['password'];;
//         $this->createdAt = $data['created_at'];
//         $this->email = $data['email'];
//     }

//     public static function getByEmail(string $email)
//     {
//         $db = Db::getInstance();
//         $data = $db->fetchOne(
//             "SELECT * fROM users WHERE email = :email",
//             __METHOD__,
//             [':email' => $email]
//         );
//         if (!$data) {
//             return null;
//         }

//         $user = new self($data);
//         $user->id = $data['id'];
//         return $user;
//     }

//     public static function getByIds(array $userIds)
//     {
//         $db = Db::getInstance();
//         $idsString = implode(',', $userIds);
//         $data = $db->fetchAll(
//             "SELECT * fROM users WHERE id IN($idsString)",
//             __METHOD__
//         );
//         if (!$data) {
//             return [];
//         }

//         $users = [];
//         foreach ($data as $elem) {
//             $user = new self($elem);
//             $user->id = $elem['id'];
//             $users[$user->id] = $user;
//         }

//         return $users;
//     }

//     public function save()
//     {
//         $db = Db::getInstance();
//         $res = $db->exec(
//             'INSERT INTO users (
//                     name, 
//                     password, 
//                     created_at,
//                     email
//                     ) VALUES (
//                     :name, 
//                     :password, 
//                     :created_at,
//                     :email
//                 )',
//             __FILE__,
//             [
//                 ':name' => $this->name,
//                 ':password' => self::getPasswordHash($this->password),
//                 ':created_at' => $this->createdAt,
//                 ':email' => $this->email,
//             ]
//         );

//         $this->id = $db->lastInsertId();

//         return $res;
//     }

//     public static function getById(int $id): ?self
//     {
//         $db = Db::getInstance();
//         $data = $db->fetchOne("SELECT * fROM users WHERE id = :id", __METHOD__, [':id' => $id]);
//         if (!$data) {
//             return null;
//         }

//         $user = new self($data);
//         $user->id = $id;
//         return $user;
//     }


//     public static function getList(int $limit = 10, int $offset = 0): array
//     {
//         $db = Db::getInstance();
//         $data = $db->fetchAll(
//             "SELECT * fROM users LIMIT $limit OFFSET $offset",
//             __METHOD__
//         );
//         if (!$data) {
//             return [];
//         }

//         $users = [];
//         foreach ($data as $elem) {
//             $user = new self($elem);
//             $user->id = $elem['id'];
//             $users[] = $user;
//         }

//         return $users;
//     }

//     public static function getPasswordHash(string $password)
//     {
//         return sha1('.,f.akjsduf' . $password);
//     }

//     /**
//      * @return mixed
//      */
//     public function getId()
//     {
//         return $this->id;
//     }

//     /**
//      * @return string
//      */
//     public function getName(): string
//     {
//         return $this->name;
//     }

//     /**
//      * @return mixed
//      */
//     public function getPassword()
//     {
//         return $this->password;
//     }

//     public function isAdmin(): bool
//     {
//         return in_array($this->id, ADMIN_IDS);
//     }
// }