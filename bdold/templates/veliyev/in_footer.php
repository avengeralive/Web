<footer>
  <table class="table-borderless" style="margin:30px auto;">
        <tr>
            <td colspan="2"><p class="openSansBold" style="color:#223a46;text-align:center;font-size: 18px;">Не нашли свой вопрос?<br>Свяжитесь с нами!</p></td>
        </tr>        
        <tr>
            <td width="40px"><img src="./templates/<?php echo $template; ?>/img/skype.png" width="25px"></td>
            <td><?php if (isset($settings_skype) && $settings_skype!='') {echo '&nbsp;&nbsp;<a style="font-size: 20px;" href="skype:'.$settings_skype.'?add">'.$settings_skype.'</a>';} ?></td>    
        </tr>
        <tr>
            <td width="40px"><img src="./templates/<?php echo $template; ?>/img/mail.png" width="25px"></td>
            <td><?php if (isset($settings_email) && $settings_email!='') {echo '&nbsp;&nbsp;<a style="font-size: 20px;" href="mailto:'.$settings_email.'">'.$settings_email.'</a>';} ?>    </td>    
        </tr>        
    </table>  
</footer>
<!--</div>

    <footer class="footer navbar-fixed-bottom main">
        <div class="container">
        <div class="row">
            <div class="col">
                <a href="./"><img src="./templates/<?php echo $template; ?>/img/Logo footer.png" alt="logo"></a>
                <p class="phone">
                    <a class=""  href="">
                            <?php
                            if (isset($settings_phone) && $settings_phone!=''){
                                echo $settings_phone;
                            }
                            ?>
                    
                    </a>
                </p>
                
                <p>
                            <?php
                            if (isset($settings_email) && $settings_email!=''){
                                echo '<p>'.$settings_email.'</p>';
                            }
                            ?>
                </p>
                <p>
                </p>
                <p class="copy">&copy <?= date('Y');?> </p>
            </div>
            <div class="col">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Общее</a>  
                  <a class="nav-link" href="/info.php">Информация</a>
                  <a class="nav-link" href="/about.php">О компании</a>
                  <a class="nav-link" href="/contacts.php">Контакты</a>
                </nav>
            </div>
            <div class="col">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Вебмастеру</a>  
                  <a class="nav-link" href="http://api.blackdollar.ru/apidoc/">API</a>
                  <a class="nav-link" href="/help.php">FAQ</a>
                </nav>
            </div>
            <div class="col">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Рекламадателю</a>  
                  <a class="nav-link" href="/help.php">FAQ</a>
                  <a class="nav-link" href="/info.php">Информация</a>
                </nav>
            </div>
        </div>
        </div>
    </footer>
</div> 
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    -->

    <script>
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom_select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("div");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("div");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("div");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            
            $(s).val(s.options[i].getAttribute('value')).change();
            //console.log($(s).val());
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

$(function(){
    $('.custom_select select').on('change', function(){
        console.log($(this).val());
    })
});
</script>
    </body>
</html>