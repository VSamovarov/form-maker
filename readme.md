//Удобное написание форм
//В form-builder.php - автозагрузщик

$f = new VSamFormBulder\FormBuilder;

### Opening a Form
// <form method="POST">
$f->open(); 
$f->star(); 

// <form method="GET">
$f->open()->get();

// <form method="POST" action="/test">
$f->open()->action('/test');

//<form method="POST" action="" enctype="multipart/form-data"
$f->open()->multipart();

### Атрибуты
// <input type="text" name="proba" value="Проба" placeholder="Введите значение" disabled="disabled">
$attr = ['type'=>'text','name'=>"proba","placeholder"=>"Введите значение",'disabled'=>"disabled"]
$f->input($attr)->value("Проба");

//<input type="text" name="proba" placeholder="Введите значение" disabled="disabled">
$f->text('proba')->addAttr(["placeholder"=>"Введите значение",'disabled'=>"disabled"])


//<input type="text" name="proba" data-cop-lol="ура" data-pro-pro="pot">
$f->text('proba')->addData(["cop-lol"=>"ура",'pro-pro'=>"pot"])

//<input type="text" name="proba" v.cop-lol="ура" v.pro-pro="pot">
$f->text('proba')->addData(["cop-lol"=>"ура",'pro-pro'=>"pot"],'v','.')

// <input type="text" name="proba">
$f->text('proba');

// <input type="text" name="proba" value="Вверх" placeholder="Введите значение" disabled="disabled">
$f->text('proba')->value('Вверх')->placeholder('Введите значение')->disabled();

//<input tel="text" name="proba[]" pattern="[0-9./()\s-]+" value="068-354-34-34" required="required">
$f->tel('proba[]')->value('068-354-34-34')->required();

### Textarea
//<textarea name="proba">dddddddddddddddddd</textarea>
$f->textarea('proba')->text('dddddddddddddddddd');

### Button
//<button name="proba" type="submit"><span>*</span>Вперед</button>
$f->button('proba')->text('<span>*</span>Вперед');

//<button name="proba" type="reset"><span>*</span>Вперед</button>
$f->button('proba')->text('<span>*</span>Вперед')->reset();

### Select
//<select name="proba"><option value='0'>проба1</option><option value='1'>проба2</option><option value='2'>проба3</option></select>
$f->select('proba',['проба1', 'проба2', 'проба3']);

//<select name="proba_name">
//	<option value='proba1'>проба1</option>
//	<option value='proba2'>проба2</option>
//	<option value='proba3'>проба3</option>
//</select>
$f->select('proba_name',['proba1'=>'проба1', 'proba2'=>'проба2', 'proba3'=>'проба3']);


//<select name="proba_name" multiple="multiple">
//	<option value='proba1' label="пр" selected="selected">проба1</option>
//	<option value='proba2' disabled="disabled">проба2</option>
//	<option value='proba3'>проба3</option>
//</select>

$value = [
			['value'=>'proba1','label'=>'пр','selected'],
			['value'=>'proba2','disabled'],
			['value'=>'proba3'],
		];
$f->select('proba_name',$value)->multiple();

или 
$attr = ['name'=>"proba_name","multiple"=>"multiple"]

$f->select($attr,$value)->multiple();


### Select - группы

$value = [
			[
				'label'=>'GrouName1',
				'disabled'=>'disabled',
				'option'=>[
						['value'=>'proba1','label'=>'пр','selected'],
						['value'=>'proba2','disabled'],
						['value'=>'proba3']
					]
			],
			[
				'label'=>'GrouName1',
				'option'=>[1,2,3,4]
			], ...
		];

$f->select('proba_name',$value)->multiple();

### Wrapper

//<label class="wrapper usname">
//	<div class="name">ФИО</div>
//	<input type="text" name="usname" value="">
//	<div class="help">Имя</div>
//</label>

//Класс к label генерится из атрибута name
$f->text('usname')->labelWrapper('ФИО')->help('Имя')->error();	

//Параметр ошибка (error) перекрывает помощь (help)
//<label class="wrapper usname">
//	<div class="name">ФИО</div>
//	<input type="text" name="usname" value="">
//	<div class="help error">Ошибка!</div>
//</label>

$f->text('usname')->labelWrapper('ФИО')->help('Имя')->error('Ошибка!');	

//Пустые параметры игнорируются	
//	<input type="text" name="usname" value="">
//	<div class="help">Имя</div>
$f->text('usname')->labelWrapper()->help('Имя')->error();	

