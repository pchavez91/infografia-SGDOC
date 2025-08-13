<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Explorador de Archivos en Cascada</title>
    <style>
      #explorador {
        margin-top: 24px;
        padding-left: 20px;
      }

      .item-carpeta, .item-archivo {
        position: relative;
        margin: 12px 0;
        padding-left: 20px;
        font-size: 1em;
        cursor: pointer;
      }

      .item-carpeta::before, .item-archivo::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 12px;
        height: 100%;
        border-left: 2px solid #ccc;
      }

      .item-carpeta::after {
        content: "";
        position: absolute;
        top: 12px;
        left: 0;
        width: 20px;
        height: 0;
        border-top: 2px solid #ccc;
      }

      .hijos-carpeta {
        margin-left: 20px;
        padding-left: 10px;
        border-left: 2px solid #ccc;
        display: none;
      }
    </style>
</head>
<body>
    <h2>Explorador de Archivos</h2>
    

    <script src="script/cascada.js"></script>
</body>
</html>

  <button type="button" class="btn btn-info" onclick="abrir_modal()">Abrir Explorador</button>

  <div class="modal fade" id="abrir_modal_explorador" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Explorador de Archivos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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



  </body>

</html>
