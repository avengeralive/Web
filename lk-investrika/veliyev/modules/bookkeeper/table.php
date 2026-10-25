<div class="table">
    <table cellspacing=0 class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="text-align: center;">Дата</th>
                <?php 
                if($user_tip == 70){ 
                ?>
                <th style="text-align: right;" width=50% colspan="2">Приход</th>
                <th style="text-align: right;">Расход</th>
                <th style="text-align: right;">Сальдо</th>
                <th width="20"> &mdash; </th>
                <?php 
                } 
                ?>
                <?php 
                if($user_tip == 10){ 
                ?>
                <th width=50% colspan="2">Сумма вывода</th>
                <?php 
                } 
                ?> 
                <?php 
                if($user_tip == 40){ 
                ?>
                <th width=50% colspan="2">Сумма пополнения</th>
                <?php 
                } 
                ?>                
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            $total_out = 0;
            $total_profit = 0;
            
            foreach ($var_data as $date => $rows) {
                echo '<tr class="date">
            <td align="center"> ' . $date . ' </tD>';

                $dayIn = 0;
                $dayOut = 0;

                foreach ($rows as $r) {
                    if($user_tip == 70){
                        if ($r->operation == 1) {
                            $dayIn += $r->summ;
                        } else {
                            $dayOut += $r->summ;
                        }
                    }
                    if($user_tip == 10){
                        if ($r->operation == 2) {
                            $dayIn += $r->summ;
                        } else {
                            $dayOut += $r->summ;
                        }
                    }
                    if($user_tip == 40){
                        if ($r->operation == 1) {
                            $dayIn += $r->summ;
                        } else {
                            $dayOut += $r->summ;
                        }
                    }                    
                }
                $total += $dayIn;
                $total_out += $dayOut;
                $total_profit += $dayIn - $dayOut;
                if($user_tip == 70){
                echo '<td align=right colspan=2><span class="text-green">' . number_format(round($dayIn, 2), 2, '.', ' ') . ' руб.</span></tD>';
                echo '<tD align=right><span class="text-green">-' . number_format(round($dayOut, 2), 2, '.', ' ') . ' руб.</span></tD>';
                echo '<td align=right><span class="text-green">' . number_format(round($dayIn - $dayOut, 2), 2, '.', ' ') . ' руб.</span></tD>';
               
                echo '    
            <td align="right"> <input type="button" onclick="$(this).parent().parent().toggleClass(\'active\'); $(\'.rows' . date('Ymd', strtotime($date)) . '\').toggle()" class="btn btn-sm btn-default" value="+" ></tD>
        </tR>';
              
                    foreach ($rows as $r) {
                        echo ' <tr style="display:none" class="details rows' . date('Ymd', strtotime($date)) . '">
                            <td align="right"> ' . date('H:i:s', strtotime($r->date)) . '</tD>
                            <td align="right"> ' . $r->description . ', ' . $r->email . ', ' . $r->user_id . ': ' . $r->wmr . '; ' . $r->comments . '  </tD>';
                        if ($r->operation == 1) {
                            echo '<td width=70 align=right>' . number_format($r->summ, 2, '.', ' ') . '</td>';
                            echo '<td align=right>&mdash;</td>';
                        } else {
                            echo '<td width=70 align=right>&mdash;</td>';
                            echo '<td align=right>-' . number_format($r->summ, 2, '.', ' ') . '</td>';
                        }
                        echo '
                            <td align="right"> </tD>
                            <td align="right"> </tD>


                        </tR>';
                    }
                }
                if($user_tip == 10 || $user_tip == 40){
                echo '<td align=right colspan=2><span class="text-green">' . number_format(round($dayIn, 2), 2, '.', ' ') . ' руб.</span></tD>';
                }                  
            }
            ?>
        </tbody>


        <tr class="date">
            <?php 
            if($user_tip == 70){ 
            ?>   
            <td align="right" colspan="2"><b>Итого:</b></td>
            <td align="right"><b> <?= number_format(round($total, 2), 2, '.', ' '); ?> руб</b></td>
            <td align="right"><b>-<?= number_format(round($total_out, 2), 2, '.', ' '); ?> руб</b></td>
            <td align="right"><b> <?= number_format(round($total_profit, 2), 2, '.', ' '); ?> руб</b></td>
            <?php 
            } 
            ?>   
            <?php 
            if($user_tip == 40 || $user_tip == 10){ 
            ?>     
            <td align="right" colspan="2"></td>
            <td align="right"><b>Итого: <?= number_format(round($total, 2), 2, '.', ' '); ?> руб</b></td>
            <?php 
            } 
            ?>             
        </tr>
        </tbody>
    </table>
</div>