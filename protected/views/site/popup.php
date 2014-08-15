<html>
    <head>
        <meta charset="utf-8">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script language="javascript">
            $(function() {
                var a = window.opener.jQuery("#date1").val();
                $("#txt").html(a);
            });
        </script> 
    </head>
    <body>

        <?php
        echo date('H:i:s');
        ?>
        <span id="txt"></span>
    </body>
</html>


