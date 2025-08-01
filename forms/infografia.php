<?php
$seccion = isset($_GET['seccion']) ? $_GET['seccion'] : '';

$ayudas = [
  'subida' => [
    'titulo' => '¿Cómo subir un documento?',
    'texto' => 'Selecciona el área y subsistema, adjunta el archivo. El código se genera automáticamente.'
  ],
  'versionado' => [
    'titulo' => '¿Cómo versionar documentos?',
    'texto' => 'Al subir un archivo con el mismo nombre, se agregará automáticamente un número de versión como -01, -02, etc.'
  ],
  'investigacion' => [
    'titulo' => '¿Qué hace esta sección?',
    'texto' => 'Aquí puedes registrar investigaciones de accidentes laborales según D.S. 44.'
  ],
  // Agrega más ayudas según tus secciones
];

if (isset($ayudas[$seccion])) {
  $ayuda = $ayudas[$seccion];
  echo '
  <div style="
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 320px;
    background-color: #e8f4fd;
    color: #084298;
    border: 1px solid #b6e0fe;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    font-size: 14px;
    z-index: 9999;">
    <strong>' . htmlspecialchars($ayuda['titulo']) . '</strong><br>
    <p style="margin: 5px 0;">' . htmlspecialchars($ayuda['texto']) . '</p>
  </div>';
}
?>

