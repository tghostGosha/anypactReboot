import * as flsFunctions from "./modules/functions.js";
import $ from "jquery"
// import { Inputmask } from "inputmask";
import Swiper, { Navigation, Pagination } from 'swiper';
// import JustValidate from 'just-validate';

// Swiper.use([Navigation, Pagination])

flsFunctions.isWebp();


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
const rightMenu = document.querySelector('.right-menu');
const bellSvg = document.querySelector('.svg-notification-bell-dims')
notificationsBtn.addEventListener('click', (e) => {
  rightMenu.classList.toggle('open')
  bellSvg.classList.toggle('_active')
});

//====Открытие карты=============

const openMap = document.querySelector('.location')
const cityChoose = document.querySelector('.city__choose')
const closeMap = document.querySelector('.city__choose-btn-close')
openMap.addEventListener('click', (e) => {
  cityChoose.classList.remove('_close');
  cityChoose.classList.add('_open');

})
closeMap.addEventListener('click', (e) => {
  cityChoose.classList.remove('_open');
  cityChoose.classList.add('_close');
})

//====Открытие категории сделки=============
const openCategory = document.querySelector('#button_select_category')
const selectCategory = document.querySelector('.select__category-list')

openCategory.addEventListener('click', (e) => {
  setTimeout(function () {
    selectCategory.classList.toggle('_open');
  }, 200);
  openCategory.classList.toggle('_open');
})

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
