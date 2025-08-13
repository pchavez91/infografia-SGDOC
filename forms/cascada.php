<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Explorador de Archivos en Cascada</title>
    <style>
      #explorador {
        display: flex;
        gap: 32px;
        margin-top: 24px;
        flex-wrap: wrap;
      }
      .carpeta-raiz {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-width: 200px;
        margin-right: 16px;
      }
      .carpeta-titulo {
        font-size: 1.2em;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        margin-bottom: 6px;
      }
      .carpeta-titulo .icono-carpeta {
        font-size: 1.5em;
        margin-right: 8px;
      }
      .hijos-carpeta {
        margin-left: 24px;
        margin-top: 4px;
        border-left: 2px solid #e0e0e0;
        padding-left: 10px;
        background-color: #f9f9f9; 
      }

      .item-carpeta, .item-archivo {
        display: flex;
        align-items: center;
        font-size: 1em;
        margin: 4px 0;
        cursor: pointer;
      }
      .item-carpeta .icono-carpeta,
      .item-archivo .icono-archivo {
        font-size: 1.2em;
        margin-right: 8px;
      }
      .item-carpeta:hover, .item-archivo:hover {
        background: #f0f4fa;
        border-radius: 4px;
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
