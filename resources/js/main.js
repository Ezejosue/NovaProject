$(function () {
  $('[data-tooltip="tooltip"]').tooltip({trigger: "hover"})
});

(function ($) {
    // USE STRICT
    "use strict";
    $(".animsition").animsition({
      inClass: 'fade-in',
      outClass: 'fade-out',
      inDuration: 900,
      outDuration: 900,
      linkElement: 'a:not([target="_blank"]):not([href^="#"]):not([class^="chosen-single"])',
      loading: true,
      loadingParentElement: 'html',
      loadingClass: 'page-loader',
      loadingInner: '<div class="page-loader__spin"></div>',
      timeout: false,
      timeoutCountdown: 5000,
      onLoadEvent: true,
      browser: ['animation-duration', '-webkit-animation-duration'],
      overlay: false,
      overlayClass: 'animsition-overlay-slide',
      overlayParentElement: 'html',
      transition: function (url) {
        window.location.href = url;
      }
    });

    
  
  
  
})(jQuery);
(function ($) {
  // USE STRICT
  "use strict";

  // Select 2
  try {

    $(".js-select2").each(function () {
      $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
      });
    });

  } catch (error) {
    console.log(error);
  }


})(jQuery);
(function ($) {
  // USE STRICT
  "use strict";

  // Dropdown 
  try {
    var menu = $('.js-item-menu');
    var sub_menu_is_showed = -1;

    for (var i = 0; i < menu.length; i++) {
      $(menu[i]).on('click', function (e) {
        e.preventDefault();
        $('.js-right-sidebar').removeClass("show-sidebar");        
        if (jQuery.inArray(this, menu) == sub_menu_is_showed) {
          $(this).toggleClass('show-dropdown');
          sub_menu_is_showed = -1;
        }
        else {
          for (var i = 0; i < menu.length; i++) {
            $(menu[i]).removeClass("show-dropdown");
          }
          $(this).toggleClass('show-dropdown');
          sub_menu_is_showed = jQuery.inArray(this, menu);
        }
      });
    }
    $(".js-item-menu, .js-dropdown").click(function (event) {
      event.stopPropagation();
    });

    $("body,html").on("click", function () {
      for (var i = 0; i < menu.length; i++) {
        menu[i].classList.remove("show-dropdown");
      }
      sub_menu_is_showed = -1;
    });

  } catch (error) {
    console.log(error);
  }

  var wW = $(window).width();
    // Right Sidebar
    var right_sidebar = $('.js-right-sidebar');
    var sidebar_btn = $('.js-sidebar-btn');

    sidebar_btn.on('click', function (e) {
      e.preventDefault();
      for (var i = 0; i < menu.length; i++) {
        menu[i].classList.remove("show-dropdown");
      }
      sub_menu_is_showed = -1;
      right_sidebar.toggleClass("show-sidebar");
    });

    $(".js-right-sidebar, .js-sidebar-btn").click(function (event) {
      event.stopPropagation();
    });

    $("body,html").on("click", function () {
      right_sidebar.removeClass("show-sidebar");

    });


  try {
    // Hamburger Menu
    $('.hamburger').on('click', function () {
      $(this).toggleClass('is-active');
      $('.navbar-mobile').slideToggle('500');
    });
    $('.navbar-mobile__list li.has-dropdown > a').on('click', function () {
      var dropdown = $(this).siblings('ul.navbar-mobile__dropdown');
      $(this).toggleClass('active');
      $(dropdown).slideToggle('500');
      return false;
    });
  } catch (error) {
    console.log(error);
  }
})(jQuery);

// Botón subir imagen
var triggerUpload = document.getElementById('triggerUpload'),
    upInput = document.getElementById('filePicker'),
    preview = document.querySelector('.preview');




  /* var uploaded = this.value,
      ext = ext.toLowerCase(),
      fileName = uploaded.substring(uploaded.lastIndexOf("\\") + 1),
      accepted = ["jpg", "png", "gif", "jpeg"]; */
  
  /*
    ::Add in blank img tag and spinner
    ::Use FileReader to read the img data
    ::Set the image source to the FileReader data
  */
  function showPreview() {
      preview.innerHTML = "<div class='loadingLogo'></div>";
	    preview.innerHTML += '<img id="img-preview" />';
	    var reader = new FileReader();
	    reader.onload = function () {
	        var img = document.getElementById('img-preview');
	        img.src = reader.result;
	    };
	    reader.readAsDataURL(e.target.files[0]);
      preview.removeChild(document.querySelector('.loadingLogo'));
      document.querySelector('.fileName').innerHTML = fileName + "<b> Uploaded!</b>";
  };
  
/*   //only do if supported image file
  if (new RegExp(accepted.join("|")).test(ext)) {
    showPreview();
  } else {
    preview.innerHTML = "";
    document.querySelector('.fileName').innerHTML = "Hey! Upload an image file, not a <b>." + ext + "</b> file!";
  }
   */


// Botón subir imagen 2
var triggerUpload1 = document.getElementById('triggerUpload1'),
    upInput1 = document.getElementById('filePicker1'),
    preview1 = document.querySelector('.preview1');

/* //force triggering the file upload here...
triggerUpload1.onclick = function() {
  upInput1.click();
};

 *//* 
upInput1.onchange = function(e) {

  var uploaded1 = this.value,
      ext1 = uploaded1.substring(uploaded1.lastIndexOf('.') + 1),
      ext1 = ext1.toLowerCase(),
      fileName1 = uploaded1.substring(uploaded1.lastIndexOf("\\") + 1),
      accepted1 = ["jpg", "png", "gif", "jpeg"];
   */
  /*
    ::Add in blank img tag and spinner
    ::Use FileReader to read the img data
    ::Set the image source to the FileReader data
  */
  function showPreview1() {
      preview1.innerHTML = "<div class='loadingLogo'></div>";
	    preview1.innerHTML += '<img id="img-preview1" />';
	    var reader1 = new FileReader();
	    reader1.onload = function () {
	        var img1 = document.getElementById('img-preview1');
	        img1.src = reader1.result;
	    };
	    reader1.readAsDataURL(e.target.files[0]);
      preview1.removeChild(document.querySelector('.loadingLogo'));
      document.querySelector('.fileName1').innerHTML = fileName1 + "<b> Uploaded!</b>";
  };
  
  
  /* 
  if (new RegExp(accepted1.join("|")).test(ext1)) {
    showPreview1();
  } else {
    preview1.innerHTML = "";
    document.querySelector('.fileName1').innerHTML = "Hey! Upload an image file, not a <b>." + ext1 + "</b> file!";
  } */
  /* 

//Validaciones del lado del cliente
bootstrapValidate("#create_clave1", "min:6:Ingrese una contraseña mayor a 5 caracteres")
bootstrapValidate("#create_clave2", "min:6:Ingrese una contraseña mayor a 5 caracteres" )*/

