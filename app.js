let controller;
let slideScene;
let pageScene;

function animateSlide() {
    // Init Controller
    controller = new ScrollMagic.Controller();
    //Select something 
    const mainImg = document.querySelector('.main-img');
    const mainText = document.querySelector('.main-text');
    const aboutPage = document.querySelector('.about-page');
    const skillPage = document.querySelector('.skill-page');
    const nav = document.querySelector('.nav');
    const sidBar = document.querySelector('.side-bar');
    const homePage = document.querySelector('.home-page');
    const _aboutPage = document.querySelector('.about-page');
    const _skillPage = document.querySelector('.skill-page');
    const _projectPage = document.querySelector('.project-page');


    const PageTl = gsap.timeline({
        defaluts: {
            duration: 1,
            ease: "power2.inOut"
        }
    });

    // page transition for all the page is 
    // First: Home Page
    const pageTl2 = gsap.timeline();
    pageTl2.fromTo(homePage, { opacity: 1, scale: 1 }, { opacity: 0, scale: 0 });
    // Create new scene
    pageScene = new ScrollMagic.Scene({
            triggerElement: homePage,
            duration: '100%',
            triggerHook: 0
        })
        .setTween(pageTl2)
        .setPin(homePage, { pushFollowers: false })
        .addTo(controller);

    // Second: about page
    const pageTl3 = gsap.timeline();
    pageTl3.fromTo(_aboutPage, { opacity: 1, scale: 1 }, { opacity: 0, scale: 0 });
    // Create new scene
    pageScene = new ScrollMagic.Scene({
            triggerElement: _aboutPage,
            duration: '100%',
            triggerHook: 0
        })
        .setTween(pageTl3)
        .setPin(_aboutPage, { pushFollowers: false })
        .addTo(controller);



    const aboutTl = gsap.timeline({
        defaluts: {
            duration: 1,
            ease: "power2.inOut"
        }
    });
    // This is for skill section
    const skillTl = gsap.timeline({
        defaluts: {
            duration: 1,
            ease: "power2.inOut"
        }
    });
    // home page animation
    PageTl.fromTo(mainText, { y: "100%", opacity: 0 }, { y: "0%", opacity: 1 });
    PageTl.fromTo(mainImg, { y: "100%", opacity: 0 }, { y: "0%", opacity: 1 }, '+=.1');
    // sidebar animation
    PageTl.fromTo(sidBar, { x: "-100%", opacity: 0 }, { x: "0%", opacity: 1 }, '-=.25');

    // nav animation
    PageTl.fromTo(nav, { y: "-100%", opacity: 0 }, { y: "0%", opacity: 1 }, '-=.25');



    // about page time line
    aboutTl.fromTo(aboutPage, { y: "50%" }, { y: "0%", opacity: 1 });
    // skill page time line
    skillTl.fromTo(skillPage, { x: "-50%" }, { x: "0%", opacity: 1 });

    // Create scene to create the slider animation effects
    slideScene = new ScrollMagic.Scene({
            triggerElement: aboutPage,
            triggerHook: .63,
            reverse: false
        }).setTween(aboutTl)
        .addTo(controller);
    // Create scene to create the slider animation effects
    slideScene = new ScrollMagic.Scene({
            triggerElement: skillPage,
            triggerHook: .43,
            reverse: false
        }).setTween(skillTl)
        .addTo(controller);

    // Simple animatin on scrolling for projects
    const columns = document.getElementsByClassName('project-col');

    const columnTitle = document.getElementsByClassName('project-title');


    Array.from(columns).forEach(column => {
        // time line animation
        const columnTl = gsap.timeline({
            defaults: { duration: .5, ease: "power2.inOut" }
        });
        columnTl.fromTo(column, { opacity: 0 }, { opacity: 1 });

        //Create Scene
        slideScene = new ScrollMagic.Scene({
                triggerElement: column,
                triggerHook: .60,
                reverse: false,

            }).setTween(columnTl)
            .addTo(controller);
    });

    const leftColumn = document.querySelector('.left-contact');
    const rightColumn = document.querySelector('.right-contact');
    const contactTitle = document.querySelector('.contact-title')
    const leftColTl = gsap.timeline({
        defaults: { duration: .5, ease: "power2.inOut" }
    });
    leftColTl.fromTo(contactTitle, { opacity: 0 }, { opacity: 1 });
    leftColTl.fromTo(leftColumn, { x: "-50%" }, { x: "0%", opacity: 1 });
    leftColTl.fromTo(rightColumn, { y: "50%" }, { y: "0%", opacity: 1 });

    // create Scene
    slideScene = new ScrollMagic.Scene({
            triggerElement: leftColumn,
            triggerHook: .45,
            reverse: false
        }).setTween(leftColTl)
        .addTo(controller);

}

