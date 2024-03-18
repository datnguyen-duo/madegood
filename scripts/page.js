/*	-----------------------------------------------------------------------------
  HOMEPAGE
--------------------------------------------------------------------------------- */

function loadIndexScripts(scrollContainer) {
  var video = document.querySelector(".home__video-showreel");
  var playIcon = document.querySelector(".play-icon");

  playIcon.onclick = function () {
    playVid();
  };

  video.onclick = function () {
    this.muted ? playVid() : pauseVid();
  };

  function playVid() {
    video.muted = false;
    gsap.to("#banner .container", { opacity: 0, pointerEvents: "none" });
  }

  function pauseVid() {
    video.muted = true;
    gsap.to("#banner .container", { opacity: 1, pointerEvents: "initial" });
  }

  jQuery(function ($) {
    setTimeout(() => {
      var container = $("#intro .container h1:first-of-type");
      var str = $("#intro .container h1:first-of-type").text();
      var str1 = str.split(" ")[0];
      var str2 = str.split(" ")[1];

      var img = $(".intro__images .img-wrapper:nth-child(2)");

      container.text(str1);
      container.append(img);
      container.append(str2);

      //PARALLAX

      gsap.to("#intro .container img", {
        yPercent: "random(-70, -40)",
        ease: "none",
        scrollTrigger: {
          trigger: "#intro",
          scrub: true,
          start: "top bottom",
        },
      });

      // COLLAGE LOAD
      var imgsOne = document.querySelectorAll(
        ".intro__images .img-wrapper:nth-child(2), .intro__images .img-wrapper:nth-child(3), #intro h1 .img-wrapper"
      );
      var imgsTwo = document.querySelectorAll(
        ".intro__images .img-wrapper:nth-child(1), .intro__images .img-wrapper:nth-child(4), .intro__images .img-wrapper:nth-child(5)"
      );

      var tl = gsap.timeline({
        scrollTrigger: {
          trigger: "#intro",

          start: "top 60%",
        },
        onComplete: function () {
          // document.body.addEventListener("mousemove", function (e) {
          //   var axOne = (window.innerWidth / 2 - e.pageX) / 30;
          //   var ayOne = -(window.innerHeight / 2 - e.pageY) / 30;
          //   var axTwo = -(window.innerWidth / 2 - e.pageX) / 25;
          //   var ayTwo = (window.innerHeight / 2 - e.pageY) / 25;
          //   imgsOne.forEach((img) => {
          //     img.setAttribute(
          //       "style",
          //       "transform: rotateY(" +
          //         axOne +
          //         "deg) rotateX(" +
          //         ayOne +
          //         "deg);-webkit-transform: rotateY(" +
          //         axOne +
          //         "deg) rotateX(" +
          //         ayOne +
          //         "deg);-moz-transform: rotateY(" +
          //         axOne +
          //         "deg) rotateX(" +
          //         ayOne +
          //         "deg)"
          //     );
          //   });
          //   imgsTwo.forEach((img) => {
          //     img.setAttribute(
          //       "style",
          //       "transform: rotateY(" +
          //         axTwo +
          //         "deg) rotateX(" +
          //         ayTwo +
          //         "deg);-webkit-transform: rotateY(" +
          //         axTwo +
          //         "deg) rotateX(" +
          //         ayTwo +
          //         "deg);-moz-transform: rotateY(" +
          //         axTwo +
          //         "deg) rotateX(" +
          //         ayTwo +
          //         "deg)"
          //     );
          //   });
          // });
        },
      });

      tl.from("#intro .container h1 .img-wrapper", { width: 0 });
      tl.from(
        ".intro__images .img-wrapper",
        1,
        {
          top: "25%",
          left: "40%",
          stagger: 0.05,
          ease: "Expo.inOut",
        },
        "-=.3"
      );
    }, 500);
  });

  jQuery(function ($) {
    setTimeout(() => {
      var marquee = $("#contact .marquee");
      var w = marquee.width();
      var x = Math.round($(window).width() / w) + 1;

      for (var i = 0; i < x; i++) {
        $("#contact .marquee span:first-of-type").clone().appendTo(marquee);
      }

      gsap.to(marquee, {
        duration: 1,
        ease: "none",
        x: "-=" + w,
        modifiers: {
          x: gsap.utils.unitize((x) => parseFloat(x) % 500),
        },
        repeat: -1,
      });
    }, 500);
  });

  // WHO WE ARE SECTION LOAD
  var mainImg = document.getElementById("project__1");
  var asideImg = document.getElementById("project__2");
  var sectionLoad = gsap.timeline({
    scrollTrigger: {
      trigger: mainImg,
      start: "top 70%",
    },
  });

  sectionLoad.from(mainImg, 1, {
    clipPath: "inset(0 0 100% 0)",
    ease: "expo.inOut",
  });
  sectionLoad.from(asideImg, { opacity: 0 }, "-=.5");

  // SLIDERS

  jQuery(function ($) {
    var slider = document.querySelector(".slider__projects");
    var sliderAside = document.querySelector(".slider__projects #project__2");
    var slides = document.querySelectorAll(
      "#who-we-are .slider__projects .project-wrapper"
    );
    var ctaAside = document.querySelector(
      "#who-we-are .projects-wrapper .cta-aside"
    );

    var btn = document.querySelector(
      "#who-we-are .grid-container .wrapper .icon"
    );

    var style = window.getComputedStyle(sliderAside);
    var matrix = new WebKitCSSMatrix(style.transform);
    var transformX = matrix.m41;
    var transformY = matrix.m42;

    function initSlider() {
      var tl = gsap.timeline({
        onComplete: function () {
          // ScrollTrigger.getAll().forEach((st) => st.refresh());

          // for (let i = 0; i < 3; i++) {
          //   ScrollTrigger.getById("morphTrigger__sections-" + i).refresh();
          // }
          document.body.classList.add("init__slider");
          ScrollTrigger.refresh();
        },
      });

      if (window.innerWidth > 768) {
        tl.to(ctaAside, { opacity: 0 });
        tl.add(function () {
          scroller.scrollTo(slider, true);
        });
      }
      tl.to(sliderAside, {
        x: 0,
        y: 0,
        perspective: 0,
        rotationY: 0,
        rotationX: 0,
        minWidth: (x) => {
          if (window.innerWidth < 768) {
            return (x = "85vw");
          } else {
            return (x = "60vw");
          }
        },
        ease: Power1.easeInOut,
      });
      tl.set(slides, { display: "block" });
      if (window.innerWidth < 767) {
        // ScrollTrigger.refresh();
      } else {
        tl.to(slider, {
          x: () =>
            -(slider.scrollWidth - document.documentElement.clientWidth) + "px",
          ease: "none",
          scrollTrigger: {
            id: "projectST",
            trigger: slider,
            invalidateOnRefresh: true,
            pin: true,
            scrub: true,
            end: () => "+=" + slider.offsetWidth,
          },
        });
      }
    }

    function revertSlider() {
      var tl = gsap.timeline({
        onStart: function () {
          document.body.classList.remove("init__slider");
        },
        onComplete: function () {
          ScrollTrigger.getById("projectST").disable();
          ScrollTrigger.refresh();
        },
      });

      tl.set(".project-wrapper:not(#project__1):not(#project__2)", {
        display: "none",
      });
      tl.to(sliderAside, {
        x: transformX,
        y: transformY,
        perspective: 1500,
        rotationY: 0,
        rotationX: 0,
        minWidth: "20vw",
        ease: Power1.easeInOut,
      });
      tl.to(ctaAside, { opacity: 1 });
      tl.set(slider, { clearProps: "all" });
      // ScrollTrigger.getById("projectST").pin(false);
    }

    btn.addEventListener("click", function () {
      if (document.body.classList.contains("init__slider")) {
        revertSlider();
      } else {
        initSlider();
      }
    });
  });

  //ROTATING ICON

  gsap.to("#services header .img-wrapper", {
    rotation: 580,
    scrollTrigger: {
      trigger: "#services",
      start: "top bottom",
      scrub: true,
    },
  });

  /*	-----------------------------------------------------------------------------
          START MORPH SVG
        --------------------------------------------------------------------------------- */
  var morphContainer = document.querySelector("#services .container");

  MorphSVGPlugin.convertToPath(
    "circle, rect, ellipse, line, polygon, polyline"
  );

  gsap.to("body", {
    scrollTrigger: {
      trigger: morphContainer,
      toggleClass: { targets: "body", className: "init__cursor-shapes" },
      start: "top 60%",
      end: "bottom 40%",
      id: "morphTrigger__container",

      onLeave: function () {
        gsap.to("#cursor", {
          morphSVG: { shape: "#cursor" },
        });
      },
      onEnterBack: function () {
        gsap.to("#cursor", {
          morphSVG: { shape: "#msvgCircle" },
        });
        document.body.classList.add("has-circle");
      },
      onLeaveBack: function () {
        gsap.to("#cursor", {
          morphSVG: { shape: "#cursor" },
        });
      },
    },
  });

  var tlMorphSVG = gsap
    .timeline({ paused: true })
    .to("#cursor", {
      morphSVG: { shape: "#msvgRectangle" },
    })
    .add(function () {
      document.body.classList.add("has-rect");
      document.body.classList.remove("has-halfcircle");
    })
    .addPause()
    .to("#cursor", {
      morphSVG: { shape: "#msvgHalfCircle" },
    })
    .add(function () {
      document.body.classList.add("has-halfcircle");
      document.body.classList.remove("has-circle");
    })
    .addPause()
    .to("#cursor", {
      morphSVG: { shape: "#msvgCircle" },
    })
    .add(function () {
      document.body.classList.add("has-circle");
    });

  gsap.utils.toArray(".service-wrapper").forEach((section, i) => {
    ScrollTrigger.create({
      trigger: section,
      start: "top 60%",
      end: "bottom 40%",
      id: "morphTrigger__sections-" + i,

      onEnter: () => {
        tlMorphSVG.play();
      },
      onLeaveBack: () => {
        tlMorphSVG.reverse();
      },
    });
  });

  // parallax mobile

  if (window.innerWidth < 768) {
    var imageShapes = document.querySelectorAll(".service-wrapper .shape");
    var winHeight = window.innerHeight;

    imageShapes.forEach((shape) => {
      gsap.to(shape, {
        y: -40,
        scrollTrigger: {
          trigger: shape,
          scrub: true,
          start: "top bottom",
          end: "+=" + winHeight * 1.2,
        },
      });
    });
  }

  //CONTACT IMAGES PIN

  // var contactPinTrigger = document.getElementById("contact");

  // var y;

  // if (window.innerWidth > 768) {
  //   y = -100;
  // } else {
  //   y = -170;
  // }

  // var tlContactPin = gsap.timeline({
  //   scrollTrigger: {
  //     id: "contactImgPin",
  //     trigger: contactPinTrigger,
  //     pin: true,
  //     pinSpacing: true,
  //     scrub: true,
  //     invalidateOnRefresh: true,
  //
  //     end: "+=300%",
  //   },
  // });
  // tlContactPin.to("#contact .img-wrapper img:nth-child(3)", {
  //   yPercent: y,
  //   rotation: -25,
  // });
  // tlContactPin.to("#contact .img-wrapper img:nth-child(2)", {
  //   yPercent: y,
  //   rotation: 25,
  // });

  // gsap.from(".st__curve-pin", 1, {
  //   opacity: 0,
  //   y: -40,
  //   scale: 1.4,
  //   ease: "power4.out",
  //   scrollTrigger: {
  //     trigger: ".st__curve-pin",
  //     start: "top 70%",
  //
  //   },
  // });

  // ScrollTrigger.refresh();
}

