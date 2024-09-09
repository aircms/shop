import {timer} from "../timer";
import {wait} from "../wait";
import $ from "jquery";
import popupTemplate from "./template.html";
import confirmTemplate from "./confirm.html";
import {locale} from "../locale";

export const popup = new class {
  template = popupTemplate;
  confirmTemplate = confirmTemplate;
  selector = 'body > [data-popup]';
  defaultOpts = {
    style: ''
  };

  show(content, opts = {}) {
    return new Promise((resolve) => {
      this.close().then(() => {
        opts = {...this.defaultOpts, ...opts};
        content = this.template.replaceAll('{{style}}', opts.style).replaceAll('{{content}}', content);
        $('body').append(content);
        $(this.selector).find('[data-close]').click(() => {
          this.close();
          return false;
        });
        resolve();
      });
    });
  }

  confirm(message, opts = {}) {
    return new Promise((resolve, reject) => {
      this.close().then(() => {
        opts = {...this.defaultOpts, ...opts};
        message = this.confirmTemplate
          .replaceAll('{{style}}', opts.style)
          .replaceAll('{{yes}}', locale.l('Так'))
          .replaceAll('{{no}}', locale.l('Ні'))
          .replaceAll('{{title}}', locale.l('Підтвердіть'))
          .replaceAll('{{content}}', message);

        $('body').append(message);

        $(this.selector).find('[data-yes]').click(() => {
          this.close();
          resolve();
          return false;
        });

        $(this.selector).find('[data-close]').click(() => {
          this.close();
          reject();
          return false;
        });
      });
    });
  }

  close() {
    return new Promise((resolve) => {
      if ($(this.selector).length) {
        $(this.selector).css('opacity', '0');
        timer(200, () => {
          $(this.selector).remove();
          resolve();
        });
      } else {
        resolve();
      }
    });
  }

  isOpened() {
    return !!$(this.selector).length;
  }

  watch() {
    wait.on('[data-popup-href]', (el) => $(el).click(function () {
      $.get($(this).data('popup-href'), (c) => popup.show(c));
      return false;
    }));
  }
};