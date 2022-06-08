  // БУРГЕР МЕНЮ
$(document).ready(function() {
    $('.icon').click(function() {
        $('.navbar').toggleClass('open-menu');
        $('.logo').toggleClass('hidden');
    });
});
  // БУРГЕР МЕНЮ


  // СЛАЙДЕР СТРАН
$(document).ready(function() {
  $('.country-page-slider').slick({
    arrows: true,
    dots: true,
    fade: true,
    speed: 400, 
    autoplay: true,
    autoplaySpeed: 1000
  }) 
});
  // СЛАЙДЕР СТРАН


  // СЛАЙДЕР ТУРОВ
$(document).ready(function() {
  $('.tours-page-slider').slick({
    arrows: true,
    dots: true,
    fade: true,
    speed: 400, 
    autoplay: true,
    autoplaySpeed: 1000
  }) 
});
  // СЛАЙДЕР ТУРОВ


// var departure_date = document.querySelector('#departure_date').value;

// if(departure_date != undefined) {
  $('#departure_date').css({
    'border': '1px solid rgb(68, 163, 187)',
    'box-shadow': '1px 1px 2px 0 rgb(68, 163, 187)'
  });
// }


      // ПОИСК ТУРА

$(document).on('click', '#tour_search', function(){
  var city_id = document.querySelector('#city_name').value;
  var country_id = document.querySelector('#country_name').value;
  var departure_date = document.querySelector('#departure_date').value;
  var nights = document.querySelector('#nights').value;

  $.ajax({
    url: '../../vendor/tourSearch.php',
    method: 'POST',
    dataType: 'json',
    data: {
      city_id: city_id,
      country_id: country_id,
      departure_date: departure_date,
      nights : nights 
    },
    success: function(data){
      $('.tours-container').empty();
      if(data) {
        $('.tours-container').append(`<div class='tours-container-title'><h2>Можем порекомендовать следующие туры</h2></div>`)
        $('.tours-container').append(`<div class='tours-block'></div>`)
        for(let i = 0; i < data.length; i++) {
          $('.tours-block').append(`<div class='tours-block-inner'></div>`)
          $('.tours-block-inner:last').append(`<div class='tours-img'><img src="assets/img/hotels/${data[i].img}"></div>`)
          $('.tours-block-inner:last').append(`<div class='tours-title'><h3>${data[i].name}</h3></div>`)
          $('.tours-block-inner:last').append(`<div class='tours-title'><p>${data[i].Country}</p></div>`)
          $('.tours-block-inner:last').append(`<div class='tours-short-desc'><p>${data[i].price}</p></div>`)
          $('.tours-block-inner:last').append(`<div class='tours-short-desc'><p>${data[i].nights}</p></div>`)
          $('.tours-block-inner:last').append(`<div class='tours-short-desc'><p>${data[i].departure_date}</p></div>`)
          $('.tours-block-inner:last').append(`<div class='tours-desc'><p>${data[i].description}</p></div>`)
          $('.tours-block-inner:last').append(`<div class='result'><a href="/toursPage.php?id=${data[i].id}">Подробнее</a></div>`)
        }
      }
      else {
        $('.tours-block').append(`<div class='result'><h2>К сожалению по вашему запросу ничего не найдено</h2></div>`)
      }
   },
 });
});

      // ПОИСК ТУРА


      // ДОБАВИТЬ В ИЗБРАННОЕs

// $(document).on('click', '#btn-like', function(){
//   var user_id = 'user';
//   var tours_id = 'tour';
//   $.ajax({
//       url: "../../vendor/toursOrder.php",
//       method: 'POST',
//       dataType: 'JSON',
//       data: {
//         user_id: user_id,
//         tours_id: tours_id
//       },
//       success: function(data){
//           alert(data);
//       }
//   });
// });

$(document).on('click', '#btn-like', function(){
  var user_id = 'user';
  var tours_id = 'tour';

  $.ajax({
    url: '../../vendor/toursOrder.php',
    method: 'POST',
    dataType: 'json',
    data: {
        user_id: user_id,
        tours_id: tours_id
    },
    success: function(data){
      if(data) {
        $('.cabinet-tours-contaier').append(`<div class='favourite-tours'></div>`)
        for(let i = 0; i < data.length; i++) {
          $('.favourite-tours').append(`<div class='favourite-tours-block-inner'></div>`)
          $('.favourite-tours-block-inner:last').append(`<div class='tours-img'><img src="assets/img/hotels/${data[i].img}"></div>`)
          $('.favourite-tours-block-inner:last').append(`<div class='tours-title'><h3>${data[i].name}</h3></div>`)
          $('.favourite-tours-block-inner:last').append(`<div class='tours-title'><p>${data[i].Country}</p></div>`)
          $('.favourite-tours-block-inner:last').append(`<div class='tours-short-desc'><p>${data[i].price}</p></div>`)
          $('.favourite-tours-block-inner:last').append(`<div class='tours-short-desc'><p>${data[i].nights}</p></div>`)
          $('.favourite-tours-block-inner:last').append(`<div class='tours-short-desc'><p>${data[i].departure_date}</p></div>`)
          $('.favourite-tours-block-inner:last').append(`<div class='tours-desc'><p>${data[i].description}</p></div>`)
          $('.favourite-tours-block-inner:last').append(`<div class='result'><a href="/toursPage.php?id=${data[i].id}">Подробнее</a></div>`)
        }
      }
      else {
        $('.tours-block').append(`<div class='result'><h2>К сожалению по вашему запросу ничего не найдено</h2></div>`)
      }
   },
 });
});
      // ДОБАВИТЬ В ИЗБРАННОЕ


      // УДАЛИТЬ ИЗ ИЗБРАННОГО

$(document).on('click', '#btn-dislike', function(){
  $('.favourite-tours-block-inner').remove();
  $.ajax({
      url: "../../vendor/toursOrderDelete.php",
      method: 'POST',
      dataType: 'JSON',
      data: {},
      success: function(data){
          alert(data);
      }
  });
});

       // УДАЛИТЬ ИЗ ИЗБРАННОГО

       
       // ГАЛЕРЕЯ

