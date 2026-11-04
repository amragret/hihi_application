<?php

namespace Questions;

use Database;
use PDO;


class QuestionsManager implements QuestionsManagerInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    
    public function getAllQuestions(): array
    {
        $rows = $this->pdo->query(
            'SELECT q.id_question, q.texte, q.image, q.ordre AS ordre_question,
                    c.id_choix, c.libelle, c.ordre AS ordre_choix
             FROM question q
             JOIN choix c ON c.id_question = q.id_question
             ORDER BY q.ordre, c.ordre'
        )->fetchAll();

        $questions = [];

        foreach ($rows as $row) {
            $id = (int) $row['id_question'];

            
            if (!isset($questions[$id])) {
                $questions[$id] = new Question(
                    $id,
                    (int) $row['ordre_question'],
                    $row['texte'],
                    $row['image'],
                );
            }

            $questions[$id]->addChoice(new Choice(
                (int) $row['id_choix'],
                (int) $row['ordre_choix'],
                $row['libelle'],
            ));
        }

        return array_values($questions);
    }

    
    public function saveAnswers(int $userId, array $choiceIds): void
    {
        $delete = $this->pdo->prepare('DELETE FROM reponse WHERE id_utilisateur = :id');
        $delete->execute(['id' => $userId]);

        $insert = $this->pdo->prepare(
            'INSERT INTO reponse (id_utilisateur, id_choix) VALUES (:id_utilisateur, :id_choix)'
        );

        foreach ($choiceIds as $choiceId) {
            $insert->execute(['id_utilisateur' => $userId, 'id_choix' => $choiceId]);
        }
    }
}
