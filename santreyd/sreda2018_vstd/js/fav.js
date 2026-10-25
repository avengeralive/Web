$(document).ready(function(){

  window.Favourite = {

    ajaxURL: '/ajax/add_fav.php',
    messList : '',
    mess : '',
    iblockID : 0,
    scrollUp: false,
    list: '',

    reload: function(){
      favourite = window.Favourite;
      url = favourite.ajaxURL+'?ajaxbuy=yes&rg='+Math.random();

      $.ajax({
        url: url,
        success: function(data){
          favourite.refresh(data);
        }
      });
    },

    refresh: function(data){

      favourite = window.Favourite;

      $('#favourite-body').html(data);
      $('#counter-favourite').html($('#counter-favourite-new').html());

      var dataJSON = $(data).find('#favourite-jdata').html();
      if (!dataJSON) return;

      favourite.list = JSON.parse(dataJSON);

      $('.item-favourite').data("favourite", 0);
      if (favourite.list != null && Object.keys(favourite.list).length > 0){
        $.each(favourite.list, function(index, elem) {
          $('.item-favourite[data-item='+index+']').each(function() {
            if (!$(this).hasClass('active'))
              $(this).addClass('active');

          });
          $('.item-favourite[data-item='+index+']').data("favourite", 1);
        });
      }else{
        $('.item-favourite').removeClass('active');
      }

      $('.item-favourite').each(function() {
        if ($(this).data('favourite') == 0)
          $(this).removeClass('active');
      });


    },

    add: function(itemID){

      favourite = window.Favourite;
      if (
        favourite.ajaxURL.length <= 0
        || favourite.iblockID <= 0)
        return;

      url = favourite.ajaxURL+'?action=delay&id='+itemID+'&ajaxbuy=yes&rg='+Math.random();

      $.ajax({
        url: url,
        success: function(data){

          favourite.refresh(data);
          SmallBasket.refreshCart({});
        }
      });

      return false;
    },

    delete: function(itemID){
      favourite = window.Favourite;

      if (
        favourite.ajaxURL.length <= 0
        || favourite.iblockID <= 0)
        return;

      url = favourite.ajaxURL+'?action=delete&id='+itemID+'&ajaxbuy=yes&rg='+Math.random();

      $.ajax({
        url: url,
        success: function(data){
          favourite.refresh(data);
          SmallBasket.refreshCart({});
        }
      });

      return false;
    },

    tocart: function(itemID){
      favourite = window.Favourite;

      if (
        favourite.ajaxURL.length <= 0
        || favourite.iblockID <= 0)
        return;

      url = favourite.ajaxURL+'?action=add&id='+itemID+'&ajaxbuy=yes&rg='+Math.random();

      $.ajax({
        url: url,
        success: function(data){
          favourite.refresh(data);
          SmallBasket.refreshCart({});
        }
      });

      return false;
    },

    init: function(){

      favourite = window.Favourite;
      favourite.reload();

      $(document).on(
        'click',
        '.favourite-button',
        function(){

          itemID = $(this).data('item');
          itemAction = $(this).data('action');

          n = 0;

          if (favourite.list == null){

          }else{
            value = parseInt(favourite.list[itemID]);
            if (!isNaN(value) && value > 0){
              n = 1;
            }
          }
          if (n == 0 && itemAction == "delay") {
            favourite.add(itemID);
          }else if (itemAction == "delete") {
            favourite.delete(itemID);
          } else if (itemAction == "add") {
            favourite.tocart(itemID);
          }

          if (favourite.list.length == 1) {
            $('#warning_empty').html('Список избанных товаров пуст');
          }

          $(this).closest('.favor__item').hide();

          return false;
        }
      );

      $(document).on(
        'click',
        '.favourite-button-delete',
        function(){

          itemID = $(this).data('item');

          favourite.delete(itemID);
          return false;
        }
      );
    }

  };

  MyFavourite = window.Favourite;
  MyFavourite.ajaxURL = '/ajax/add_fav.php';
  MyFavourite.messList = '';
  MyFavourite.mess = '';
  MyFavourite.iblockID = 9999;
  MyFavourite.init();
});
