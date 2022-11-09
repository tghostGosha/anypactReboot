function OpenModalWindow(el){
	CloseModalWindow();
	let modal = $('.modal-block');
	modal.addClass('open');
	el.show();
}
function CloseModalWindow(){
	let modal = $('.modal-block');
	let forms = $('form', modal);
	let formsBlocks = $('.modal-window-content > div', modal)
	modal.removeClass('open');
	forms.each(function(){this.reset()});
	formsBlocks.each(function(){$(this).hide()});

}
$( document ).ready(function (){
	/*Каталог*/
	let searchList = $('.offers-block-header');
	if(searchList.get(0)){
		let menuViewVariable = $('.option-variable', searchList);
		if(menuViewVariable.get(0)){
			menuViewVariable.on('click', 'a', function (){

				let obj = $(this);
				let parentBlock = obj.parents('.offers-block-header').parent();
				let itemListBlock = $('.items-card-list', parentBlock);
				let variableBlock = obj.parents('.option-variable');

				if(obj.hasClass('table')){
					itemListBlock.addClass('table-view');
				}
				else{
					itemListBlock.removeClass('table-view');
				}

				$('a', variableBlock).removeClass('active');
				obj.addClass('active');
			});
		}
	}
	/*Фильтр*/
	$('.filter-block form').on('click', '[name="set_filter"]', function (e){
		e.preventDefault();
		let obj = $(this);
		let form = obj.parents('form');
		let data = form.serializeArray();

		$.ajax({
			url: form.action,
			method: 'GET',
			data: data,
			success: function(reply){
				reply = BX.parseJSON(reply);
				BX.reload(reply.SEF_SET_FILTER_URL);
			},
			beforeSend:function () {
				obj.prop('disabled', true);
			},
			error: function(reply){
				//BX.reload();
			}
		});

		return false;
	});

	$('.filter-item-block-list select').selectize({
		sortField: 'text'
	});

	let filterRangeBlock = $('.filter-range-block');
	if(filterRangeBlock.get(0)){
		let sliderRange = $(".filter-range-slider", filterRangeBlock);
		if(sliderRange.get(0)){
			sliderRange.each(function (){
				let obj = $(this);
				let minInput = obj.siblings('.min-price');
				let maxInput = obj.siblings('.max-price');
				obj.slider({
					min: Number(obj.attr('data-min')),
					max: Number(obj.attr('data-max')),
					values: [Number(minInput.val()), Number(maxInput.val())],
					range: true,
					stop: function(event, ui) {
						minInput.val(sliderRange.slider("values",0));
						maxInput.val(sliderRange.slider("values",1)).blur();
					},
					slide: function(event, ui){
						minInput.val(sliderRange.slider("values",0));
						maxInput.val(sliderRange.slider("values",1));
					}
				});
			});
		}
	}

	let filterDate = $('.filter-date');
	if(filterDate.get(0)){
		filterDate.on('click', function () {
			let obj = $(this);
			BX.calendar({
				node:this,
				field:obj.attr('name'),
				form: obj.attr('data-form-name'),
				bTime: false,
				currentTime: obj.attr('data-current-time'),
				bHideTime: true
			});
		});
	}

	/*PopUp формы*/
	/* Регистрация */
	$(document).on('click', '#regpopup_btn_reg', function (){
		OpenModalWindow($('#regpopup_registration'));
	});
	/* Авторизация*/
	$(document).on('click', '#reg_button, #regpopup_btn_aut, #regpopup_btn_aut_fgpw, .nav-link[href="#"]', function (){
		OpenModalWindow($('#regpopup_autarisation'));
	});
	/* Восстановление пароля */
	$(document).on('click', '#regpopup_btn_fgpw', function (){
		OpenModalWindow($('#regpopup_forgotpassword'));
	});

	$(document).on('click', '.open-form-message', function (){
		OpenModalWindow($('.pact-send-mess'));
	});
	$(document).on('click', '.open-form-complaint', function (){
		OpenModalWindow($('.pact-send-complaint'));
	});

	$(document).on('click', '.modal-window .button-close, .modal-bg', function (){
		CloseModalWindow();
	});
	$(document).on('click', '.modal-window', function (e){
		e.stopPropagation();
	});
	$(document).on('submit', '#complaints_on_deal', function (e){
		e.stopPropagation();
		let form = $(this);
		let fields = {
			data:form.serialize()
		};
		BX.ajax.runAction('anypact:core.pact.complaint', fields).then((response)=>{
			let reply = response.data;
			form.html('<div class="success-message">'+reply.text+'</div>')
		});
		return false;
	});
	/*$('#complaints_on_deal select').selectize();*/
	$(document).on('submit', '#message_user', function (e){
		e.stopPropagation();
		let form = $(this);
		let fields = {
			data:form.serialize()
		};
		BX.ajax.runAction('anypact:core.pact.sendUserMail', fields).then((response)=>{
			let reply = response.data;
			form.html('<div class="success-message">'+reply.text+'</div>')
		});
		return false;
	});

});