/*	-----------------------------------------------------------------------------
  FIXED SCRIPTS
--------------------------------------------------------------------------------- */
let scroller;
document.addEventListener("DOMContentLoaded", function (event) {
  gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, MotionPathPlugin);

  gsap.set(".cursor", { xPercent: -50, yPercent: -50 });

  var cursor = document.querySelector(".cursor");
  var pos = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
  var mouse = { x: pos.x, y: pos.y };
  var speed = 0.1;

  var fpms = 60 / 1000;

  var xSet = gsap.quickSetter(cursor, "x", "px");
  var ySet = gsap.quickSetter(cursor, "y", "px");

  document.body.addEventListener("mousemove", (e) => {
    mouse.x = e.x;
    mouse.y = e.y;
  });

  gsap.ticker.add((time, deltaTime) => {
    var delta = deltaTime * fpms;
    var dt = 1.0 - Math.pow(1.0 - speed, delta);

    pos.x += (mouse.x - pos.x) * dt;
    pos.y += (mouse.y - pos.y) * dt;
    xSet(pos.x);
    ySet(pos.y);
  });
});

/*	-----------------------------------------------------------------------------
  NAVIGATION
--------------------------------------------------------------------------------- */
function resetMenu() {
  document.body.classList.remove("init__menu");
  gsap.set(".nav-icons > .line, .nav-container", {
    clearProps: "all",
  });
}
document.addEventListener("DOMContentLoaded", function (event) {
  var container = document.querySelector(".nav-container");
  var navItems = document.querySelectorAll(".nav-container ul h1");
  var lineOne = document.querySelector(".nav-icon__toggle .line:nth-child(1)");
  var lineTwo = document.querySelector(".nav-icon__toggle .line:nth-child(2)");
  var lineThree = document.querySelector(
    ".nav-icon__toggle .line:nth-child(3)"
  );

  function openMenu() {
    var tl = gsap.timeline();
    tl.to(lineTwo, 0.25, { margin: "-3px 0" });
    tl.to(lineTwo, 0.25, { opacity: 0 }, "-=.25");
    tl.to(lineOne, 0.25, { rotate: 45 });
    tl.to(lineThree, 0.25, { rotate: -45 }, "-=.25");
    tl.to(
      container,
      {
        height: "100%",
        ease: "expo.inOut",
      },
      "-=.50"
    );
    tl.from(navItems, { opacity: 0, y: 30, stagger: 0.06 });
    tl.from(".nav__preview", { opacity: 0 }, "-=.50");
    tl.from(".nav__contact-details", { opacity: 0 }, "<");
  }
  function closeMenu() {
    var tl = gsap.timeline();

    tl.to(navItems, { opacity: 0 });
    tl.to(".nav__preview", { opacity: 0 }, "<");
    tl.to(".nav__contact-details", { opacity: 0 }, "<");

    tl.to(container, {
      height: "0",
      ease: "expo.inOut",
    });
    tl.to(lineOne, 0.25, { rotate: 0 }, "-=.25");
    tl.to(lineThree, 0.25, { rotate: 0 }, "-=.25");
    tl.to(lineTwo, 0.25, { opacity: 1 });

    tl.to(lineTwo, 0.25, { margin: "10px 0" }, "-=.25");

    tl.set(navItems, { clearProps: "all" });
    tl.set(".nav__preview", { clearProps: "all" });
    tl.set(".nav__contact-details", { clearProps: "all" });
  }

  document
    .querySelector(".nav-icon__toggle")
    .addEventListener("click", function () {
      if (document.body.classList.contains("init__menu")) {
        closeMenu();
      } else {
        openMenu();
      }
      document.body.classList.toggle("init__menu");
      document.body.classList.remove(
        "init__cursor-shapes",
        "has-rect",
        "has-halfcircle",
        "has-circle"
      );
    });

  /*	-----------------------------------------------------------------------------
    NAVIGATION HOVERS
  --------------------------------------------------------------------------------- */

  mySplitText = new SplitText(".hover__headline span", { type: "chars" });

  gsap.utils.toArray(".hover__headline").forEach((headline, i) => {
    headlineMajor = headline.querySelectorAll(".major div");
    headlineMinor = headline.querySelectorAll(".minor div");
    var tl = gsap.timeline({
      paused: true,
    });
    tl.to(
      headline,
      0.35,
      {
        xPercent: 10,
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
      document.querySelectorAll(".circle").forEach((circle) => {
        circle.classList.remove("active");
      });
      document.querySelectorAll(".circle")[i].classList.add("active");
      document
        .querySelectorAll(".nav__preview .img-wrapper  > .preview-image")
        [i].classList.add("active");

      tl.play();
    });
    headline.addEventListener("mouseleave", function () {
      document.querySelectorAll(".circle").forEach((circle) => {
        circle.classList.remove("active");
      });
      document
        .querySelectorAll(".nav__preview .img-wrapper  > .preview-image")
        [i].classList.remove("active");

      tl.reverse();
    });
  });
});

