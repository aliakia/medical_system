<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
    <div class="{{ !empty($containerNav) ? $containerNav : 'container-fluid' }}">
        <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
            <div>
                <a href="{{ config('variables.licenseUrl') ? config('variables.licenseUrl') : '#' }}"
                    class="footer-link me-4" target="_blank">License</a>
                <a href="{{ config('variables.documentation') ? config('variables.documentation') : '#' }}"
                    target="_blank" class="footer-link me-4">Documentation</a>
                <a href="{{ config('variables.support') ? config('variables.support') : '#' }}" target="_blank"
                    class="footer-link d-none d-sm-inline-block">Support</a>
            </div>
        </div>
    </div>
</footer>
<!--/ Footer-->