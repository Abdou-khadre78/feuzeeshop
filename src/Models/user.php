<?php

namespace App\Models;

use PDO;
use Config\DataBase;

class User
{
    protected ?int $id;
    protected ?string $firstname;
    protected ?string $lastname;
    protected ?string $mail;
    protected ?string $password;
    protected ?string $phonenumber;
    protected ?string $adress;
    protected ?string $created_at;
    protected int|string|null $id_role;

    public function __construct(?int $id, ?string $firstname, ?string $lastname, ?string $mail, ?string $password, ?string $phonenumber, ?string $adress, ?string $created_at, int|string|null $id_role)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->mail = $mail;
        $this->password = $password;
        $this->phonenumber = $phonenumber;
        $this->adress = $adress;
        $this->created_at = $created_at;
        $this->id_role = $id_role;
    }

    public function save(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO user (id,firstname,lastname,mail,password,phonenumber,adress,created_at,id_role) VALUES (?,?,?,?,?,?,?,?,?)";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id, $this->firstname,  $this->lastname,  $this->mail, $this->password, $this->phonenumber,  $this->adress, $this->created_at, $this->id_role]);
    }

    public function login($mail)
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `user` WHERE `mail` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$mail]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row['id_role'] == 1) {
            return new UserParent($row['id'], $row['pseudo'], $row['mail'], $row['password'], $row['score'], $row['id_role']);
        } elseif ($row['id_role'] == 2) {
            return new UserKid($row['id'], $row['pseudo'], $row['mail'], $row['password'], $row['score'], $row['id_role']);
        } else {
            return null;
        }
    }

    public function getUserById()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `user` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['id'], $row['pseudo'], $row['mail'], $row['password'], $row['score'], $row['id_role']);
        } else {
            return null;
        }
    }

    public function getKids()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT `user`.`id`, `user`.`pseudo` FROM `user` WHERE `user`.`id_role` = 2";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $resultKids = $statement->fetchAll(PDO::FETCH_ASSOC);
        $kids = [];
        foreach ($resultKids as $row) {
            $kid = new User($row['id'], $row['pseudo'], null, null, null, null);
            $kids[] = $kid;
        }
        return $kids;
    }
        // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    public function getIdRole(): ?int
    {
        return $this->id_role;
    }

    // Setters
    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;
        return $this;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function setPhonenumber(string $phonenumber): static
    {
        $this->phonenumber = $phonenumber;
        return $this;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;
        return $this;
    }

    public function setCreatedAt(DateTime $created_at): static
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function setIdRole(int|string $id_role): static
    {
        $this->id_role = $id_role;
        return $this;
    }
}
