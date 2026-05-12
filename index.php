<?php

require_once 'classes/WhatsApp.php';
require_once 'classes/Quarto.php';
require_once 'classes/Pousada.php';
require_once 'classes/Contato.php';

$whatsapp = new WhatsApp("5535997583373", "Olá! Gostaria de saber mais sobre a Pousada Pé da Serra.");

$contato = new Contato(
  "(35) 99758-3373",
  "@pousada_pedaserra_stl",
  "Rod. LMG, KM 3, São Tomé das Letras - MG, 37408-000",
  "14h",
  "12h"
);

$pousada = new Pousada("Pousada Pé da Serra");
$pousada->adicionarQuarto(new Quarto("Suíte 1", "Ambiente aconchegante e confortável para relaxar e aproveitar a pousada.", 2, "Img/Suíte/quarto1.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 2", "Espaço confortável com ambiente acolhedor ideal para momentos de descanso.", 2, "Img/Suíte/quarto2.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 3", "Suíte espaçosa e confortável para aproveitar dias inesquecíveis em São Tomé das Letras.", 3, "Img/Suíte/quarto3.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 4", "Conforto e praticidade em um ambiente tranquilo cercado pela natureza da serra.", 2, "Img/Suíte/quarto4.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 5", "Ambiente amplo e acolhedor perfeito para compartilhar bons momentos.", 3, "Img/Suíte/quarto5.jpg", $whatsapp));
$pousada->adicionarQuarto(new Quarto("Suíte 6", "Ideal para descansar e aproveitar toda a experiência que a pousada tem a oferecer.", 3, "Img/Suíte/quarto6.jpg", $whatsapp));

