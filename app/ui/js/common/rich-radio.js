import {wait} from "../module/wait";
import $ from "jquery";

export const richRadio = new class {
  watch() {
    wait.on('[data-rich-radio]', (richRadio) => {
      $(richRadio).find('[data-rich-radio-button]').click((e) => {
        const group = $(e.currentTarget).closest('[data-rich-radio]');
        group.find('[data-rich-radio-icon]').removeClass('fa-circle-dot').addClass('fa-circle');
        group.find('[data-rich-radio-container]').removeClass('sc-level-1');

        group.find('.show').removeClass('show');

        const container = $(e.currentTarget).closest('[data-rich-radio-container]');
        container.addClass('sc-level-1');
        container.find('[data-rich-radio-icon]').removeClass('fa-circle').addClass('fa-circle-dot');

        container.addClass('show');

        $(group).find('[data-rich-radio-value]').val($(e.currentTarget).data('rich-radio-button'));
      });
      $(richRadio).find('[data-rich-radio-active]').click();
    });
  }
}