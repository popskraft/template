/**
 *  Cross-fade Slider
 *  ========================================
*/
class CrossFadeCarousel {
  constructor(container, options) {
    this.container = container;
    this.slides = this.container.querySelectorAll('.imageSlider-item');
    this.currentSlide = 0;
    this.interval = options.interval || 3000;
    this.transitionDuration = options.transitionDuration || 1000;

    this.initStyles();
    this.initSlideshow();
  }
  
  /**
   * Static initialization method to create instances for all sliders on the page
   */
  static init() {
    document.querySelectorAll('.imageSlider').forEach(container => {
      new CrossFadeCarousel(container, {
        interval: 5000,
        transitionDuration: 1500
      });
    });
  }

  initStyles() {
    // this.container.style.position = 'relative';
    // this.container.style.overflow = 'hidden';
    // this.container.style.width = '100%';
    // this.container.style.height = '100vh';

    this.slides.forEach(slide => {
      // slide.style.position = 'absolute';
      // slide.style.top = '0';
      // slide.style.left = '0';
      // slide.style.width = '100%';
      // slide.style.height = '100%';
      slide.style.opacity = '0';
      slide.style.transition = `opacity ${this.transitionDuration}ms ease-in-out`;
    });

    if (this.slides.length > 0) {
      this.slides[0].style.opacity = '1';
    }
  }

  initSlideshow() {
    const firstImage = this.slides[0].querySelector('img');
    if (firstImage.complete) {
      this.startSlideshow();
    } else {
      firstImage.addEventListener('load', () => this.startSlideshow());
    }
  }

  startSlideshow() {
    this.intervalId = setInterval(() => this.showNextSlide(), this.interval);
  }

  showNextSlide() {
    this.slides[this.currentSlide].style.opacity = '0';
    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
    this.slides[this.currentSlide].style.opacity = '1';
  }
}

// Make available globally for browser usage
window.CrossFadeCarousel = CrossFadeCarousel;

// Init 

// document.addEventListener("DOMContentLoaded", function() {
//   document.querySelectorAll('.imageSlider').forEach(container => {
//     new CrossFadeCarousel(container, {
//       interval: 5000,
//       transitionDuration: 1500
//     });
//   });
// });