//Cart
function addCart(proid,color,size,quantity){
  $.ajax({
      type:"GET",
      url:"cart/add",
      data: {proid: proid,
            color: color,
            size: size,
            quantity: quantity},
      success: function(response){
        alert('Thêm sản phẩm thành công vào giỏ hàng');
        $('.cart-count').html('&nbsp;' + response['count']+ '&nbsp;');
      },
      error: function(response){
        alert('Vui lòng chọn đầy đủ thông tin');
      }
  })
}

function deleteCart(id){
  $.ajax({
      type:"GET",
      url:"cart/delete",
      data: {id: id},
      success: function(response){
        alert('Xóa sản phẩm thành công trong giỏ hàng');
        $('.cart-count').html('&nbsp;' + response['count']+ '&nbsp;');
        $('.cart-total').html('<h4>' + response['total'] + '</h4>');
        var cartTable = $('.table');
        var cart = cartTable.find("tr" + "[data-row='" + id + "']");
        cart.remove();
      },
      error: function(response){
        alert('Lỗi');
      }
  })
}

function editCart(id,quantity,price){
  $.ajax({
      type:"GET",
      url:"cart/edit",
      data: {id: id,quantity:quantity},
      success: function(response){
        $('.total-' + id).text(response['total']);
        $('.cart-total').html('<h4>' + response['totals'] + '</h4>');
      },
      error: function(response){
        alert('lỗi');
      }
  })
}

function updateCart(id,size,color){
  $.ajax({
      type:"GET",
      url:"cart/update",
      data: {id: id,size:size,color:color},
      success: function(response){
        if(!response['cart']){
          alert('Lựa chọn của bạn không phù hợp. Vui lòng chọn lại');
          location.reload();
        }
      },
      error: function(response){
      }
  })
}

function getSize(proid, color) {
  $.ajax({
      type: "GET",
      url: "product/" + proid + "/getsize",
      data: { proid: proid, color: color },
      success: function(response) {
        var option = '<option value="0">Chọn kích cỡ</option>';
        $.each(response.sizes, function(index, size) {
            option += '<option value="' + size + '">' + size + '</option>';
        });
        $('.get-size').html(option);

        var span = $('<span class="current">Chọn kích cỡ</span>')
        var ul = $('<ul class="list"></ul>');
        var li = '<li data-value="0" class="option selected">Chọn kích cỡ</li>';
        $.each(response.sizes, function(index, size) {
            li += '<li data-value="' + size + '" class="option">' + size + '</li>';
        });
        ul.append(li);
        $('.nice-select.get-size').html(span);
        $('.nice-select.get-size').append(ul);
      },
      error: function(response) {
          alert('Lỗi');
      }
  });
}

function addReview(proid, comment) {
  var review = $("input[name='rating']:checked").val();
  if(comment != null && review != null){
    $.ajax({
        type: "GET",
        url: "product/" + proid + "/addreview",
        data: { proid: proid, review: review, comment: comment },
        success: function(response) {
            var reviewItem = '<div class="review_item">' +
                '<div class="media">' +
                '<div class="d-flex">' +
                '<img style="width: 80px;height: 80px;border-radius: 50%;object-fit: cover;" src="images/' + response['avatar'] + '" alt="">' +
                '</div>' +
                '<div class="media-body">' +
                '<h4>' + response['name'] + '</h4>';
            for (var i = 0; i < response['reviews']['review']; i++) {
                reviewItem += '<i class="fa fa-star"></i>';
            }
            reviewItem += '<h5>'+ response['time'] +'</h5>' +
            '</div>' +
                '</div>' +
                '<p>' + response['reviews']['comment'] + '</p>' +
                '</div>';
            $('.review_list').append(reviewItem);
            $('.review_box').html('<h4>Cảm ơn bạn đã đánh giá!!!</h4>');

            var overall = '<h5>Tổng thể</h5>' +
                          '<h4>' + response['avg'] +'</h4>' +
                          '<h6>( '+ response['count'] +' Đánh giá)</h6>';

            var ratingList = '<h3>Dựa trên '+ response['count'] +' đánh giá</h3>'+
                             '<ul class="list">'+
                                '<li><a>5 sao <i class="fa fa-star"></i>'+
                                '<i class="fa fa-star"></i><i class="fa fa-star"></i>'+
                                '<i class="fa fa-star"></i><i class="fa fa-star"></i> '+ response['5start'] +'</a></li>'+

                                '<li><a>4 sao <i class="fa fa-star"></i>'+
                                '<i class="fa fa-star"></i><i class="fa fa-star"></i>'+
                                '<i class="fa fa-star"></i> '+ response['4start'] +'</a></li>'+

                                '<li><a>3 sao <i class="fa fa-star"></i>'+
                                '<i class="fa fa-star"></i><i class="fa fa-star"></i> '+ response['3start'] +'</a></li>'+

                                '<li><a>2 sao <i class="fa fa-star"></i> <i class="fa fa-star"></i> '+ response['2start'] +'</a></li>'+

                                '<li><a>1 sao <i class="fa fa-star"></i> '+ response['1start'] +'</a></li>'+
                              '</ul>';
            $('.box_total').html(overall);
            $('.rating_list').html(ratingList);
        },
        error: function(response) {
            alert('Lỗi');
        }
    });
  }
  else{
    alert('Vui lòng điền đủ thông tin');
  }
}

