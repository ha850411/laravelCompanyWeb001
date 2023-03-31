<form action="/viewFixed" id="viewFm" method="post">
{{csrf_field()}}
<input type="hidden" name="view_id" id="view_id">
</form>


<script src="{{ asset('/admin/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/main.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="{{ asset('/admin/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('/admin/assets/js/widgets.js') }}"></script>
<script src="{{ asset('/admin/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
<script src="{{ asset('/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script> -->
<script>
    function tipFun(id)
    {
        $('#view_id').val(id);
        $('#viewFm').submit();
    }
</script>
