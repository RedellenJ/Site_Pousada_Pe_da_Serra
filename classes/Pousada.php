<?php

final class Pousada {

    private string $nome;
    private array $quartos;

    public function __construct(string $nome) {
        $this->nome    = $nome;
        $this->quartos = [];
    }

    public function adicionarQuarto($quarto) {
        $this->quartos[] = $quarto;
    }

    public function listarQuartos() {
        foreach ($this->quartos as $quarto) {
            $quarto->exibirCard();
        }
    }
}