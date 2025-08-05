
function abre_modal_ayuda(){
    $("#ventana_de_ayuda").modal('show');
}

//siguiente y atras en el modal
  let pasoActual = 1;
  const totalPasos = 3;

  function cambiarPaso(direccion) {
    // Oculta el paso actual
    document.getElementById(`paso${pasoActual}`).style.display = "none";

    // Cambia el paso
    pasoActual += direccion;

    // Muestra el nuevo paso
    document.getElementById(`paso${pasoActual}`).style.display = "block";

    // Actualiza botones
    const btnAnterior = document.getElementById("btnAnterior");
    const btnSiguiente = document.getElementById("btnSiguiente");

    btnAnterior.disabled = pasoActual === 1;

    if (pasoActual === totalPasos) {
      btnSiguiente.style.display = "none";

      // ⏱️ Cerrar el modal automáticamente después de 10 segundos
      setTimeout(() => {
        $('#ventana_de_ayuda').modal('hide');
        pasoActual = 1; // Reinicia si vuelven a abrir el modal

        // mostrar solo el primer paso al reabrir
        document.getElementById("paso2").style.display = "none";
        document.getElementById("paso3").style.display = "none";
        document.getElementById("paso1").style.display = "block";
        btnSiguiente.style.display = "inline-block";
        btnAnterior.disabled = true;

      }, 10000); // 10000 milisegundos = 5 segundos
    } else {
      btnSiguiente.style.display = "inline-block";
      btnSiguiente.textContent = "Siguiente";
    }
  }