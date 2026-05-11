<?php

final class Contato {

    private string $telefone;
    private string $instagram;
    private string $endereco;
    private string $checkin;
    private string $checkout;

    public function __construct(string $telefone, string $instagram, string $endereco, string $checkin, string $checkout) {
        $this->telefone = $telefone;
        $this->instagram = $instagram;
        $this->endereco = $endereco;
        $this->checkin = $checkin;
        $this->checkout = $checkout;
    }

    public function exibirContato() {
        echo '
        <p class="footer__contact">
            WhatsApp:<br />
            <a href="https://wa.me/55' . preg_replace('/\D/', '', $this->telefone) . '">
                ' . $this->telefone . '
            </a>
        </p>
        <p class="footer__contact">
            Instagram:<br />
            <a href="https://instagram.com/' . ltrim($this->instagram, '@') . '" target="_blank" rel="noopener">
                ' . $this->instagram . '
            </a>
        </p>
        <address class="footer__address">' . $this->endereco . '</address>';
    }

    public function exibirHorario() {
        echo '<p>Check-in: ' . $this->checkin . ' &nbsp;|&nbsp; Check-out: ' . $this->checkout . '</p>';
    }
}