    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>CodeInsect</b> Admin System | Version 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="<?php echo base_url(); ?>">CodeInsect</a>.</strong> All rights reserved.
         <!-- dateTimePicker1.Format = DateTimePickerFormat.Custom;
   dateTimePicker1.CustomFormat = "MM/yyyy"; -->
    </footer>
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>