import * as flsFunctions from "./modules/functions.js";
import $ from "jquery"
import './modules/map.js'  //====яндекс карта
import gsap from "gsap";   //======Анимация
// import { Inputmask } from "inputmask";
import Swiper, { Navigation, Pagination } from 'swiper';
// import JustValidate from 'just-validate';

Swiper.use([Navigation, Pagination])

flsFunctions.isWebp();

//Модальное окно
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
	$(document).on('click', '#walletRegister', function (){
		OpenModalWindow($('#modalWalletRegister'));
	});

	$(document).on('click', '.modal-close, .modal-bg', function (){
		CloseModalWindow();
	});
	$(document).on('click', '.modal-window', function (e){
		e.stopPropagation();
	});
});
//====БУргер=============
const burger = document.querySelector('.menu__icon');
if(burger) {
      const iconMenu = document.querySelector('.header__nav');
      const menuBody = document.querySelector('.navbar-nav');
      burger.addEventListener('click', (e) => {
        burger.classList.toggle('_active');
        setTimeout(function () {
          iconMenu.classList.toggle('_active');
        }, 300);
            
            
        menuBody.classList.toggle('_active');
            
      });
};

//====Профайл на мобилке=============
const userIcon = document.querySelector('.header__profile-mobile');
if(userIcon) {
  const closeBtn = document.querySelector('.close__btn')
  const menuModal = document.querySelector('.user-menu-modal');
  const menuModalBody = document.querySelector('.user-menu-modal-block');
      
  userIcon.addEventListener('click', (e) => {
    userIcon.classList.toggle('_active');
    menuModal.classList.toggle('_show');
    menuModalBody.classList.toggle('_show');
            
  });
  closeBtn.addEventListener('click', (e) => {
    menuModalBody.classList.toggle('_show');
    setTimeout(function () {
      menuModal.classList.toggle('_show');
    }, 200);
    
    
  })
}

//====Боковое окно=============
const notificationsBtn = document.querySelector('#notification_btn');
const bellSvg = document.querySelector('.svg-notification-bell-dims')
let rightMenu = gsap.timeline();

notificationsBtn.onclick = function() {
  if (!notificationsBtn.classList.contains('active')) {
    notificationsBtn.classList.add('active');
    bellSvg.classList.add('_active')
    rightMenu
      .to('.right-menu', {x: -368, duration: 0.4});
      rightMenu.play();
  } else {
    notificationsBtn.classList.remove('active');
    bellSvg.classList.remove('_active')
    rightMenu.reverse();
  }
  
}

//====Открытие категории сделки=============
const openCategory = document.querySelector('#button_select_category')
const selectCategory = document.querySelector('.select__category-list')
let tl = gsap.timeline();
openCategory.onclick = function() {
  if (!openCategory.classList.contains('active')) {
    openCategory.classList.add('active');
    
    tl
      .to(selectCategory, {height: 'auto',y: 0, opacity:1, display:'flex', duration: 0.3})
      
    tl.play();
  } else {
    openCategory.classList.remove('active');
    tl.reverse(0.5);
  }
  
}

//=======Открытие настроек профиля===========
const openProfileOptions = document.querySelector('#profileOptionsBtn')
const selectOptions = document.querySelector('#selectProfileOptions')
let options = gsap.timeline();
openProfileOptions.onclick = function() {
  if (!openProfileOptions.classList.contains('active')) {
    openProfileOptions.classList.add('active');
    
    options
      .to(selectOptions, {height: 'auto', y: 0, display:'flex', duration: 0.3})
      
    options.play();
  } else {
    openProfileOptions.classList.remove('active');
    options.reverse(0.5);
  }
  
}
// openCategory.addEventListener('click', (e) => {
//   setTimeout(function () {
//     selectCategory.classList.toggle('_open');
//   }, 200);
//   openCategory.classList.toggle('_open');
// })

// const awardsSection = document.querySelector('#awards')
// gsap.timeline( {
//   scrollTrigger: {
//     trigger: '#awards',
//     start: 'top top',
//     end: '+=500',
//     markers: true,
//     pin: true,
//   }
// });

//====Открытие карты=============

const openMap = document.querySelector('.location')
const openMap2 = document.querySelector('.region__link')
const cityChoose = document.querySelector('#city_choose')
const closeMap = document.querySelector('.city__choose-btn-close')
let map = gsap.timeline();

let mapOpen = (btn) => {
  btn.onclick = function() {
    if (!openMap.classList.contains('active')) {
      btn.classList.add('active');
      
      map
        .add('start')
        .to(cityChoose, {height: 'auto', y: 0, opacity: 1, duration: 0.5, easy:'none'}, 'start')
        .to('.city__choose .container', {  y: 0, opacity: 1, duration: 0.7, easy:'none'}, 'start')
      map.play();
  
      closeMap.onclick = function() {
        map.reverse(0.5);
        btn.classList.remove('active');
      }
    } 
    
  }
}

mapOpen(openMap)
mapOpen(openMap2)

