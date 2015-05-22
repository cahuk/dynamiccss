
Модуль предназначен для переключения стилей для обичной версии сайта и мобильной.
Работает по следующему принципу:
	- сначала определяет тип устройства screen|mobile;
	- в зависимости от типа, подгружает нужный css файл, который прописан в конфиге или выберает из дефолтных css/screen|mobile;
	- эти данные записываютсья в сессию;
	- считывает css файл и выводит его клиенту с отправкой соответвенного заголовка header('Content-type: text/css');
	- если пользователь переключает версию, тогда подтягиваеться альтернативная версия файла и так же его выбор записываеться в сессию;
	- пример работы модуля, можно проверить path_to/dynamiccss/index-test.php;

Подключение:
1. Для подключения, необходимо занести модуль в доступный публичный каталог.;
2. Прописать пути к вашим css файлам в конфигурационном файле dynamic_css_conf.php;
	3.1 Если необходимо, то Вы можете вынести конфиг в общую папку конфигруаций, но при этом нужно будет указать абсолютный путь к нему в файле dynamicoutput.css.php в переменной $config_path = 'your_path/dynamic_css_conf.php';
4. Если модуль не найдет конфиг файл, или Вы не укажите в dynamic_css_conf.php путь к одной из версий стилей, тогда по умолчанию будут подгружены css/mobile.css и/или css/screen.css. Вы можете использовать эти файлы для определения своих стилей.;
5. В шаблоне необходимо добавить мета тег <meta name="viewport" content="width=device-width, initial-scale=1.0">;
6. Так же добавляем ссылку на наш динамический css файл <link rel="stylesheet" type="text/css" href="path_to/dynamiccss/dynamicoutput.css.php?get_css" />
7. В том месте, где вы хотите видеть ссылку переключения версий, нужно вставить следующий код:

		<a href="path_to/dynamiccss/dynamicoutput.css.php?user_choice" id="dynamic_css"></a>
		<script src="path_to/dynamiccss/dynamicoutput.css.php?get_js"></script>
		
		Обязательно script должен находиться после ссылки! 

#######################################
ПРИМЕР ШАБЛОНА ДЛЯ ИСПОЛЬЗОВАНИЯ МОДУЛЯ:

<!DOCTYPE html>
<html>
 <head>
 
	<!-- viewport -->
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- viewport -->
	
	
    <!--  dynamic css  -->
		<link rel="stylesheet" type="text/css" href="path_to/dynamiccss/dynamicoutput.css.php?get_css" />
	<!--  dynamic css -->


    <meta charset="utf-8">
    <title>An example of using dynamic css</title>
 </head>
 
<body>
    <div class="menu">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque condimentum tempor est in tristique. Ut et blandit metus. Nullam est odio, auctor et molestie ac, molestie vitae purus. Nullam sit amet tempor nulla, quis bibendum nunc. Morbi nec dolor diam. Nulla facilisi. Nullam eu metus elit. In magna neque, placerat sit amet tristique vitae, posuere at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam non nibh lorem. Morbi id pretium metus, ac ultricies quam. Donec risus sem, congue ac viverra a, varius at diam. Curabitur imperdiet nec massa in luctus.</p>

      <p>Morbi at enim fringilla, aliquet ipsum sit amet, fermentum erat. Maecenas est ex, ullamcorper nec diam vel, finibus iaculis odio. Morbi eleifend, orci nec lacinia pulvinar, mauris arcu venenatis diam, ac molestie urna magna at leo. Mauris eget dapibus diam, a tincidunt elit. Quisque accumsan enim ac dictum eleifend. Mauris posuere ante velit, eu tempor nibh dictum vulputate. Etiam fermentum libero ac dui sodales, non feugiat lorem sodales.</p>
    </div>

	
	<!-- dynamic.css -->
			<a href="path_to/dynamiccss/dynamicoutput.css.php?user_choice" id="dynamic_css"></a>
			<script src="path_to/dynamiccss/dynamicoutput.css.php?get_js"></script>
	<!-- end dynamic.css -->	
	

</body>
</html>

