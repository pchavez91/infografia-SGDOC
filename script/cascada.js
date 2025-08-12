function buildTree(elements, parentId = 0) {
    const branch = [];
    elements.forEach(el => {
        if (el.id_padre == parentId) {
            const children = buildTree(elements, el.id);
            if (children.length) {
                el.children = children;
            }
            branch.push(el);
        }
    });
    return branch;
}

const treeData = buildTree(data.data);

// Función para renderizar el árbol (simplificado)
function renderTree(nodes) {
    let html = '<ul>';
    nodes.forEach(node => {
        html += `<li>${node.nombre_elemento}`;
        if (node.children) {
            html += renderTree(node.children);
        }
        html += '</li>';
    });
    html += '</ul>';
    return html;
}

document.getElementById('contenedor').innerHTML = renderTree(treeData);
