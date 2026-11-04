<?php

namespace Questions;

class Question
{
    /** @var Choice[] */
    private array $choices = [];

    public function __construct(
        private int $id,
        private int $order,
        private string $text,
        private ?string $image = null,
    ) {}

    public function getId(): int { return $this->id; }
    public function getOrder(): int { return $this->order; }
    public function getText(): string { return $this->text; }
    public function getImage(): ?string { return $this->image; }

    /** @return Choice[] */
    public function getChoices(): array
    {
        return $this->choices;
    }

    public function addChoice(Choice $choice): void
    {
        $this->choices[] = $choice;
    }

    // Vérification du formulaire par rapport au choix
    public function hasChoice(int $choiceId): bool
    {
        foreach ($this->choices as $choice) {
            if ($choice->getId() === $choiceId) {
                return true;
            }
        }

        return false;
    }
}
