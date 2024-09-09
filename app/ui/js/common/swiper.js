import $ from "jquery";
import {wait} from "../module/wait";
import Swiper from "swiper";

export const swiperNav = new class {
  watch() {
    wait.on('[data-swiper][data-swiper-options]', (el) => {
      let swiperOptions = {};
      try {
        swiperOptions = JSON.parse($(el).data('swiper-options').replaceAll("'", '"'))
      } catch {
      }
      new Swiper(el, swiperOptions);
    });

    wait.on('[data-swiper-nav-prev]', (navPrev) => {
      $(navPrev).click((e) => {
        $(e.currentTarget).closest('[data-swiper-container]').find('[data-swiper]')[0].swiper.slidePrev();
      });
    });

    wait.on('[data-swiper-nav-next]', (navPrev) => {
      $(navPrev).click((e) => {
        $(e.currentTarget).closest('[data-swiper-container]').find('[data-swiper]')[0].swiper.slideNext();
      });
    });
  }
};