/*	-----------------------------------------------------------------------------
  ABOUT PAGE
--------------------------------------------------------------------------------- */
function loadAboutScripts(scrollContainer) {
  var parallaxImg = document.querySelector("#about_intro .fixed");

  gsap.fromTo(
    parallaxImg,
    {
      y: "-18vw",
    },

    {
      y: "0vw",
      scrollTrigger: {
        trigger: parallaxImg.closest("section"),
        start: "top top",
        end: "50% top",
        scrub: true,
      },
    }
  );

  var hovers = document.querySelectorAll("#about_intro .content span");
  var images = document.querySelectorAll("#about_intro .img-wrapper img");

  hovers.forEach((hover, index) => {
    hover.addEventListener("mouseenter", function () {
      images.forEach((imagesClass) => {
        imagesClass.classList.remove("active");
      });
      images[index].classList.add("active");
    });
  });

  var valRows = document.querySelectorAll("#values .row");

  valRows.forEach((row, i) => {
    var anim = row.querySelectorAll(".col");

    var stg;

    if (window.innerWidth > 768) {
      if (i % 2 == 0) {
        stg = -0.1;
      } else {
        stg = 0.1;
      }
    } else {
      stg = 0;
    }

    gsap.fromTo(
      anim,
      {
        opacity: 0,
      },
      {
        opacity: 1,
        stagger: stg,
        scrollTrigger: {
          trigger: row,
          start: "top 70%",
        },
      }
    );
  });

  ScrollTrigger.refresh();
}

