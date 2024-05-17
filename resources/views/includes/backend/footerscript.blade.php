<script src="{{ asset('root/hyp/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>


<!-- Apex Chart Candlestick Demo js -->
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
<script src="https://apexcharts.com/samples/assets/series1000.js"></script>
<script src="https://apexcharts.com/samples/assets/github-data.js"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>

<!-- Wallet Dashboard js -->
<script src="{{ asset('root/hyp/assets/js/pages/demo.dashboard-wallet.js') }}"></script>
<script src="{{ asset('root/hyp/assets/js/app.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/js/ui/component.todo.js') }}"></script>


<!-- Include jQuery -->
<script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('root/dek/assets/js/modal.js') }}"></script>
<script src="{{ asset('root/dek/assets/js/classie.js') }}"></script>
<script src="{{ asset('root/dek/assets/js/modalEffects.js') }}"></script>

{{-- THE LINK TO THE PERMISSIONS --}}
<script src="{{ asset('root/js/permission-access.js') }}"></script>

<script src="{{ asset('root/hyp/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- DataTables Buttons and Dependencies -->
<script src="{{ asset('root/hyp/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('root/hyp/assets/vendor/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>


<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('root/hyp/assets/vendor/select2/js/select2.min.js') }}"></script>

@yield('additional-js')

<script>
    $(document).ready(function() {
        $('.select2').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
                width: '100%'
            });
            // $(this).val($(this).find('option:first').val()).trigger('change');
        });


        //======= HANDLING THE COLLAPSE OF THE SIDE NAV =========================

        $('.side-nav-link[data-bs-toggle="collapse"]').on('click', function() {
            var target = $(this).attr('href');
            if (target && target.startsWith('.')) {
                var collapseClass = target.substring(1);
                $('.collapse').not('.' + collapseClass).removeClass('show');
                $('.' + collapseClass).toggleClass('show');
            }
        });
        // ================================================================

        $('.iclose-btn').on('click', function() {
            $('.help-box').hide();
        });

    });
</script>


</body>

</html>
