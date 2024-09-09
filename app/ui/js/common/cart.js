import $ from "jquery";
import {wait} from "../module/wait";
import {toast} from "../module/toast";
import {popup} from "../module/popup/popup";
import {locale} from "../module/locale";
import {offcanvas} from "../module/offcanvas";
import {until} from "../module/timer";
import {nav} from "../module/nav";

export const cart = new class {
  previewSelector = 'body [data-cart-container]';
  ready = false;

  constructor() {
    $('body').append('<div class="d-n"><div class="h-f" data-cart-container></div></div>');
    this.cartChanged().then(() => this.ready = true);
  }

  watch() {
    until(() => this.ready, () => {
      wait.on('[data-cart-add]', (el) => {
        $(el).click((el) => {
          this.request('add', {product: $(el.currentTarget).data('cart-add'), count: 1}).then(() => {
            toast.show(locale.l('Чудово! Ви успішно додали товар до кошика!'));
          });
        })
      });

      wait.on('[data-cart-remove]', (el) => {
        $(el).click((el) => {
          const product = $(el.currentTarget).data('cart-remove');
          const cartPageRemoveBtn = $('[data-cart-page-remove="' + product + '"]');
          const cartCheckoutForm = $('[data-cart-checkout-form]');

          if (cartPageRemoveBtn.length) {
            cartPageRemoveBtn.click();

          } else if (cartCheckoutForm.length) {
            popup.confirm(locale.l('Видалити товар із кошика?')).then(() => {
              this.request('remove', {product}).then((r) => {
                toast.show(locale.l('Товар успішно видалено з кошика'));

                if (!r.count) {
                  nav.reload();
                } else {
                  $('[data-cart-checkout-product="' + product + '"]').remove();
                  $('[data-cart-info]').html(r.info);
                }
              });
            });

          } else {
            popup.confirm(locale.l('Видалити товар із кошика?')).then(() => {
              this.request('remove', {product}).then(() => {
                toast.show(locale.l('Товар успішно видалено з кошика'));
              });
            });
          }
        })
      });

      wait.on('[data-cart-open]', (el) => {
        $(el).click(() => this.open());
      });

      wait.on('[data-cart-add-form]', (el) => {
        const input = $(el).closest('[data-cart-add-form]').find('input');

        $(el).find('[data-cart-add-form-minus]').click(() => {
          let val = parseInt(input.val());
          val > 1 && input.val(val - 1);
        });
        $(el).find('[data-cart-add-form-plus]').click(() => {
          let val = parseInt(input.val());
          input.val(val + 1);
        });

        $(el).find('[data-cart-add-form-submit]').click(() => {
          this.request('add', {product: $(el).data('cart-add-form'), count: input.val()}).then(() => {
            toast.show(locale.l('Чудово! Ви успішно додали товар до кошика!'));
          });
        });
      });

      wait.on('[data-cart-count-form]', (el) => {
        $(el).find('[data-cart-count-form-minus]').click(() => {
          if (parseInt($(el).find('input').val()) > 1) {
            this.request('minus', {product: $(el).data('cart-count-form'), sign: 'minus'}).then((r) => {
              $(el).closest('[data-cart-form-line]').html(r.line);
              $('[data-cart-info]').html(r.info);
            });
          }
        });
        $(el).find('[data-cart-count-form-plus]').click(() => {
          this.request('plus', {product: $(el).data('cart-count-form'), sign: 'plus'}).then((r) => {
            $(el).closest('[data-cart-form-line]').html(r.line);
            $('[data-cart-info]').html(r.info);
          });
        });
      });

      wait.on('[data-cart-coupon-form]', (el) => {
        $(el).submit(() => {
          const coupon = $(el).find('input').val();
          if (coupon.length) {
            this.request('coupon', {coupon})
              .then(() => nav.reload())
              .catch(() => $(el).find('[data-coupon-error]').removeClass('o-0'));
          }
          return false;
        });
      });

      wait.on('[data-cart-coupon-remove]', (el) => {
        $(el).click(() => {
          popup.confirm(locale.l('Скасувати промокод?')).then(() => {
            this.request('remove-coupon').then(() => {
              nav.reload();
            });
          });
        });
      });

      wait.on('[data-cart-page-remove]', (el) => {
        $(el).click(() => {
          popup.confirm(locale.l('Видалити товар із кошика?')).then(() => {
            const product = $(el).data('cart-page-remove');
            this.request('remove', {product}).then((r) => {
              toast.show(locale.l('Товар успішно видалено з кошика'));
              if (r.count) {
                $('[data-cart-form-line="' + product + '"]').remove();
                $('[data-cart-info]').html(r.info);
              } else {
                nav.reload();
              }
            });
          });
        });
      });
    });
  }

  request(method, params = {}) {
    return new Promise((resolve, reject) => {
      $.post('/cart/' + method, params)
        .then((r) => {
          this.cartChanged();
          resolve(r);
        })
        .catch((e) => reject(e));
    });
  }

  open() {
    offcanvas.show($(this.previewSelector).parent(), {side: 'end'});
  }

  close() {
    offcanvas.close();
  }

  cartChanged() {
    return new Promise((resolve) => {
      $.get(locale.languagePrefix + '/cart/preview', (r) => {
        $(this.previewSelector).html(r.preview);
        $('[data-cart-count-badge]').attr('data-badge', r.count);
        resolve();
      });
    });
  }
};