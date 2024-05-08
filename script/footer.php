<!-- <footer class="bg-danger p-2 text-white text-center" style="margin-left:250px;">
© <?php echo date("Y"); ?> | <a class="text-white" href="https://www.yahoobaba.net/" target="_blank">YahooBaba</a>
</footer> -->

<script src="assets/js/jquery.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dataTables.js"></script>
<script src="assets/js/datatables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/dataTables.buttons.html5.min.js"></script>
<script src="assets/js/dataTables.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="assets/js/dataTables.vfs_fonts.min.js"></script>
<script src="assets/js/multi.min.js"></script>
<script src="assets/js/admin.js"></script>
<script type="text/javascript">
$(document).ready(function() {
      $('.table-data').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'excel', 'pdf', 'print'
      ]
    });


      $('.select2').select2();

      // load image with jquery
    $('.image').change(function(){
        readURL(this);
    });

  // preview image before upload
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#image').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $('#sidebarCollapse').on('click', function () {
               $('#sidebar').toggleClass('active');
           });

});


</script>

</body>
</html>