//CheckOut
function checkCart(id){
  $.ajax({
      type:"GET",
      url:"cart/check",
      data: {id: id},
      success: function(response){
        $('.cart-total').html('<h4>' + response['totals'] + '</h4>');
      },
      error: function(response){
        alert('lỗi');
      }
  })
}

//Love
function addLove(proid){
  $.ajax({
      type:"GET",
      url:"love/add",
      data: {proid: proid},
      success: function(response){
        alert('Thêm sản phẩm thành công vào mục yêu thích');
        $('.love-count').html('&nbsp;' + response['count']+ '&nbsp;');
      },
      error: function(response){
        alert('Lỗi');
      }
  })
}

function deleteLove(id){
  $.ajax({
      type:"GET",
      url:"love/delete",
      data: {id: id},
      success: function(response){
        alert('Xóa sản phẩm thành công trong giỏ hàng');
        $('.love-count').html('&nbsp;' + response['count']+ '&nbsp;');
        var loveTable = $('.table');
        var love = loveTable.find("tr" + "[data-row='" + id + "']");
        love.remove();
      },
      error: function(response){
        alert('Lỗi');
      }
  })
}

$(document).ready(function(){
	"use strict";

	var window_width 	 = $(window).width(),
	window_height 		 = window.innerHeight,
	header_height 		 = $(".default-header").height(),
	header_height_static = $(".site-header.static").outerHeight(),
	fitscreen 			 = window_height - header_height;


	$(".fullscreen").css("height", window_height)
    $(".fitscreen").css("height", fitscreen);

  //------- Active Nice Select --------//

    $('select').niceSelect();


    $('.navbar-nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    $('.img-pop-up').magnificPopup({
        type: 'image',
        gallery:{
        enabled:true
        }
    });

    // Search Toggle
    $("#search_input_box").hide();
    $("#search").on("click", function () {
        $("#search_input_box").slideToggle();
        $("#search_input").focus();
    });
    $("#close_search").on("click", function () {
        $('#search_input_box').slideUp(500);
    });

    /*==========================
		javaScript for sticky header
		============================*/
			$(".sticky-header").sticky();

    /*=================================
    Javascript for banner area carousel
    ==================================*/
    $(".active-banner-slider").owlCarousel({
        items:1,
        autoplay:false,
        autoplayTimeout: 5000,
        loop:true,
        nav:true,
        navText:["<img src='user/img/banner/prev.png'>","<img src='user/img/banner/next.png'>"],
        dots:false
    });

    /*=================================
    Javascript for product area carousel
    ==================================*/
    $(".active-product-area").owlCarousel({
        items:1,
        autoplay:false,
        autoplayTimeout: 5000,
        loop:true,
        nav:true,
        navText:["<img src='user/img/product/prev.png'>","<img src='user/img/product/next.png'>"],
        dots:false
    });

    /*=================================
    Javascript for single product area carousel
    ==================================*/
    $(".s_Product_carousel").owlCarousel({
      items:1,
      autoplay:false,
      autoplayTimeout: 5000,
      loop:true,
      nav:false,
      dots:true
    });
    
    /*=================================
    Javascript for exclusive area carousel
    ==================================*/
    $(".active-exclusive-product-slider").owlCarousel({
        items:1,
        autoplay:false,
        autoplayTimeout: 5000,
        loop:true,
        nav:true,
        navText:["<img src='user/img/product/prev.png'>","<img src='user/img/product/next.png'>"],
        dots:false
    });

    //--------- Accordion Icon Change ---------//

    $('.collapse').on('shown.bs.collapse', function(){
        $(this).parent().find(".lnr-arrow-right").removeClass("lnr-arrow-right").addClass("lnr-arrow-left");
    }).on('hidden.bs.collapse', function(){
        $(this).parent().find(".lnr-arrow-left").removeClass("lnr-arrow-left").addClass("lnr-arrow-right");
    });

  // Select all links with hashes
  $('.main-menubar a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function(event) {
      // On-page links
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
        && 
        location.hostname == this.hostname
      ) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top-70
          }, 1000, function() {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();
            if ($target.is(":focus")) { // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            };
          });
        }
      }
    });



      // -------   Mail Send ajax

         $(document).ready(function() {
            var form = $('#booking'); // contact form
            var submit = $('.submit-btn'); // submit button
            var alert = $('.alert-msg'); // alert div for show alert message

            // form submit event
            form.on('submit', function(e) {
                e.preventDefault(); // prevent default form submit

                $.ajax({
                    url: 'booking.php', // form action url
                    type: 'POST', // form submit method get/post
                    dataType: 'html', // request type html/json/xml
                    data: form.serialize(), // serialize form data
                    beforeSend: function() {
                        alert.fadeOut();
                        submit.html('Sending....'); // change submit button text
                    },
                    success: function(data) {
                        alert.html(data).fadeIn(); // fade in response data
                        form.trigger('reset'); // reset form
                        submit.attr("style", "display: none !important");; // reset submit button text
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            });
        });




    $(document).ready(function() {
        $('#mc_embed_signup').find('form').ajaxChimp();
    });   



     if(document.getElementById("js-countdown")){

        var countdown = new Date("October 17, 2018");

        function getRemainingTime(endtime) {
            var milliseconds = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor(milliseconds / 1000 % 60);
            var minutes = Math.floor(milliseconds / 1000 / 60 % 60);
            var hours = Math.floor(milliseconds / (1000 * 60 * 60) % 24);
            var days = Math.floor(milliseconds / (1000 * 60 * 60 * 24));

        return {
            'total': milliseconds,
            'seconds': seconds,
            'minutes': minutes,
            'hours': hours,
            'days': days
            };
        }

        function initClock(id, endtime) {
            var counter = document.getElementById(id);
            var daysItem = counter.querySelector('.js-countdown-days');
            var hoursItem = counter.querySelector('.js-countdown-hours');
            var minutesItem = counter.querySelector('.js-countdown-minutes');
            var secondsItem = counter.querySelector('.js-countdown-seconds');

        function updateClock() {
            var time = getRemainingTime(endtime);

            daysItem.innerHTML = time.days;
            hoursItem.innerHTML = ('0' + time.hours).slice(-2);
            minutesItem.innerHTML = ('0' + time.minutes).slice(-2);
            secondsItem.innerHTML = ('0' + time.seconds).slice(-2);

            if (time.total <= 0) {
              clearInterval(timeinterval);
            }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        initClock('js-countdown', countdown);

  };



      $('.quick-view-carousel-details').owlCarousel({
          loop: true,
          dots: true,
          items: 1,
      })



    //----- Active No ui slider --------//



    $(function(){

        if(document.getElementById("price-range")){
        
        var nonLinearSlider = document.getElementById('price-range');
        
        var nonLinearSlider = document.getElementById('price-range');

        // Retrieve data attributes
        var minAttributeValue = nonLinearSlider.getAttribute('data-min');
        var maxAttributeValue = nonLinearSlider.getAttribute('data-max');
        
        // Convert attribute values to numbers
        var minValue = minAttributeValue !== '' ? parseFloat(minAttributeValue) : 0;
        var maxValue = maxAttributeValue !== '' ? parseFloat(maxAttributeValue) : 100;
        
        noUiSlider.create(nonLinearSlider, {
            connect: true,
            behaviour: 'tap',
            start: [minValue, maxValue], // Set start values based on data attributes
            range: {
                'min': 0,
                'max': 100
            }
        });
        


        var nodes = [
            document.getElementById('lower-value'), // 0
            document.getElementById('upper-value'), // 1
        ];

        // Display the slider value and how far the handle moved
        // from the left edge of the slider.
        nonLinearSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
            nodes[handle].innerHTML = values[handle];
            // Set the value of the corresponding hidden input
            var hiddenInputId = handle === 0 ? 'lower_value' : 'upper_value';
            document.getElementById(hiddenInputId).value = values[handle];
        });
      }
    });

    
    //-------- Have Cupon Button Text Toggle Change -------//

    $('.have-btn').on('click', function(e){
        e.preventDefault();
        $('.have-btn span').text(function(i, text){
          return text === "Have a Coupon?" ? "Close Coupon" : "Have a Coupon?";
        })
        $('.cupon-code').fadeToggle("slow");
    });

    $('.load-more-btn').on('click', function(e){
        e.preventDefault();
        $('.load-product').fadeIn('slow');
        $(this).fadeOut();
    });
    




  //------- Start Quantity Increase & Decrease Value --------//




    var value,
        quantity = document.getElementsByClassName('quantity-container');

    function createBindings(quantityContainer) {
        var quantityAmount = quantityContainer.getElementsByClassName('quantity-amount')[0];
        var increase = quantityContainer.getElementsByClassName('increase')[0];
        var decrease = quantityContainer.getElementsByClassName('decrease')[0];
        increase.addEventListener('click', function () { increaseValue(quantityAmount); });
        decrease.addEventListener('click', function () { decreaseValue(quantityAmount); });
    }

    function init() {
        for (var i = 0; i < quantity.length; i++ ) {
            createBindings(quantity[i]);
        }
    };

    function increaseValue(quantityAmount) {
        value = parseInt(quantityAmount.value, 10);

        console.log(quantityAmount, quantityAmount.value);

        value = isNaN(value) ? 0 : value;
        value++;
        quantityAmount.value = value;
    }

    function decreaseValue(quantityAmount) {
        value = parseInt(quantityAmount.value, 10);

        value = isNaN(value) ? 0 : value;
        if (value > 0) value--;

        quantityAmount.value = value;
    }

  init();

//------- End Quantity Increase & Decrease Value --------//

  /*----------------------------------------------------*/
  /*  Google map js
    /*----------------------------------------------------*/

    if ($("#mapBox").length) {
        var $lat = $("#mapBox").data("lat");
        var $lon = $("#mapBox").data("lon");
        var $zoom = $("#mapBox").data("zoom");
        var $marker = $("#mapBox").data("marker");
        var $info = $("#mapBox").data("info");
        var $markerLat = $("#mapBox").data("mlat");
        var $markerLon = $("#mapBox").data("mlon");
        var map = new GMaps({
          el: "#mapBox",
          lat: $lat,
          lng: $lon,
          scrollwheel: false,
          scaleControl: true,
          streetViewControl: false,
          panControl: true,
          disableDoubleClickZoom: true,
          mapTypeControl: false,
          zoom: $zoom,
          styles: [
            {
              featureType: "water",
              elementType: "geometry.fill",
              stylers: [
                {
                  color: "#dcdfe6"
                }
              ]
            },
            {
              featureType: "transit",
              stylers: [
                {
                  color: "#808080"
                },
                {
                  visibility: "off"
                }
              ]
            },
            {
              featureType: "road.highway",
              elementType: "geometry.stroke",
              stylers: [
                {
                  visibility: "on"
                },
                {
                  color: "#dcdfe6"
                }
              ]
            },
            {
              featureType: "road.highway",
              elementType: "geometry.fill",
              stylers: [
                {
                  color: "#ffffff"
                }
              ]
            },
            {
              featureType: "road.local",
              elementType: "geometry.fill",
              stylers: [
                {
                  visibility: "on"
                },
                {
                  color: "#ffffff"
                },
                {
                  weight: 1.8
                }
              ]
            },
            {
              featureType: "road.local",
              elementType: "geometry.stroke",
              stylers: [
                {
                  color: "#d7d7d7"
                }
              ]
            },
            {
              featureType: "poi",
              elementType: "geometry.fill",
              stylers: [
                {
                  visibility: "on"
                },
                {
                  color: "#ebebeb"
                }
              ]
            },
            {
              featureType: "administrative",
              elementType: "geometry",
              stylers: [
                {
                  color: "#a7a7a7"
                }
              ]
            },
            {
              featureType: "road.arterial",
              elementType: "geometry.fill",
              stylers: [
                {
                  color: "#ffffff"
                }
              ]
            },
            {
              featureType: "road.arterial",
              elementType: "geometry.fill",
              stylers: [
                {
                  color: "#ffffff"
                }
              ]
            },
            {
              featureType: "landscape",
              elementType: "geometry.fill",
              stylers: [
                {
                  visibility: "on"
                },
                {
                  color: "#efefef"
                }
              ]
            },
            {
              featureType: "road",
              elementType: "labels.text.fill",
              stylers: [
                {
                  color: "#696969"
                }
              ]
            },
            {
              featureType: "administrative",
              elementType: "labels.text.fill",
              stylers: [
                {
                  visibility: "on"
                },
                {
                  color: "#737373"
                }
              ]
            },
            {
              featureType: "poi",
              elementType: "labels.icon",
              stylers: [
                {
                  visibility: "off"
                }
              ]
            },
            {
              featureType: "poi",
              elementType: "labels",
              stylers: [
                {
                  visibility: "off"
                }
              ]
            },
            {
              featureType: "road.arterial",
              elementType: "geometry.stroke",
              stylers: [
                {
                  color: "#d6d6d6"
                }
              ]
            },
            {
              featureType: "road",
              elementType: "labels.icon",
              stylers: [
                {
                  visibility: "off"
                }
              ]
            },
            {},
            {
              featureType: "poi",
              elementType: "geometry.fill",
              stylers: [
                {
                  color: "#dadada"
                }
              ]
            }
          ]
        });
      }
 });