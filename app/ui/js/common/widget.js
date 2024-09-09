import $ from "jquery";
import {wait} from "../module/wait";

wait.on('.widget .title', (el) => $(el).click(function () {
  const widget = $(this).closest('.widget');
  widget.toggleClass('show');
  if (widget.hasClass('show')) {
    setTimeout(() => widget.addClass('overflow'), 200);
  } else {
    widget.removeClass('overflow');
  }
}));