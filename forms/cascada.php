<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <title>Explorador de Archivos en Cascada</title>
      <style>
        #explorador {
          width: 100%;
          height: 400px;
          overflow-y: auto;
          margin: 24px;
          padding: 20px;
          background-color: #f9f9f9;
          border-radius: 8px;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
          font-family: 'Segoe UI', sans-serif;
        }

        .item-carpeta, .item-archivo {
          position: relative;
          margin: 12px 0;
          padding-left: 20px;
          font-size: 1em;
          cursor: pointer;
        }

        /* Línea vertical */
        .item-carpeta::before, .item-archivo::before {
          content: "";
          position: absolute;
          top: 0;
          left: 0;
          width: 14px;
          height: 100%;
          border-left: 3px solid #000000ff;
        }

        /* Línea horizontal */
        .item-carpeta::after {
          content: "";
          position: absolute;
          top: 16px;
          left: 0;
          width: 24px;
          height: 0;
          border-top: 3px solid #000000ff;
        }

        .hijos-carpeta {
          margin-left: 28px;
          padding-left: 12px;
          display: none;
        }
      </style>
  </head>
  <body>
    <h2>Explorador de Archivos</h2>

    <div id="botonesExplorador" class="mb-3"></div>
      
    <script src="script/cascada.js"></script>
  </body>

  <div class="modal fade" id="abrir_modal_explorador" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="display: flex; align-items: center; justify-content: space-between;">
          
          <img src="../../images/photos/logo_comasa_avatar.png" alt="Logo Comasa" style="height: 40px; margin-right: 10px;">
          
          <div style="flex-grow: 1; text-align: center;">
            <h2 class="modal-title" id="modalLabel" style="margin: 0;">Explorador de Archivos</h2>
          </div>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 10px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div id="explorador" class="explorador-cascada"></div>
        </div>
      </div>
    </div>
  </div>


  <script>
    // Obtener todos los elementos con clase folder
    const folders = document.querySelectorAll(".folder");
    folders.forEach(folder => {
      folder.addEventListener("click", () => {
        // Alternar mostrar/ocultar la lista anidada (subcarpetas y archivos)
        const nested = folder.nextElementSibling;
        if (nested) {
          nested.classList.toggle("active");
        }
      });
    });
  </script>
</html>