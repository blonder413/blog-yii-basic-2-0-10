<?php
use yii\bootstrap\Modal;
?>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Fin de mis cursos</h4>
      </div>
      <div class="modal-body">
        <p>
            Debido a que no he tenido el impacto que buscaba cuando empecé a hacer
            video tutoriales y cuando creé mi blog, he decidido culminar
            con la generación de video tutoriales. Ya no generaré más contenido ni
            actualizaré mi blog, no sé hasta cuándo estará en línea pero los
            video tutoriales que he grabado seguirán tanto en
            <a href="https://www.youtube.com/channel/UCOBMvNSxe08V5E9qExfFt4Q" target="_blank">youtube</a> como en
            <a href="https://vimeo.com/blonder413" target="_blank">vimeo</a>.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
$script = <<< JS
// Retorna un número aleatorio entre min (incluido) y max (excluido)
function getRandomArbitrary(min, max) {
  valor = Math.random() * (max - min) + min;
  return parseInt(valor);
}

$(document).ready(function() {

    var aleatorio = getRandomArbitrary(0,10);
    
    // console.log(aleatorio);
    
//    if (aleatorio == 1) {
        $('#myModal').modal({
            keyboard: false
        })
//    }
    
});
JS;

$this->registerJs($script);
?>