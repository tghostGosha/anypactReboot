import * as flsFunctions from "./modules/functions.js";
import $ from "jquery";
import "./modules/map.js"; //====яндекс карта
import gsap from "gsap"; //======Анимация
// import { Inputmask } from "inputmask";
import Swiper, { Navigation, Pagination } from "swiper";
import Choices from "choices.js";
import { Carousel } from '@fancyapps/ui/dist/carousel/carousel.esm.js';


import { Thumbs } from '@fancyapps/ui/dist/carousel/carousel.thumbs.esm.js';


import { Fancybox } from '@fancyapps/ui/dist/fancybox/fancybox.esm.js';
new Carousel(
  document.getElementById('productCarousel'),
  {
    infinite: false,
    Dots: false,
    Thumbs: {
      type: 'classic',
      Carousel: {
        slidesPerPage: 1,
        Navigation: true,
        center: true,
        fill: true,
        dragFree: true,
      },
    },
  },
  { Thumbs }
);

Fancybox.bind('[data-fancybox="gallery"]', {
  idle: false,
  compact: false,
  dragToClose: false,

  animated: false,
  showClass: 'f-fadeSlowIn',
  hideClass: false,

  Carousel: {
    infinite: false,
  },

  Images: {
    zoom: false,
    Panzoom: {
      maxScale: 1.5,
    },
  },

  Toolbar: {
    absolute: true,
    display: {
      left: [],
      middle: [],
      right: ['close'],
    },
  },

  Thumbs: {
    type: 'classic',
    Carousel: {
      axis: 'x',

      slidesPerPage: 1,
      Navigation: true,
      center: true,
      fill: true,
      dragFree: true,

      breakpoints: {
        '(min-width: 640px)': {
          axis: 'y',
        },
      },
    },
  },
});

// import JustValidate from 'just-validate';

Swiper.use([Navigation, Pagination]);

flsFunctions.isWebp();

//Модальное окно
function OpenModalWindow(el) {
  CloseModalWindow();
  let modal = $(".modal-block");
  modal.addClass("open");
  el.show();
}

function CloseModalWindow() {
  let modal = $(".modal-block");
  let forms = $("form", modal);
  let formsBlocks = $(".modal-window-content > div", modal);
  modal.removeClass("open");
  forms.each(function () {
    this.reset();
  });
  formsBlocks.each(function () {
    $(this).hide();
  });
}

$(document).ready(function () {
  $(document).on("click", "#walletRegister", function () {
    OpenModalWindow($("#modalWalletRegister"));
  });

  $(document).on("click", ".modal-close, .modal-bg", function () {
    CloseModalWindow();
  });
  $(document).on("click", ".modal-window", function (e) {
    e.stopPropagation();
  });
});
$(document).ready(function () {
  $(document).on("click", "#CardComplaint", function () {
    OpenModalWindow($("#modalCardComplaint"));
  });

  $(document).on("click", ".modal-close, .modal-bg", function () {
    CloseModalWindow();
  });
  $(document).on("click", ".modal-window", function (e) {
    e.stopPropagation();
  });
});
//====БУргер=============
const burger = document.querySelector(".menu__icon");
if (burger) {
  const iconMenu = document.querySelector(".header__nav");
  const menuBody = document.querySelector(".navbar-nav");
  burger.addEventListener("click", (e) => {
    burger.classList.toggle("_active");
    setTimeout(function () {
      iconMenu.classList.toggle("_active");
    }, 300);

    menuBody.classList.toggle("_active");
  });
}

