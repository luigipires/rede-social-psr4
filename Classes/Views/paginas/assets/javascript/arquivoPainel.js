$(function(){
	excluirPostagem();
	excluirImagem();
	janelaSucesso();
	//================================================================
	//slideToggle em javascript puro

	/*let slideUp = (target,duration = 500) => {
	    target.style.transitionProperty = 'height, margin, padding';
	    target.style.transitionDuration = duration + 'ms';
	    target.style.height = target.offsetHeight + 'px';
	    target.offsetHeight;
	    target.style.overflow = 'hidden';
	    target.style.height = 0;
	    target.style.paddingTop = 0;
	    target.style.paddingBottom = 0;
	    target.style.marginTop = 0;
	    target.style.marginBottom = 0;
	    target.setAttribute('target','none');
	    
	    window.setTimeout(() => {
	      target.style.display = 'none';
	      // target.removeAttribute('style');
	      target.style.removeProperty('height');
	      target.style.removeProperty('padding-top');
	      target.style.removeProperty('padding-bottom');
	      target.style.removeProperty('margin-top');
	      target.style.removeProperty('margin-bottom');
	      target.style.removeProperty('overflow');
	      target.style.removeProperty('transition-duration');
	      target.style.removeProperty('transition-property');
	    },duration);
  	}

	let slideDown = (target,duration = 500) => {
	    target.style.removeProperty('display');
	    let display = window.getComputedStyle(target).display;

	    if(display === 'none'){
	    	display = 'block';
	    }

	    target.style.display = display;
	    let height = target.offsetHeight;
	    target.setAttribute('target','block');

	    target.style.overflow = 'hidden';
	    target.style.height = 0;
	    target.style.paddingTop = 0;
	    target.style.paddingBottom = 0;
	    target.style.marginTop = 0;
	    target.style.marginBottom = 0;
	    target.offsetHeight;
	    target.style.transitionProperty = "height, margin, padding";
	    target.style.transitionDuration = duration + 'ms';
	    target.style.height = height + 'px';
	    target.style.removeProperty('padding-top');
	    target.style.removeProperty('padding-bottom');
	    target.style.removeProperty('margin-top');
	    target.style.removeProperty('margin-bottom');

	    window.setTimeout(() => {
      		target.style.removeProperty('height');
      		target.style.removeProperty('overflow');
      		target.style.removeProperty('transition-duration');
      		target.style.removeProperty('transition-property');
	    },duration);
	}

	var slideToggle = (target,duration = 500) => {
		if(window.getComputedStyle(target).display === 'none'){
			return slideDown(target,duration);
		}else{
			return slideUp(target,duration);
		}
	}*/

	//================================================================
	//abrir dropmenu das notifica????es

	// var notificacao = document.querySelectorAll('.notificacoes .icones>div>h3');

	// for(let i = 0; i < notificacao.length; i++){
	// 	notificacao[i].addEventListener('click', (e) => {
	// 		let el = e.target.parentElement.parentNode.querySelector('.wrap-notificacoes');
	// 		// console.log(el)
	// 		if(el.getAttribute('target') == 'block'){
	// 			slideUp(el,200);
	// 			el.style.display = 'none';
	// 		}else{
	// 			slideToggle(el,200);
	// 		}
			

	// 		// 		if(div2[n].getAttribute('target') == 'none'){
	// 		// 			e.target.parentElement.style.color = '#FFF6E6';
	// 		// 			e.target.parentElement.style.border = '2px solid #FFF6E6';
	// 		// 		}else{
	// 		// 			e.target.parentElement.style.color = '#7ECEFC';
	// 		// 			e.target.parentElement.style.border = '2px solid #7ECEFC';
	// 		// 		}
	// 	});
	// }

	//======================================================
	//abrir e fechar janelas

	function excluirPostagem(){
		let boxErro = document.querySelectorAll('[excluirPost]');

		for(let i = 0; i < boxErro.length; i++){
			boxErro[i].addEventListener('click', (e) => {
				//pega valor
				let valueAttr = e.target.parentElement.firstChild.getAttribute('target');
				let url = window.location.href;

				//abre janela
				$('.window-warning').fadeIn();
				window.scroll(0,0);
				document.querySelector('body').style.overflow = 'hidden';

				//constr??i URL para exclus??o
				document.querySelector('.content-warning>a').setAttribute('href',url+'?excluir-postagem='+valueAttr);
			});
		}
	}

	function excluirImagem(){
		let boxErro = document.querySelectorAll('[excluirImagem]');

		for(let i = 0; i < boxErro.length; i++){
			boxErro[i].addEventListener('click', (e) => {
				//pega valor
				let valueAttr = e.target.parentElement.firstChild.getAttribute('target');
				let url = window.location.href;

				//abre janela
				$('.window-warning').fadeIn();
				window.scroll(0,0);
				document.querySelector('body').style.overflow = 'hidden';

				//constr??i URL para exclus??o
				document.querySelector('.content-warning>a').setAttribute('href',url+'?excluir-imagem='+valueAttr);
			});
		}
	}

	function janelaSucesso(){
		let url = window.location.href;

		let paramsURL = url.split(/[?]/);

		if(paramsURL[1]){
			setTimeout(() => {
				$('.window-warning').fadeOut();
				$('.window-success').fadeIn();
				document.querySelector('.window-success>div>a').setAttribute('href',paramsURL[0]);
			},500);
		}
	}
})