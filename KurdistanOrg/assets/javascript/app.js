const header = document.querySelector("header");
const change = false;
const menu = document.querySelector(".menu");

if (header) {
  // adding scroll to toggle with the nav bg changes
  window.addEventListener("scroll", function () {
    if (window.pageYOffset > 0) {
      header.classList.toggle("sticky", window.scrollY > 0);
      if (menu) {
        menu.classList.toggle("active-color", window.scrollY > 0);
      }
    } else {
      header.classList.toggle("sticky", window.scrollY > 0);
      if (menu) {
        menu.classList.toggle("active-color", window.scrollY > 0);
      }
    }
  });
}

// Navigation

const navUl = document.querySelector(".navigation");
// for scroll change menu b
if (menu) {
  menu.addEventListener("click", () => {
    // change menu image to close image
    navUl.classList.toggle("active");
    const closeMenu = menu.querySelector(".menu-holder");
    if (navUl.classList.contains("active")) {
      closeMenu.setAttribute("src", "assets/images/close.svg");
    } else {
      closeMenu.setAttribute("src", "assets/images/menu.svg");
    }
  });
}

// this is just work for the setting in the jory post
const selectBtn = document.getElementById("type");
if (selectBtn) {
  selectBtn.addEventListener("click", () => {
    // get the first option and disabled
    selectBtn.children[0].setAttribute("disabled", "disabled");
  });
}

// Javascript jsap animation
let controller;
let slideScene;
let pageScene;
// Init Controller
controller = new ScrollMagic.Controller();

// select something
// Simple animatin on scrolling for the sections
const columns = document.getElementsByClassName("anim-label-simple-fade-out");
const nav = document.querySelector("header");

Array.from(columns).forEach((column) => {
  // time line animation
  const columnTl = gsap.timeline({
    defaults: {
      duration: 1,
      ease: "power2.inOut",
    },
  });
  columnTl.fromTo(
    column,
    {
      opacity: 0,
    },
    {
      opacity: 1,
    },
    ""
  );

  //Create Scene
  slideScene = new ScrollMagic.Scene({
    triggerElement: column,
    triggerHook: 0.6,
    reverse: false,
  })
    .setTween(columnTl)
    .addTo(controller);
});

// page navigation animation
const PageTl = gsap.timeline({
  defaluts: {
    duration: 1,
    ease: "power2.inOut",
  },
});
// nav animation
PageTl.fromTo(
  nav,
  {
    y: "-1000%",
    opacity: 0,
  },
  {
    y: "0%",
    opacity: 1,
  },
  "+=.25"
);
// animate the navigation with the trigger
slideScene = new ScrollMagic.Scene({
  triggerElement: nav,
  triggerHook: 0,
  reverse: false,
})
  .setTween(PageTl)
  .addTo(controller);

// contact form and for login and about
const leftColumn = document.querySelector(".left-col");
const rightColumn = document.querySelector(".right-col");
const contactTitle = document.querySelector(".contact-title");
// contact time line
const leftColTl = gsap.timeline({
  defaults: {
    duration: 0.5,
    ease: "power2.inOut",
  },
});
// contact animation of timeline
leftColTl.fromTo(
  contactTitle,
  {
    opacity: 0,
  },
  {
    opacity: 1,
  }
);
leftColTl.fromTo(
  rightColumn,
  {
    y: "50%",
    opacity: 0,
  },
  {
    y: "0%",
    opacity: 1,
  }
);
leftColTl.fromTo(
  leftColumn,
  {
    x: "-50%",
    opacity: 0,
  },
  {
    x: "0%",
    opacity: 1,
  }
);

// create Scene
slideScene = new ScrollMagic.Scene({
  triggerElement: leftColumn,
  triggerHook: 0.8,
  reverse: false,
})
  .setTween(leftColTl)
  .addTo(controller);

// get the post-alert and remove when its appear after 3s

const coverPage = document.querySelector(".cover-page");

if (coverPage) {
  setTimeout(() => {
    coverPage.classList.add("active");
    document.body.style.overflow = "hidden";
  }, 1000);

  setTimeout(() => {
    coverPage.children[0].classList.add("active-post");
  }, 1500);

  setTimeout(() => {
    coverPage.children[0].classList.remove("active-post");
  }, 4000);

  setTimeout(() => {
    coverPage.classList.remove("active");
    document.body.style.overflow = "visible";
  }, 4500);
}