//====Профайл на мобилке=============
const userIcon = document.querySelector(".header__profile-mobile");
if (userIcon) {
  const closeBtn = document.querySelector("#closeBtnUserMenu");
  const menuModal = document.querySelector("#user_menu");
  const menuModalBody = document.querySelector("#userMenuBlock");

  userIcon.addEventListener("click", (e) => {
    userIcon.classList.toggle("_active");
    menuModal.classList.toggle("_show");
    menuModalBody.classList.toggle("_show");
  });
  closeBtn.addEventListener("click", (e) => {
    menuModalBody.classList.toggle("_show");
    setTimeout(function () {
      menuModal.classList.toggle("_show");
    }, 200);
  });
}
//====Категории на мобилке=============
const usecategory = document.querySelector(".category__mobile-slide");
if (usecategory) {
  const closeBtn = document.querySelector("#closeBtnCategory");
  const categoryMenu = document.querySelector("#categoryMenu");
  const categoryMenuBlock = document.querySelector("#categoryMenuBlock");

  usecategory.addEventListener("click", (e) => {
    categoryMenu.classList.toggle("_show");
    categoryMenuBlock.classList.toggle("_show");
  });
  closeBtn.addEventListener("click", (e) => {
    categoryMenuBlock.classList.toggle("_show");
    setTimeout(function () {
      categoryMenu.classList.toggle("_show");
    }, 200);
  });
}

//====Боковое окно=============
const notificationsBtn = document.querySelector("#notification_btn");
const bellSvg = document.querySelector(".svg-notification-bell-dims");
let rightMenu = gsap.timeline();

notificationsBtn.onclick = function () {
  if (!notificationsBtn.classList.contains("active")) {
    notificationsBtn.classList.add("active");
    bellSvg.classList.add("_active");
    if(window.screen.width > 768) {

      rightMenu.to(".right-menu", { x: -368, duration: 0.3 });
      rightMenu.play();
    } else {
      rightMenu.to(".right-menu", { x: -250, duration: 0.3 });
      rightMenu.play();
    }
  } else {
    notificationsBtn.classList.remove("active");
    bellSvg.classList.remove("_active");
    rightMenu.reverse();
  }
};

//====Открытие категории сделки=============
const openCategory = document.querySelector("#button_select_category");
const selectCategory = document.querySelector(".select__category-list");
let tl = gsap.timeline();
try {
  openCategory.onclick = function () {
    if (!openCategory.classList.contains("active")) {
      openCategory.classList.add("active");

      tl.to(selectCategory, {
        height: "auto",
        y: 0,
        opacity: 1,
        display: "flex",
        duration: 0.3,
      });

      tl.play();
    } else {
      openCategory.classList.remove("active");
      tl.reverse(0.5);
    }
  };
} catch (error) {}
//====Открытие каталога категории =============
const openCatalogCategory = document.querySelector("#button_catalog_category");

let tl2 = gsap.timeline();
try {
openCatalogCategory.onclick = function () {

    if (!openCatalogCategory.classList.contains("active")) {
      openCatalogCategory.classList.add("active");
  
      tl2.to(selectCategory, {
        height: "auto",
        y: 0,
        opacity: 1,
        display: "flex",
        duration: 0.3,
      });
  
      tl2.play();
    } else {
      openCatalogCategory.classList.remove("active");
      tl2.reverse(0.5);
    }
  }
}
catch(error){}

//=======Открытие настроек профиля===========
const openProfileOptions = document.querySelector("#profileOptionsBtn");
const selectOptions = document.querySelector("#selectProfileOptions");
let options = gsap.timeline();
openProfileOptions.onclick = function () {
  if (!openProfileOptions.classList.contains("active")) {
    openProfileOptions.classList.add("active");

    options.to(selectOptions, {
      height: "auto",
      y: 0,
      display: "flex",
      duration: 0.3,
    });

    options.play();
  } else {
    openProfileOptions.classList.remove("active");
    options.reverse(0.5);
  }
};
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

const openMap = document.querySelector(".location");
const openMap2 = document.querySelector(".region__link");
const cityChoose = document.querySelector("#city_choose");
const closeMap = document.querySelector(".city__choose-btn-close");
let map = gsap.timeline();

let mapOpen = (btn) => {
  btn.onclick = function () {
    if (!openMap.classList.contains("active")) {
      btn.classList.add("active");

      map
        .add("start")
        .to(
          cityChoose,
          { height: "auto", y: 0, opacity: 1, duration: 0.5, easy: "none" },
          "start"
        )
        .to(
          ".city__choose .container",
          { y: 0, opacity: 1, duration: 0.7, easy: "none" },
          "start"
        );
      map.play();

      closeMap.onclick = function () {
        map.reverse(0.5);
        btn.classList.remove("active");
      };
    }
  };
};
try {
  mapOpen(openMap);
} catch (error) {}
try {
  mapOpen(openMap2);
} catch (error) {}

