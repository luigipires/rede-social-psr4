$(function(){
	const login = $('#login');
	const cadastro = $('#cadastro');

	//================================================================
	//ajax do login

	login.submit(function(){
		const este = $(this);
		const url = path+'ajax/dados.php';

		$.ajax({
			beforeSend:function(){
				este.animate({'opacity':'0.5'});
				este.find('input').attr('disabled','true');
				este.find('input[type=submit]').css('cursor','wait');
			},
			url:url,
			dataType:'json',
			method:'post',
			data:este.serialize()
		}).done(function(data){
			$('.erro-mensagem').hide();
			este.animate({'opacity':'1'});
			este.find('input').removeAttr('disabled');
			este.find('input[type=submit]').css('cursor','pointer');

			if(data.sucesso){
				if($('.erro-mensagem').is(':hidden') == false){
					$('.erro-mensagem').hide();
				}

				$('#login>.feedback').prepend('<div style="padding:10px; margin: 0 0 30px 0;" class="sucesso-mensagem"><h3><i class="fas fa-check-circle"></i></h3><p>'+data.mensagem+'</p></div>');
				setTimeout(function(){
					$('.sucesso-mensagem').fadeOut();
				},6000);
				document.getElementById('login').reset();
				document.querySelector('#login>div>label').innerHTML = 'Selecionar arquivo';
			}else{
				if($('.erro-mensagem').is(':hidden') == false){
					$('.erro-mensagem').hide();
				}

				$('#login>.feedback').prepend('<div style="padding:10px; margin: 0 0 30px 0;" class="erro-mensagem"><h3><i class="fas fa-exclamation-triangle"></i></h3><p>'+data.mensagem+'</p></div>');
			}
		});

		return false;
	});

	//================================================================
	//ajax do cadastro

	/*cadastro.submit(function(){
		const este = $(this);
		const url = path+'ajax/dados.php';

		$.ajax({
			beforeSend:function(){
				este.animate({'opacity':'0.5'});
				este.find('input').attr('disabled','true');
				este.find('input[type=submit]').css('cursor','wait');
			},
			url:url,
			dataType:'json',
			method:'post',
			data:este.serialize()
		}).done(function(data){
			$('.erro-mensagem').hide();
			este.animate({'opacity':'1'});
			este.find('input').removeAttr('disabled');
			este.find('input[type=submit]').css('cursor','pointer');
			window.scroll(0,0);

			if(data.sucesso){
				if($('.erro-mensagem').is(':hidden') == false){
					$('.erro-mensagem').hide();
				}

				$('#cadastro>.feedback').prepend('<div style="padding:10px; margin: 0 0 30px 0;" class="sucesso-mensagem"><h3><i class="fas fa-check-circle"></i></h3><p>'+data.mensagem+'</p></div>');
				setTimeout(function(){
					$('.sucesso-mensagem').fadeOut();
				},5000);
				document.getElementById('cadastro').reset();
				document.querySelector('#cadastro>div>label').innerHTML = 'Selecionar arquivo';
			}else{
				if($('.erro-mensagem').is(':hidden') == false){
					$('.erro-mensagem').hide();
				}

				$('#cadastro>.feedback').prepend('<div style="padding:10px; margin: 0 0 30px 0;" class="erro-mensagem"><h3><i class="fas fa-exclamation-triangle"></i></h3><p>'+data.mensagem+'</p></div>');
			}
		});

		return false;
	});*/
})