<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
  <div
    class="{{ (!empty($containerNav) ? $containerNav : 'container-fluid') }} d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      ©
      <script>
        document.write(new Date().getFullYear())

      </script>
      , made with ❤️ by <a href="{{ (!empty(config('variables.creatorUrl')) ? config('variables.creatorUrl') : '') }}"
        target="_blank"
        class="footer-link fw-semibold">{{ (!empty(config('variables.creatorName')) ? config('variables.creatorName') : '') }}</a>
    </div>
    <p xmlns:cc="http://creativecommons.org/ns#">This work is licensed under <a
        href="https://creativecommons.org/licenses/by-sa/4.0/?ref=chooser-v1" target="_blank"
        rel="license noopener noreferrer" style="display:inline-block;">CC BY-SA 4.0<img
          style="height:22px!important;margin-left:3px;vertical-align:text-bottom;"
          src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img
          style="height:22px!important;margin-left:3px;vertical-align:text-bottom;"
          src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img
          style="height:22px!important;margin-left:3px;vertical-align:text-bottom;"
          src="https://mirrors.creativecommons.org/presskit/icons/sa.svg?ref=chooser-v1" alt=""></a></p>
  </div>
</footer>
<!--/ Footer-->