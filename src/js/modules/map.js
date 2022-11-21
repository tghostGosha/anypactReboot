


    let elementsOnMap = {
        map: null,
        city: null,
        idBlockMap: null,
        objectManager: null,
        init(options) {
            this.idBlockMap = options.id;
            this.city = options.city;
            this.create();
        },
        create() {
            let zoom = (this.city === 'Москва') ? 5 : 10;
            ymaps.ready(() => {
                let CityGeocoder = ymaps.geocode(this.city, { results: 1 });
                let options = {
                    center: null,
                    zoom: zoom,
                    controls: ['zoomControl', 'fullscreenControl'],
                };
                let additionally = {
                    suppressMapOpenBlock: true,
                    yandexMapDisablePoiInteractivity: true,
                    restrictMapArea: [
                        [-72.82711143783236, -132.75126599992967],
                        [88.37941819194958, -132.75126600007033]
                    ],
                };
                CityGeocoder.then((res) => {
                    options.center = res.geoObjects.get(0).geometry.getCoordinates();
                    this.map = new ymaps.Map(this.idBlockMap, options, additionally);
                    this.map.behaviors.disable(['scrollZoom']);
                    let currentBounds = this.map.getBounds();

                    this.setObjectManager();
                    this.getPoints(currentBounds);
                    //this.setEvents();
                });
            });
        },
        getPoints(bounds) {
            this.setPoints(points);
        },
        setPoints(points) {
            points.type = 'FeatureCollection';
            /*for(let key in points.features){
                points.features[key].properties.balloonContent = null;
                points.features[key].properties.clusterCaption = null;
            }*/
            this.objectManager.add(points);
        },
        setObjectManager() {
            this.objectManager = new ymaps.ObjectManager({
                clusterize: true,
                gridSize: 64,
                //clusterDisableClickZoom: true
                clusterDisableClickZoom: false
            });
            this.objectManager.objects.options.set('preset', {
                iconLayout: "default#imageWithContent",
                iconImageHref: '/local/templates/anypact/img/map_icon.svg',
                iconImageSize: [24, 24],
                iconImageOffset: [-12, -12],
                iconContentOffset: [0, 0],
            });
            this.objectManager.clusters.options.set('preset', {
                clusterIconColor: '#FF6600',
                preset: "islands#orangeClusterIcons"
            });

            this.map.geoObjects.add(this.objectManager);

            this.map.geoObjects.events.add('click', this.geoObjectsClick);
        },

        geoObjectsClick(el) {
            let elementIds = [];
            let overlay = el.get('overlay');
            let data = overlay.getData();
            switch (data.type) {
                case 'Cluster':
                    for (let feature of data.features) {
                        elementIds.push(feature.id);
                    }
                    break;
                case 'Feature':
                    elementIds.push(data.id);
                    break;

            }
        },
        setEvents() {
            this.map.events.add('actionend', () => {
                let currentBounds = this.map.getBounds();
                this.getPoints(currentBounds);
            });
        },
        getDetailInfo(el) {
            let id = el.get('objectId');
            //let target = el.get('target');
            let overlay = el.get('overlay');
            let data = overlay.getData();

            //console.log(el);

            console.log('id => ', id);
            /*console.log('child =>', el.get('child'));
            console.log('target =>', target);
            console.log('type =>', el.get('type'));
            console.log('overlay =>', overlay);*/
            console.log('overlay.data =>', data);
        }
    };



elementsOnMap.init({
    'id': 'mymap',
    'city': 'Москва',
});


