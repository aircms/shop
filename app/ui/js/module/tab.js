import $ from "jquery";
import {wait} from "./wait";

export const tab = new class {
  watch() {
    wait.on('[data-tab]', (el) => {
      const tabs = $(el).find('[data-tab-content] > div');
      tabs
        .addClass('d-n')
        .addClass('v-hid')
        .addClass('o-0')
        .addClass('an-1');

      $(el).find('[data-tab-title]').click(function () {
        tabs
          .addClass('d-n')
          .addClass('o-0')
          .addClass('v-hid')
          .removeClass('o-100');

        const tab = $(tabs[$(this).index()]);

        tab.removeClass('d-n');

        setTimeout(() => {
          tab
            .removeClass('v-hid')
            .removeClass('o-0')
            .addClass('o-100')
        }, 50);

        $(el).find('[data-tab-title]').removeClass('active');
        $(this).addClass('active');
      });

      $($(el).find('[data-tab-title]')[0]).click();
    });
  }
}