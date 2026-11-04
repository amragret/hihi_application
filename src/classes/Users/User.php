<?php

namespace Users;


class User {
    public const ROLE_USER = 1;
    public const ROLE_ADMIN = 2;

    public function __construct(
        private ?int $id,
        private string $pseudo,
        private string $email,
        private string $passwordHash,
        private string $language = 'fr',
        private int $roleId = self::ROLE_USER,
        private ?int $hihiId = null,
        private ?string $shareCode = null,
    ) {
    }


    public static function fromRow(array $row): self {
        return new self(
            (int) $row['id_utilisateur'],
            $row['pseudo'],
            $row['email'],
            $row['mot_de_passe'],
            $row['language'],
            (int) $row['id_role'],
            $row['id_hihi'] !== null ? (int) $row['id_hihi'] : null,
            $row['code_partage'],
        );
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
    public function getPasswordHash(): string {
        return $this->passwordHash;
    }
    public function getLanguage(): string {
        return $this->language;
    }
    public function getRoleId(): int {
        return $this->roleId;
    }
    public function getHihiId(): ?int {
        return $this->hihiId;
    }
    public function getShareCode(): ?string {
        return $this->shareCode;
    }

    public function isAdmin(): bool {
        return $this->roleId === self::ROLE_ADMIN;
    }

    // L'utilisateur a passé le test s'il a une HiHi attribuée.
    public function hasTakenTest(): bool {
        return $this->hihiId !== null;
    }

    public function checkPassword(string $password): bool {
        return password_verify($password, $this->passwordHash);
    }
}
