class MobileNavbar {
    constructor(mobileMenu, navList, navLinks) {
      this.mobileMenu = document.querySelector(mobileMenu);
      this.navList = document.querySelector(navList);
      this.navLinks = document.querySelectorAll(navLinks);
      this.activeClass = "active";
  
      this.handleClick = this.handleClick.bind(this);
    }
  
    animateLinks() {
      this.navLinks.forEach((link, index) => {
        link.style.animation
          ? (link.style.animation = "")
          : (link.style.animation = `navLinkFade 0.5s ease forwards ${
              index / 7 + 0.3
            }s`);
      });
    }
  
    handleClick() {
      this.navList.classList.toggle(this.activeClass);
      this.mobileMenu.classList.toggle(this.activeClass);
      this.animateLinks();
    }
  
    addClickEvent() {
      this.mobileMenu.addEventListener("click", this.handleClick);
    }
  
    init() {
      if (this.mobileMenu) {
        this.addClickEvent();
      }
      return this;
    }
  }
  
  const mobileNavbar = new MobileNavbar(
    ".mobile-menu",
    ".nav-list",
    ".nav-list li",
  );
  mobileNavbar.init();





  function redirectToHome() {
    window.location.href = 'inicio.php';
}



function initMap() {
  const sensors = [
      { lat: -22.7570025, lng: -47.3839586 },
      { lat: -22.7580828, lng: -47.3831891 },
      { lat: -22.7578661, lng: -47.3844843 }
  ];

  const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: sensors[0],
      mapTypeId: 'roadmap',
  });

  const markers = sensors.map((sensor, index) => {
      const marker = new google.maps.Marker({
          position: sensor,
          map: map,
          title: 'Vaga',
          icon: {
              url: 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E',
              scaledSize: new google.maps.Size(20, 20),
          },
      });
      return marker;
  });

  setInterval(() => {
      fetch('vagas.php')
          .then(response => response.json())
          .then(data => {
              data.forEach((vaga, index) => {
                  const iconUrl = vaga.StatusDaVaga === 'Livre'
                      ? 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E'
                      : 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%23ff0000" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E';
                  markers[index].setIcon({
                      url: iconUrl,
                      scaledSize: new google.maps.Size(20, 20),
                  });
              });
          })
          .catch(error => console.error('Error fetching data:', error));
  }, 1000);
}

document.getElementById('contato-link').addEventListener('click', function(event) {
  event.preventDefault(); // Previne o comportamento padrão do link
  document.getElementById('footer').scrollIntoView({ behavior: 'smooth' });
});


function toggleMenu() {
  var sideMenu = document.getElementById('side-menu');
  sideMenu.classList.toggle('open');
}

//mascara CEP






// scroll boxmap inicio
    function smoothScroll(element, to, duration) {
      const start = element.scrollTop;
      const startTime = performance.now();

      function animateScroll(currentTime) {
          const timeElapsed = currentTime - startTime;
          const progress = Math.min(timeElapsed / duration, 1); // Limita o progresso a 1 (100%)

          element.scrollTop = start + (to - start) * easeInOutQuad(progress);

          if (progress < 1) {
              requestAnimationFrame(animateScroll);
          }
      }

      function easeInOutQuad(t) {
          return t < 0.5
              ? 2 * t * t
              : -1 + (4 - 2 * t) * t;
      }

      requestAnimationFrame(animateScroll);
    }

      function scrollUp() {
        const boxscroll = document.querySelector('.boxscroll');
        smoothScroll(boxscroll, boxscroll.scrollTop - 121, 800); // Duração em milissegundos
    }

      function scrollDown() {
        const boxscroll = document.querySelector('.boxscroll');
        smoothScroll(boxscroll, boxscroll.scrollTop + 121, 800); // Duração em milissegundos
    }
//scroll boxmap fim



// scroll boxmap vagas adm geral inicio
    function smoothScroll(element, to, duration) {
      const start = element.scrollTop;
      const startTime = performance.now();

      function animateScroll(currentTime) {
          const timeElapsed = currentTime - startTime;
          const progress = Math.min(timeElapsed / duration, 1); // Limita o progresso a 1 (100%)

          element.scrollTop = start + (to - start) * easeInOutQuad(progress);

          if (progress < 1) {
              requestAnimationFrame(animateScroll);
          }
      }

      function easeInOutQuad(t) {
          return t < 0.5
              ? 2 * t * t
              : -1 + (4 - 2 * t) * t;
      }

      requestAnimationFrame(animateScroll);
    }

      function scrollUp3() {
        const boxscroll = document.querySelector('.boxscroll');
        smoothScroll(boxscroll, boxscroll.scrollTop - 125, 800); // Duração em milissegundos
    }

      function scrollDown3() {
        const boxscroll = document.querySelector('.boxscroll');
        smoothScroll(boxscroll, boxscroll.scrollTop + 125, 800); // Duração em milissegundos
    }
//scroll boxmap vagas adm geral fim



//scroll user inicio
    function smoothScroll(element, to, duration) {
      const start = element.scrollTop;
      const startTime = performance.now();

      function animateScroll(currentTime) {
          const timeElapsed = currentTime - startTime;
          const progress = Math.min(timeElapsed / duration, 1); // Limita o progresso a 1 (100%)

          element.scrollTop = start + (to - start) * easeInOutQuad(progress);

          if (progress < 1) {
              requestAnimationFrame(animateScroll);
          }
      }

      function easeInOutQuad(t) {
          return t < 0.5
              ? 2 * t * t
              : -1 + (4 - 2 * t) * t;
      }

      requestAnimationFrame(animateScroll);
    }

      function scrollUp2() {
        const scroll = document.querySelector('.scroll');
        smoothScroll(scroll, scroll.scrollTop - 145, 800); // Duração em milissegundos
    }

      function scrollDown2() {
        const scroll = document.querySelector('.scroll');
        smoothScroll(scroll, scroll.scrollTop + 145, 800); // Duração em milissegundos
    }
//scoll user fim

  