/*	-----------------------------------------------------------------------------
  PAGE TRANSITIONS
--------------------------------------------------------------------------------- */

document.addEventListener("DOMContentLoaded", function (event) {
  var screen = document.querySelector(".page-transition");
  var screenBars = document.querySelectorAll(".page-transition div");
  function pageTransitionLeave() {
    var tl = gsap.timeline();

    tl.to(screenBars, 0.3, {
      height: "100%",
      stagger: 0.05,
    });
    tl.set(screen, { alignItems: "flex-end" });
  }

  function pageTransitionEnter() {
    var tl = gsap.timeline({
      onStart: function () {
        document.getElementById("smooth-content").classList.remove("loading");
        resetMenu();
      },
    });

    tl.to(screenBars, 0.3, {
      height: "0",
      stagger: 0.05,
    });
    tl.set(screen, { clearProps: "all" });
  }

  function btgLeave() {
    var tl = gsap.timeline();

    tl.set(screenBars, { background: "#fec32e" });
    tl.to(screenBars, 0.3, {
      height: "100%",
      stagger: 0.05,
    });
    tl.set(screen, { alignItems: "flex-end" });
  }

  function projectIndexLeave() {
    var activeProject = document.querySelector(".selected img"),
      w = document.documentElement.clientWidth,
      h = document.documentElement.clientHeight,
      x;

    if (window.innerWidth > 768) {
      x = "-6vw";
    } else {
      x = -16;
    }

    var tl = gsap.timeline({
      onStart: function () {
        if (window.innerWidth > 768) {
          scroller.scrollTo(activeProject.closest(".project"), {
            duration: 400,
          });
        }
      },
      onComplete: function () {},
    });
    tl.set(".filters, video", { opacity: 0 });
    tl.to(
      activeProject,
      {
        zIndex: 9,
        opacity: 1,
        minWidth: w,
        minHeight: h,
        x: x,
        y: 0,
        rotation: 0,
        ease: "Power4.out",
      },
      "<"
    );
  }

  /*	-----------------------------------------------------------------------------
  PAGE LOADERS
--------------------------------------------------------------------------------- */

  function hpLoader(scrollContainer) {
    // var bannerHeadlineSplit = new SplitText(".banner__headline__split-text", {
    //   type: "chars, lines",
    // });
    // var tl = gsap.timeline({
    //   onStart: function () {
    //     document.getElementById("smooth-content").classList.remove("loading");
    loadGlobalScripts(scrollContainer);
    //   },
    //   onComplete: function () {
    //     locoScroll.start();
    //   },
    // });
    // tl.from(bannerHeadlineSplit.chars, {
    //   opacity: 0,
    //   duration: 0.7,
    //   stagger: 0.02,
    //   ease: "power1.out",
    // });
    // tl.from(
    //   bannerHeadlineSplit.lines,
    //   {
    //     y: 40,
    //     duration: 0.7,
    //     rotationZ: 5,
    //     stagger: 0.1,
    //     ease: "power1.out",
    //   },
    //   "<"
    // );
  }

  function hpLoaderOnce(scrollContainer) {
    var bannerHeadlineSplit = new SplitText(".banner__headline__split-text", {
      type: "chars, lines",
    });
    var tl = gsap.timeline({
      onStart: function () {
        scroller.paused(true);

        document.getElementById("smooth-content").classList.remove("loading");
        // loadGlobalScripts(scrollContainer);
      },
      onComplete: function () {
        document.documentElement.classList.add("loaded");
        scroller.paused(false);
      },
    });

    tl.to(".loader img", 1, {
      scale: 60,
      yPercent: -350,
      delay: 0.7,
      ease: "Expo.inOut",
    });
    tl.to(".loader", 0.25, { opacity: 0 }, "<50%");
    tl.from(".play-icon", { opacity: 0 }, "<");
  }

  function aboutLoader(scrollContainer) {
    var bannerHeadlineSplit = new SplitText("#about_intro h1", {
      type: "chars, lines",
      charsClass: "char",
    });
    var tl = gsap.timeline({
      onStart: function () {
        document.getElementById("smooth-content").classList.remove("loading");
      },
    });

    tl.from(bannerHeadlineSplit.chars, {
      duration: 0.7,
      stagger: 0.02,
      ease: "power1.out",
    });
    tl.to(
      bannerHeadlineSplit.chars,
      {
        opacity: 1,
        duration: 0.7,
        stagger: 0.02,
        ease: "power1.out",
      },
      "<"
    );
    tl.from(
      bannerHeadlineSplit.lines,
      {
        y: 40,
        duration: 0.7,
        rotationZ: 5,
        stagger: 0.1,
        ease: "power1.out",
      },
      "<"
    );
    tl.from(
      "#about_intro .text-wrap span",
      {
        width: 0,
        height: 0,
        padding: "0 .5em",
      },
      "-=.3"
    );
    tl.from("#about_intro .text-wrap span", { opacity: 0 });
    tl.from(scrollContainer, { opacity: 1 });
  }

  function servicesLoader(scrollContainer) {
    var video = document.querySelector(".banner-video");
    var tl = gsap.timeline({
      onStart: function () {
        document.getElementById("smooth-content").classList.remove("loading");
      },
    });

    tl.from("#services_banner .headline", 1.2, {
      opacity: 0,
      yPercent: -80,
      scale: 2,
      ease: "power4.out",
    });
    tl.from("#services_banner .play", { opacity: 0 }, "<50%");
    tl.add(function () {
      video.play();
    }, "<");
  }

  function portfolioLoader(scrollContainer) {
    var tl = gsap.timeline({
      onStart: function () {
        document.getElementById("smooth-content").classList.remove("loading");
      },
    });

    tl.to("#portfolio_banner h1", { opacity: 1 });
  }

  function btgLoader(scrollContainer) {
    var tl = gsap.timeline({
      onStart: function () {
        document.getElementById("smooth-content").classList.remove("loading");
      },
    });

    tl.to(".page-transition", { opacity: 0 });
    tl.from(".images img", { opacity: 0, stagger: -0.1 });
    tl.from(".marquee__alt-modal", { opacity: 0 });
    tl.set(".page-transition, .page-transition > div", { clearProps: "all" });
  }

  function projectLoader(scrollContainer) {
    var video = document.querySelector(".banner-video");
    var tl = gsap.timeline({
      onStart: function () {
        document.getElementById("smooth-content").classList.remove("loading");
        gsap.set(".filters", { clearProps: "all" });
      },
    });

    tl.to(".play-icon", { opacity: 1 });
    tl.to(".scroll", { opacity: 1 });
    tl.to(
      "#project_banner .headline__rotate",
      { opacity: 1, delay: 0.4 },
      "<25%"
    );
    tl.add(function () {
      video.play();
    }, "<");
  }

  function contactLoader(scrollContainer) {
    var tl = gsap.timeline({
      onStart: function () {
        document.getElementById("smooth-content").classList.remove("loading");
      },
    });

    if (window.innerWidth > 768) {
      tl.from(".headline", 1.2, {
        opacity: 0,
        yPercent: -80,
        scale: 2,
        ease: "power4.out",
      });
    }
    tl.from(".contact-main > .row", { opacity: 0 }, "<50%");
    tl.from(".contact-main > .row .inner", { opacity: 0 }, "<50%");
    tl.from(".contact-main > .row + *", { opacity: 0 }, "<50%");
  }

  function shopLoader(scrollContainer) {
    document.getElementById("smooth-content").classList.remove("loading");
  }

  /*	-----------------------------------------------------------------------------
  BARBA
--------------------------------------------------------------------------------- */

  function delay(n) {
    n = n || 2000;
    return new Promise((done) => {
      setTimeout(() => {
        done();
      }, n);
    });
  }

  barba.hooks.afterLeave((data) => {
    var currentNamespace = data.current.namespace;
    var nextNamespace = data.next.namespace;

    var nextHtml = data.next.html;
    var response = nextHtml.replace(
      /(<\/?)body( .+?)?>/gi,
      "$1notbody$2>",
      nextHtml
    );
    var bodyClasses = jQuery(response).filter("notbody").attr("class");
    var bodyClassesNoLoading = bodyClasses.replace("loading", "");

    if (currentNamespace == "Portfolio" && nextNamespace == "case_studies") {
      jQuery("body").attr("class", bodyClassesNoLoading);
    } else if (
      currentNamespace == "case_studies" &&
      nextNamespace == "case_studies"
    ) {
      jQuery("body").attr("class", bodyClassesNoLoading);
    } else {
      jQuery("body").attr("class", bodyClasses);
    }
  });

  barba.hooks.beforeEnter((data) => {
    if (data.current.container) {
      data.current.container.remove();
      ScrollTrigger.refresh();
    }
    var scrollContainer = data.next.container;

    imagesLoaded(scrollContainer.querySelectorAll("section")[0], function () {
      if (history.scrollRestoration) {
        history.scrollRestoration = "manual";
      }
      ScrollTrigger.clearScrollMemory();
      window.scrollTo(0, 0);
      scroller = ScrollSmoother.create({
        smooth: 0.8,
        normalizeScroll: true,
        ignoreMobileResize: true,
      });
      ScrollTrigger.normalizeScroll({ allowNestedScroll: true });
      ScrollTrigger.config({ ignoreMobileResize: true });

      loadGlobalScripts();

      setTimeout(() => {
        scroller.scrollTo(0, false);
      }, 50);
    });
  });

  barba.hooks.afterEnter((data) => {
    var namespace = data.next.namespace;

    if (namespace !== "Portfolio") {
      var vids = document.querySelectorAll("video");
      vids.forEach((vid) => {
        var playPromise = vid.play();
        if (playPromise !== undefined) {
          playPromise.then((_) => {}).catch((error) => {});
        }
      });
    }
  });

  barba.init({
    timeout: 5000,
    transitions: [
      {
        name: "general-transition",
        async leave(data) {
          const done = this.async();
          pageTransitionLeave();
          await delay(1000);
          done();
        },

        async enter(data) {
          var scrollContainer = data.next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            pageTransitionEnter();
          });
        },

        async once(data) {
          var scrollContainer = data.next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            if (data.next.namespace == "Home") {
              hpLoaderOnce(scrollContainer);
            } else {
              document.documentElement.classList.add("loaded");
            }
          });
        },
      },
      {
        name: "btg",
        from: {
          namespace: ["Portfolio"],
        },
        to: {
          namespace: ["BTG"],
        },
        async leave(data) {
          const done = this.async();

          btgLeave();

          await delay(1000);

          done();
        },
      },
      {
        name: "portfolio-transition",
        from: {
          namespace: ["Portfolio"],
        },
        to: {
          namespace: ["case_studies"],
        },
        async leave(data) {
          const done = this.async();
          if (window.innerWidth > 768) {
            projectIndexLeave();
            await delay(1500);
          } else {
            pageTransitionLeave();
            await delay(1000);
          }

          done();
        },
        async enter(data) {
          if (window.innerWidth < 768) {
            var scrollContainer = data.next.container;
            firstSection = scrollContainer.querySelectorAll("section")[0];
            imagesLoaded(firstSection, function () {
              pageTransitionEnter();
            });
          }
        },
      },
    ],

    views: [
      {
        namespace: "Home",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            if (document.documentElement.classList.contains("loaded")) {
              hpLoader(scrollContainer);
            }
            loadIndexScripts(scrollContainer);
          });
        },
      },
      {
        namespace: "About",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadAboutScripts(scrollContainer);
            aboutLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "services",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadServicesScripts(scrollContainer);
            servicesLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "Portfolio",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadPortfolioScripts(scrollContainer);
            portfolioLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "BTG",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadBtgScripts(scrollContainer);
            btgLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "case_studies",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadProjectScripts(scrollContainer);
            projectLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "Contact",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadContactScripts(scrollContainer);
            contactLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "Find Us",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadContactScripts(scrollContainer);
            contactLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "Follow Us",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadContactScripts(scrollContainer);
            contactLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "product",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadShopScripts(scrollContainer);
            shopLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "Products Listing",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadShopScripts(scrollContainer);
            shopLoader(scrollContainer);
          });
        },
      },
      {
        namespace: "cart",
        afterEnter({ next }) {
          var scrollContainer = next.container;
          firstSection = scrollContainer.querySelectorAll("section")[0];
          imagesLoaded(firstSection, function () {
            loadShopScripts(scrollContainer);
            shopLoader(scrollContainer);
          });
        },
      },
    ],
  });
});

