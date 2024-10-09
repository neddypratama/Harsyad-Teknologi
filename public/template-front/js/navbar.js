(function () {
  "use strict";

  var siteMenuClone = function () {
    var jsCloneNavs = document.querySelectorAll(".js-clone-nav"),
      siteMobileMenuBody = document.querySelector(".site-mobile-menu-body");

    jsCloneNavs.forEach((nav) => {
      var navCloned = nav.cloneNode(true);
      navCloned.setAttribute("class", "site-nav-wrap");
      siteMobileMenuBody.appendChild(navCloned);
    });

    setTimeout(function () {
      var hasChildrens = document
        .querySelector(".site-mobile-menu")
        .querySelectorAll(".has-children");

      var counter = 0;
      hasChildrens.forEach((hasChild) => {
        var refEl = hasChild.querySelector("a");

        var newElSpan = document.createElement("span");
        newElSpan.setAttribute("class", "arrow-collapse collapsed");

        hasChild.insertBefore(newElSpan, refEl);

        var arrowCollapse = hasChild.querySelector(".arrow-collapse");
        arrowCollapse.setAttribute("data-toggle", "collapse");
        arrowCollapse.setAttribute("data-toggle", "#collapseItem" + counter);

        var dropdown = hasChild.querySelector(".dropdown");
        dropdown.setAttribute("class", "collapse");
        dropdown.setAttribute("id", "collapseItem" + counter);

        counter++;
      });
    }, 1000);

    var menuToggle = document.querySelectorAll(".js-menu-toggle"),
      mTog;

    menuToggle.forEach((mtoggle) => {
      mTog = mtoggle;
      mtoggle.addEventListener("click", (e) => {
        if (document.body.classList.contains("offcanvas-menu")) {
          document.body.classList.remove("offcanvas-menu");
          document.body.classList.remove("no-scroll");
          mtoggle.classList.remove("active");
          mTog.classList.remove("active");
        } else {
          document.body.classList.add("offcanvas-menu");
          document.body.classList.add("no-scroll");
          mtoggle.classList.add("active");
          mTog.classList.add("active");
        }
      });
    });

    //click outside of the offcanvasmenu container
    var specifiedElement = document.querySelector(".site-mobile-menu"),
      mt,
      mtoggleTemp;

    document.addEventListener("click", function (event) {
      var isClickInside = specifiedElement.contains(event.target);
      menuToggle.forEach((mtoggle) => {
        mtoggleTemp = mtoggle;
        mt = mtoggle.contains(event.target);
      });

      if (!isClickInside && !mt) {
        if (document.body.classList.contains("offcanvas-menu")) {
          document.body.classList.remove("offcanvas-menu");
          mtoggleTemp.classList.remove("active");
        }
      }
    });
    // Fungsi untuk menutup offcanvas jika ukuran layar berubah
    function closeOffcanvasOnResize() {
      if (window.innerWidth >= 990) {
        if (document.body.classList.contains("offcanvas-menu")) {
          document.body.classList.remove("offcanvas-menu");
          if (mtoggleTemp) {
            mtoggleTemp.classList.remove("active");
          }
        }
      }
    }

    // Menambahkan event listener untuk mendeteksi perubahan ukuran layar
    window.addEventListener("resize", closeOffcanvasOnResize);

    // Memastikan offcanvas tertutup jika halaman dimuat dengan layar yang lebar
    document.addEventListener("DOMContentLoaded", closeOffcanvasOnResize);
  };

  siteMenuClone();
})();

// Pilih elemen <img> dari logo
var logo = document.querySelector(".col-6.col-md-6.col-lg-3 .logo img");

// Fungsi untuk mengganti logo berdasarkan ukuran layar
function changeLogoBasedOnScreenWidth() {
  var screenWidth = window.innerWidth;

  if (screenWidth < 400) {
    // Jika ukuran layar lebih kecil dari 768px, ganti dengan logo untuk mobile
    logo.setAttribute("src", "../Harsyad Teknologi/icon-logo.png");
    logo.setAttribute("alt", "Harsyad Teknologi Mobile Logo");
  } else {
    // Jika ukuran layar lebih besar dari 1200px, kembalikan ke logo semula
    logo.setAttribute("src", "../Harsyad Teknologi/logo.png");
    logo.setAttribute("alt", "Harsyad Teknologi Original Logo");
  }
}

// Panggil fungsi saat pertama kali halaman dimuat
changeLogoBasedOnScreenWidth();

// Tambahkan event listener untuk memantau perubahan ukuran layar
window.addEventListener("resize", changeLogoBasedOnScreenWidth);
