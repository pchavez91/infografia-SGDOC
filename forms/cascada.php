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

    .nombre-elemento {
      flex: 1;
    }

    #botonesExplorador {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .nivel-1 {
      display: flex;
      justify-content: center;      /* Centra el único botón */
    }
    .nivel-1 .boton-caja {
      max-width: 140px;             /* Ancho fijo para dos palabras */
      padding: 16px 24px;
      font-size: 1.1em;
    }

    /* Niveles 2, 3 y 4: botones más pequeños */
    .nivel-2 .boton-caja,
    .nivel-3 .boton-caja,
    .nivel-4 .boton-caja {
      max-width: 120px;             /* Ajusta ancho para wrapping */
      padding: 10px 14px;           /* Reduce tamaño */
      font-size: 0.9em;
    }

    /* Conserva la indentación por nivel */
    .nivel-2 { margin-left: 40px; }
    .nivel-3 { margin-left: 80px; }
    .nivel-4 { margin-left: 120px; }

    /* Botones */
    .boton-caja {
      white-space: normal;          /* Permite salto de línea */
      word-wrap: break-word;        /* Rompe palabras largas */
      text-align: center;           /* Centrado de cada línea */
      box-sizing: border-box;       /* Padding incluido en ancho */
    }
    .boton-caja:hover { transform: scale(1.05); }

    /* Colores fijos por rol en la jerarquía */
    .clr-alta      { background-color: #F44336; } /* rojo para Alta dirección */
    .clr-subgerencia { background-color: #00BCD4; } /* celeste para subgerencias */
    .clr-depto     { background-color: #FFC107; } /* amarillo oscuro para áreas */
    .clr-formatos  { background-color: #4CAF50; } /* verde para Formatos Oficiales */

    </style>
  </head>
  <body>
    <center>
      <h2>Explorador de Archivos</h2><br>

      <div id="botonesExplorador" class="mb-3"></div>
    
    </center>
      
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