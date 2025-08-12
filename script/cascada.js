function buildTree(data) {
  const map = {};
  const roots = [];
  data.forEach(item => {
    map[item.id] = { ...item, children: [] };
  });
  data.forEach(item => {
    if (item.id_padre && map[item.id_padre]) {
      map[item.id_padre].children.push(map[item.id]);
    }
  });
  data.forEach(item => {
    if (!item.id_padre || item.id_padre == 0) {
      roots.push(map[item.id]);
    }
  });
  return roots;
}

function renderCarpetasRaiz(roots) {
  const contenedor = document.getElementById('explorador');
  contenedor.innerHTML = '';
  roots.forEach(root => {
    const div = document.createElement('div');
    div.className = 'carpeta-raiz';

    // Título de la carpeta raíz
    const titulo = document.createElement('div');
    titulo.className = 'carpeta-titulo';
    titulo.innerHTML = `<span class="icono-carpeta">📁</span> ${root.nombre_elemento}`;
    div.appendChild(titulo);

    // Contenedor para hijos (oculto por defecto)
    const hijos = document.createElement('div');
    hijos.className = 'hijos-carpeta';
    hijos.style.display = 'none';
    div.appendChild(hijos);

    // Mostrar/ocultar hijos al hacer click
    titulo.onclick = () => {
      hijos.style.display = hijos.style.display === 'none' ? '' : 'none';
      if (hijos.innerHTML === '') {
        hijos.appendChild(renderHijos(root.children));
      }
    };

    contenedor.appendChild(div);
  });
}

function renderHijos(nodes) {
  const cont = document.createElement('div');
  nodes.forEach(node => {
    if (node.tipo_elemento === 'carpeta') {
      const carpeta = document.createElement('div');
      carpeta.className = 'item-carpeta';
      carpeta.innerHTML = `<span class="icono-carpeta">📁</span> ${node.nombre_elemento}`;
      // Subcarpetas
      const hijos = document.createElement('div');
      hijos.className = 'hijos-carpeta';
      hijos.style.display = 'none';
      carpeta.onclick = (e) => {
        e.stopPropagation();
        hijos.style.display = hijos.style.display === 'none' ? '' : 'none';
        if (hijos.innerHTML === '') {
          hijos.appendChild(renderHijos(node.children));
        }
      };
      carpeta.appendChild(hijos);
      cont.appendChild(carpeta);
    } else {
      const archivo = document.createElement('div');
      archivo.className = 'item-archivo';
      archivo.innerHTML = `<span class="icono-archivo">📄</span> ${node.nombre_elemento}`;
      archivo.onclick = (e) => {
        e.stopPropagation();
        if (node.codigo_archivo) {
          window.open('ruta/a/archivos/' + node.codigo_archivo, '_blank');
        }
      };
      cont.appendChild(archivo);
    }
  });
  return cont;
}

// Fetch y renderizado principal
fetch('json/json.php?accion=consulta_directorio_completo')
  .then(res => res.json())
  .then(json => {
    const roots = buildTree(json.data);
    renderCarpetasRaiz(roots);
  });
