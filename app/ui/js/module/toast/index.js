import $ from "jquery";
import toastTemplate from "./template.html";
import {timer} from "../timer";

export const toast = new class {
  defaultOpts = {
    dismissible: true,
    dismissAfter: 5000,
    dismissOnclick: true,
    style: 'default',
  };
  template = toastTemplate;
  selector = "body > [data-toast]";

  show(content, opts) {
    opts = {...this.defaultOpts, ...opts || {}};

    this.close().then(() => {
      const template = this.template
        .replaceAll('{{style}}', opts.style)
        .replaceAll('{{content}}', content);

      $('body').append(template);

      timer(50, () => $(this.selector).addClass('show'));
      if (opts.dismissible) {
        timer(opts.dismissAfter, () => this.close());
      }

      if (opts.dismissOnclick) {
        $(this.selector).click(() => this.close());
      }
    });
  }

  close() {
    return new Promise((resolve) => {
      const toast = $(this.selector);
      if (toast.length) {
        toast.removeClass('show');
        timer(200, () => {
          toast.remove();
          resolve();
        });
        return;
      }
      resolve();
    });
  }
};