fetch('json/json.php?accion=consulta_directorio_completo')
  .then(res => res.json())
  .then(json => {
      const data = json.data; // <-- ¡Aquí está el array!
      const tree = buildTree(data);
      const html = renderTree(tree);
      document.getElementById('explorador').appendChild(html);
  });

// Convierte el array plano en un árbol
function buildTree(data) {
    const map = {};
    const roots = [];

    // Mapeo de todos los elementos por su id
    data.forEach(item => {
        map[item.id] = { ...item, children: [] };
    });

    // Asignación de hijos a sus padres
    data.forEach(item => {
        if (item.id_padre && map[item.id_padre]) {
            map[item.id_padre].children.push(map[item.id]);
        }
    });

    // Solo los nodos raíz (sin padre)
    data.forEach(item => {
        if (!item.id_padre || item.id_padre == 0) {
            roots.push(map[item.id]);
        }
    });

    return roots;
}
// Renderiza el árbol como HTML
function renderTree(nodes) {
    const ul = document.createElement('ul');
    ul.className = 'tree';

    nodes.forEach(node => {
        const li = document.createElement('li');
        li.textContent = node.nombre_elemento;
        li.className = node.tipo_elemento === 'carpeta' ? 'folder' : 'file';

        if (node.children && node.children.length > 0) {
            const childUl = renderTree(node.children);
            childUl.style.display = 'none'; // Oculta los hijos por defecto
            li.appendChild(childUl);

            li.addEventListener('click', function(e) {
                e.stopPropagation();
                childUl.style.display = childUl.style.display === 'none' ? '' : 'none';
            });
        } else if (node.tipo_elemento !== 'carpeta') {
            // Acción para archivos (ver siguiente punto)
            li.addEventListener('click', function(e) {
                e.stopPropagation();
                abrirArchivo(node); // función personalizada
            });
        }

        ul.appendChild(li);
    });

    return ul;
}
