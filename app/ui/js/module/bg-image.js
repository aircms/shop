import $ from "jquery";
import {wait} from "./wait";

export const bgImage = new class {
  watch() {
    wait.on('[data-bg]', (e) => {
      $(e).css("background-image", "url(" + $(e).data("bg") + ")");
      $(e).addClass('bg-image');
    });
  }
}