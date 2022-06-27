<!--   Core JS Files   -->
<script src="{{ asset('/app/js/core/popper.min.js') }}"></script>
<script src="{{ asset('/app/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('/app/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/app/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('/app/js/plugins/chartjs.min.js') }}"></script>

<!-- Date picker -->
<script src="https://unpkg.com/flatpickr@4.6.9/dist/l10n/de.js"></script>
<script src="https://unpkg.com/flatpickr@4.6.9/dist/plugins/rangePlugin.js"></script>
<script src="https://unpkg.com/flatpickr@4.6.9/dist/plugins/monthSelect/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.2/dist/sweetalert2.all.min.js"></script>

<!-- Tom Select -->
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<!-- Vanilla calendar -->
<script src="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@1.3.5/vanilla-calendar.min.js"></script>

<!-- Load FilePond library -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('/app/js/soft-ui-dashboard.min.js?v=1.0.2') }}"></script>


<script>

  function confirmDeletion(form) {
    Swal.fire({
      title: '@lang("messages.really_perform_destructive_action")',
      icon: "warning",
      customClass: {
        popup: "bg-elevated-3"
      },
      focusConfirm: false,
      confirmButtonClass: "bg-danger",
      confirmButtonText: '@lang("messages.yes")',
      cancelButtonText: '@lang("messages.cancel")',
      showCancelButton: true
    }).then(value => {
      if (value.value) form.submit();
    });
    return false;
  }

  function confirmAction(form, message) {
    if (!message) {
      message = "@lang("messages.really_perform_this_action")";
    }
    Swal.fire({
      title: message,
      icon: "warning",
      customClass: {
        popup: "bg-elevated-3"
      },
      focusConfirm: false,
      confirmButtonClass: "bg-danger",
      confirmButtonText: '@lang("messages.yes")',
      cancelButtonText: '@lang("messages.cancel")',
      showCancelButton: true
    }).then(value => {
      if (value.value) form.submit();
    });
    return false;
  }

</script>
