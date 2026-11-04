<?php

namespace Users;

use Database;
use PDO;

// Seule classe qui lit et écrit dans la table "utilisateur".
class UsersManager implements UsersManagerInterface {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getPdo();
    }

    public function getUserById(int $id): ?User {
        return $this->findOneBy('id_utilisateur', $id);
    }

    public function getUserByEmail(string $email): ?User {
        return $this->findOneBy('email', $email);
    }

    public function getUserByShareCode(string $shareCode): ?User {
        return $this->findOneBy('code_partage', $shareCode);
    }

    public function emailExists(string $email): bool {
        return $this->getUserByEmail($email) !== null;
    }

    public function pseudoExists(string $pseudo): bool {
        return $this->findOneBy('pseudo', $pseudo) !== null;
    }




    public function createUser(User $user): int {
        $stmt = $this->pdo->prepare(
            'INSERT INTO utilisateur (pseudo, email, mot_de_passe, language, id_role)
             VALUES (:pseudo, :email, :mot_de_passe, :language, :id_role)'
        );
        $stmt->execute([
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'mot_de_passe' => $user->getPasswordHash(),
            'language' => $user->getLanguage(),
            'id_role' => $user->getRoleId(),
        ]);

        return (int) $this->pdo->lastInsertId();
    }


    public function saveResult(User $user, int $hihiId): void {
        $shareCode = $user->getShareCode() ?? bin2hex(random_bytes(16)); // 32 caractères

        $stmt = $this->pdo->prepare(
            'UPDATE utilisateur
             SET id_hihi = :id_hihi, date_attribution = NOW(), code_partage = :code
             WHERE id_utilisateur = :id'
        );
        $stmt->execute([
            'id_hihi' => $hihiId,
            'code' => $shareCode,
            'id' => $user->getId(),
        ]);
    }



    private function findOneBy(string $column, string|int $value): ?User {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE $column = :value");
        $stmt->execute(['value' => $value]);
        $row = $stmt->fetch();

        return $row ? User::fromRow($row) : null;
    }
}
