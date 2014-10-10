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
		
		<br/>
		<h4>Организация</h4> <hr/>
			<div class="form-group">
			<label class="col-sm-2 control-label" for="Organizationfull">Полное наименование</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Organizationfull" name="Organizationfull" placeholder="Общество с ограниченной ответственностью &quot;Компания&quot;" pattern="^.{3,512}$">
			</div>
		  </div>
			<div class="form-group">
			<label class="col-sm-2 control-label" for="Organizationshort">Краткое наименование по уставу</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Organizationshort" name="Organizationshort" placeholder="ООО &quot;Компания&quot;" pattern="^.{3,512}$">
			</div>
		  </div>
		  
		 <h4>Руководитель</h4> <hr/>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="FIOdir">ФИО</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="FIOdir" name="FIOdir" placeholder="Фамилия Имя Отчество" pattern="^([а-яА-ЯёЁ]{1,50}\s{0,1}){1,3}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Positiondir">Должность</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Positiondir" name="Positiondir" placeholder="Должность" pattern="^.{3,100}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Reasondir">Основание полномочий</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Reasondir" name="Reasondir" placeholder="Устава, доверенности и т.п." pattern="^.{3,100}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Phonedir">Телефон</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Phonedir" name="Phonedir" placeholder="Телефон" pattern="^(\d|\W){6,20}$">
			</div>
		  </div>
		  
		  <h4>Контактное лицо</h4><hr/>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="FIOcont">ФИО</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="FIOcont" name="FIOcont" placeholder="Фамилия Имя Отчество" pattern="^([а-яА-ЯёЁ]{1,50}\s{0,1}){1,3}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Positioncont">Должность</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Positioncont" name="Positioncont" placeholder="Должность" pattern="^.{3,100}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Phonecont">Телефон</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Phonecont" name="Phonecont" placeholder="Телефон" pattern="^(\d|\W){6,20}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Email">E-mail</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Email" name="Email" placeholder="xxx@yyy.zzz" pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$">
			</div>
		  </div>
		  
		  <h4>Реквизиты</h4><hr/>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="INN">ИНН</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="INN" name="INN" placeholder="000000000000" pattern="^[0-9]{10,12}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="KPP">КПП</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="KPP" name="KPP" placeholder="000000000" pattern="^\d{9}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="OGRN">ОГРН</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="OGRN" name="OGRN" placeholder="0000000000000" pattern="^\d{13,15}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Schet">Р/С</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Schet" name="Schet" placeholder="00000000000000000000" pattern="^\d{20}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Korrschet">Корреспондентский / лицевой счет</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Korrschet" name="Korrschet" placeholder="00000000000000000000" pattern="^\d{20}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="BIK">БИК</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="BIK" name="BIK" placeholder="000000000" pattern="^[0-9]{9}$">
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Bankname">Полное наименование банка</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Bankname" name="Bankname" placeholder="Акционерный коммерческий банк «Банк» " pattern="^.{3,512}$">
			</div>
		  </div>
		  
		  <h4>Местоположение</h4><hr/>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="Addrlegal">Юридический адрес</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Addrlegal" name="Addrlegal" placeholder="Юридический адрес" pattern="^.{3,512}$">
			</div>
		  </div>
			<div class="form-group">
			<label class="col-sm-2 control-label" for="Addrfact">Фактический адрес</label>
			<div class="col-sm-10">
			  <input class="form-control" type="text" id="Addrfact" name="Addrfact" placeholder="Фактический адрес" pattern="^.{3,512}$">
			</div>
		  </div>
		  
		  <br/>
		  <div class="form-group" >
			<label class="col-sm-2 control-label" for="Comment">Комментарий</label>
			<div class="col-sm-10">
			  <textarea class="form-control" rows="3" name="Comment" pettertn="^.{0,512}$"></textarea> 
			</div>
		  </div>
		  
		  
		 		  
		   <br/>
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

