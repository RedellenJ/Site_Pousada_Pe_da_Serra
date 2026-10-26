(function () {
  'use strict';

  const header = document.getElementById('header');
  const navLinks = document.querySelectorAll('.nav__link');
  const galleryLinks = document.querySelectorAll('.gallery__link, .testimonial__link');
  const galleryItems = Array.from(document.querySelectorAll('.gallery__link'));
  const galleryModal = document.getElementById('gallery-modal');
  const galleryModalImage = document.getElementById('gallery-modal-image');
  const galleryModalClose = document.querySelector('.gallery-modal__close');
  const galleryModalPrevious = document.querySelector('.gallery-modal__nav--previous');
  const galleryModalNext = document.querySelector('.gallery-modal__nav--next');
  const galleryModalCounter = document.getElementById('gallery-modal-counter');
  const themeToggle = document.querySelector('.theme-toggle');
  let activeItems = [];
  let activeIndex = 0;
  let lastOpenedLink = null;
  let swipeStartX = null;
  let scrollAnimationFrame = null;
  const currentPath = window.location.pathname.split('/').pop() || 'index.html';

  function applyTheme(theme, savePreference) {
    document.documentElement.dataset.theme = theme;
    if (themeToggle) {
      const darkMode = theme === 'dark';
      themeToggle.setAttribute('aria-pressed', String(darkMode));
      themeToggle.setAttribute('aria-label', darkMode ? 'Ativar modo claro' : 'Ativar modo escuro');
      themeToggle.querySelector('.theme-toggle__icon').textContent = darkMode ? '☀' : '☾';
      themeToggle.querySelector('.theme-toggle__label').textContent = darkMode ? 'Modo claro' : 'Modo escuro';
    }
    if (savePreference) {
      try { localStorage.setItem('pousada-theme-v2', theme); } catch (error) { /* Storage may be unavailable. */ }
    }
  }

  let savedTheme = null;
  try { savedTheme = localStorage.getItem('pousada-theme-v2'); } catch (error) { /* Start in light mode if storage is unavailable. */ }
  applyTheme(savedTheme || 'light', false);

  if (themeToggle) {
    themeToggle.addEventListener('click', function () {
      const nextTheme = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
      applyTheme(nextTheme, true);
    });
  }

  function setActiveLink(targetHref) {
    navLinks.forEach(function (link) {
      const href = link.getAttribute('href');
      const isHomeLink = targetHref === '#inicio' && href === 'index.html' && currentPath === 'index.html';
      const isAboutPageLink = targetHref === '#sobre' && href === 'sobre.html' && currentPath === 'sobre.html';
      link.classList.toggle('active', href === targetHref || isHomeLink || isAboutPageLink);
    });
  }

  function getNavDestination(link) {
    const url = new URL(link.href, window.location.href);
    if (url.origin !== window.location.origin) return null;

    const page = url.pathname.split('/').pop() || 'index.html';
    let targetId = url.hash ? decodeURIComponent(url.hash.slice(1)) : '';
    if (!targetId && page === 'index.html') targetId = 'inicio';
    if (!targetId && page === 'sobre.html') targetId = 'sobre';
    return { page: page, targetId: targetId };
  }

  function getScrollDestination(target) {
    const targetTop = window.scrollY + target.getBoundingClientRect().top;
    const headerPosition = header ? window.getComputedStyle(header).position : 'static';
    const stickyOffset = header && (headerPosition === 'sticky' || headerPosition === 'fixed')
      ? header.getBoundingClientRect().height
      : 0;
    return Math.max(0, targetTop - stickyOffset - 12);
  }

  function stopScrollAnimation() {
    if (scrollAnimationFrame !== null) {
      window.cancelAnimationFrame(scrollAnimationFrame);
      scrollAnimationFrame = null;
    }
  }

  function animateToSection(target, targetId, updateHistory) {
    stopScrollAnimation();
    if (updateHistory) {
      history.pushState(null, '', '#' + encodeURIComponent(targetId));
    }
    setActiveLink('#' + targetId);

    const destination = getScrollDestination(target);
    const start = window.scrollY;
    const distance = destination - start;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || Math.abs(distance) < 2) {
      window.scrollTo(0, destination);
      return;
    }

    const duration = Math.min(1250, Math.max(720, Math.abs(distance) * 0.38));
    let startTime = null;
    function step(timestamp) {
      if (startTime === null) startTime = timestamp;
      const progress = Math.min((timestamp - startTime) / duration, 1);
      const eased = progress < 0.5
        ? 4 * progress * progress * progress
        : 1 - Math.pow(-2 * progress + 2, 3) / 2;
      window.scrollTo(0, start + distance * eased);

      if (progress < 1) {
        scrollAnimationFrame = window.requestAnimationFrame(step);
      } else {
        scrollAnimationFrame = null;
      }
    }
    scrollAnimationFrame = window.requestAnimationFrame(step);
  }

  function animatePendingNavigation() {
    let targetId = null;
    try {
      targetId = sessionStorage.getItem('pousada-nav-target');
      sessionStorage.removeItem('pousada-nav-target');
    } catch (error) { /* Continue without a saved cross-page destination. */ }
    if (!targetId) return;

    const target = document.getElementById(targetId);
    if (!target) return;
    history.replaceState(null, '', '#' + encodeURIComponent(targetId));
    window.requestAnimationFrame(function () {
      animateToSection(target, targetId, false);
    });
  }

  animatePendingNavigation();

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
  const currentHash = window.location.hash;

  if (currentHash) {
    setActiveLink(currentHash);
  } else {
    navLinks.forEach(function (link) {
      const href = link.getAttribute('href');
      if (
        href === currentPath ||
        (currentPath === 'index.html' && href === 'index.html')
      ) {
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
    link.addEventListener('click', function (event) {
      if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
      const destination = getNavDestination(link);
      if (!destination || !destination.targetId) return;

      if (destination.page === currentPath) {
        const target = document.getElementById(destination.targetId);
        if (!target) return;
        event.preventDefault();
        animateToSection(target, destination.targetId, true);
        return;
      }

      if (destination.page === 'index.html') {
        event.preventDefault();
        try {
          sessionStorage.setItem('pousada-nav-target', destination.targetId);
          window.location.assign(link.href.split('#')[0]);
        } catch (error) {
          window.location.assign(link.href);
        }
      }
    });
  });

  window.addEventListener('wheel', stopScrollAnimation, { passive: true });
  window.addEventListener('touchstart', stopScrollAnimation, { passive: true });

  function showGalleryItem() {
    if (!galleryModal || !galleryModalImage) {
      return;
    }

    const item = activeItems[activeIndex];
    const image = item && item.querySelector('img');
    if (!item || !image) return;

    galleryModalImage.src = item.getAttribute('href');
    galleryModalImage.alt = image.alt || 'Imagem da galeria';
    if (galleryModalCounter) {
      galleryModalCounter.textContent = activeItems.length > 1 ? (activeIndex + 1) + ' / ' + activeItems.length : '';
    }
    if (galleryModalPrevious) galleryModalPrevious.hidden = activeItems.length < 2;
    if (galleryModalNext) galleryModalNext.hidden = activeItems.length < 2;
  }

  function openGalleryModal(items, index, opener) {
    if (!galleryModal || !galleryModalImage) return;
    activeItems = items;
    activeIndex = index;
    lastOpenedLink = opener;
    showGalleryItem();
    galleryModal.classList.add('is-open');
    galleryModal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    if (galleryModalClose) galleryModalClose.focus();
  }

  function moveGallery(direction) {
    if (activeItems.length < 2) return;
    activeIndex = (activeIndex + direction + activeItems.length) % activeItems.length;
    showGalleryItem();
  }

  function closeGalleryModal() {
    if (!galleryModal || !galleryModalImage) {
      return;
    }

    galleryModal.classList.remove('is-open');
    galleryModal.setAttribute('aria-hidden', 'true');
    galleryModalImage.src = '';
    galleryModalImage.alt = '';
    if (galleryModalCounter) galleryModalCounter.textContent = '';
    document.body.style.overflow = '';
    if (lastOpenedLink) lastOpenedLink.focus();
    lastOpenedLink = null;
    activeItems = [];
  }

  galleryLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {
      event.preventDefault();

      if (link.classList.contains('gallery__link')) {
        openGalleryModal(galleryItems, galleryItems.indexOf(link), link);
      } else {
        openGalleryModal([link], 0, link);
      }
    });
  });

  if (galleryModalClose) {
    galleryModalClose.addEventListener('click', closeGalleryModal);
  }
  if (galleryModalPrevious) galleryModalPrevious.addEventListener('click', function () { moveGallery(-1); });
  if (galleryModalNext) galleryModalNext.addEventListener('click', function () { moveGallery(1); });

  if (galleryModal) {
    galleryModal.addEventListener('touchstart', function (event) {
      swipeStartX = event.changedTouches[0].clientX;
    }, { passive: true });
    galleryModal.addEventListener('touchend', function (event) {
      if (swipeStartX === null) return;
      const swipeDistance = event.changedTouches[0].clientX - swipeStartX;
      if (Math.abs(swipeDistance) > 45) moveGallery(swipeDistance < 0 ? 1 : -1);
      swipeStartX = null;
    }, { passive: true });
  }

  if (galleryModal) {
    galleryModal.addEventListener('click', function (event) {
      if (event.target === galleryModal) {
        closeGalleryModal();
      }
    });
  }

  window.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && galleryModal && galleryModal.classList.contains('is-open')) {
      closeGalleryModal();
    } else if (galleryModal && galleryModal.classList.contains('is-open') && event.key === 'ArrowRight') {
      event.preventDefault();
      moveGallery(1);
    } else if (galleryModal && galleryModal.classList.contains('is-open') && event.key === 'ArrowLeft') {
      event.preventDefault();
      moveGallery(-1);
    }
  });

})();