// =========swiper hero=======
try{

  const swiperDeal = new Swiper(".swiper-deal", {
    modules: [Navigation, Pagination],
    slidesPerView: 1,
    slidesPerGroup: 1,
    spaceBetween: 16,
    loop: false,
    breakpoints: {
      // when window width is >= 1090px
      1090: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
      // when window width is >= 523px
      523: {
        slidesPerView: 2,
        spaceBetween: 16,
      },
      // when window width is >= 320px
      320: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
    },
  
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-deal-next",
      prevEl: ".swiper-deal-prev",
    },
  });
} catch(error){}
// =========swiper hero=======
try {

  const swiperCategory = new Swiper(".swiper__category", {
    modules: [Navigation, Pagination],
    slidesPerView: 8,
    slidesPerGroup: 1,
    spaceBetween: 16,
    loop: false,
    breakpoints: {
      // when window width is >= 1090px
      1090: {
        slidesPerView: 7,
        spaceBetween: 36,
      },
      768: {
        slidesPerView: 5,
        spaceBetween: 30,
      },
      // when window width is >= 523px
      523: {
        slidesPerView: 4,
        spaceBetween: 22,
      },
      // when window width is >= 320px
      320: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-category-next",
      prevEl: ".swiper-category-prev",
    },
  });
}catch(error){}
//===========swiper ======