// =========swiper hero=======
const swiperDeal = new Swiper('.swiper-deal', {
  modules: [Navigation, Pagination],
  slidesPerView: 4,
  slidesPerColumn: 4,
  slidesPerGroup: 2,
  spaceBetween: 20,
  loop: false,

  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  }
})

//====делаем первую букву  в Верхнем регистре
// const regex = /[A-Za-z0-0]/;
// let firstLetterToUpperCase = (className) => {
//   const inputs = document.getElementsByClassName(className)
  
  
//     for (let i = 0; i < inputs.length; ++i) {
//       inputs[i].onblur = () => {
//         // if (regex.test(inputs[i].value)) inputs[i].value='';
//         if (inputs[i].value === '') return;
  
//         let str = inputs[i].value
//           .trim()
//           .replace(/-+/g, '-')
//           .replace(/^-|-$/g, '')
//           .replace(/\s+/g, ' ')
//           .trim()
//         inputs[i].value = str[0].toUpperCase() + str.substr(1).toLowerCase()
//       }
//     }
  
// }
// firstLetterToUpperCase('form-control')



//=====Input mask
// const mask = event => {
//   const { target, keyCode, type } = event;

//   const pos = target.selectionStart;
//   if (pos < 3) event.preventDefault();
//   const matrix = '+7 (___) ___-__-__';
//   let i = 0;
//   const def = matrix.replace(/\D/g, '');
//   const val = target.value.replace(/\D/g, '');
//   let newValue = matrix.replace(/[_\d]/g,
//     a => (i < val.length ? val[i++] || def[i] : a));
//   i = newValue.indexOf('_');
//   if (i !== -1) {
//     i < 5 && (i = 3);
//     newValue = newValue.slice(0, i);
//   }
//   let reg = matrix.substring(0, target.value.length).replace(/_+/g,
//     (a) => `\\d{1,${a.length}}`).replace(/[+()]/g, '\\$&');
//   reg = new RegExp(`^${reg}$`);
//   if (!reg.test(target.value) || target.value.length < 5 ||
//     keyCode > 47 && keyCode < 58) {
//     target.value = newValue;
//   }
//   if (type === 'blur' && target.value.length < 5) target.value = '';
// };

// const input = document.getElementById('exampleFormControlInput');

// if (input.type === 'tel') {
//   input.addEventListener('input', mask);
//   input.addEventListener('focus', mask);
//   input.addEventListener('blur', mask);
//   input.addEventListener('keydown', mask);
// }





//========Валидация формы открытия счета и маска================
      //======маска телефон
// const accountFormTel = document.getElementById('tel');
// if (accountFormTel.type === 'tel') {
//   accountFormTel.addEventListener('input', mask);
//   accountFormTel.addEventListener('focus', mask);
//   accountFormTel.addEventListener('blur', mask);
//   accountFormTel.addEventListener('keydown', mask);
// }
//       //======заглавная буква
// firstLetterToUpperCase('account__form-input');
//       //=======Валидация
// const validation = new JustValidate('#accountform', {
//   errorFieldCssClass: 'is-invalid',
//   errorLabelStyle: {
//     fontSize: '14px',
//     color: '#dc3545',
//   },
//   successFieldCssClass: 'is-valid',
//   successLabelStyle: {
//     fontSize: '14px',
//     color: '#20b418',

//   },
//   successFieldStyle: {
//     border: '1px solid #44953D',
//   },
//   focusInvalidField: true,
//   lockForm: true,
// });
// validation
//   .addField('#firstname', [
//     {
//       rule: 'minLength',
//       value: 3,
//       errorMessage: 'Фамилия должна содержать не менее 3-х символов ',
//     },
//     {
//       rule: 'maxLength',
//       value: 30,
//     },
//     {
//       rule: 'required',
//       errorMessage: 'Обязательное поле',
//     },
//   ])
//   .addField('#secondname', [
//     {
//       rule: 'minLength',
//       value: 2,
//       errorMessage: 'Имя должно содержать не менее 2-х символов ',
//     },
//     {
//       rule: 'maxLength',
//       value: 30,
//     },
//     {
//       rule: 'required',
//       errorMessage: 'Обязательное поле',
//     },
//   ])
//   .addField('#surname', [
//     {
//       rule: 'minLength',
//       value: 3,
//       errorMessage: 'Отчество должно содержать не менее 3-х символов ',
//     },
//     {
//       rule: 'maxLength',
//       value: 30,
//     },
//     {
//       rule: 'required',
//       errorMessage: 'Обязательное поле',
//     },
//   ])
//   .addField('#mail', [
//     {
//       rule: 'required',
//       errorMessage: 'Обязательное поле',
//     },
//     {
//       rule: 'email',
//       errorMessage: 'Не валидный Email',
//     },
//   ])
//   .addField('#tel', [
//     {
//       rule: 'required',
//       errorMessage: 'Обязательное поле',
//     },
//   ])
//   .addField('#accountCheck', [
//     {
//       rule: 'required',
//       errorMessage: 'Подтвердите',
//     },
//   ])
//   // {
//   //   successMessage: 'Силён! с первой попытки'
//   // }
//   .onSuccess((ev) => {
//     ev.preventDefault();
//     window.showNotification();
//   });
