(function () {
  'use strict';

  function showResult(form, message, success) {
    var status = form.querySelector('[data-inquiry-status]');
    if (!status) {
      status = document.createElement('div');
      status.dataset.inquiryStatus = '';
      status.style.cssText = 'padding:14px 18px;margin:16px 0;border-radius:8px;';
      status.setAttribute('aria-live', 'polite');
      form.appendChild(status);
    }
    status.setAttribute('role', success ? 'status' : 'alert');
    status.style.background = success ? '#e8f7ee' : '#fef2f2';
    status.style.color = success ? '#15803d' : '#991b1b';
    status.textContent = message;
  }

  document.querySelectorAll('form[data-inquiry-form]').forEach(function (form) {
    var sending = false;
    form.addEventListener('submit', async function (event) {
      event.preventDefault();
      if (sending) return;
      sending = true;
      var button = form.querySelector('[type="submit"]');
      var original = button ? button.textContent : '';
      if (button) { button.disabled = true; button.textContent = 'Sending…'; }
      try {
        var response = await fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          credentials: 'same-origin',
          headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        });
        var result = await response.json();
        if (response.ok && result.success === true) {
          form.reset();
          showResult(form, result.message, true);
        } else {
          var errors = result.errors ? Object.values(result.errors).flat() : [];
          var message = errors[0] || result.message || 'Your enquiry could not be sent. Please try again.';
          if (response.status === 429) message = 'Too many enquiries have been sent. Please try again later.';
          showResult(form, message, false);
        }
      } catch (error) {
        showResult(form, 'Your enquiry could not be sent. Please check your connection and try again.', false);
      } finally {
        var widget = form.querySelector('[data-inquiry-turnstile]');
        if (widget && widget.dataset.widgetId && window.turnstile) window.turnstile.reset(widget.dataset.widgetId);
        sending = false;
        if (button) { button.disabled = false; button.textContent = original; }
      }
    });
  });

  var widgets = document.querySelectorAll('[data-inquiry-turnstile]');
  if (!widgets.length) return;
  window.gbaseTurnstileLoaded = function () {
    widgets.forEach(function (container) {
      if (container.dataset.widgetId) return;
      container.dataset.widgetId = window.turnstile.render(container, {
        sitekey: container.dataset.sitekey,
        action: 'inquiry'
      });
    });
  };
  if (window.turnstile) {
    window.gbaseTurnstileLoaded();
  } else {
    var script = document.createElement('script');
    script.src = 'https://challenges.cloudflare.com/turnstile/v0/api.js?onload=gbaseTurnstileLoaded&render=explicit';
    script.async = true;
    script.onerror = function () {
      widgets.forEach(function (container) {
        showResult(container.closest('form'), 'Verification could not load. Please check your connection and reload the page.', false);
      });
    };
    document.head.appendChild(script);
  }
}());
