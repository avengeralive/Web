<?php
    if(isset($error_message) && $error_message != ''){
?>
<script type="text/javascript">
    new Noty({
      text: '<?php echo $error_message; ?>',
      type: '<?php echo $error_type; ?>',
      theme: 'nest',
      timeout: 3000,
      closeWith: ['click', 'button'],
      layout: 'topRight'
    }).show()
</script>
<?php
    }
?>