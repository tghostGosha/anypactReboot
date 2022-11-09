BX.userPactsList = {
	options: {},
	controls: {},
	init: function(options){
		this.options = options;
		this.controls.main = BX(options.blockListId);
		this.controls.button = BX(options.buttonId);
		this.controls.list = BX(options.itemListId,this.controls.main);
		BX.bindDelegate(this.controls.main, 'click', this.controls.button, ()=>{
			this.send();
		});
	},
	getData:function (){
		let result = [];
		let nav = this.options.navParams;
		nav.NavPageNomer++;
		result['PAGEN_'+nav.NavNum] = nav.NavPageNomer;
		return result;
	},
	send:function (){
		let nav = this.options.navParams;
		BX.ajax({
			url: this.options.source,
			method: 'post',
			async: true,
			processData: true,
			emulateOnload: true,
			start: true,
			data: this.getData(),
			onsuccess: (result)=>{
				$(this.controls.list).append(result);
				if(parseInt(nav.NavPageNomer) === parseInt(nav.NavPageCount)){
					BX.remove(this.controls.button);
				}
			},
			onfailure: function(type, e){
				// on error do nothing
			}
		});
		/**/
	}
}