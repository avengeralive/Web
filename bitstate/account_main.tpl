{include file="header_account.tpl"}
	<h1>Your account:</h1>
	{if $settings.use_transaction_code ==1 && $userinfo.transaction_code == ''} <b>Note: currently you have not specified 
	a Transaction code. The Transaction code strengthens your funds security in our 
	system. The code is required to withdraw funds from your account{if $settings.internal_transfer_enabled} 
	and for internal transfer to another user account{/if}. Just do not change 'Transaction 
	code' in your account information if you do not want to use this feature. <a href=?a=edit_account>Click 
	here</a> to specify a new transaction code .</b> <br />
	<br />
	{/if}
            <div class="client_info">
              <img src="images/icon.jpg" alt="" style="float: left; margin-right: 17px;" />
              <div class="client_info_left">
                <span>User:</span> <br />
                Registration Date: <br />
                Last Access: <br />
              </div>
              <div class="client_info_right">
                <span>{$userinfo.username}</span> <br />
                {$userinfo.create_account_date}<br />
                {$last_access}<br />
              </div>
            </div>
            
            <div class="account_balance">
              <div class="account_balance_left">
                <span>Account Balance:</span> 
              </div>
              <div class="account_balance_right">
                <span>{$currency_sign}{$ab_formated.total}</span> <br />
				{section name=p loop=$ps}
				   {if $ps[p].balance > 0}{$currency_sign}{$ps[p].balance} of {$ps[p].name}<br />{/if}
				{/section}
              </div>
            </div>
            
            <div class="hr"></div>
            
            <div class="table_block">
              <div class="table_block_left">
                <table>
                  <tr>
                    <td class="table_block_left_TDleft">Earned Total:</td>
                    <td class="table_block_left_TDright"><span>{$currency_sign}{$ab_formated.earning}</span></td>
                  </tr>
                  <tr>
                    <td class="table_block_left_TDleft">Pending Withdrawal:</td>
                    <td class="table_block_left_TDright"><span>{$currency_sign}{$ab_formated.withdraw_pending}</span></td>
                  </tr>
                  <tr>
                    <td class="table_block_left_TDleft">Withdrew Total: </td>
                    <td class="table_block_left_TDright"><span>{$currency_sign}{$ab_formated.withdrawal}</span></td>
                  </tr>
                  <tr>
                    <td class="table_block_left_TDleft">Active Deposit:</td>
                    <td class="table_block_left_TDright"><span>{$currency_sign}{$ab_formated.active_deposit}</span></td>
                  </tr>
                </table>
              </div>
              
              <div class="table_block_right">
                <table>
                  {if $last_deposit}
                  <tr>
                    <td class="table_block_right_TDleft">Last Deposit:</td>
                    <td class="table_block_right_TDright"><span>{$currency_sign}{$last_deposit}</span> {$last_deposit_date}</td>
                  </tr>
                  {/if}
		          {if $ab_formated.deposit != 0}
				  <tr>
                    <td class="table_block_right_TDleft">Total Deposit:</td>
                    <td class="table_block_right_TDright"><span>{$currency_sign}{$ab_formated.deposit}</span></td>
                  </tr>
                  {/if}
                  {if $last_withdrawal}
                  <tr>
                    <td class="table_block_right_TDleft">Last Withdrawal: </td>
                    <td class="table_block_right_TDright"><span>{$currency_sign}{$last_withdrawal}</span> {$last_withdrawal_date}</td>
                  </tr>
                  {/if}
                  {if $ab_formated.withdrawal > 0}
                  <tr>
                    <td class="table_block_right_TDleft">Withdrew Total:</td>
                    <td class="table_block_right_TDright"><span>{$currency_sign}{$ab_formated.withdrawal}</span></td>
                  </tr>
                  {/if}
                </table>
              </div>
            </div>
{include file="footer_account.tpl"}