/*	-----------------------------------------------------------------------------
  SERVICES PAGE
--------------------------------------------------------------------------------- */
function loadServicesScripts(scrollContainer) {
  var video = document.querySelector(".banner-video");
  var playIcon = document.querySelector(".play");

  playIcon.onclick = function () {
    video.muted ? playVid() : pauseVid();
  };

  video.onclick = function () {
    this.muted ? playVid() : pauseVid();
  };

  function playVid() {
    video.muted = false;
    gsap.to(".play, .headline", {
      opacity: 0,
    });
  }

  function pauseVid() {
    video.muted = true;
    gsap.to(".play, .headline", {
      opacity: 1,
    });
  }

  //MOTION PATH
  let headlineText = new SplitText(".text", { type: "chars,words,lines" });

  var revHeadlineText = headlineText.chars.reverse();
  var tl = gsap.timeline();
  var dur = headlineText.chars.length * 0.65;
  var total = headlineText.chars.length * 0.065;

  tl.set(headlineText.chars, {
    scaleX: -1,
    scaleY: -1,
    xPercent: -50,
    yPercent: -50,
    transformOrigin: "50% 50%",
  });

  tl.to(headlineText.chars, {
    motionPath: {
      path: "#curvePath",
      align: "#curvePath",
      autoRotate: true,
      start: (i) => i / headlineText.chars.length,
      end: (i) => i / headlineText.chars.length + 1,
    },
    duration: dur,
    repeat: -1,
    ease: "none",
  });

  window.addEventListener("resize", function () {
    gsap.to(headlineText.chars, {
      motionPath: {
        path: "#curvePath",
        align: "#curvePath",
        autoRotate: true,
        start: (i) => i / headlineText.chars.length,
        end: (i) => i / headlineText.chars.length + 1,
      },
      duration: dur,
      repeat: -1,
      ease: "none",
    });
  });

  //PARALLAX
  var pImages = document.querySelectorAll(".p__img");
  var winHeight = window.innerHeight;

  pImages.forEach((img) => {
    var trigger = img.parentNode;
    gsap.to(img, {
      yPercent: "-70",
      ease: "none",
      scrollTrigger: {
        trigger: trigger,
        scrub: true,
        start: "top bottom",
        end: "+=" + winHeight * 1.2,
      },
    });
  });

  // FEATURED WORK STAGGER

  var oneX, oneY, twoX, twoY, threeX, threeY, fourX, fourY, fiveX, fiveY;

  if (window.innerWidth > 768) {
    oneX = 0;
    oneY = -120;

    twoX = 90;
    twoY = 0;

    threeX = 0;
    threeY = 0;

    fourX = 0;
    fourY = 25;

    fiveX = -60;
    fiveY = -50;
  } else {
    oneX = -100;
    oneY = -200;

    twoX = -10;
    twoY = -75;

    threeX = 0;
    threeY = 0;

    fourX = 0;
    fourY = 75;

    fiveX = 0;
    fiveY = -100;
  }

  var featWorkTl = gsap.timeline({
    scrollTrigger: {
      trigger: "#featured_work h1",
      start: "top 70%",
    },
  });

  featWorkTl.to("#featured_work .img-wrapper:nth-child(1)", {
    top: 0,
    right: "10%",
    xPercent: oneX,
    yPercent: oneY,
  });
  featWorkTl.to(
    "#featured_work .img-wrapper:nth-child(2)",
    {
      top: 0,
      right: 0,
      xPercent: twoX,
      yPercent: twoY,
    },
    "<0.1"
  );
  featWorkTl.to(
    "#featured_work .img-wrapper:nth-child(3)",
    {
      bottom: 0,
      right: 0,
      xPercent: threeX,
      yPercent: threeY,
    },
    "<0.1"
  );
  featWorkTl.to(
    "#featured_work .img-wrapper:nth-child(4)",
    {
      bottom: 0,
      left: 0,
      xPercent: fourX,
      yPercent: fourY,
    },
    "<0.1"
  );
  featWorkTl.to(
    "#featured_work .img-wrapper:nth-child(5)",
    {
      top: 0,
      left: 0,
      xPercent: fiveX,
      yPercent: fiveY,
    },
    "<0.1"
  );

  // ScrollTrigger.refresh();
}

