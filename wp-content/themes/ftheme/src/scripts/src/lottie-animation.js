//import Lottie from '../../../../../../node_modules/lottie-web/build/player/lottie.js';

var lottieAnimation = lottie.loadAnimation({
    container: document.getElementsByClassName('animation-wrapper'),
    path: 'wp-content/themes/ftheme/src/scripts/src/data/looped-animation.json',
    renderer: 'svg',
    loop: true,
    autoplay: true,
    name: 'Home Hero Animation'
});

lottieAnimation.play();
  