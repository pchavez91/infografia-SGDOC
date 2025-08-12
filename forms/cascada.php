<!DOCTYPE html>
<html lang="es"> 
  
  <head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Explorador de Carpetas en Cascada</title>
  <style>
    ul {
      list-style-type: none;
      padding-left: 20px;
    }
    .folder, .file {
      cursor: pointer;
      user-select: none;
    }
    .folder::before {
      content: "📁 ";
    }
    .file::before {
      content: "📄 ";
    }
    .nested {
      display: none;
    }
    .active {
      display: block;
    }
  </style>
  </head>
  <body>

  <h2>Explorador de Carpetas en Cascada</h2>

  <ul id="fileTree">
    <li>
      <span class="folder">Carpeta 1</span>
      <ul class="nested">
        <li><span class="file">Archivo 1-1.txt</span></li>
        <li><span class="file">Archivo 1-2.txt</span></li>
        <li>
          <span class="folder">Subcarpeta 1-1</span>
          <ul class="nested">
            <li><span class="file">Archivo 1-1-1.txt</span></li>
            <li><span class="file">Archivo 1-1-2.txt</span></li>
          </ul>
        </li>
      </ul>
    </li>
    <li>
      <span class="folder">Carpeta 2</span>
      <ul class="nested">
        <li><span class="file">Archivo 2-1.txt</span></li>
      </ul>
    </li>
    <li><span class="file">Archivo raíz.txt</span></li>
  </ul>

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