/*	-----------------------------------------------------------------------------
  PORTFOLIO PAGE
--------------------------------------------------------------------------------- */
function loadPortfolioScripts(scrollContainer) {
  var w = document.querySelector("#portfolio_banner h1").clientWidth;
  var imgWidth = document.querySelector(
    "#portfolio_banner h1 img:first-of-type"
  ).clientWidth;

  var dis = w + imgWidth * 2 - window.innerWidth;

  if (window.innerWidth > 768) {
    gsap.to("#portfolio_banner h1", {
      ease: "none",
      x: -dis,
      scrollTrigger: {
        trigger: "#portfolio_banner",
        invalidateOnRefresh: true,
        scrub: true,
        pin: true,
        pinSpacing: true,
        end: () => "+=" + window.innerHeight,
      },
    });
  }

  // filters
  gsap.to(".filters", {
    scrollTrigger: {
      trigger: "#portfolio_main",
      toggleClass: { targets: "body", className: "init__filters" },
      start: "top top",
      end: "bottom 60%",
    },
  });

  var filterItems = document.querySelectorAll(".filter__item"),
    projectCards = document.querySelectorAll(".project");

  filterItems.forEach((item) => {
    item.addEventListener("click", function () {
      var target = this.getAttribute("data-attribute-filter");

      filterItems.forEach((itemClass) => {
        itemClass.classList.remove("active");
      });
      this.classList.add("active");

      projectCards.forEach((project) => {
        if (target) {
          project.classList.add("hidden");
          if (project.classList.contains(target)) {
            project.classList.remove("hidden");
          }
        } else {
          project.classList.remove("hidden");
        }
      });

      // ScrollTrigger.refresh();
    });
  });

  var projects = document.querySelectorAll(".video");

  projects.forEach((project) => {
    var video = project.querySelector("video");
    project.addEventListener("click", function (e) {
      e.currentTarget.classList.add("selected");
    });
    if (video) {
      project.addEventListener("mouseenter", function () {
        video.play();
      });
      project.addEventListener("mouseleave", function () {
        video.pause();
      });
    }
  });

  // ScrollTrigger.refresh();
}