/*	-----------------------------------------------------------------------------
  GLOBAL SCRIPTS
--------------------------------------------------------------------------------- */

function loadGlobalScripts(scrollContainer) {
  var hovers = document.querySelectorAll(
    "a:not(.service-wrapper), .link, .wpcf7-submit"
  );

  hovers.forEach((hover) => {
    hover.addEventListener("mouseenter", function () {
      document.body.classList.add("init__cursor-hover");
    });
    hover.addEventListener("mouseleave", function () {
      document.body.classList.remove("init__cursor-hover");
    });
  });

  /*	-----------------------------------------------------------------------------
     TEXT EFFECTS
   --------------------------------------------------------------------------------- */
  const headlineTriggers = gsap.utils.toArray(".headline__split-text");
  if (headlineTriggers) {
    headlineTriggers.forEach((split) => {
      let headlineSplit = new SplitText(split, {
        type: "chars, lines, words",
      });
      var tl = gsap.timeline({
        scrollTrigger: {
          trigger: split,
          start: "top 80%",
        },
        onStart: function () {
          split.parentNode.classList.add("disabled-pointer");
          split.classList.add("disabled-pointer");
        },
        onComplete: function () {
          split.parentNode.classList.remove("disabled-pointer");
          split.classList.remove("disabled-pointer");
        },
      });
      tl.from(headlineSplit.chars, {
        opacity: 0,
        duration: 0.7,
        stagger: 0.02,
        ease: "power1.out",
      });
      tl.from(
        headlineSplit.lines,
        {
          y: 40,
          duration: 0.7,
          rotationZ: 5,
          stagger: 0.1,
          ease: "power1.out",
        },
        "-=1"
      );
    });
  }

  const curveTriggers = gsap.utils.toArray(".st__curve");
  if (curveTriggers) {
    curveTriggers.forEach((curve) => {
      var tl = gsap.timeline({
        scrollTrigger: {
          trigger: curve,
          start: "top 80%",
        },
      });

      tl.fromTo(
        curve,
        1,
        {
          opacity: 0,
          y: -40,
          scale: 1.4,
        },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          ease: "power4.out",
        }
      );
    });
  }

  const fadeTriggers = gsap.utils.toArray(".st__fade");
  if (fadeTriggers) {
    fadeTriggers.forEach((fade) => {
      var tl = gsap.timeline({
        scrollTrigger: {
          trigger: fade,
          start: "top 80%",
        },
      });
      tl.fromTo(
        fade,
        {
          opacity: 0,
        },
        {
          opacity: 1,
        }
      );
    });
  }

  const imgTriggers = gsap.utils.toArray(".st__image");

  if (imgTriggers) {
    imgTriggers.forEach((img) => {
      gsap.from(img, 1, {
        clipPath: "inset(0 0 100% 0)",
        ease: "expo.inOut",
        opacity: 0,
        scrollTrigger: {
          trigger: img,
          start: "top 80%",
        },
      });
    });
  }

  // MARQUEES

  setTimeout(() => {
    var marqueesAlt = jQuery(".marquee__alt > div");

    marqueesAlt.each(function (index, marquee) {
      var w = marquee.clientWidth;
      var x = Math.round(window.innerWidth / w) + 3;
      var e = document.documentElement.clientHeight * 1.5;

      var distance;

      if (index < 1) {
        distance = w;
      } else {
        distance = w * -1;
      }

      for (var i = 0; i < x; i++) {
        jQuery(marquee).find(" > *:first-of-type").clone().appendTo(marquee);
      }
      gsap.to(marquee, {
        ease: "none",
        x: -distance,
        scrollTrigger: {
          trigger: "#services_main",
          invalidateOnRefresh: true,
          scrub: true,
          end: () => "+=" + e,
        },
      });
    });
  }, 500);

  if (document.querySelector("video")) {
    const videos = gsap.utils.toArray("video");

    videos.forEach((video) => {
      ScrollTrigger.create({
        trigger: video,
        onLeave: (self) => (self.trigger.muted = true),
      });
    });
  }

  cartToggle = document.querySelector(".nav-icon__cart-toggle");

  cartToggle.addEventListener("click", function () {
    document.body.classList.toggle("init__cart");
  });
}
