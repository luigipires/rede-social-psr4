$(function(){
	uploadArquivos();
	menu();
	abrirJanela();
	fecharJanela();
	mostrarSenha();
	formCompleted();
	tooltip();

	//================================================================
	//menu

	function menu(){
		let menuMobile = document.querySelector('.menu-mobile>h3');

		if(menuMobile){
			menuMobile.addEventListener('click',() => {
				$('.menu-mobile>ul').slideToggle();
			});
		}
	}

	//================================================================
	//mostrando senha

	function mostrarSenha(){
		let senha = document.querySelectorAll('.mostrar-senha>h3');

		for(let i = 0; i < senha.length; i++){
			senha[i].addEventListener('click', (e) => {
				let classePrincipal = e.target.parentElement.parentNode.parentElement;
				let tipoInput = classePrincipal.querySelector('input').getAttribute('type');
				let input = classePrincipal.querySelector('input');
				let icone = e.target.parentElement.firstChild;

				if(tipoInput == 'password'){
					input.setAttribute('type','text');
					icone.setAttribute('class','fas fa-eye-slash');
				}else{
					input.setAttribute('type','password');
					icone.setAttribute('class','fas fa-eye');
				}
			});
		}
	}

	//================================================================
	//input file e label

	function uploadArquivos(){
		let inputFile = document.querySelector('input[id=foto]');
		let label = document.querySelector('label[for=foto]');

		if(inputFile){
			inputFile.addEventListener('change', (e) => {
				label.textContent = e.target.value.split('\\').pop();
			});
		}
	}

	//================================================================
	//abrir e fechar modal

	function abrirJanela(){
		let modal = document.querySelectorAll('[login]');

		for(let i = 0; i < modal.length; i++){
			modal[i].addEventListener('click', () => {
				document.querySelector('.menu-mobile>ul').style.display = 'none';
				$('.tela-login').fadeIn();
				window.scroll(0,0);
				document.querySelector('body').style.overflow = 'hidden';
			});
		}
	}

	function fecharJanela(){
		let modal = document.querySelectorAll('.fechar-janela>img');

		if(modal){
			for(let i = 0; i < modal.length; i++){
				modal[i].addEventListener('click', () => {
					$('.tela-login').fadeOut();
					$('.window-success').fadeOut();
					$('.window-warning').fadeOut();
					document.querySelector('body').style.overflow = 'auto';
				});
			}
		}
	}

	//================================================================
	//verifica se tem a classe de feedback

	function formCompleted(){
		const mensagem = document.querySelector('.sucesso-mensagem');

		if(document.contains(mensagem) == true){
			let url = window.location.href;
			let lastUrl = url.split('/');

			if(lastUrl[5] == 'cadastro'){
				document.getElementById('cadastro').reset();
			}

			setTimeout(() => {
				$('.sucesso-mensagem').fadeOut(function(){
					setTimeout(() => {
						location.href = url;
					},1000);
				});
			},2500);
		}
	}

	//================================================================
	//hover do tooltip

	function tooltip(){
		let tooltip = $('.tooltip>h3');

		tooltip.hover(function(){
			$(this).next('.text-tooltip').children('div').fadeIn('fast');
		},function(){
			$(this).next('.text-tooltip').children('div').fadeOut('fast');
		});
	}	
})