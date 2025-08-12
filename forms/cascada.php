<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Explorador de Archivos en Cascada</title>
    <style>
        ul.tree, ul.tree ul {
            list-style: none;
            margin-left: 20px;
            padding-left: 0;
        }
        ul.tree li {
            margin: 2px 0;
            cursor: pointer;
        }
        .folder::before {
            content: "📁 ";
        }
        .file::before {
            content: "📄 ";
        }
    </style>
</head>
<body>
    <h2>Explorador de Archivos</h2>
    <div id="explorador"></div>

    <script src="script/cascada.js"></script>
</body>
</html>

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
