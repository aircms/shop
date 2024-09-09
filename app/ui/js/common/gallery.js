import {wait} from "../module/wait";
import $ from "jquery";
import Swiper from "swiper";

wait.on('[data-gallery]', (gallery) => {
  const fullImages = $(gallery).find('[data-swiper-full-images]');
  const previewImages = $(gallery).find('[data-swiper-preview-images]');

  const fullImagesSwiper = new Swiper(fullImages[0], {
    spaceBetween: 10,
  });

  const previewImagesSwiper = new Swiper(previewImages[0], {
    slidesPerView: "auto",
    spaceBetween: 10,
  });

  previewImages.find('img').click(function () {
    fullImagesSwiper.slideTo($(this).parent().index());
    previewImagesSwiper.slideTo($(this).parent().index());
  });
});