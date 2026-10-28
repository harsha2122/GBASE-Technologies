(function () {
  'use strict';
  document.querySelectorAll('[data-video-url-editor]').forEach(function (editor) {
    var rows = editor.querySelector('[data-video-url-rows]');
    editor.querySelector('[data-add-video-url]').addEventListener('click', function () {
      var row = rows.firstElementChild.cloneNode(true);
      row.querySelector('input').value = '';
      rows.appendChild(row);
      row.querySelector('input').focus();
    });
    rows.addEventListener('click', function (event) {
      var button = event.target.closest('[data-remove-video-url]');
      if (!button) return;
      var row = button.closest('[data-video-url-row]');
      if (rows.children.length === 1) {
        row.querySelector('input').value = '';
        row.querySelector('input').focus();
      } else {
        row.remove();
        rows.lastElementChild.querySelector('input').focus();
      }
    });
  });
}());
