
document.addEventListener('DOMContentLoaded', function () {
      const btnAyuda = document.getElementById('btnAyuda');
      const ayudaBurbuja = document.getElementById('ayudaBurbuja');

      // Mostrar/Ocultar con animación
      btnAyuda.addEventListener('click', function (e) {
        e.stopPropagation();
        ayudaBurbuja.classList.toggle('visible');
      });

      // Ocultar si se hace clic fuera
      document.addEventListener('click', function (e) {
        if (!btnAyuda.contains(e.target) && !ayudaBurbuja.contains(e.target)) {
          ayudaBurbuja.classList.remove('visible');
        }
      });
    });

