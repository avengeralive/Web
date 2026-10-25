
<script type="text/javascript">
    $( "#datepicker" ).daterangepicker({
        ranges: {
            '<?php echo $loc['stats.php']['t33']; ?>': [moment(), moment()],
            '<?php echo $loc['stats.php']['t34']; ?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '<?php echo $loc['stats.php']['t35']; ?>': [moment().subtract(6, 'days'), moment()],
            '<?php echo $loc['stats.php']['t36']; ?>': [moment().subtract(29, 'days'), moment()],
            '<?php echo $loc['stats.php']['t37']; ?>': [moment().startOf('month'), moment().endOf('month')],
            '<?php echo $loc['stats.php']['t38']; ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            "format": "DD.MM.YYYY",
            "separator": " - ",
            "applyLabel": "<?php echo $loc['stats.php']['t39']; ?>",
            "cancelLabel": "<?php echo $loc['stats.php']['t40']; ?>",
            "fromLabel": "<?php echo $loc['stats.php']['t41']; ?>",
            "toLabel": "<?php echo $loc['stats.php']['t42']; ?>",
            "customRangeLabel": "<?php echo $loc['stats.php']['t43']; ?>",
            "daysOfWeek": [
                "<?php echo $loc['stats.php']['t44']; ?>",
                "<?php echo $loc['stats.php']['t45']; ?>",
                "<?php echo $loc['stats.php']['t46']; ?>",
                "<?php echo $loc['stats.php']['t47']; ?>",
                "<?php echo $loc['stats.php']['t48']; ?>",
                "<?php echo $loc['stats.php']['t49']; ?>",
                "<?php echo $loc['stats.php']['t50']; ?>"
            ],
            "monthNames": [
                "<?php echo $loc['stats.php']['t51']; ?>",
                "<?php echo $loc['stats.php']['t52']; ?>",
                "<?php echo $loc['stats.php']['t53']; ?>",
                "<?php echo $loc['stats.php']['t54']; ?>",
                "<?php echo $loc['stats.php']['t55']; ?>",
                "<?php echo $loc['stats.php']['t56']; ?>",
                "<?php echo $loc['stats.php']['t57']; ?>",
                "<?php echo $loc['stats.php']['t58']; ?>",
                "<?php echo $loc['stats.php']['t59']; ?>",
                "<?php echo $loc['stats.php']['t60']; ?>",
                "<?php echo $loc['stats.php']['t61']; ?>",
                "<?php echo $loc['stats.php']['t62']; ?>"
            ],
            "firstDay": 1
        },

        <?php if(isset($_POST['date1'])) { ?>
        startDate: '<?php echo $_POST['date1']; ?>',
        endDate: '<?php echo $_POST['date2']; ?>'
        <?php } else { ?>
        startDate: moment().subtract(6, 'days'),
        endDate: moment()
        <?php } ?>
    });
</script>
