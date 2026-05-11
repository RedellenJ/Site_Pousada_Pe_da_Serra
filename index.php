<?php

require_once 'classes/WhatsApp.php';
require_once 'classes/Quarto.php';
require_once 'classes/Pousada.php';
require_once 'classes/Contato.php';

$whatsapp = new WhatsApp("5535997583373", "Olá! Gostaria de saber mais sobre a Pousada Pé da Serra.");

$pousada = new Pousada("Pousada Pé da Serra");
$pousada->adicionarQuarto(new Quarto("Suíte 1", "Ambiente aconchegante e confortável para relaxar e aproveitar a pousada.", 2, "Img/Suíte/quarto1.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 2", "Espaço confortável com ambiente acolhedor ideal para momentos de descanso.", 2, "Img/Suíte/quarto2.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 3", "Suíte espaçosa e confortável para aproveitar dias inesquecíveis em São Tomé das Letras.", 3, "Img/Suíte/quarto3.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 4", "Conforto e praticidade em um ambiente tranquilo cercado pela natureza da serra.", 2, "Img/Suíte/quarto4.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 5", "Ambiente amplo e acolhedor perfeito para compartilhar bons momentos.", 3, "Img/Suíte/quarto5.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 6", "Ideal para descansar e aproveitar toda a experiência que a pousada tem a oferecer.", 3, "Img/Suíte/quarto6.jpg", $whatsapp));

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pousada Pé da Serra</title>

  <link rel="icon" type="image/png" href="Img/Logo.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <header class="header" id="header">
    <div class="header__container">
      <a href="#inicio" class="header__logo">
        <img src="Img/Logo.png" alt="Pousada Pé da Serra" />
      </a>

      <nav class="nav" id="nav">
        <ul class="nav__list">
          <li><a href="index.php" class="nav__link">Início</a></li>
          <li><a href="sobre.php" class="nav__link">Sobre Nós</a></li>
          <li><a href="#quartos" class="nav__link">Quartos</a></li>
          <li><a href="#experiencias" class="nav__link">Experiências</a></li>
          <li><a href="#galeria" class="nav__link">Galeria</a></li>
          <li><a href="#contato" class="nav__link">Contato</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="main">
    <section class="hero" id="inicio">
      <div class="hero__slideshow">
        <div class="hero__slide"></div>
        <div class="hero__slide"></div>
        <div class="hero__slide"></div>
        <div class="hero__slide"></div>
      </div>
      <div class="section__container">
        <div class="hero__content">
          <span class="hero__eyebrow">Pousada Pé da Serra</span>
          <h1 class="hero__title">Um refúgio de tranquilidade entre as montanhas</h1>
          <p class="hero__text">
            Venha viver experiências únicas em São Tomé das Letras, com conforto, café da manhã caseiro e paisagens que conectam você à natureza.
          </p>
          <div class="hero__actions">
            <a href="sobre.php" class="btn btn--primary">Conheça a pousada</a>
            <a href="<?php echo $whatsapp->gerarLink(); ?>" class="btn btn--secondary" target="_blank">Reservar agora</a>
          </div>
        </div>
      </div>
    </section>
  </main>

<section class="rooms" id="quartos">
  <div class="rooms__container">

    <div class="section-header">
      <span class="section-subtitle">Hospedagem</span>
      <h2 class="section-title">Nossos Quartos</h2>
      <p class="section-text">
        Conforto, tranquilidade e uma vista incrível para tornar sua estadia inesquecível.
      </p>
    </div>

    <div class="rooms__grid">
      <?php 
        $pousada->listarQuartos(); 
      ?>
    </div>
  </div>
</section>

  <footer class="footer">
    <div class="footer__container">

      <div class="footer__brand">
        <img src="Img/Logo.png" alt="Pousada Pé da Serra" class="footer__logo" />
        <address class="footer__address">
          Rod. LMG, KM 3, São Tomé das Letras - MG, 37408-000
        </address>
        <a href="https://www.google.com/maps/search/Pousada+P%C3%A9+da+Serra+S%C3%A3o+Tom%C3%A9+das+Letras" class="footer__map-link" target="_blank" rel="noopener">
          Ver no Google Maps
        </a>
        <p class="footer__contact">
          WhatsApp:<br />
          <a href="https://wa.me/5535997583373">(35) 99758-3373</a>
        </p>
        <p class="footer__contact">
          Instagram:<br />
          <a href="https://instagram.com/pousada_pedaserra_stl" target="_blank" rel="noopener">
            @pousada_pedaserra_stl
          </a>
        </p>
      </div>

      <div class="footer__col">
        <h3 class="footer__title">Atalhos</h3>
        <ul class="footer__links">
          <li><a href="index.php">Início</a></li>
          <li><a href="sobre.php">Sobre Nós</a></li>
          <li><a href="#quartos">Quartos</a></li>
          <li><a href="#experiencias">Experiências</a></li>
          <li><a href="#galeria">Galeria</a></li>
          <li><a href="#contato">Contato</a></li>
        </ul>
      </div>

      <div class="footer__col">
        <h3 class="footer__title">Funcionamento</h3>
        <p>Check-in: 14h &nbsp;|&nbsp; Check-out: 12h</p>
      </div>

      <div class="footer__col">
        <h3 class="footer__title">Localização</h3>
        <div class="footer__map">
          <iframe
            title="Localização Pousada Pé da Serra"
            src="https://maps.google.com/maps?q=Pousada+P%C3%A9+da+Serra+S%C3%A3o+Tom%C3%A9+das+Letras&t=h&z=16&output=embed"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

    </div>

    <div class="footer__bottom">
      <p>&copy; 2026 Pousada Pe da Serra. Todos os direitos reservados.</p>
    </div>
  </footer>

  <?php 
    $whatsapp->exibirBotaoFlutuante(); 
  ?>
    <script src="script.js"></script>

</body>

</html>
