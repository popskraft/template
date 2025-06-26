// Refactored AOS Library with modern JavaScript practices

class DeviceDetector {
  static _testUserAgent(patterns) {
  /**
   * Checks if any of the given patterns match the current user agent string.
   * @param {RegExp[]} patterns - array of patterns to test against the user agent string
   * @returns {boolean} true if any of the patterns match, false otherwise
   */
    const userAgent = navigator.userAgent || navigator.vendor || window.opera || '';
    return patterns.some(pattern => pattern.test(userAgent));
  }

  static phone() {
    const mobilePatterns = [
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i,
      /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i
    ];
    return this._testUserAgent(mobilePatterns);
  }

  static mobile() {
    const mobileTabletPatterns = [
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i
    ];
    return this._testUserAgent(mobileTabletPatterns);
  }

  static tablet() {
    return this.mobile() && !this.phone();
  }
}

class AnimateOnScroll {
  constructor(options = {}) {
    this.defaultOptions = {
      offset: 120,
      delay: 0,
      easing: 'ease',
      duration: 400,
      disable: false,
      once: false,
      startEvent: 'DOMContentLoaded',
      throttleDelay: 99,
      debounceDelay: 50,
      disableMutationObserver: false
    };

    this.options = { ...this.defaultOptions, ...options };
    this.elements = [];
    this.initialized = false;
  }

  // Throttle function to limit event frequency
  _throttle(func, limit) {
    let inThrottle;
    return function (...args) {
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    };
  }

  // Debounce function to delay event processing
  _debounce(func, delay, immediate = false) {
    let timeout;
    return function (...args) {
      const context = this;
      const later = () => {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      const callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, delay);
      if (callNow) func.apply(context, args);
    };
  }

  // Check if AOS should be disabled
  _isDisabled() {
    const { disable } = this.options;
    return disable === true ||
      (disable === 'mobile' && DeviceDetector.mobile()) ||
      (disable === 'phone' && DeviceDetector.phone()) ||
      (disable === 'tablet' && DeviceDetector.tablet()) ||
      (typeof disable === 'function' && disable());
  }

  // Find elements with data-aos attribute
  _findAOSElements() {
    const elements = document.querySelectorAll('[data-aos]');
    return Array.from(elements).map(node => ({ node }));
  }

  // Calculate element position
  _calculatePosition(element, offset = 0) {
    let node = element;
    let top = 0;
    let left = 0;

    while (node && !isNaN(node.offsetLeft) && !isNaN(node.offsetTop)) {
      top += node.offsetTop - (node.tagName !== 'BODY' ? node.scrollTop : 0);
      left += node.offsetLeft - (node.tagName !== 'BODY' ? node.scrollLeft : 0);
      node = node.offsetParent;
    }

    return { top, left };
  }

  // Process and animate elements
  _processElements() {
    const { innerHeight, pageYOffset } = window;

    this.elements.forEach(element => {
      const position = this._calculatePosition(element.node, this.options.offset);
      element.position = position.top;
      element.node.classList.add('aos-init');
    });

    this._animateElements();
  }

  // Animate elements based on scroll position
  _animateElements() {
    const { innerHeight, pageYOffset } = window;

    this.elements.forEach(element => {
      const shouldAnimate = element.position < (innerHeight + pageYOffset);
      const onceAttribute = element.node.getAttribute('data-aos-once');

      if (shouldAnimate) {
        element.node.classList.add('aos-animate');
      } else if (onceAttribute !== 'true') {
        element.node.classList.remove('aos-animate');
      }
    });
  }

  // Initialize AOS
  init() {
    if (this._isDisabled()) {
      this._removeAttributes();
      return;
    }

    this.elements = this._findAOSElements();
    this._setupEventListeners();
    this._processInitialState();
  }

  // Remove AOS-related attributes
  _removeAttributes() {
    this.elements.forEach(element => {
      element.node.removeAttribute('data-aos');
      element.node.removeAttribute('data-aos-easing');
      element.node.removeAttribute('data-aos-duration');
      element.node.removeAttribute('data-aos-delay');
    });
  }

  // Setup event listeners
  _setupEventListeners() {
    const { startEvent, debounceDelay, throttleDelay } = this.options;

    // Initial load handling
    if (['complete', 'interactive'].includes(document.readyState) && startEvent === 'DOMContentLoaded') {
      this._processElements();
    }

    // Event listeners
    const processElements = this._debounce(this._processElements.bind(this), debounceDelay, true);
    const animateElements = this._throttle(this._animateElements.bind(this), throttleDelay);

    if (startEvent === 'load') {
      window.addEventListener('load', processElements);
    } else {
      document.addEventListener(startEvent, processElements);
    }

    window.addEventListener('resize', processElements);
    window.addEventListener('orientationchange', processElements);
    window.addEventListener('scroll', animateElements);
  }

  // Process initial state of elements
  _processInitialState() {
    const { easing, duration, delay } = this.options;

    document.body.setAttribute('data-aos-easing', easing);
    document.body.setAttribute('data-aos-duration', duration);
    document.body.setAttribute('data-aos-delay', delay);

    this._processElements();
  }

  // Refresh AOS
  refresh(hardRefresh = false) {
    if (hardRefresh) {
      this._removeAttributes();
    }
    this._processElements();
  }
}

// Export for ES modules
export { AnimateOnScroll, DeviceDetector };

// Make available globally for non-module usage and create AOS API
if (typeof window !== 'undefined') {
  window.AnimateOnScroll = AnimateOnScroll;
  window.DeviceDetector = DeviceDetector;
  
  // Create AOS global API
  window.AOS = {
    init: function (options) {
      const aos = new AnimateOnScroll(options);
      aos.init();
      return aos;
    },
    refresh: function (hardRefresh = false) {
      const aos = new AnimateOnScroll();
      aos.init();
      aos.refresh(hardRefresh);
      return aos;
    }
  };
}