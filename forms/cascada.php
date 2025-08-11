<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Explorador de carpetas en cascada</title>
<style>
ul {
  list-style-type: none;
  padding-left: 20px;
}

li {
  cursor: pointer;
  user-select: none;
  font-size: 18px;      /* Tamaño de letra más grande */
  margin: 4px 0;        /* Espacio vertical entre ítems */
  line-height: 1.4;     /* Altura de línea para mejor lectura */
}

.folder::before {
  content: "📁 ";
  font-size: 80px;      /* Ícono más grande */
  margin-right: 6px;
}

.file::before {
  content: "📄 ";
  font-size: 20px;
  margin-right: 6px;
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

<h2>Explorador de Carpetas</h2>

<div id="contenedor"></div>

<script>
// Ejemplo: llamada fetch a tu PHP que devuelve JSON (ajusta la URL)
fetch('json/json.php?accion=consulta_directorio_completo')
  .then(response => response.json())
  .then(data => {
    const treeData = buildTree(data.data);
    document.getElementById('contenedor').innerHTML = renderTree(treeData);
    addToggleListeners();
  });

// Convierte el arreglo plano a estructura de árbol
function buildTree(elements, parentId = 0) {
  const branch = [];
  elements.forEach(el => {
    if (el.id_padre == parentId) {
      const children = buildTree(elements, el.id);
      if (children.length) el.children = children;
      branch.push(el);
    }
  });
  return branch;
}

// Renderiza la estructura de árbol en UL / LI
function renderTree(nodes) {
  let html = '<ul>';
  nodes.forEach(node => {
    const isFolder = node.tipo_elemento === 'carpeta';  // O el valor que uses para carpeta
    html += `<li>
      <span class="${isFolder ? 'folder' : 'file'}">${node.nombre_elemento}</span>`;
    if (isFolder && node.children) {
      html += `<ul class="nested">${renderTree(node.children)}</ul>`;
    }
    html += '</li>';
  });
  html += '</ul>';
  return html;
}

// Añade funcionalidad toggle (expandir/colapsar carpetas)
function addToggleListeners() {
  const folders = document.querySelectorAll('.folder');
  folders.forEach(folder => {
    folder.addEventListener('click', function(e) {
      e.stopPropagation();
      const nextUl = this.nextElementSibling;
      if (!nextUl) return;
      nextUl.classList.toggle('active');
    });
  });
}
</script>

</body>
</html>
