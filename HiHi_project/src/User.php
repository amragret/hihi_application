<?php

class User {
    private ?int $id;
    private string $pseudo;
    private string $email;
    private string $password;
    private int $roleId;
    private ?int $hihiId;

    public function __construct(
        string $pseudo,
        string $email,
        string $password,
        ?int $id = null,
        int $roleId = 1,
        ?int $hihiId = null
    ) {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
        $this->roleId = $roleId;
        $this->hihiId = $hihiId;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRoleId(): int {
        return $this->roleId;
    }

    public function getHihiId(): ?int {
        return $this->hihiId;
    }

    public function hasTakenTest(): bool {
        return $this->hihiId !== null;
    }
}
