<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'url' => $model->url], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Set image'), ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>

        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'text:raw', //ntext - отображает теги
            'created_date',
            'modified_date',
            'url:url',
            'status_id',
            'sort',
            'author.username',
            'tagsAsString',
        ],
    ]) ?>

</div>





<h1>My First Google Map</h1>

<div id="map" style="width:100%;height: 500px;"></div>

<div class="text-success">Your position: </div>
<div id="lat"></div>
<div id="lng"></div>
<div class="text-info">Your address: </div>
    <div id="address"> </div>


<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            //center: {lat: 44, lng: 34},
            zoom: 6

        });



        var infoWindow = new google.maps.InfoWindow({map: map});


        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude

                };


                    document.getElementById("lat").innerHTML = pos.lat;
                document.getElementById("lng").innerHTML = pos.lng;
                console.log(pos);

               /* var tribeca = {lat:pos.lat, lng: pos.lng};
                var marker = new google.maps.Marker({
                    position: tribeca,
                    map: map,
                    title: 'Your are here'
                });*/

                var geocoder = new google.maps.Geocoder;
                var infowindow = new google.maps.InfoWindow;


                var latlng = {lat: pos.lat, lng: pos.lng};
                console.log(latlng);

                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[1]) {
                            map.setZoom(11);

                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            infowindow.setContent(results[1].formatted_address);

                            document.getElementById('address').innerHTML = infowindow.content;
                            console.log(infowindow.content);


                            infowindow.open(map, marker);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });



                //infoWindow.setPosition(pos);
                //infoWindow.setContent('You are here!');
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }




</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzhI2jTbdvHUGmbId1fx6eaNcTeSgpKW4&callback=initMap">
</script>


<hr style="color: #0b58a2">
<hr style="color: yellow">




