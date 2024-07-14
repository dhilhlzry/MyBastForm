  @if (!request()->is('login'))
    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="/">{{ env('APP_NAME') }}</a>.</strong> All rights reserved.
    </footer>
  @endif
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('template/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('template/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('template/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/adminlte/dist/js/adminlte.js') }}"></script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
  $(document).ready(function(){
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});

    $('#logout').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
      Swal.fire({
        title: "Are you sure?",
        text: "You will returned to login page.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Logout"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
    });
  });
  </script>
  <script>
    // success message popup notification
    @if(session()->has('success'))
      toastr.success("{{ session()->get('success') }}");
    @endif

    // info message popup notification
    @if(session()->has('info'))
      toastr.info("{{ session()->get('info') }}");
    @endif

    // warning message popup notification
    @if(session()->has('warning'))
      toastr.warning("{{ session()->get('warning') }}");
    @endif

    // error message popup notification
    @if(session()->has('error'))
      toastr.error("{{ session()->get('error') }}");
    @endif
  </script>
@stack('custom-scripts')

</body>
</html>
