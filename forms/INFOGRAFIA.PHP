

<div class="panel panel-info">
    <div class="panel box-shadow-none content-header margin-topbar">
      <div class="form-group col-xs-12 col-lg-12 panel-header">

        <!-- Título -->
        <b><center>SOLICITUD DE CÓDIGO</center></b>

        <img id="btnAyuda" onclick="abre_modal_ayuda()" src="IMAGENES/ayuda.png" alt="Ayuda" class="icono-ayuda" title="¿Necesitas ayuda?">

      </div>
    </div>
  </div>


<!-- VENTANA NUEVA AYUDA-->
  <div id="ventana_de_ayuda" class="modal fade">
    <div class="modal-dialog" style="width: 800px; max-width: 100%;">
      <div class="modal-content" style="border-radius: 10px;">
      
        <div class="modal-header" style="background-color: #39b3d7; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">SOLICITUD DE CÓDIGO</h4>
        </div>

        <div class="modal-body" style="padding: 20px;">

          <!-- Paso 1 -->
          <div id="paso1">
            <p><b>Paso 1: Llenar los campos</b></p>
            <ul>
              <li>Selecciona el área, subsistema, etc.</li>
              <li>Completa todos los campos requeridos.</li>
            </ul>
            <img src="IMAGENES/SOLICITUD_DE_CODIGO.png" style="width: 100%; height: auto;">
          </div>

          <!-- Paso 2 -->
          <div id="paso2" style="display: none;">
            <p><b>Paso 2: Generación del código</b></p>
            <ul>
              <li>El sistema asigna un código automáticamente.</li>
              <li>Verifica que sea correcto antes de guardar.</li>
            </ul>
            <img src="IMAGENES/paso2.png" style="width: 100%; height: auto;">
          </div>

          <!-- Paso 3 -->
          <div id="paso3" style="display: none;">
            <p><b>Paso 3: Guardar y finalizar</b></p>
            <ul>
              <li>Adjunta el documento y presiona "Guardar".</li>
              <li>Revisa en la lista que tu archivo esté publicado.</li>
            </ul>
            <img src="IMAGENES/paso3.png" style="width: 100%; height: auto;">
          </div>

        </div>

        <!-- Controles de navegación -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="btnAnterior" onclick="cambiarPaso(-1)">Anterior</button>
          <button type="button" class="btn btn-primary" id="btnSiguiente" onclick="cambiarPaso(1)">Siguiente</button>
          </div>


      </div>
    </div>
  </div>




