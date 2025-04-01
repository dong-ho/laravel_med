<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            , made with BLUE EYE
        </div>
        <div class="d-none d-lg-inline-block">

        </div>
    </div>
</footer>
<!-- Toast layout -->
<div
    class="bs-toast toast toast-placement-ex common-toast m-5"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-bs-delay="5000">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-medium toast-title"></div>
        <small>{{ date('m.d H:i') }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body"></div>
</div>
