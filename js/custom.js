validImgExt=['.jpg','.png'];
errors={
	'password':{
		'length':{
			'ru':'Пароль должен быть не меньше 3 символов',
			'en':'Password must be at least 3 characters'
		},
		'same':{
			'ru':'Пароли не совпадают',
			'en':'Passwords do not match'
		}
	},

	'username':{
		'length':{
			'ru':'Логин должен быть не меньше 3 символов',
			'en':'Username must be at least 3 characters'
		}
	},
	
	'images':{
		'extension':{
			'ru':'Картинка должно быть в этих расширениях: ( '+validImgExt.join(', ')+' )',
			'en':'The picture should be in these extensions: ( '+validImgExt.join(', ')+' )'
		}
	}
}

function start(){
	
	lang = $('body').attr('lang');

	$('a.red').click(function(){
		res = confirm('Действительно хотите удалить?');
		if(res){
			_this = $(this);
			$.post(_this.attr('href'),{csrf:$('[name="csrf"]').val()},function(dat){
				if(dat){
					_this.parents('tr').remove();
					alert(dat);
				}
			});
		}

		return false;
	});

	$('form.createuser').submit(function(){
		if($('[name=username]').val().trim().length<3){
			alert(errors.username.length[lang]);
			return false;
		}

		if($('[name=password]').val().trim().length<3){
			alert(errors.password.length[lang]);
			return false;
		}

		/*if($('#password').val().trim()!=$('#repeat-password').val().trim()){
			alert(errors.password.same[lang]);
			return false;
		}*/

	});

}

$(start);