$galeria = [
  'Imagem 1.jpeg',
  'Imagem 2.jpeg',
  'Imagem 3.jpeg',
  'Imagem 4.jpeg',
  'Imagem 5.jpeg',
  'Imagem 6.jpeg',
  'Imagem 7.jpeg',
  'Imagem 8.jpeg',
  'Imagem 9.jpeg',
  'Imagem 10.jpeg',
  'Imagem 11.jpeg',
  'Imagem 12.jpeg',
  'Imagem 13.jpeg',
  'Imagem 14.jpeg',
  'Imagem 15.jpeg',
  'Imagem 16.jpeg',
  'Imagem 17.jpeg',
  'Imagem 18.jpeg',
  'Imagem 19.jpeg',
  'Imagem 20.jpeg',
  'Imagem 21.jpeg'
];

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
          <li><a href="#sobre" class="nav__link">Sobre Nós</a></li>
          <li><a href="#quartos" class="nav__link">Quartos</a></li>
          <li><a href="#depoimentos" class="nav__link">Experiências</a></li>
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
            <a href="#sobre" class="btn btn--primary">Conheça a pousada</a>
            <a href="<?php echo $whatsapp->gerarLink(); ?>" class="btn btn--secondary" target="_blank">Reservar agora</a>
          </div>
        </div>
      </div>
    </section>

    <section class="section about" id="sobre">
      <div class="section__container">
        <span class="section__eyebrow">Sobre Nós</span>
        <h2 class="section__title">Nossa história e compromisso</h2>
        <p class="section__text">
          Somos uma pousada familiar que valoriza o calor humano, a gastronomia local e o descanso em meio à natureza. Aqui, cada detalhe é pensado para que sua estadia seja acolhedora e memorável.
        </p>

        <div class="about__grid">
          <article class="feature-card">
            <h3>Hospedagem acolhedora</h3>
            <p>Quartos confortáveis com decoração simples, lençóis macios e vista para o verde.</p>
          </article>
          <article class="feature-card">
            <h3>Experiência local</h3>
            <p>Atividades, passeios e dicas da região para que você descubra o melhor de São Tomé.</p>
          </article>
          <article class="feature-card">
            <h3>Atendimento de verdade</h3>
            <p>Recepção próxima, check-in fácil e apoio para tornar seu passeio mais leve.</p>
          </article>
        </div>
      </div>
    </section>

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
          <?php $pousada->listarQuartos(); ?>
        </div>
      </div>
    </section>

    <section class="benefits" id="beneficios">
      <div class="section__container">
        <div class="section-header">
          <span class="section-subtitle">O que oferecemos</span>
          <h2 class="section-title">Nossos Benefícios</h2>
        </div>

        <div class="benefits__grid">
          <article class="benefit-card">
            <div class="benefit-icon">☕</div>
            <h3 class="benefit-title">Café da Manhã</h3>
            <p class="benefit-desc">Delicioso café mineiro incluso na diária.</p>
          </article>
          <article class="benefit-card">
            <div class="benefit-icon">🏊‍♂️</div>
            <h3 class="benefit-title">Piscina</h3>
            <p class="benefit-desc">Área de lazer com piscina para relaxar.</p>
          </article>
          <article class="benefit-card">
            <div class="benefit-icon">📶</div>
            <h3 class="benefit-title">Wi-Fi Grátis</h3>
            <p class="benefit-desc">Internet de alta velocidade em toda a pousada.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="testimonials" id="depoimentos">
      <div class="section__container">
        <div class="section-header">
          <span class="section-subtitle">O que dizem sobre nós</span>
          <h2 class="section-title">Depoimentos de Clientes</h2>
        </div>

        <div class="testimonials__grid">
          <article class="testimonial-card">
            <p class="testimonial-text">&quot;Lugar incrível! Paz e tranquilidade, o café da manhã é espetacular em São Tomé. Voltarei com certeza!&quot;</p>
            <h4 class="testimonial-author">- Maria Silva</h4>
          </article>
          <article class="testimonial-card">
            <p class="testimonial-text">&quot;Atendimento nota 10 e quartos super confortáveis. A vista para a serra é inesquecível.&quot;</p>
            <h4 class="testimonial-author">- João Paulo</h4>
          </article>
        </div>
      </div>
    </section>

    <section class="gallery" id="galeria">
      <div class="section__container">
        <div class="section-header">
          <span class="section-subtitle">Explore</span>
          <h2 class="section-title">Galeria</h2>
          <p class="section-text">
            Conheça os espaços e paisagens incríveis da Pousada Pé da Serra.
          </p>
        </div>

        <div class="gallery__grid">
          <?php foreach ($galeria as $indice => $imagem): ?>
            <a href="Img/Galeria/<?php echo rawurlencode($imagem); ?>" class="gallery__link">
              <img
                src="Img/Galeria/<?php echo rawurlencode($imagem); ?>"
                alt="Galeria <?php echo $indice + 1; ?>"
                class="gallery__image"
              />
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <div class="gallery-modal" id="gallery-modal" aria-hidden="true">
      <button class="gallery-modal__close" type="button" aria-label="Fechar imagem">&times;</button>
      <img class="gallery-modal__image" id="gallery-modal-image" src="" alt="" />
    </div>
  </main>

  <footer class="footer" id="contato">
    <div class="footer__container">

      <div class="footer__brand">
        <img src="Img/Logo.png" alt="Pousada Pé da Serra" class="footer__logo" />
        <?php $contato->exibirContato(); ?>
        <a href="https://www.google.com/maps/search/Pousada+P%C3%A9+da+Serra+S%C3%A3o+Tom%C3%A9+das+Letras" class="footer__map-link" target="_blank" rel="noopener">
          Ver no Google Maps
        </a>
      </div>

      <div class="footer__col">
        <h3 class="footer__title">Atalhos</h3>
        <ul class="footer__links">
          <li><a href="index.php">Início</a></li>
          <li><a href="#sobre">Sobre Nós</a></li>
          <li><a href="#quartos">Quartos</a></li>
          <li><a href="#depoimentos">Experiências</a></li>
          <li><a href="#galeria">Galeria</a></li>
          <li><a href="#contato">Contato</a></li>
        </ul>
      </div>

      <div class="footer__col">
        <h3 class="footer__title">Funcionamento</h3>
        <?php $contato->exibirHorario(); ?>
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
