<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h1><? echo Translations::gi()->edit_realtor; ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<? if ($realtor->company == 0) { ?>
			<form id="needs-validation" novalidate>
				<input type="hidden" name="id" id="id" value="<? echo $realtor->id; ?>">
				<div class="row">
					<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
						<label for="first"><? echo Translations::gi()->name; ?></label>
						<input type="text" class="form-control" name="name" id="name" value="<? echo $realtor->name; ?>" placeholder="<? echo Translations::gi()->name; ?>" required>
					</div>
					<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
						<label for="last"><? echo Translations::gi()->surname; ?></label>
						<input type="text" class="form-control" name="surname" id="surname" value="<? echo $realtor->surname; ?>" placeholder="<? echo Translations::gi()->surname; ?>" required>
					</div>
					<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
						<label for="patronymic"><? echo Translations::gi()->patronymic; ?></label>
						<input type="text" class="form-control" name="patronymic" id="patronymic" value="<? echo $realtor->patronymic; ?>" placeholder="<? echo Translations::gi()->patronymic; ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="email">E-mail</label>
						<input type="email" class="form-control" name="email" id="email" value="<? echo $realtor->email; ?>" placeholder="E-mail" required>
					</div>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="birthday"><? echo Translations::gi()->birthday; ?></label>
						<input type="date" class="form-control" name="birthday" id="birthday" value="<? echo $realtor->birthday; ?>" placeholder="<? echo Translations::gi()->birthday; ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="mobile"><? echo Translations::gi()->mobile; ?></label>
						<p>
							<input type="text" class="form-control" name="mobile1" id="mobile1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="mobile2" id="mobile2" style="width:60px; float: left; margin-right: 10px;">
								<option value="50" <? if (substr($realtor->mobile, 4, 2) == 50) echo "selected"; ?>>50</option>
								<option value="51" <? if (substr($realtor->mobile, 4, 2) == 51) echo "selected"; ?>>51</option>
								<option value="55" <? if (substr($realtor->mobile, 4, 2) == 55) echo "selected"; ?>>55</option>
								<option value="70" <? if (substr($realtor->mobile, 4, 2) == 70) echo "selected"; ?>>70</option>
								<option value="77" <? if (substr($realtor->mobile, 4, 2) == 77) echo "selected"; ?>>77</option>
							</select>
							<input type="text" class="form-control" name="mobile3" value="<? echo substr($realtor->mobile, 6, 3); ?>" id="mobile3" maxlength="3" style="width:48px; float: left; margin-right: 10px;" required>
							<input type="text" class="form-control" name="mobile4" value="<? echo substr($realtor->mobile, 9, 2); ?>" id="mobile4" maxlength="2" style="width:40px; float: left; margin-right: 10px;" required>
							<input type="text" class="form-control" name="mobile5" value="<? echo substr($realtor->mobile, 11, 2); ?>" id="mobile5" maxlength="2" style="width:40px; float: left;" required>
						</p>
					</div>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="home"><? echo Translations::gi()->home; ?></label>
						<p>
							<input type="text" class="form-control" name="home1" id="home1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="home2" id="home2" style="width:60px; float: left; margin-right: 10px;">
								<option value="12" <? if (substr($realtor->home, 4, 2) == 12) echo "selected"; ?>>12</option>
							</select>
							<input type="text" class="form-control" name="home3" value="<? echo substr($realtor->home, 6, 3); ?>" id="home3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="home4" value="<? echo substr($realtor->home, 9, 2); ?>" id="home4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="home5" value="<? echo substr($realtor->home, 11, 2); ?>" id="home5" maxlength="2" style="width:40px; float: left;">
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<a id="addphone" style="color:#fff; cursor: pointer;" class="btn btn-sm btn-success" title="Добавить телефон"><i class="fa fa-plus"></i> Добавить телефон</a>
					</div>
				</div>
				<div class="row" id="additionalphone" style="margin-bottom: 15px;">
				<? if ($realtor->phone1 != 'NaN' && $realtor->phone2 != 'NaN') { ?>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="phone">Дополнительный телефон 1</label>
						<p>
							<input type="text" class="form-control" name="phone1_1" id="phone1_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="phone1_2" id="phone1_2" style="width:60px; float: left; margin-right: 10px;">
								<option value="50" <? if (substr($realtor->phone1, 4, 2) == 50) echo "selected"; ?>>50</option>
								<option value="51" <? if (substr($realtor->phone1, 4, 2) == 51) echo "selected"; ?>>51</option>
								<option value="55" <? if (substr($realtor->phone1, 4, 2) == 55) echo "selected"; ?>>55</option>
								<option value="70" <? if (substr($realtor->phone1, 4, 2) == 70) echo "selected"; ?>>70</option>
								<option value="77" <? if (substr($realtor->phone1, 4, 2) == 77) echo "selected"; ?>>77</option>
								<option value="12" <? if (substr($realtor->phone1, 4, 2) == 12) echo "selected"; ?>>12</option>
							</select>
							<input type="text" class="form-control" name="phone1_3" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="phone1_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="phone1_4" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="phone1_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="phone1_5" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="phone1_5" maxlength="2" style="width:40px; float: left;">
						</p>
					</div>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="phone">Дополнительный телефон 2</label>
						<p>
							<input type="text" class="form-control" name="phone2_1" id="phone2_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="phone2_2" id="phone2_2" style="width:60px; float: left; margin-right: 10px;">
								<option value="50" <? if (substr($realtor->phone2, 4, 2) == 50) echo "selected"; ?>>50</option>
								<option value="51" <? if (substr($realtor->phone2, 4, 2) == 51) echo "selected"; ?>>51</option>
								<option value="55" <? if (substr($realtor->phone2, 4, 2) == 55) echo "selected"; ?>>55</option>
								<option value="70" <? if (substr($realtor->phone2, 4, 2) == 70) echo "selected"; ?>>70</option>
								<option value="77" <? if (substr($realtor->phone2, 4, 2) == 77) echo "selected"; ?>>77</option>
								<option value="12" <? if (substr($realtor->phone2, 4, 2) == 12) echo "selected"; ?>>12</option>
							</select>
							<input type="text" class="form-control" name="phone2_3" value="<? echo substr($realtor->phone2, 6, 3); ?>" id="phone2_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="phone2_4" value="<? echo substr($realtor->phone2, 6, 3); ?>" id="phone2_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="phone2_5" value="<? echo substr($realtor->phone2, 6, 3); ?>" id="phone2_5" maxlength="2" style="width:40px; float: left;">
						</p>
					</div>
				<? } else if ($realtor->phone1 != 'NaN') { ?>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="phone">Дополнительный телефон 1</label>
						<p>
							<input type="text" class="form-control" name="phone1_1" id="phone1_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="phone1_2" id="phone1_2" style="width:60px; float: left; margin-right: 10px;">
								<option value="50" <? if (substr($realtor->phone1, 4, 2) == 50) echo "selected"; ?>>50</option>
								<option value="51" <? if (substr($realtor->phone1, 4, 2) == 51) echo "selected"; ?>>51</option>
								<option value="55" <? if (substr($realtor->phone1, 4, 2) == 55) echo "selected"; ?>>55</option>
								<option value="70" <? if (substr($realtor->phone1, 4, 2) == 70) echo "selected"; ?>>70</option>
								<option value="77" <? if (substr($realtor->phone1, 4, 2) == 77) echo "selected"; ?>>77</option>
								<option value="12" <? if (substr($realtor->phone1, 4, 2) == 12) echo "selected"; ?>>12</option>
							</select>
							<input type="text" class="form-control" name="phone1_3" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="phone1_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="phone1_4" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="phone1_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="phone1_5" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="phone1_5" maxlength="2" style="width:40px; float: left;">
						</p>
					</div>
				<? } ?>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="id_serial"><? echo Translations::gi()->id_serial; ?></label>
						<input type="text" class="form-control" name="id_serial" id="id_serial" value="<? echo $realtor->id_serial; ?>" placeholder="<? echo Translations::gi()->id_serial; ?>">
					</div>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="id_pin"><? echo Translations::gi()->id_pin; ?></label>
						<input type="text" class="form-control" name="id_pin" id="id_pin" value="<? echo $realtor->id_pin; ?>" placeholder="<? echo Translations::gi()->id_pin; ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label for="company_name"><? echo Translations::gi()->company_name; ?></label>
						<input type="text" class="form-control" name="company_name" id="company" value="<? echo $realtor->company_name; ?>" placeholder="<? echo Translations::gi()->company_name; ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label for="comment"><? echo Translations::gi()->comment; ?></label>
						<textarea class="form-control" name="comment" id="comment" placeholder="<? echo Translations::gi()->comment; ?>" rows="6"><? echo $realtor->comment; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<button class="btn btn-success" type="submit">Сохранить</button>
					</div>
				</div>
			</form>
		<? } else { ?>
			<form id="needs-validation2" novalidate>
				<input type="hidden" id="logo" value="<? echo $realtor->logo; ?>">
				<input type="hidden" name="id" id="id" value="<? echo $realtor->id; ?>">
				<div class="row">
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="company_name"><? echo Translations::gi()->company_name; ?></label>
						<input type="text" class="form-control" name="company_name" id="company_name" value="<? echo $realtor->company_name; ?>" placeholder="<? echo Translations::gi()->company_name; ?>" required>
					</div>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="company_email">E-mail</label>
						<input type="email" class="form-control" name="company_email" id="company_email" value="<? echo $realtor->email; ?>" placeholder="E-mail" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="company_mobile"><? echo Translations::gi()->mobile; ?></label>
						<p>
							<input type="text" class="form-control" name="company_mobile1" id="company_mobile1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="company_mobile2" id="company_mobile2" style="width:60px; float: left; margin-right: 10px;">
								<option value="50" <? if (substr($realtor->mobile, 4, 2) == 50) echo "selected"; ?>>50</option>
								<option value="51" <? if (substr($realtor->mobile, 4, 2) == 51) echo "selected"; ?>>51</option>
								<option value="55" <? if (substr($realtor->mobile, 4, 2) == 55) echo "selected"; ?>>55</option>
								<option value="70" <? if (substr($realtor->mobile, 4, 2) == 70) echo "selected"; ?>>70</option>
								<option value="77" <? if (substr($realtor->mobile, 4, 2) == 77) echo "selected"; ?>>77</option>
							</select>
							<input type="text" class="form-control" name="company_mobile3" value="<? echo substr($realtor->mobile, 6, 3); ?>" id="company_mobile3" maxlength="3" style="width:48px; float: left; margin-right: 10px;" required>
							<input type="text" class="form-control" name="company_mobile4" value="<? echo substr($realtor->mobile, 9, 2); ?>" id="company_mobile4" maxlength="2" style="width:40px; float: left; margin-right: 10px;" required>
							<input type="text" class="form-control" name="company_mobile5" value="<? echo substr($realtor->mobile, 11, 2); ?>" id="company_mobile5" maxlength="2" style="width:40px; float: left;" required>
						</p>
					</div>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="company_home"><? echo Translations::gi()->home; ?></label>
						<p>
							<input type="text" class="form-control" name="company_home1" id="company_home1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="company_home2" id="company_home2" style="width:60px; float: left; margin-right: 10px;">
								<option value="12" <? if (substr($realtor->home, 4, 2) == 12) echo "selected"; ?>>12</option>
							</select>
							<input type="text" class="form-control" name="company_home3" value="<? echo substr($realtor->home, 6, 3); ?>" id="company_home3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="company_home4" value="<? echo substr($realtor->home, 9, 2); ?>" id="company_home4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="company_home5" value="<? echo substr($realtor->home, 11, 2); ?>" id="company_home5" maxlength="2" style="width:40px; float: left;">
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<a id="company_addphone" style="color:#fff; cursor: pointer;" class="btn btn-sm btn-success" title="Добавить телефон"><i class="fa fa-plus"></i> Добавить телефон</a>
					</div>
				</div>
				<div class="row" id="company_additionalphone" style="margin-bottom: 15px;">
				<? if ($realtor->phone1 != 'NaN' && $realtor->phone2 != 'NaN') { ?>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="phone">Дополнительный телефон 1</label>
						<p>
							<input type="text" class="form-control" name="company_phone1_1" id="company_phone1_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="company_phone1_2" id="company_phone1_2" style="width:60px; float: left; margin-right: 10px;">
								<option value="50" <? if (substr($realtor->phone1, 4, 2) == 50) echo "selected"; ?>>50</option>
								<option value="51" <? if (substr($realtor->phone1, 4, 2) == 51) echo "selected"; ?>>51</option>
								<option value="55" <? if (substr($realtor->phone1, 4, 2) == 55) echo "selected"; ?>>55</option>
								<option value="70" <? if (substr($realtor->phone1, 4, 2) == 70) echo "selected"; ?>>70</option>
								<option value="77" <? if (substr($realtor->phone1, 4, 2) == 77) echo "selected"; ?>>77</option>
								<option value="12" <? if (substr($realtor->phone1, 4, 2) == 12) echo "selected"; ?>>12</option>
							</select>
							<input type="text" class="form-control" name="company_phone1_3" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="company_phone1_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="company_phone1_4" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="company_phone1_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="company_phone1_5" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="company_phone1_5" maxlength="2" style="width:40px; float: left;">
						</p>
					</div>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="phone">Дополнительный телефон 2</label>
						<p>
							<input type="text" class="form-control" name="company_phone2_1" id="company_phone2_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="company_phone2_2" id="company_phone2_2" style="width:60px; float: left; margin-right: 10px;">
								<option value="50" <? if (substr($realtor->phone2, 4, 2) == 50) echo "selected"; ?>>50</option>
								<option value="51" <? if (substr($realtor->phone2, 4, 2) == 51) echo "selected"; ?>>51</option>
								<option value="55" <? if (substr($realtor->phone2, 4, 2) == 55) echo "selected"; ?>>55</option>
								<option value="70" <? if (substr($realtor->phone2, 4, 2) == 70) echo "selected"; ?>>70</option>
								<option value="77" <? if (substr($realtor->phone2, 4, 2) == 77) echo "selected"; ?>>77</option>
								<option value="12" <? if (substr($realtor->phone2, 4, 2) == 12) echo "selected"; ?>>12</option>
							</select>
							<input type="text" class="form-control" name="company_phone2_3" value="<? echo substr($realtor->phone2, 6, 3); ?>" id="company_phone2_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="company_phone2_4" value="<? echo substr($realtor->phone2, 6, 3); ?>" id="company_phone2_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="company_phone2_5" value="<? echo substr($realtor->phone2, 6, 3); ?>" id="company_phone2_5" maxlength="2" style="width:40px; float: left;">
						</p>
					</div>
				<? } else if ($realtor->phone1 != 'NaN') { ?>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="phone">Дополнительный телефон 1</label>
						<p>
							<input type="text" class="form-control" name="company_phone1_1" id="company_phone1_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
							<select class="form-control" name="company_phone1_2" id="company_phone1_2" style="width:60px; float: left; margin-right: 10px;">
								<option value="50" <? if (substr($realtor->phone1, 4, 2) == 50) echo "selected"; ?>>50</option>
								<option value="51" <? if (substr($realtor->phone1, 4, 2) == 51) echo "selected"; ?>>51</option>
								<option value="55" <? if (substr($realtor->phone1, 4, 2) == 55) echo "selected"; ?>>55</option>
								<option value="70" <? if (substr($realtor->phone1, 4, 2) == 70) echo "selected"; ?>>70</option>
								<option value="77" <? if (substr($realtor->phone1, 4, 2) == 77) echo "selected"; ?>>77</option>
								<option value="12" <? if (substr($realtor->phone1, 4, 2) == 12) echo "selected"; ?>>12</option>
							</select>
							<input type="text" class="form-control" name="company_phone1_3" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="company_phone1_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="company_phone1_4" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="company_phone1_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
							<input type="text" class="form-control" name="company_phone1_5" value="<? echo substr($realtor->phone1, 6, 3); ?>" id="company_phone1_5" maxlength="2" style="width:40px; float: left;">
						</p>
					</div>
				<? } ?>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label for="voen">VOEN</label>
						<input type="text" class="form-control" name="voen" id="voen" value="<? echo $realtor->voen; ?>" placeholder="VOEN">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="comment"><? echo Translations::gi()->comment; ?></label>
						<textarea class="form-control" name="company_comment" id="company_comment" placeholder="<? echo Translations::gi()->comment; ?>" rows="6"><? echo $realtor->comment; ?></textarea>
					</div>
					<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<label for="comment"><? echo Translations::gi()->about; ?></label>
						<textarea class="form-control" name="about" id="about" placeholder="<? echo Translations::gi()->about; ?>" rows="6"><? echo $realtor->about; ?></textarea>
					</div>
				</div>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12">
					<div id="object-photo" class="dropzone"></div>
				</div>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images row">
				</div>
				<div class="row">
					<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<button class="btn btn-success" type="submit"><? echo Translations::gi()->save; ?></button>
					</div>
				</div>
			</form>
		<? } ?>
		</div>
	</div>
	<script>
		Dropzone.autoDiscover = false;
		jQuery("#object-photo").dropzone({
			url: '/materials/temp/dropzone.php?session_id=<?php echo session_id(); ?>',
			acceptedFiles: 'image/*',
			timeout: 1000000,
			method: "post",
			success: function (file, response) {
				file.previewElement.classList.add("dz-success");
				name = response;
				$("#logo").val(name);
				$('.images').html('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + name + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button></div>');
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
		$(function(){
			<? if ($realtor->phone1 != 'NaN' && $realtor->phone2 != 'NaN') { ?>
				var phone = 3;
			<? } else if ($realtor->phone1 != 'NaN') { ?>
				var phone = 2;
			<? } else { ?>
				var phone = 1;
			<? } ?>
			$("#addphone").on('click', function() {
				if (phone < 3) {
					$("#additionalphone").append('<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6"><label for="phone">Дополнительный телефон ' + phone + '</label><p><input type="text" class="form-control" name="phone' + phone + '_1" id="phone' + phone + '_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled><select class="form-control" name="phone' + phone + '_2" id="phone' + phone + '_2" style="width:60px; float: left; margin-right: 10px;"><option value="50">50</option><option value="51">51</option><option value="55">55</option><option value="70">70</option><option value="77">77</option><option value="12">12</option></select><input type="text" class="form-control" name="phone' + phone + '_3" id="phone' + phone + '_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;"><input type="text" class="form-control" name="phone' + phone + '_4" id="phone' + phone + '_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;"><input type="text" class="form-control" name="phone' + phone + '_5" id="phone' + phone + '_5" maxlength="2" style="width:40px; float: left;"></p></div>');
					phone++;
				}
			});
			<? if ($realtor->phone1 != 'NaN' && $realtor->phone2 != 'NaN') { ?>
				var company_phone = 3;
			<? } else if ($realtor->phone1 != 'NaN') { ?>
				var company_phone = 2;
			<? } else { ?>
				var company_phone = 1;
			<? } ?>
			$("#company_addphone").on('click', function() {
				if (company_phone < 3) {
					$("#company_additionalphone").append('<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6"><label for="company_phone">Дополнительный телефон ' + company_phone + '</label><p><input type="text" class="form-control" name="company_phone' + company_phone + '_1" id="company_phone' + company_phone + '_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled><select class="form-control" name="company_phone' + company_phone + '_2" id="company_phone' + company_phone + '_2" style="width:60px; float: left; margin-right: 10px;"><option value="50">50</option><option value="51">51</option><option value="55">55</option><option value="70">70</option><option value="77">77</option><option value="12">12</option></select><input type="text" class="form-control" name="company_phone' + company_phone + '_3" id="company_phone' + company_phone + '_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;"><input type="text" class="form-control" name="company_phone' + company_phone + '_4" id="company_phone' + company_phone + '_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;"><input type="text" class="form-control" name="company_phone' + company_phone + '_5" id="company_phone' + company_phone + '_5" maxlength="2" style="width:40px; float: left;"></p></div>');
					company_phone++;
				}
			});
			images = $('#logo').val();
			if (images != '')
			{
				$('.images').html('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button></div>');
			}
			$(document).on('click', '.delete', function(){
				$(this).parent().remove();
				$("#logo").val('');
			});
			$("#needs-validation").on('submit', function(event){
				if ($("#needs-validation")[0].checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					$.ajax({
						url: '/remart/save_realtor',
						method: 'post',
						dataType: 'json',
						data: {
							id: $('#id').val(),
							name: $('#name').val(),
							surname: $('#surname').val(),
							patronymic: $('#patronymic').val(),
							email: $('#email').val(),
							birthday: $('#birthday').val(),
							mobile: $('#mobile1').val() + $('#mobile2').val() + $('#mobile3').val() + $('#mobile4').val() + $('#mobile5').val(),
							home: $('#home1').val() + $('#home2').val() + $('#home3').val() + $('#home4').val() + $('#home5').val(),
							phone1: $('#phone1_1').val() + $('#phone1_2').val() + $('#phone1_3').val() + $('#phone1_4').val() + $('#phone1_5').val(),
							phone2: $('#phone2_1').val() + $('#phone2_2').val() + $('#phone2_3').val() + $('#phone2_4').val() + $('#phone2_5').val(),
							id_serial: $('#id_serial').val(),
							id_pin: $('#id_pin').val(),
							company_name: $('#company').val(),
							company: 0,
							logo: '',
							about: '',
							voen: '',
							comment: $('#comment').val()
						},
						success: function(data)
						{
							if (data == true) 
							{
								alert('<? echo Translations::gi()->edit_realtor_success; ?>');
								window.location = '/dashboard';
							}
							else
							{
								alert('<? echo Translations::gi()->edit_realtor_error; ?>');
							}
						},
						error: function(data)
						{
							console.log(data);
						}
					});
				}
				$("#needs-validation").addClass("was-validated");
				return false;
			});
			
			$("#needs-validation2").on('submit', function(event){
				if ($("#needs-validation2")[0].checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					$.ajax({
						url: '/remart/save_realtor',
						method: 'post',
						dataType: 'json',
						data: {
							id: $('#id').val(),
							company_name: $('#company_name').val(),
							company: 1,
							email: $('#company_email').val(),
							mobile: $('#company_mobile1').val() + $('#company_mobile2').val() + $('#company_mobile3').val() + $('#company_mobile4').val() + $('#company_mobile5').val(),
							home: $('#company_home1').val() + $('#company_home2').val() + $('#company_home3').val() + $('#company_home4').val() + $('#company_home5').val(),
							phone1: $('#company_phone1_1').val() + $('#company_phone1_2').val() + $('#company_phone1_3').val() + $('#company_phone1_4').val() + $('#company_phone1_5').val(),
							phone2: $('#company_phone2_1').val() + $('#company_phone2_2').val() + $('#company_phone2_3').val() + $('#company_phone2_4').val() + $('#company_phone2_5').val(),
							comment: $('#company_comment').val(),
							about: $('#about').val(),
							logo: $('#logo').val(),
							voen: $('#voen').val(),
							name: '',
							surname: '',
							patronymic: '',
							birthday: '',
							id_serial: '',
							id_pin: ''
						},
						success: function(data)
						{
							if (data == true) 
							{
								alert('<? echo Translations::gi()->edit_realtor_cm_success; ?>');
								window.location = '/dashboard';
							}
							else
							{
								alert('<? echo Translations::gi()->edit_realtor_cm_error; ?>');
							}
						},
						error: function(data)
						{
							console.log(data);
						}
					});
				}
				$("#needs-validation2").addClass("was-validated");
				return false;
			});
		});
</script>
</div>
<style>
</style>