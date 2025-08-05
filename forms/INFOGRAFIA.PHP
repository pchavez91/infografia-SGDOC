<script src="script/infografia.js"></script>


<img id="btnAyuda" onclick="abre_modal_ayuda()" src="img/ayuda.png" alt="Ayuda" class="icono-ayuda" title="¿Necesitas ayuda?">


<!-- VENTANA NUEVA AYUDA-->
    <div id="ventana_de_ayuda" class="modal fade">
      <div class="modal-dialog" style="max-width: 500px; margin-top: 10%;">
        <div class="modal-content" style="border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); font-family: Arial, sans-serif;">
          <div class="modal-header" style="background-color: #39b3d7; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white; font-size: 28px; opacity: 0.9;">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" style="text-align: center; font-weight: bold;">SOLICITUD DE CÓDIGO</h4>
          </div>

          <form action="#" method="post" role="form" style="padding: 20px; font-size: 15px; line-height: 1.6;">       
            <b style="display: block; margin-bottom: 10px; color: #333;">¿Cómo hacer una solicitud de código?</b>
            <ol style="padding-left: 20px; margin-bottom: 15px; color: #444;">
              <li>Completa los campos requeridos: área, subsistema, etc.</li>
              <li>El sistema generará automáticamente un código.</li>
              <li>Adjunta el documento correspondiente.</li>
              <li>Haz clic en "Guardar".</li>
            </ol>
            <i style="color: #666;">Este código se usará para el control y seguimiento del documento.</i>
          </form>
        </div>
      </div>
    </div>