function loadBtgScripts(scrollContainer) {
  var e = document.documentElement.clientHeight * 1.3;
  var images = document.querySelectorAll("#fp_main .images > img");
  var total = images.length;
  var totalDistance = e * total;
  var count = document.querySelector(".count");
  var dir;
  // document.getElementById("fp_main").style.height =
  //   document.documentElement.clientHeight + "px";

  var tlModalPin = gsap.timeline({
    scrollTrigger: {
      trigger: "#fp_main",
      pin: true,
      pinSpacing: true,
      scrub: true,
      start: "top top",
      end: () => "+=" + totalDistance,
      onUpdate: function (self) {
        dir = self.direction;
      },
    },
  });

  images.forEach((img, index) => {
    var i = index + 1;
    if (i < total) {
      tlModalPin.to(img, {
        y: -e / 1.2,
        rotation: "random(-45, 45)",
      });
      tlModalPin.add(function () {
        if (dir > 0) {
          count.classList.remove("init-" + (i - dir));
          count.classList.add("init-" + i);
        } else {
          count.classList.remove("init-" + i);
          count.classList.add("init-" + (i + dir));
        }
      }, "<40%");
    }
  });

  setTimeout(() => {
    var marqueesAlt = jQuery(".marquee__alt-modal > div");

    marqueesAlt.each(function (index, marquee) {
      var w = marquee.clientWidth;
      var x = Math.round((window.innerWidth + totalDistance) / w) + 3;

      var distance;

      document.querySelector(".marquee__alt-modal > .rev").style.marginLeft =
        -(w * 2) + "px";

      if (index < 1) {
        distance = w;
      } else {
        distance = w * -1;
      }

      for (var i = 0; i < x; i++) {
        jQuery(marquee).find(" > *:first-of-type").clone().appendTo(marquee);
      }
      gsap.to(marquee, {
        duration: 4,
        ease: "none",
        x: -distance,
        modifiers: {
          x: gsap.utils.unitize((x) => parseFloat(x) % w),
        },
        repeat: -1,
      });
    });
  }, 500);

  // ScrollTrigger.refresh();
}

