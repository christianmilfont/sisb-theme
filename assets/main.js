(function () {
  var toggle = document.getElementById('sisbMenuToggle');
  var menu   = document.getElementById('sisbMobileMenu');

  if (!toggle || !menu) return;

  function setOpen(open) {
    menu.classList.toggle('open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  }

  toggle.addEventListener('click', function () {
    setOpen(!menu.classList.contains('open'));
  });

  menu.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      setOpen(false);
    });
  });

  // Escape fecha o menu e devolve o foco ao botão, para que a navegação
  // por teclado não fique presa dentro do painel aberto.
  document.addEventListener('keydown', function (event) {
    if (event.key !== 'Escape') return;
    if (!menu.classList.contains('open')) return;

    setOpen(false);
    toggle.focus();
  });
})();
