$(function(){
	FetchPostagens();
	FetchLogin();

	//================================================================
	//ajax de postagens

	function FetchPostagens(){
		const postagens = document.querySelector('[postagens]');

		if(postagens){
			postagens.addEventListener('submit', (event) => {
				event.preventDefault();

				//parâmetros FETCH
				var pathFetch = asset+'ajax/postagens.php';
				var body = new FormData(postagens);

				// let fotos = body.getAll('fotos[]');

				// for(let nomeFoto of fotos.entries()){
				// 	if(nomeFoto[1].length != 0){
				// 		let fotoUpada = nomeFoto;

				// 		console.log(fotoUpada)
				// 		event.target.insertAdjacentHTML('beforeend',fotoUpada);
				// 	}
				// }

				//bloqueia formulário até a requisição ser completada
				event.target.style.transitionProperty = 'opacity';
				event.target.style.transitionDuration = '1000ms';
				event.target.style.opacity = '0.5';

				let textarea = event.target.querySelector('textarea');
				let labelFile = event.target.querySelectorAll('label');
				let input = event.target.querySelector('input[type=submit]');

				textarea.setAttribute('disabled','true');
				textarea.style.cursor = 'wait';
				input.setAttribute('disabled','true');
				input.style.cursor = 'wait';

				for(let i = 0; i < labelFile.length; i++){
					labelFile[i].style.cursor = 'wait';
				}

				//requisição FETCH
				fetch(pathFetch,{
					method: "POST",
					body,
				})
				.then((response) => response.json())
				.then((data) => {
					//volta o formulário ao normal
					event.target.style.transitionProperty = 'opacity';
					event.target.style.transitionDuration = '1500ms';
					event.target.style.opacity = '1';

					let textarea = event.target.querySelector('textarea');
					let labelFile = event.target.querySelectorAll('label');
					let input = event.target.querySelector('input[type=submit]');

					textarea.removeAttribute('disabled');
					textarea.style.cursor = 'text';
					input.removeAttribute('disabled');
					input.style.cursor = 'pointer';

					for(let i = 0; i < labelFile.length; i++){
						labelFile[i].style.cursor = 'pointer';
					}

					mostrarResposta(postagens,data);

					event.target.reset();

					//verifica se o feedback sucesso aparece e faz recarregar a página
					let mensagem = document.querySelector('.sucesso-mensagem');

					if(document.contains(mensagem)){
						setTimeout(() => {
							$('.sucesso-mensagem').fadeOut(function(){
								let url = window.location.href;

								setTimeout(() => {
									location.href = url;
								},1000);
							});
						},2500);
					}
				})
				.catch(error => console.log(error));
			});
		}
	}

	//================================================================
	//ajax do login

	function FetchLogin(){
		const login = document.getElementById('login');

		if(login){
			login.addEventListener('submit', (event) => {
				event.preventDefault();

				//parâmetros FETCH
				var pathFetch = asset+'ajax/dados.php';
				var body = new FormData(login);

				//bloqueia formulário até a requisição ser completada
				event.target.style.transitionProperty = 'opacity';
				event.target.style.transitionDuration = '1000ms';
				event.target.style.opacity = '0.5';

				let input = event.target.querySelector('input[type=submit]');

				input.setAttribute('disabled','true');
				input.style.cursor = 'wait';

				//requisição FETCH
				fetch(pathFetch,{
					method:'post',
					body
				})
				.then((response) => response.json())
				.then((data) => {
					//volta o formulário ao normal
					event.target.style.transitionProperty = 'opacity';
					event.target.style.transitionDuration = '1500ms';
					event.target.style.opacity = '1';

					let input = event.target.querySelector('input[type=submit]');

					input.removeAttribute('disabled');
					input.style.cursor = 'pointer';

					//função do feedback
					mostrarResposta(event.target,data);
				})
				.catch((error) => console.log(error));
			});
		}
	}

	//================================================================
	//mostra feedbacks do FETCH

	function mostrarResposta(nomeDiv,resposta){
		if(resposta.sucesso == true){
			//verifica se a classe existe
			let aviso = document.querySelector('.erro-mensagem');

			if(document.contains(aviso) == true){
				aviso.style.display = 'none';
			}

			//mostra mensagem
			let content = '<div style="padding:10px; margin: 0 0 10px 0;" class="sucesso-mensagem"><h3><i class="fas fa-check-circle"></i></h3><h2>'+resposta.mensagem+'</h2></div>';
			
			nomeDiv.insertAdjacentHTML('afterBegin',content);
		}else if(resposta.login == true){
			//verifica se a classe existe
			let aviso = document.querySelector('.erro-mensagem');

			if(document.contains(aviso) == true){
				aviso.style.display = 'none';
			}

			//reseta formulário
			nomeDiv.reset();

			//redireciona
			let url = window.location.href;

			location.href = url;
		}else{
			//verifica se a classe existe
			let aviso = document.querySelector('.erro-mensagem');

			if(document.contains(aviso) == true){
				aviso.style.display = 'none';
			}

			//mostra mensagem
			let content = '<div style="padding:10px; margin: 0 0 10px 0;" class="erro-mensagem"><h3><i class="fas fa-exclamation-triangle"></i></h3><h2>'+resposta.mensagem+'</h2></div>';
			
			nomeDiv.insertAdjacentHTML('afterBegin',content);
		}
	}
})