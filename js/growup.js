jQuery(document).ready(function ($) {
  // Custom Growup Scripts
  revealPosts();
  /* variable Declaration */
  var last_scroll = 0;

  /* Carosul Functions */
  $(document).on("click", ".growup-carousel-thumb", function () {
    var id = $("#" + $(this).attr("id"));
    $(id).on("slid.bs.carousel", function () {
      growup_get_bs_thumb(id);
    });
  });

  $(document).on("mouseenter", ".growup-carousel-thumb", function () {
    var id = $("#" + $(this).attr("id"));
    growup_get_bs_thumb(id);
  });

  function growup_get_bs_thumb(id) {
    var prevThumb = $(id)
      .find(".carousel-item.active")
      .find(".prev-image-preview")
      .data("image");
    var nextThumb = $(id)
      .find(".carousel-item.active")
      .find(".next-image-preview")
      .data("image");
    $(id)
      .find(".carousel-control-prev.show-preview")
      .find(".thumbnail-container")
      .css({ "background-image": "url( " + prevThumb + " )" });
    $(id)
      .find(".carousel-control-next.show-preview")
      .find(".thumbnail-container")
      .css({ "background-image": "url( " + nextThumb + " )" });
  }

  /* Ajax Functions */
  $(document).on("click", ".growup-load-more:not(.loading)", function () {
    var that = $(this);
    var page = $(this).data("page");
    var newPage = page + 1;
    var ajaxurl = that.data("url");
    var prev = that.data("prev");
    var archive = that.data("archive");

    if (typeof prev === "undefined") {
      prev = 0;
    }
    if (typeof archive === "undefined") {
      archive = 0;
    }

    that.addClass("loading").find(".text").slideUp(320);
    that.find(".growup-load-icon").addClass("spin");

    $.ajax({
      url: ajaxurl,
      type: "post",
      data: {
        page: page,
        prev: prev,
        archive: archive,
        action: "growup_load_more",
      },
      error: function (response) {
        console.log(response);
      },
      success: function (response) {
        if (response == 0) {
          $(".growup-posts-container").append(
            "<div class='text-center'><h3>You reached the end of the line!</h3><p>No More Posts.</p></div>"
          );
          that.slideUp(320);
        } else {
          setTimeout(function () {
            if (prev == 1) {
              $(".growup-posts-container").prepend(response);
              newPage = page - 1;
            } else {
              $(".growup-posts-container").append(response);
            }
            if (newPage == 1) {
              that.slideUp(320);
            } else {
              that.data("page", newPage);

              that.removeClass("loading").find(".text").slideDown(320);
              that.find(".growup-load-icon").removeClass("spin");
            }

            revealPosts();
          }, 1000);
        }
      },
    });
  });
  /* Scroll Functions */
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (Math.abs(scroll - last_scroll) > $(window).height() * 0.1) {
      last_scroll = scroll;

      $(".page-limit").each(function (index) {
        if (isVisible($(this))) {
          history.replaceState(null, null, $(this).attr("data-page"));
          return false;
        }
      });
    }
  });
  /* Helper Functions */
  function revealPosts() {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    var posts = $("article:not(.reveal)");
    var i = 0;

    setInterval(function () {
      if (i >= posts.length) return false;

      var elements = posts[i];
      $(elements).addClass("reveal").find(".growup-carousel-thumb").carousel();

      i++;
    }, 200);
  }

  function isVisible(element) {
    var scroll_pos = $(window).scrollTop();
    var window_height = $(window).height();
    var el_top = $(element).offset().top;
    var el_height = $(element).height();
    var el_bottom = el_top + el_height;

    return (
      el_bottom - el_height * 0.25 > scroll_pos &&
      el_top < scroll_pos + 0.5 * window_height
    );
  }

  /* Sidebar Functions */
  $(document).on("click", ".js-toggleSidebar", function () {
    $(".growup-sidebar").toggleClass("sidebar-closed");
    $("body").toggleClass("no-scroll");
    $(".sidebar-overlay").fadeToggle(320);
  });

  /* Contact Form Submission*/
  $("#growupContactForm").on("submit", function (e) {

    $('.is-invalid').removeClass('is-invalid');
    $('.js-show-feedback').removeClass('js-show-feedback');

    e.preventDefault();
    
    var form = $(this),
        name = form.find('#name').val(),
        email = form.find('#email').val(),
        message = form.find('#message').val(),
        ajaxurl = form.data("url");

        if( name === ''  ){
          $('#name').addClass('is-invalid');
          return;
        }
        if( email === ''  ){
          $('#email').addClass('is-invalid');
          return;
        }
        if( message === ''  ){
          $('#message').addClass('is-invalid');
          return;
        }
        
       
        $('.js-form-submission').addClass('js-show-feedback');
        
        $.ajax({
          url: ajaxurl,
          type: "post",
          data: {
            name: name,
            email: email,
            message: message,
            action: "growup_save_user_contact_form",
          },
          error: function (response) {
            $('.js-form-submission').removeClass('js-show-feedback');
            $('.js-form-error ').addClass('js-show-feedback');
            form.find('input, button, textarea').removeAttr('disabled');
          },
          success: function (response) {
            if(response == 0){
              setTimeout(function(){
                $('.js-form-submission').removeClass('js-show-feedback');
                $('.js-form-error ').addClass('js-show-feedback');
                form.find('input, button, textarea').removeAttr('disabled');
              },1200);
            }else{
              setTimeout(function(){
                $('.js-form-submission').removeClass('js-show-feedback');
                $('.js-form-success ').addClass('js-show-feedback');
                form.find('input, button, textarea').removeAttr('disabled').val('');
              },1200);
            }
        
          }
        });
  });

});