animateSlide();


// form inputs and clearing them
const contactName = document.querySelector('input[name=name]');
const contactEmail = document.querySelector('input[name=email]');
const contactMessage = document.querySelector('textarea');
const contactBtn = document.querySelector('.btn-sub');

contactBtn.addEventListener('click', () => {
    setTimeout(() => {
        contactName.value = "";
        contactEmail.value = "";
        contactMessage.value = "";
    }, 1000);
});

var scroll = new SmoothScroll('a[href*="#"]', {
    speed: 300
});



// links for toggle the color of the links (blue)
const links = document.querySelectorAll('.links');
links.forEach((link) => {
        link.addEventListener('click', (e) => {
            clearAll(links);
            const tar = e.target;
            let hasClassLink = tar.classList.contains('colorLink');
            if (hasClassLink) {
                tar.classList.remove('colorLink');
            } else {
                tar.classList.add('colorLink');
            }
            setTimeout(() => {
                tar.classList.remove('colorLink');

            }, 15000);
        })


    })
    // Clear if it has a class name colorLink to toggle the color
function clearAll(link) {
    link.forEach(li => {
        li.classList.remove('colorLink');
    })
}



// function cursorAnimation(e) {
//     let mouse = document.querySelector('.cursor');
//     mouse.style.top = e.pageY + "px";
//     mouse.style.left = e.pageX + "px";
// }
// window.addEventListener('mousemove', cursorAnimation);


const burger = document.querySelector('.burger');
const navigation = document.querySelector('.nav');

function navToggle(e) {

    if (window.innerWidth <= 650) {
        // If it doesn't contain an active class(so add)
        if (!e.target.classList.contains('active')) {
            e.target.classList.add('active'); // use this as a toggle
            gsap.to('.line1', .5, { rotate: "45", y: 5, });
            gsap.to('.line2', .5, { rotate: "-45", y: -5, });
            gsap.to('.line3', .5, { opacity: 0 });

            // expand nav
            gsap.to(navigation, 1, { clipPath: "circle(2500px at 100% -10%)" })
            navigation.addEventListener('click', linkClick)

            document.body.classList.add('hide'); // To remove the ugly mesuse scrolling
            navigation.addEventListener('click', linkClick)

        } else {
            e.target.classList.remove('active'); // use this as a toggle
            gsap.to('.line1', .5, { rotate: "0", y: 0, });
            gsap.to('.line2', .5, { rotate: "0", y: 0, });
            gsap.to('.line3', .5, { opacity: 1 });
            window.addEventListener('resize', () => {
                if (window.innerWidth > 650) {
                    navigation.style.clipPath = "circle(2500px at 100% -10%)";
                } else {
                    navigation.style.clipPath = "circle(50px at 100% -10%)";
                    if (e.target.classList.contains('active')) {
                        gsap.to('.nav', 1, { clipPath: "circle(50px at 100% -10%)" })
                    }
                }
            })

            // expand nav
            gsap.to('.nav', 1, { clipPath: "circle(50px at 100% -10%)" })
            document.body.classList.remove('hide');
        }
    }

}
if (window.innerWidth > 650) {
    navigation.style.clipPath = "circle(2500px at 100% -10%)";
}





function linkClick(e) {
    const term = e.target;
    if (window.innerWidth < 650) {
        if (term.classList.contains('links')) {
            e.target.classList.remove('active'); // use this as a toggle
            gsap.to('.line1', .5, { rotate: "0", y: 0, });
            gsap.to('.line2', .5, { rotate: "0", y: 0, });
            gsap.to('.line3', .5, { opacity: 1 });

            // expand nav
            gsap.to('.nav', 1, { clipPath: "circle(50px at 100% -10%)" })
            document.body.classList.remove('hide');
        }
    }


}


burger.addEventListener('click', navToggle);