$(function(){

	abrirJanela();
	fecharJanela();

	//================================================================
	//menu

	var menuMobile = document.querySelector('.menu-mobile>h3');

	menuMobile.addEventListener('click',() => {
		$('.menu-mobile>ul').slideToggle();
	});

	//================================================================
	//mostrando senha

	var senha = document.querySelectorAll('.mostrar-senha>h3');

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

	//================================================================
	//input file e label

	var inputFile = document.querySelector('input[name=foto]');
	var label = document.querySelector('label[for=foto]');

	inputFile.addEventListener('change', (e) => {
		label.textContent = e.target.value.split('\\').pop();
	});

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
		let modal = document.querySelector('.fechar-janela>img');

		modal.addEventListener('click', () => {
			$('.tela-login').fadeOut();
			document.querySelector('body').style.overflow = 'auto';
		});
	}
})