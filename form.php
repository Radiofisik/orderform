 <?php
 $purl=plugins_url();
 ?>
 <script>
 var purl =" <?php echo $purl; ?>";
 </script>

 
 <div class="row">
	<div class="col-sm-10 col-md-offset-1">
	<h3>Для заказа заполните форму</h3>
		<form class="form-horizontal" role="form" id="mainform" action="<?php echo $purl."/orderform/form_processing.php";?>" method="post">
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="FIO">Ваше имя</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="FIO" name="FIO" placeholder="Фамилия Имя Отчество" pattern="^([а-яА-ЯёЁ]{1,50}\s{0,1}){1,3}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Organization">Организация</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Organization" name="Organization" placeholder="ООО &quot;Компания&quot;" pattern="^.{3,512}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="BIK">БИК</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="BIK" name="BIK" placeholder="000000000" pattern="^[0-9]{9}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="INN">ИНН</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="INN" name="INN" placeholder="000000000000" pattern="^[0-9]{10,12}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Schet">Р/С</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Schet" name="Schet" placeholder="00000000000000000000" pattern="^\d{20}$">
			</div>
		  </div>
		  <div class="form-group" >
			<label class="col-sm-2 control-label" for="Comment">Комментарий</label>
			<div class="col-sm-10">
			  <textarea class="form-control" rows="3" name="Comment" pettertn="^.{0,512}$"></textarea> 
			</div>
		  </div>
		  
		  
		 		  
		  
		  <div id="cont">
		  <div class="prod">
			  <div class="form-group ">
				<label class="col-sm-2 control-label" for="Product">Продукт</label>
				<div class="col-sm-4">
					<select class="form-control" name="Product1">
					  <option>Vipnet client</option>
					   <option>VipNet coordinator HW1000</option>
					  <option>Другие продукты Vipnet</option>
					</select>
				</div>
				<label class="col-sm-2 control-label" for="Quantity" value="1">Количество</label>
				<div class="col-sm-2">
					<input class="form-control Quantity" type="text"  name="Quantity1" placeholder="1" pattern="^\d{1,3}$">
				</div>
				<div class="col-md-2">
				<div class="btn-group">
					<button type="button" class="btn btn-default addbtn">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
					<button type="button" class="btn btn-default delbtn">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</div>
				</div>
			  </div>
		  </div>
		  </div>
		  
		  
		  <div class="col-sm-offset-2" id='output'></div>
		  <div class="col-sm-offset-2">
		  	  <button type="submit" class="btn btn-primary btn-lg btn-block">Отправить</button>
		  </div>
		  
		  
		  
		  
		  		  
		</form>
	
    
    </div>
  </div>

