import $ from "jquery";

export const locale = new class {
  phrases = {};
  language = $('html').data('lang');
  languagePrefix = $('html').data('lang-prefix');
  _ready = false;
  listeners = [];

  constructor() {
    $.get('/async/phrases', {lang: this.language}, (phrases) => {
      this.phrases = phrases;
      this._ready = true;
      this.listeners.forEach((ln) => ln());
    });
  }

  ready(listener) {
    if (this._ready) {
      listener();
    } else {
      this.listeners.push(listener);
    }
  }

  l(key) {
    if (!this.phrases[key]) {
      const phrases = JSON.parse(localStorage.getItem('phrases')) || {};
      phrases[key] = key;
      localStorage.setItem('phrases', JSON.stringify(phrases));
    }
    return this.phrases[key] || key;
  }
}