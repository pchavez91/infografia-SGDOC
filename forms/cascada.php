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
        padding-left: 4px 8px;
        font-size: 1em;
        cursor: pointer;
      }

      .item {
        display: flex;
        align-items: center; 
        margin-left: 16px;   
      }

      .icono {
        width: 60px;
        height: 60px;
        margin-right: 8px;
        flex-shrink: 0;       
      }

      /* Línea vertical */
      .item-carpeta::before,
      .item-archivo::before {
        content: "";
        position: absolute;
        top: 0;
        left: -20px; 
        width: 0;
        height: 100%;
        border-left: 4px solid #228B22;
      }

      /* Línea horizontal */
      .item-carpeta::after {
        content: "";
        position: absolute;
        top: 50%; 
        left: -18px;
        width: 18px;
        border-top: 3px solid #228B22;
        transform: translateY(-50%);
      }


      .hijos-carpeta {
      padding-left: 3.8em;
      display: none;
      }

      
      #botonesExplorador {
        display: flex;
        flex-direction: column;
        gap: 40px; /* separación entre niveles */
      }

      /* Niveles jerárquicos */
      .nivel {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 16px;
        position: relative;
      }

      .nivel-2 { margin-left: 40px; }
      .nivel-3 { margin-left: 80px; }
      .nivel-4 { margin-left: 120px; }

      
      .boton-caja {
        width: 170px;
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 10px;
        font-size: 1.1em;
        line-height: 1.2em;
        white-space: normal;
        word-wrap: break-word;
        box-sizing: border-box;
        border-radius: 10px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        border: none;
        box-shadow: 2px 2px 6px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
      }
      .boton-caja:hover {
        transform: scale(1.05);
      }

      /* Colores fijos por rol */
      .clr-alta        { background-color: #F44336; } 
      .clr-subgerencia { background-color: #00BCD4; } 
      .clr-depto       { background-color: #FFC107; } 
      .clr-formatos    { background-color: #4CAF50; } 

      
      /* Línea vertical desde cada botón hacia la línea horizontal */
      .nivel:not(.nivel-1) .boton-caja::before {
        content: "";
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 20px;
        background-color: #03f74cff;
        z-index: 0;
      }

   
      .nombre-elemento {
        flex: 1;
      }

      /* Estilo de encabezado */
      .panel-header {
        background-color: #39b3d7;
        border: 1px solid #269abc;
        padding: 10px;
        position: relative;
      }

      .panel-header b {
        color: white;
        font-size: 16px;
      }

      .icono-ayuda {
        width: 48px;
        height: 48px;
        cursor: pointer;
        position: absolute;
        top: -4px;
        right: 10px;
      }

    </style>
  </head>
  <body>
    <div class="panel-header">
      <b><center>Explorador de archivos</center></b>
      <img id="btnAyuda" onclick="abre_modal_ayuda()" src="IMAGENES/ayuda.png" alt="Ayuda" class="icono-ayuda" title="¿Necesitas ayuda?">
    </div>
    <br>

    <div id="botonesExplorador" class="mb-3"></div>
    
    <script src="script/cascada.js"></script>
    <script src="script/infografia.js"></script>
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