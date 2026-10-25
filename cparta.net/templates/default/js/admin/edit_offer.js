$(function () {
    $(document).on('change', 'select[name="uroven_dostupa"]', function () {
        if ($(this).val() == '-1') {
            $('a.magic').show();
            return ;
        }
        
        $('a.magic').hide();
        

    });
    $('select[name="uroven_dostupa"]').trigger('change');
    $(document).on('click','#js-offer-visible', function(){
        window.open('/offers.php?offer='+$(this).data('id')+'&action=visible','name','width=400,height=600');
        return false;
    })

    $(document).on('click', '.js-delete-country', function () {
        if (!confirm("Удалить страну?"))
            return false;
        $(this).parent('tr').fadeOut(function () {
            $(this).remove();
        })
        return false;
    })

    $('[name^="stat"]').on('keyup', function (e) {
        if ((e.keyCode < 48 || e.keyCode > 57) && e.keyCode != 8 && e.keyCode != 46)
            return;
        var par = $(this).parent().find('[name^="stat"]');
        var index = $(par).index(this);
        var sum = 0;
        $(this).parent().find('[name^="stat"]:lt(' + index + ')').each(function () {
            sum += Math.round($(this).val());
        })
        sum += Math.round($(this).val());
        console.log(sum);
        var total = $(this).parent().find('[name^="stat"]:empty').length - index - 1;
        var perInput = Math.round((100 - sum) / total);
        $(this).parent().find('[name^="stat"]:gt(' + index + ')').val(perInput);
    })
    $('[name*="[percent]"]').on('keyup', function (e) {
        if ((e.keyCode < 48 || e.keyCode > 57) && e.keyCode != 8 && e.keyCode != 46)
            return;
        var par = $('body').find('[name*="[percent]"]');
        var index = $(par).index(this);
        var sum = 0;
        $(this).parent().find('[name*="[percent]"]:lt(' + index + ')').each(function () {
            sum += Math.round($(this).val());
        })
        sum += Math.round($(this).val());
        console.log(sum);
        var total = $('body').find('[name*="[percent]"]:empty').length - index - 1;
        var perInput = Math.round((100 - sum) / total);
        $('body').find('[name*="[percent]"]:gt(' + index + ')').val(perInput);
    })
})