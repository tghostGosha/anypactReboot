<div class="map-space-ya">
    <?
    $city = $_SESSION['CITY_ANYPACT'];
    \Bitrix\Main\Page\Asset::getInstance()->addJs('//api-maps.yandex.ru/2.1/?apikey=08f051a6-35f1-4392-a988-5024961ee1a8&lang=ru_RU');
    if (empty($city)) {
        $city = 'Москва';
    }
    $_SESSION['EXIST_IDS'] = array();
    ?>
    <div id="ya-map"></div>
    <script type="text/javascript">
        function initMap() {
            let city = "<?= $city ?>",
                CityGeocoder = ymaps.geocode(city, {results: 1});
            CityGeocoder.then(
                function (res) {
                    var anypactMap = new ymaps.Map('ya-map', {
                            center: res.geoObjects.get(0).geometry.getCoordinates(),
                            zoom: 10,
                            controls: ['zoomControl', 'fullscreenControl'],
                        }, {
                            suppressMapOpenBlock: true,
                            yandexMapDisablePoiInteractivity: true,
                            restrictMapArea: [
                                [-72.82711143783236, -132.75126599992967],
                                [88.37941819194958, -132.75126600007033]
                            ],
                        }),
                        objectManager = new ymaps.ObjectManager({
                            clusterize: true,
                            gridSize: 64,
                            clusterDisableClickZoom: true
                        }),
                        points,
                        lastBigBounds,
                        startIsNeedLoadMore = true;
                    anypactMap.behaviors.disable(['scrollZoom']);
                    objectManager.objects.options.set('preset', {
                            "iconLayout": "default#imageWithContent",
                            "iconImageHref": '<?= SITE_TEMPLATE_PATH ?>/img/map_icon.svg',
                            "iconImageSize": [24, 24],
                            "iconImageOffset": [-12, -12],
                            "iconContentOffset": [0, 0],
                        });
                    objectManager.clusters.options.set('preset', {
                            "preset": "islands#orangeClusterIcons",
                            "clusterIconColor": '#FF6600',
                            //"hasBalloon": false,
                        });
                    lastBigBounds = anypactMap.getBounds();
                    anypactMap.geoObjects.add(objectManager);

                    //Событие карты - окончание движения карты
                    anypactMap.events.add('actionend', function (e) {
                        let currentBounds = anypactMap.getBounds(),
                            isNeedLoadMore = false,
                            isLoadPoints = false,
                            arPoints,
                            arLoadData;
                        $.each(lastBigBounds[0],function(index,coordLast) {
                            if (currentBounds[0][index] < coordLast) {
                                isNeedLoadMore = true;
                                lastBigBounds = currentBounds;
                            }
                        });
                        $.each(lastBigBounds[1],function(index,coordLast) {
                            if (currentBounds[1][index] > coordLast) {
                                isNeedLoadMore = true;
                                lastBigBounds = currentBounds;
                            }
                        });
                        while (isNeedLoadMore) {
                            points = YaMapLoadPoints(lastBigBounds);
                            let arPointsLoad = jQuery.parseJSON(points);
                            if (typeof arPointsLoad['DONE'] !== "undefined") {
                                isNeedLoadMore = false;
                            } else {
                                objectManager.add(points);
                            }
                        }
                    });
                    //Событие кластера - клик
                    objectManager.clusters.events.add('click', function (e) {
                        let objectId = e.get('objectId'),
                            object = objectManager.clusters.getById(objectId),
                            curZoom = anypactMap.action.getCurrentState().zoom;
                        if (curZoom < 15) {
                            curZoom++;
                            anypactMap.setZoom(curZoom);
                            anypactMap.setCenter(object.geometry.coordinates);
                        }
                    });

                    //установка первых точек
                    while (startIsNeedLoadMore) {
                        points = YaMapLoadPoints(lastBigBounds);
                        var arPoints = jQuery.parseJSON(points);
                        if (typeof arPoints['DONE'] !== "undefined") {
                            startIsNeedLoadMore = false;
                        } else {
                            objectManager.add(points);
                        }
                    }
                }
            );
        }
        //Подгрузка точек
        function YaMapLoadPoints(MapBounds) {
            var points;
            $.ajax({
                url: '/local/scripts/ajax-ya-map.php',
                type: 'POST',
                data: {"MAP_BOUNDS": MapBounds},
                async: false,
                success: function (data) {
                    points = data;
                },
            });
            return points;
        }
        $(document).ready(function() {
            ymaps.ready(initMap);
        });
    </script>
</div>