/*	-----------------------------------------------------------------------------
  CASE STUDY PAGE
--------------------------------------------------------------------------------- */
function loadProjectScripts(scrollContainer) {
  //MARQUEES

  var marquees = document.querySelectorAll(".vmarquee");
  marquees.forEach((marquee) => {
    if (window.innerWidth > 768) {
      var h = marquee.querySelector("h1:first-of-type").clientWidth;
      gsap.to(marquee, {
        duration: 10,
        ease: "none",
        y: h,
        modifiers: {
          y: gsap.utils.unitize((y) => parseFloat(y) % h),
        },
        repeat: -1,
      });
    } else {
      if (marquee.classList.contains("vm__banner")) {
        var h = marquee.querySelector("h1:first-of-type").clientWidth;
        gsap.to(marquee, {
          duration: 10,
          ease: "none",
          y: h,
          modifiers: {
            y: gsap.utils.unitize((y) => parseFloat(y) % h),
          },
          repeat: -1,
        });
      } else {
        var w = marquee.querySelector("h1:first-of-type").clientWidth;
        gsap.to(marquee, {
          duration: 5,
          ease: "none",
          x: -w,
          modifiers: {
            x: gsap.utils.unitize((y) => parseFloat(y) % w),
          },
          repeat: -1,
        });
      }
    }
  });

  var altMarquee = document.querySelectorAll(".vmarquee__alt > div");

  altMarquee.forEach((vmarquee, index) => {
    var slides = vmarquee.querySelectorAll(".inner:first-of-type img").length;
    var dur = slides * 7;

    if (window.innerWidth > 768) {
      var h = vmarquee.querySelector(".inner:first-of-type").clientHeight;

      var slides = vmarquee.querySelectorAll(".inner:first-of-type img").length;

      if (index < 1) {
        distance = h;
      } else {
        distance = h * -1;
      }

      gsap.to(vmarquee, {
        duration: dur,
        ease: "none",
        y: -distance,
        modifiers: {
          x: gsap.utils.unitize((x) => parseFloat(x) % h),
        },
        repeat: -1,
      });
    } else {
      // var w = document.querySelector(".vmarquee__alt").scrollWidth;
      // gsap.to(".vmarquee__alt", {
      //   duration: dur,
      //   ease: "none",
      //   x: -w,
      //   modifiers: {
      //     x: gsap.utils.unitize((x) => parseFloat(x) % w),
      //   },
      //   repeat: -1,
      // });
    }
  });

  // BANNER VIDEO

  var video = document.querySelector(".banner-video");
  var playIcon = document.querySelector(".play-icon");

  playIcon.onclick = function () {
    video.muted ? playVid() : pauseVid();
  };

  video.onclick = function () {
    this.muted ? playVid() : pauseVid();
  };

  function playVid() {
    video.muted = false;
    gsap.to(".play-icon, .scroll, #project_banner .headline__rotate", {
      opacity: 0,
    });
  }

  function pauseVid() {
    video.muted = true;
    gsap.to(".play-icon, .scroll, #project_banner .headline__rotate", {
      opacity: 1,
    });
  }

  // social slider
  var slider = jQuery(".slider");
  slider.slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    rows: 0,
  });

  // HORIZONTAL

  var slider = document.querySelector(".horizontal");
  var e = slider.scrollWidth;

  if (window.innerWidth > 768) {
    gsap.to(slider, {
      x: () => -e + document.documentElement.clientWidth + "px",
      ease: "none",
      scrollTrigger: {
        trigger: slider,
        invalidateOnRefresh: true,
        pin: true,
        pinSpacing: true,
        scrub: 0.2,
        end: () => "+=" + e,
      },
    });
  } else {
    gsap.utils.toArray(".horizontal aside img").forEach((img) => {
      gsap.to(img, {
        y: -100,
        scrollTrigger: {
          trigger: img,
          scrub: true,
        },
      });
    });
  }
  // ScrollTrigger.refresh();
}

