
function initCriarAvatar() {
  const nomeCompleto = document.querySelector('#dashboard header .perfil .nome h1').innerText;
  const nomeSeparado = nomeCompleto.split(' ');
  let nomeAbreviado;

  if (nomeSeparado[1]) {
    nomeAbreviado = nomeSeparado[0][0] + nomeSeparado[1][0];    
    document.querySelector('#dashboard header .perfil .nome h1').innerText = nomeSeparado[0] + ' ' + nomeSeparado[1];  
  } else {
    nomeAbreviado = nomeSeparado[0][0];
  }

  const avatar = document.querySelector('#dashboard header .perfil .avatar');
  avatar.innerHTML = '<h1>'+nomeAbreviado+'</h1>';  
}

initCriarAvatar();


function initTrocarFiltro() {
  const filtros = document.querySelectorAll('#dashboard main .topo .filtro a');
  const selects = document.querySelectorAll('#dashboard main .cards > div');
  console.log(selects)
  
  filtros[0].classList.add('selecionado');
  selects[0].removeAttribute('style');
  selects[1].style = 'display: none;';
  
  function selecionaPendentes(event) {
    event.preventDefault();

    filtros[1].classList.remove('selecionado');
    filtros[0].classList.add('selecionado');

    selects[0].removeAttribute('style');
    selects[1].style = 'display: none;'; 
  }
  
  function selecionaConcluidas(event) {
    event.preventDefault();

    filtros[0].classList.remove('selecionado');
    filtros[1].classList.add('selecionado');

    selects[0].style = 'display: none;';
    selects[1].removeAttribute('style');
  }
  
  filtros[0].addEventListener('click', selecionaPendentes);
  filtros[1].addEventListener('click', selecionaConcluidas);  
}

if (window.innerWidth > 600)  initTrocarFiltro();


function initAccordion() {
  const accordionList = document.querySelectorAll('.js-card dt');
  const activeClass = 'ativo';
  if (accordionList.length) {
    
    accordionList[0].nextElementSibling.classList.add(activeClass);
    accordionList[0].lastElementChild.firstElementChild.classList.remove(activeClass);
    accordionList[0].lastElementChild.lastElementChild.classList.add(activeClass);  
      
    function activeAccordion(event) {
      event.preventDefault();
      this.parentElement.nextElementSibling.classList.toggle(activeClass);
      this.parentElement.lastElementChild.lastElementChild.classList.toggle(activeClass);
      this.parentElement.lastElementChild.firstElementChild.classList.toggle(activeClass);  
    }

    for (let i = 0; i < accordionList.length; i++) {
      accordionList[i].lastElementChild.addEventListener('click', activeAccordion);      
    }    
  }
}

initAccordion();


function initChecks() {
  const checks = document.querySelectorAll('#dashboard main .cards .card .header .check');
    
  function acionarCheck() { 
    this.parentElement.nextElementSibling.classList.toggle('ativo'); 
    this.parentElement.lastElementChild.lastElementChild.classList.toggle('ativo'); 
    this.parentElement.lastElementChild.firstElementChild.classList.toggle('ativo'); 
    this.parentElement.children[1].classList.toggle('riscado');   
    this.parentElement.parentElement.classList.toggle('checked'); 
    this.classList.toggle('checked'); 
    this.firstElement.classList.toggle('checked'); 
  }
  
  checks.forEach(check => {
    check.addEventListener('click', acionarCheck);    
  }); 
   
}

initChecks();


function initAvisoPrazo() {
  const date = new Date();
  const dataHora = date.toLocaleString().split(' ');
  
  const data = dataHora[0].split('/');
  const dia = data[0];
  const mes = data[1];
  const ano = data[2];
  
  const hour = dataHora[1].split(':');
  const hora = hour[0];
  const min = hour[1];
  
  const datasCard = document.querySelectorAll('.pendentes .card .data span');
  let diaCard, mesCard, anoCard, horaCard, minCard;
  
  datasCard.forEach(dataCard => {
    diaCard = dataCard.innerText.split('-')[2];
    mesCard = dataCard.innerText.split('-')[1];
    anoCard = dataCard.innerText.split('-')[0];
  
    horaCard = dataCard.parentElement.nextElementSibling.lastElementChild.innerText.split(':')[0];
    minCard = dataCard.parentElement.nextElementSibling.lastElementChild.innerText.split(':')[1];  
    
  
    if (anoCard < ano) {
      dataCard.parentElement.parentElement.parentElement.parentElement.firstElementChild.classList.add('bolinha');
    } else {
      if (mesCard < mes) {
        dataCard.parentElement.parentElement.parentElement.parentElement.firstElementChild.classList.add('bolinha');
        if (diaCard < dia) {
          dataCard.parentElement.parentElement.parentElement.parentElement.firstElementChild.classList.add('bolinha');        
        }
      } else if (mesCard == mes) {
        if (diaCard < dia) {
          dataCard.parentElement.parentElement.parentElement.parentElement.firstElementChild.classList.add('bolinha');        
        }
      }
    }
  
    if ((anoCard == ano) && (mesCard == mes) && (diaCard == dia)) {
      if (horaCard !== 00) {
        if ((horaCard < hora)) {
          dataCard.parentElement.parentElement.parentElement.parentElement.firstElementChild.classList.add('bolinha');
        }
        if (horaCard > hora) {
          dataCard.parentElement.parentElement.parentElement.parentElement.firstElementChild.classList.add('bolinha', 'bolinha-amarela');
        }
        if ((horaCard == hora) && (minCard<min)) {
          dataCard.parentElement.parentElement.parentElement.parentElement.firstElementChild.classList.add('bolinha', 'bolinha-amarela');
        }    
      }
      
    }
    
  
  }); 
}

initAvisoPrazo();


function initFormatarData() {
  const datas = document.querySelectorAll('.card .data span');
  
  datas.forEach(data => {
    data.parentElement.firstElementChild.style = 'font-size: 16px;'
    const dia = data.innerText.split('-')[2];
    const mes = data.innerText.split('-')[1];
    const anoRaw = data.innerText.split('-')[0];
    const ano = anoRaw[2]+anoRaw[3];
    data.innerText = `${dia}.${mes}.${ano}`
  });  
}

initFormatarData();


function initFormatarHora() {
  const horas = document.querySelectorAll('.card .hora span');
  
  horas.forEach(hora => {
    if (hora.innerText === '00:00:00') {
      hora.parentElement.style= 'display: none;';
    } else {
      const hour = hora.innerText.split(':')[0];
      const minuto = hora.innerText.split(':')[1];
      hora.innerText = `${hour}:${minuto}`
    }
  });  
}

initFormatarHora();

function initEsconderDescricao() {
  const descricoes = document.querySelectorAll('.card dd p');

  descricoes.forEach(descricao => {
    if (!descricao.innerText) {
      descricao.style='display: none;';
      descricao.parentElement.parentElement.children[1].lastElementChild.style='display:none;'; 
    }
  });
}
initEsconderDescricao();