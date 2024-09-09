import {wait} from "./wait";
import $ from "jquery";

const asyncCache = {};

export const async = new class {
  watch() {
    wait.on('[data-async]', (el) => {
      if (asyncCache[$(el).data('async')]) {
        $(el).html(asyncCache[$(el).data('async')]);
      } else {
        $.get($(el).data('async'), (html) => {
          asyncCache[$(el).data('async')] = html;
          $(el).html(html);
        });
      }
    });
  }
};