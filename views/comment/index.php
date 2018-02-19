<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Security;
use kartik\alert\AlertBlock;

use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  Html::encode( '(' . $pending . ') Comments');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

$script = <<< JS
$(document).ready(function() {
//    setInterval(function() {     
//      $.pjax.reload({container:'#result_ajax'});
//    }, 450000);
        
        
    setInterval(function() {
//        var id = $("#id").val();
<<<<<<< HEAD
        var id = 413;
        $("#result_ajax").load("index-ajax",{id:id},function(){});
    }, 30000);
=======
        var pending = $pending;
        $("#result_ajax").load("comment/index-ajax",{pending:pending},function(){});
    }, 3000);
>>>>>>> fbb4f925194172539c2c0b43a9309233977d9bc3
    
});
JS;
$this->registerJs($script);
?>

<?php
echo AlertBlock::widget([
    'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    'delay'     => 10000,
]);
?>

<div class="comment-index row">
    <!--
    <div class="col-xs-hidden col-md-12">
        <div class="list-group">
          <h4>Chat</h4>

        <script id="sid0010000038030679890">(function() {
                        function async_load() {
                            s.id = "cid0010000038030679890";
                            s.src = 'http://st.chatango.com/js/gz/emb.js';
                            s.style.cssText = "width:100%;height:300px;";
                            s.async = true;
                            s.text = '{"handle":"Blonder413Hall","styles":{"a":"ffffff","b":60,"c":"4E4B58","d":"002255","f":50,"l":"AAAACC","m":"002255","n":"FFFFFF","q":"999999","r":100,"s":1,"w":0}}';
                            var ss = document.getElementsByTagName('script');
                            for (var i = 0, l = ss.length; i < l; i++) {
                                if (ss[i].id == 'sid0010000038030679890') {
                                    ss[i].id += '_';
                                    ss[i].parentNode.insertBefore(s, ss[i]);
                                    break;
                                }
                      }
                  }
                  var s = document.createElement('script');
                  if (s.async == undefined) {
                      if (window.addEventListener) {
                          addEventListener('load', async_load, false);
                      } else if (window.attachEvent) {
                          attachEvent('onload', async_load);
                      }
                  } else {
                      async_load();
                  }
        })();</script>
      </div>
    </div>
    -->
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <div id="result_ajax">
            <!-- Muestro algo cuando carga la página por primera vez -->
            <?php $pending = app\models\Comment::find()->where(['status' => 0])->count(); ?>
            <?= $this->renderAjax('_index',
                [
                    'searchModel'   => $searchModel,
                    'dataProvider'  => $dataProvider,
                    'pending'       => $pending,
                ], null
            ); ?>
            <!-- /Muestro algo cuando carga la página por primera vez -->
        </div>
        <?php Pjax::end(); ?>
    </div>
</div>