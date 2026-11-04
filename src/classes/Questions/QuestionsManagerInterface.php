<?php

namespace Questions;

interface QuestionsManagerInterface
{
    /** @return Question[] */
    public function getAllQuestions(): array;

    public function saveAnswers(int $userId, array $choiceIds): void;
}
