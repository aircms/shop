import {wait} from "../module/wait";
import {interval} from "../module/timer";
import $ from "jquery";
import {toast} from "../module/toast";
import {locale} from "../module/locale";
import {nav} from "../module/nav";
import {cart} from "./cart";

export const checkout = new class {
  lastValue = {};

  watch() {
    wait.on('[data-cart-checkout-form]', (form) => {
      this.lastValue = $(form).serialize();
      interval(1000, () => {
        const newValue = $(form).serialize();
        if (this.lastValue !== newValue) {
          this.lastValue = newValue;
          $.post('/cart/saveOrderData', this.lastValue);
        }
      });

      $(form).submit(() => {
        $(form).find('.has-error').removeClass('has-error');
        $.post('/cart/checkout', $(form).serialize())
          .then((r) => {
            nav.go(locale.languagePrefix + r.pageUrl);
            cart.cartChanged();
          })
          .catch(({responseJSON}) => {
            toast.show(locale.l('Заповніть коректно поля форми'));
            responseJSON.forEach((sel) => {
              $('[name="' + sel + '"]').parent().addClass('has-error');
            });
          });
        return false;
      });

      $(form).find('[data-repeat-data]').click(() => {
        $('[name="bankIndividual[firstName]"]').val($('[name="firstName"]').val());
        $('[name="bankIndividual[lastName]"]').val($('[name="lastName"]').val());
        $('[name="bankIndividual[phone]"]').val($('[name="phone"]').val());
      });
    });
  }
}