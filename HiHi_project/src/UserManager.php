<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/User.php';

class UserManager {
    private PDO $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    // Ajoute un utilisateur et renvoie son nouvel id
    public function add(User $user): int {
        $sql = "INSERT INTO utilisateur (
            pseudo,
            email,
            mot_de_passe
        ) VALUES (
            :pseudo,
            :email,
            :password
        )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':pseudo', $user->getPseudo());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    // Cherche un utilisateur par son e-mail
    public function findByEmail(string $email): ?User {
        $sql = "SELECT * FROM utilisateur WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        // Récupère la ligne trouvée, sous forme de tableau
        $data = $stmt->fetch();

        // Si personne n'a cet e-mail, fetch() renvoie false
        if (!$data) {
            return null;
        }

        // On transforme le tableau en objet User
        return new User(
            $data['pseudo'],
            $data['email'],
            $data['mot_de_passe'],
            $data['id_utilisateur'],
            $data['id_role'],
            $data['id_hihi']
        );
    }

    // Cherche un utilisateur par son id
    public function findById(int $id): ?User {
        $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new User(
            $data['pseudo'],
            $data['email'],
            $data['mot_de_passe'],
            $data['id_utilisateur'],
            $data['id_role'],
            $data['id_hihi']
        );
    }

    // Enregistre la HiHi obtenue au test
    public function saveHihi(int $userId, int $hihiId): void {
        $sql = "UPDATE utilisateur
                SET id_hihi = :hihi_id, date_attribution = NOW()
                WHERE id_utilisateur = :user_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':hihi_id', $hihiId);
        $stmt->bindValue(':user_id', $userId);

        $stmt->execute();
    }
}
