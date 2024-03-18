(function ($) {
  $(function () {
    // Phone nav click function
    $(".menu-icon-wrap").click(function () {
      $("body").toggleClass("navShown");
      $(".nav-wrap").fadeIn();
    });

    if ($(".service").length) {
      $("body").addClass("service-page");
    }

    $(document).ready(function () {
      $(".service-cta-wrap").insertBefore("#smooth-content");
    });

    $(window)
      .scroll(function () {
        var scrollDistance = $(window).scrollTop() + 1;

        $(".scroll-section").each(function (i) {
          if ($(this).position().top <= scrollDistance) {
            $(".service-nav-wrap ul li.active").removeClass("active");
            $(".service-nav-wrap ul li").eq(i).addClass("active");
          }
        });
      })
      .scroll();

    $('.service-nav-wrap ul li a[href*="#"]:not([href="#"])').click(
      function () {
        if (
          location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
          location.hostname == this.hostname
        ) {
          var target = $(this.hash);
          target = target.length
            ? target
            : $("[name=" + this.hash.slice(0) + "]");
          if (target.length) {
            $("html, body").animate(
              {
                scrollTop: target.offset().top,
              },
              600
            );
            return false;
          }
        }
      }
    );

    // 		$('.work-component-wrap').each(function() {
    // 			var listItems = $(this).find('.work-component');

    // 			if (listItems.length % 2 !== 0) {
    // 				listItems.last().addClass('large-work-component');
    // 			}
    // 		});

    if ($(".work-single-slider-item-wrap").length) {
      $(".work-single-slider-item-wrap").slick({
        dots: false,
        arrows: true,
        autoplay: false,
        infinite: true,
        navigation: false,
        fade: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
      });
    }

    window.onload = function () {
      document.body.classList.add("loading-complete");
      var tl = gsap.timeline({
        onComplete: function () {
          document.body.classList.add("animation-complete");
          var serviceCtaWrap = document.querySelector(".service-cta-wrap");
          serviceCtaWrap.style.zIndex = "1";
        },
      });

      tl.to(".service-loader img", 1, {
        scale: 60,
        yPercent: -350,
        delay: 0.7,
        ease: "Expo.inOut",
      }).to(".service-loader", 0.25, { opacity: 0 }, "<50%");
    };

    $(".services-item").each(function () {
      var $this = $(this);
      $this.find(" > .services-item-title").on("click touch", function (e) {
        e.preventDefault();
        $(".services-item").removeClass("active");
        $(".services-item-thumb").slideUp();
        if ($this.find(".services-item-thumb:visible").length) {
          $(".services-item").removeClass("active");
          $(".services-item-thumb").slideUp();
        } else {
          $this.addClass("active");
          $(".services-item-thumb").slideUp();
          $this.find(" > .services-item-thumb").slideDown();
        }
      });
    });

    $(window).scroll(function () {
      var scroll = $(window).scrollTop();
      if (scroll < 200) {
        $(".logo-wrap").css({
          width: "241px",
          top: "60px",
        });
      } else {
        $(".logo-wrap").css({
          width: "64px",
          top: "10px",
        });
      }
    });

    // Select all subheadings

    $(document).ready(function () {
      // Function to get a random letter
      function getRandomLetter(length) {
        var result = "";
        var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
          result += characters.charAt(
            Math.floor(Math.random() * charactersLength)
          );
        }
        return result;
      }

      // Initialize SplitType
      let typeSplit = new SplitType('[text-randomize="true"]', {
        types: "words, chars",
        tagName: "span",
      });

      // Store original text for each character
      $(".char").each(function () {
        $(this).attr("data-original-text", $(this).text());
      });

      // Function to reset text to original
      function resetText(chars) {
        chars.each(function () {
          let originalText = $(this).attr("data-original-text");
          $(this).text(originalText);
        });
      }

      // Observer for visibility
      let observer = new IntersectionObserver(
        (entries, observer) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              let chars = $(entry.target).find(".char");
              let length = chars.length;
              let myInterval = setInterval(function () {
                chars.each(function (index) {
                  if (index < length) {
                    let letter = getRandomLetter(1);
                    $(this).text(letter);
                  } else {
                    let originalText = $(this).attr("data-original-text");
                    $(this).text(originalText);
                  }
                });
                length = length - 1;
              }, 100);

              setTimeout(() => {
                resetText(chars);
                clearInterval(myInterval);
              }, 1000);

              // Stop observing the element
              observer.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.1 }
      );

      // Observe elements with text-randomize="true"
      $('[text-randomize="true"]').each(function () {
        observer.observe(this);
      });
    });

    // Initialize GSAP and ScrollSmoother
    let scroller = new ScrollSmoother();
    if ($(".main-content-wrap.service").length) {
      if (scroller) {
        scroller.kill();
      }
    }
  }); // End ready function.
})(jQuery);
