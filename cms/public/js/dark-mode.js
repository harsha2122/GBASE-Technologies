(function () {
  var STORAGE_KEY = 'gbase-theme';
  var root = document.documentElement;

  function isDark() {
    return root.classList.contains('gbase-dark');
  }

  function syncIcons() {
    var dark = isDark();
    document.querySelectorAll('#gbase-theme-toggle, #gbase-theme-toggle-mobile').forEach(function (btn) {
      var moon = btn.querySelector('.gbase-theme-icon-dark');
      var sun = btn.querySelector('.gbase-theme-icon-light');
      if (moon) moon.style.display = dark ? 'none' : '';
      if (sun) sun.style.display = dark ? '' : 'none';
    });
  }

  function setDark(dark) {
    root.classList.toggle('gbase-dark', dark);
    try {
      localStorage.setItem(STORAGE_KEY, dark ? 'dark' : 'light');
    } catch (e) {}
    syncIcons();
  }

  function toggle() {
    setDark(!isDark());
  }

  document.addEventListener('DOMContentLoaded', function () {
    syncIcons();

    var desktopBtn = document.getElementById('gbase-theme-toggle');
    var mobileBtn = document.getElementById('gbase-theme-toggle-mobile');

    if (desktopBtn) desktopBtn.addEventListener('click', toggle);
    if (mobileBtn) mobileBtn.addEventListener('click', toggle);
  });
})();
