$(document).ready(function () {
	$('#my-slider').sliderPro({
		width: "100%",
		aspectRatio: 1.6, //соотношение сторон
		loop: false,
		autoplay: false,
		fade: true,
		thumbnailWidth: 164,
		thumbnailHeight: 101,
		imageScaleMode: 'contain',
		// fullScreen: true,
		// fadeFullScreen: false,
		breakpoints: {
			450: {
				thumbnailWidth: 82,
				thumbnailHeight: 50
			}
		},
		init: function (event) {
			$('.sp-slide').each(function (index, value) {
				$(value).prepend($(value).children('.gallery-img-cover'));
			});
			$('#my-slider .sp-slides').lightGallery({
				download: false
			});
		}
	});
	let mapBlock = $('#map');
	if(mapBlock.get(0)){
		let coordinateStr = mapBlock.data('coordinates');
		if(coordinateStr.length !== 0){
			let coordinates = coordinateStr.split(',');
			if(coordinates.length === 2){
				ymaps.ready(function(){
					let map = new ymaps.Map(mapBlock.attr('id'), {
						center: coordinates,
						zoom: 15,
						controls: ['zoomControl']
					});
					let placemark = new ymaps.Placemark(coordinates, {
						iconCaption: 'поиск...'
					}, {
						iconLayout: 'default#imageWithContent',
						iconImageHref: '/local/templates/anypact/image/map_icon.svg',
						iconImageSize: [30, 30],
						iconImageOffset: [-15, -15],
						iconContentOffset: [30, 30],
					});
					map.geoObjects.add(placemark);
					map.behaviors.disable('scrollZoom');
					ymaps.geocode(coordinates).then(function (res) {
						let firstGeoObjectGlobal = res.geoObjects.get(0);
						addressLine = firstGeoObjectGlobal.getAddressLine();
						$('.address-pact').text(addressLine);
					});
				});
			}
		}
	}


	$('#show_phone').on('click', function(el){
		el.preventDefault;

		let obj = $(this);
		let data = {
			data:{
				id: obj.attr('data-pact-id'),
			}
		};
		BX.ajax.runAction('anypact:core.pact.info.getPhoneNumber', data).then((response)=>{
			let reply = response.data;
			console.log(reply);
			obj.attr('href', "tel:"+reply.link);
			obj.text(reply.text);
			obj.off();
			obj.css('font-size', '24px');
		});

		return false;
	});
});