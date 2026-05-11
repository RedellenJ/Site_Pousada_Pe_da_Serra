(function () {
  'use strict';

  const header = document.getElementById('header');
  const navLinks = document.querySelectorAll('.nav__link');
  const galleryLinks = document.querySelectorAll('.gallery__link');
  const galleryModal = document.getElementById('gallery-modal');
  const galleryModalImage = document.getElementById('gallery-modal-image');
  const galleryModalClose = document.querySelector('.gallery-modal__close');

  function setActiveLink(targetHref) {
    navLinks.forEach(function (link) {
      link.classList.toggle('active', link.getAttribute('href') === targetHref);
    });
  }

  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 10) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  }

  // Highlight active nav link based on current page
  const currentPath = window.location.pathname.split('/').pop() || 'index.html';
  const currentHash = window.location.hash;

  if (currentHash) {
    setActiveLink(currentHash);
  } else {
    navLinks.forEach(function (link) {
      const href = link.getAttribute('href');
      if (href === currentPath || (currentPath === 'index.html' && href === 'index.html')) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }

  const sections = document.querySelectorAll('section[id]');

  if (sections.length) {
    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            setActiveLink('#' + entry.target.id);
          }
        });
      },
      { rootMargin: '-40% 0px -55% 0px' }
    );

    sections.forEach(function (section) {
      observer.observe(section);
    });
  }

  navLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      const href = link.getAttribute('href');
      if (href && href.startsWith('#')) {
        setActiveLink(href);
      }
    });
  });

  function openGalleryModal(imageSrc, imageAlt) {
    if (!galleryModal || !galleryModalImage) {
      return;
    }

    galleryModalImage.src = imageSrc;
    galleryModalImage.alt = imageAlt || 'Imagem da galeria';
    galleryModal.classList.add('is-open');
    galleryModal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeGalleryModal() {
    if (!galleryModal || !galleryModalImage) {
      return;
    }

    galleryModal.classList.remove('is-open');
    galleryModal.setAttribute('aria-hidden', 'true');
    galleryModalImage.src = '';
    galleryModalImage.alt = '';
    document.body.style.overflow = '';
  }

  galleryLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {
      event.preventDefault();

      const image = link.querySelector('img');
      const imageSrc = link.getAttribute('href');
      const imageAlt = image ? image.alt : 'Imagem da galeria';

      openGalleryModal(imageSrc, imageAlt);
    });
  });

  if (galleryModalClose) {
    galleryModalClose.addEventListener('click', closeGalleryModal);
  }

  if (galleryModal) {
    galleryModal.addEventListener('click', function (event) {
      if (event.target === galleryModal) {
        closeGalleryModal();
      }
    });
  }

  window.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeGalleryModal();
    }
  });

})();
