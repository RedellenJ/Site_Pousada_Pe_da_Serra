<?php

final class Quarto {

    private string $nome;
    private string $descricao;
    private int $capacidade;
    private string $imagem;
    private WhatsApp $whatsapp;

    public function __construct(string $nome, string $descricao, int $capacidade, string $imagem, WhatsApp $whatsapp) {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->capacidade = $capacidade;
        $this->imagem = $imagem;
        $this->whatsapp = $whatsapp;
    }

    private function gerarMensagemReserva() {
        return "Olá! Gostaria de reservar a " . $this->nome . ". Poderia me passar mais informações?";
    }

    public function exibirCard() {
        $linkReserva = $this->whatsapp->gerarLink($this->gerarMensagemReserva());

        echo '
        <article class="room-card">
            <img src="' . $this->imagem . '" alt="' . $this->nome . '" class="room-card__image" />
            <div class="room-card__content">
                <div class="room-card__top">
                    <h3 class="room-card__title">' . $this->nome . '</h3>
                </div>
                <p class="room-card__description">' . $this->descricao . '</p>
                <span class="room-card__capacity">Acomoda até ' . $this->capacidade . ' hóspedes</span>
                <a href="' . $linkReserva . '" target="_blank" class="room-card__button">
                    Reservar
                </a>
            </div>
        </article>';
    }
}