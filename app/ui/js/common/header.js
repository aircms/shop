import $ from "jquery";
import {Tooltip} from "bootstrap";
import Swiper from "swiper";
import {wait} from "../module/wait";

if ($(window).width() > 768) {

  wait.on('[data-title]', (title) => new Tooltip(title, {
    title: $(title).data('title'),
    placement: $(title).data('title-placement') || 'bottom'
  }));

  $(window).scroll(() => {
    const header = $('[data-header]');
    if ($(window).scrollTop() > 100) {
      header.addClass('sticky').removeClass('shd-md-0');
    } else {
      header.removeClass('sticky').addClass('shd-md-0');
    }
  });
  $(window).scroll();
}

wait.on('[data-swiper-mobile-menu]', (el) => {
  const swiper = new Swiper(el, {
    spaceBetween: 30,
    speed: 200,
  });
  $('[data-mobile-category-container]').html($('[data-category-button] [data-async]').html());
  $('[data-mobile-category-btn]').click(() => {
    swiper.slideNext();
    return false;
  });
});