let swiper = Swiper;
let init = false;
try {

  function swiperCard() {
    let mobile = window.matchMedia("(min-width: 0px) and (max-width: 1024px)");
  
    if (mobile.matches) {
      if (!init) {
        init = true;
        swiper = new Swiper(".swiper__about", {
          modules: [Navigation],
          slidesPerView: 2,
          slidesPerGroup: 1,
          spaceBetween: 20,
          // centeredSlides: true,
          breakpoints: {
            // when window width is >= 320px
            1090: {
              slidesPerView: 3,
              spaceBetween: 20,
            },
            // when window width is >= 523px
            523: {
              slidesPerView: 2,
              spaceBetween: 16,
            },
            // when window width is >= 320px
            320: {
              slidesPerView: 1,
              spaceBetween: 20,
            },
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          navigation: {
            nextEl: ".swiper__about-next",
            prevEl: ".swiper__about-prev",
          },
        });
      }
    } else if (init) {
      swiper.destroy();
      init = false;
    }
  }
}catch(error){}
try {
  swiperCard();
  window.addEventListener("resize", swiperCard);
} catch (error) {}

//==========Фильтр "Сортироать"===========
try {

  const choiceSort = new Choices(".choices-sort", {
    searchEnabled: false,
    itemSelectText: "",
    position: "bottom",
    classNames: {
      containerInner: "choices__inner-withoot-border",
    },
  });
}catch(error) {}

//==========Фильтр "Регион"===========
try {
  const choiceRegion = new Choices(".choice-region", {
    itemSelectText: "",
    // searchEnabled: true,
    position: "bottom",
    allowHTML: true,
    removeItemButton: true,
    choices: [
      { value: "Абакан", label: "Абакан" },
      { value: "Анадырь", label: "Анадырь" },
      { value: "Архангельск", label: "Архангельск" },
      { value: "Астрахань", label: "Астрахань" },
      { value: "Барнаул", label: "Барнаул" },
      { value: "Белгород", label: "Белгород" },
      { value: "Биробиджан", label: "Биробиджан" },
      { value: "Благовещенск", label: "Благовещенск" },
      { value: "Брянск", label: "Брянск" },
      { value: "Великий Новгород", label: "Великий Новгород" },
      { value: "Владивосток", label: "Владивосток" },
      { value: "Владикавказ", label: "Владикавказ" },
      { value: "Владимир", label: "Владимир" },
    ],
    classNames: {
      containerInner: "choices__inner-withoot-border",
    },
  });
} catch (error) {}
//==========Фильтр "Время публикации"===========
try {
  const choiceJob = new Choices(".choice-job", {
    itemSelectText: "",
    searchEnabled: false,
    position: "bottom",
    allowHTML: true,
    choices: [
      { value: "IT, интернет, телеком", label: "IT, интернет, телеком" },
      { value: "Автомобильный бизнес", label: "Автомобильный бизнес" },
      { value: "Административная работа", label: "Административная работа" },
      { value: "Банки, инвестиции", label: "Банки, инвестиции" },
      { value: "Без опыта, студенты", label: "Без опыта, студенты" },
      { value: "Бухгалтерия, финансы", label: "Бухгалтерия, финансы" },
      { value: "Высший менеджмент", label: "Высший менеджмент" },
      { value: "Госслужба, НКО", label: "Госслужба, НКО" },
      { value: "Домашний персонал", label: "Домашний персонал" },
      { value: "ЖКХ, эксплуатация", label: "ЖКХ, эксплуатация" },
      { value: "Исскуство, развлечения", label: "Исскуство, развлечения" },
      { value: "Маркетинг, реклама, PR", label: "Маркетинг, реклама, PR" },
      { value: "Консультирование", label: "Консультирование" },
      { value: "Курьерская доставка", label: "Курьерская доставка" },
      { value: "Медицина, фармацевтика", label: "Медицина, фармацевтика" },
      { value: "Продажи", label: "Продажи" },
      { value: "Образование, наука", label: "Образование, наука" },
      { value: "Охрана, безопасность", label: "Охрана, безопасность" },
      { value: "Производство, сырье, с/х", label: "Производство, сырье, с/х" },
      { value: "Страхование", label: "Страхование" },
      { value: "Строительство", label: "Строительство" },
      { value: "Транспорт, логистика", label: "Транспорт, логистика" },
      { value: "Туризм, рестораны", label: "Туризм, рестораны" },
      { value: "Управление персоналом", label: "Управление персоналом" },
      { value: "Фитнес, салоны красоты", label: "Фитнес, салоны красоты" },
      { value: "Юриспрунденция", label: "Юриспрунденция" },
    ],
  });
} catch (error) {}

//==========Фильтр "Время публикации"===========
//==========Фильтр "Опыт работы"===========
//==========Фильтр "Образование"===========
//==========Фильтр "Гражданство"===========
let genericExamples = document.querySelectorAll(".choice-filter");
console.log(genericExamples);
for (let i = 0; i < genericExamples.length; ++i) {
  let element = genericExamples[i];
  new Choices(element, {
    searchEnabled: false,
    itemSelectText: "",
    position: "bottom",
  });
}

//==========Фильтр "Время публикации"===========
// const choiceTime = new Choices('.choice-time', {
//   searchEnabled: false,
//   itemSelectText: '',
//   position: 'bottom',

// })
// //==========Фильтр "Опыт работы"===========
// const choiceExperience = new Choices('.choice-experience', {
//   searchEnabled: false,
//   itemSelectText: '',
//   position: 'bottom',

// })
// //==========Фильтр "Образование"===========
// const choiceEducation = new Choices('.choice-education', {
//   searchEnabled: false,
//   itemSelectText: '',
//   position: 'bottom',

// })
// //==========Фильтр "Гражданство"===========
// const choiceNationality = new Choices('.choice-nationality', {
//   searchEnabled: false,
//   itemSelectText: '',
//   position: 'bottom',

// })
//============Сортировка списка

$("#listSort").on("click", function (event) {
  event.preventDefault();
  $("#listSort").addClass("chosen");
  $("#mediumIconsSort").removeClass("chosen");
  if ($(".tender__post")) {
    $(".tender__post").toggleClass("tender__post-list tender__post");
  }
});

$("#mediumIconsSort").on("click", function (event) {
  event.preventDefault();
  $("#mediumIconsSort").addClass("chosen");
  $("#listSort").removeClass("chosen");
  if ($(".tender__post-list")) {
    $(".tender__post-list").toggleClass("tender__post tender__post-list ");
  }
});


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
