import {wait} from "../module/wait";
import $ from "jquery";
import {locale} from "../module/locale";
import {toast} from "../module/toast";

wait.on('[data-contact-form]', (form) => {
  $(form).submit(() => {
    $(form).find('.has-error').removeClass('has-error');
    $.post('/contact', $(form).serialize())
      .then((r) => {
        form.reset();
        toast.show(locale.l('Дякую, наш менеджер зв\'яжеться з вами протягом 60 хвилин'));
      })
      .catch(({responseJSON}) => {
        toast.show(locale.l('Заповніть коректно поля форми'));
        responseJSON.forEach((sel) => {
          $('[name="' + sel + '"]').parent().addClass('has-error');
        });
      });
    return false;
  });
});