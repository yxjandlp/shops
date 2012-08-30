<script type="text/javascript">
    function go(){
        location = '<?php echo $returnUrl;?>';
    }
    $(document).ready(function(){
        $('body').jAlert('<?php echo $message;?>','success');
        setTimeout('go()',800);
    });
</script>