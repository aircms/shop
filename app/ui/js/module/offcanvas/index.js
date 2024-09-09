import $ from "jquery";
import {Offcanvas} from "bootstrap";
import {timer} from "../timer";
import {wait} from "../wait";
import defaultTemplate from "./default.html";
import backdropTemplate from "./backdrop.html";
import closeTemplate from "./close.html";

export const offcanvas = new class {
  template = defaultTemplate;
  backdropTemplate = backdropTemplate;
  closeTemplate = closeTemplate;

  defaultOpts = {
    side: 'start'
  };

  inline(el) {
    return new Promise((resolve) => {
      this.close().then(() => {
        $('body').append(this.backdropTemplate);
        const backdrop = $('body > .offcanvas-inline-backdrop');
        backdrop.click(() => this.close());

        const offcanvas = $(el);
        offcanvas.addClass('offcanvas-inline');
        if (!offcanvas.find('[data-offcanvas-dismiss]').length) {
          offcanvas.prepend(this.closeTemplate);
        }

        $('[data-offcanvas-dismiss]').click(() => this.close());

        timer(10, () => {
          offcanvas.addClass('show');
          backdrop.addClass('show');
          resolve();
        });
      });
    });
  }

  show(el, opts) {
    return new Promise((resolve) => {

      this.close().then(() => {
        let html = null;
        try {
          if ($(el).length) {
            html = $(el).html();
          }
        } catch {
        }

        if (!html) {
          html = el;
        }

        opts = {...this.defaultOpts, ...opts};
        const offCanvas = this.template
          .replaceAll('{{content}}', html)
          .replaceAll('{{side}}', opts.side);


        if (!$('.offcanvas').length) {
          $('body').append(offCanvas);
          (new Offcanvas('.offcanvas')).show();
          resolve();

        } else {
          this.close(() => {
            $('body').append(offCanvas);
            (new Offcanvas('.offcanvas')).show();
            resolve();
          });
        }
      });
    });
  }

  close() {
    return new Promise((resolve) => {
      if ($('.offcanvas').length) {
        Offcanvas.getInstance('.offcanvas').hide();
        timer(200, () => {
          $('.offcanvas').remove();
          resolve();
        });
        return;
      }

      const backdrop = $('body > .offcanvas-inline-backdrop');
      if (backdrop.length) {
        const offCanvasInline = $('.offcanvas-inline');

        backdrop.removeClass('show');
        offCanvasInline.removeClass('show');

        timer(200, () => {
          offCanvasInline.removeClass('offcanvas-inline');
          offCanvasInline.find('[data-offcanvas-dismiss]').remove();

          backdrop.remove();
          resolve();
        });
        return;
      }
      resolve();
    });
  }

  watch() {
    wait.on('[data-offcanvas]', (el) => $(el).click(() => this.show($(el).data('offcanvas'))));
    wait.on('[data-offcanvas-inline]', (el) => $(el).click(() => this.inline($(el).data('offcanvas-inline'))));
  }
};