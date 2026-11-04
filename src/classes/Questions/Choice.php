<?php

namespace Questions;

class Choice
{
    public function __construct(
        private int $id,
        private int $order,
        private string $label,
    ) {}

    public function getId(): int { return $this->id; }
    public function getOrder(): int { return $this->order; }
    public function getLabel(): string { return $this->label; }
}
