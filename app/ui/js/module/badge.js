import $ from "jquery";
import {interval} from "./timer";
import {wait} from "./wait";

class badge {
  label = null;
  style = null;

  constructor(el) {
    if (!$(el).find('.air-badge').length) {
      $(el).append('<div class="air-badge"></div>');
    }
    interval(100, () => {
      if ($(el).attr('data-badge') !== this.label) {
        this.label = $(el).attr('data-badge');
        $(el).find('.air-badge').html(this.label);
      }
    });
  }

  static watch() {
    wait.on('[data-badge]', (el) => new badge(el));
  }
}

export {badge};