/*	-----------------------------------------------------------------------------
  CONTACT PAGE
--------------------------------------------------------------------------------- */
function loadContactScripts(scrollContainer) {
  //MOTION PATH
  let headlineText = new SplitText(".text", {
    type: "chars,words,lines",
    charsClass: "char",
  });
  var revHeadlineText = headlineText.chars.reverse();

  var tl = gsap.timeline();

  tl.set(headlineText.chars, {
    scaleX: -1,
    scaleY: -1,
    xPercent: -50,
    yPercent: -50,
    transformOrigin: "50% 50%",
  });

  tl.to(headlineText.chars, {
    motionPath: {
      path: "#curvePath",
      align: "#curvePath",
      autoRotate: true,
      start: (i) => i / headlineText.chars.length,
      end: (i) => i / headlineText.chars.length + 1,
    },
    duration: 10,
    repeat: -1,
    ease: "none",
  });

  window.addEventListener("resize", function () {
    gsap.to(headlineText.chars, {
      motionPath: {
        path: "#curvePath",
        align: "#curvePath",
        autoRotate: true,
        start: (i) => i / headlineText.chars.length,
        end: (i) => i / headlineText.chars.length + 1,
      },
      duration: 10,
      repeat: -1,
      ease: "none",
    });
  });

  // source:https://stackoverflow.com/questions/454202/creating-a-textarea-with-auto-resize

  const tx = document.getElementsByTagName("textarea");
  for (let i = 0; i < tx.length; i++) {
    tx[i].setAttribute(
      "style",
      "height:" + tx[i].scrollHeight + "px;overflow-y:hidden;"
    );
    tx[i].addEventListener("input", OnInput, false);
  }

  function OnInput() {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
    ScrollTrigger.refresh();
  }

  mySplitText = new SplitText(".hover__headline-contact span", {
    type: "chars",
  });

  gsap.utils.toArray(".hover__headline-contact").forEach((headline, i) => {
    headlineMajor = headline.querySelectorAll(".major div");
    headlineMinor = headline.querySelectorAll(".minor div");

    if (i % 2 === 0) {
      var xperc = 10;
    } else {
      var xperc = -10;
    }

    var tl = gsap.timeline({
      paused: true,
    });
    tl.to(
      headline,
      0.35,
      {
        xPercent: xperc,
      },
      0
    );
    tl.to(
      headlineMajor,
      0.35,

      {
        y: "-40%",
        rotationX: -90,
        opacity: 0,
        stagger: 0.025,
      },
      0
    );
    tl.to(
      headlineMinor,
      0.35,
      {
        y: "0",
        rotationX: 0,
        opacity: 1,
        stagger: 0.025,
      },
      0
    );

    headline.addEventListener("mouseenter", function () {
      tl.play();
    });
    headline.addEventListener("mouseleave", function () {
      tl.reverse();
    });
  });

  // ScrollTrigger.refresh();
}
/*	-----------------------------------------------------------------------------
    SHOP PAGE
  --------------------------------------------------------------------------------- */
function loadShopScripts(scrollContainer) {
  var slider = jQuery(".product-gallery--images");
  slider.slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
  });

  var addToCartButton = document.querySelector(".add-to-cart"),
    cartClose = document.querySelector(".cart__close");

  addToCartButton.addEventListener("click", function () {
    document.body.classList.add("init__cart");
  });

  cartClose.addEventListener("click", function () {
    document.body.classList.remove("init__cart");
  });
}
