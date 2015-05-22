
������ ������������ ��� ������������ ������ ��� ������� ������ ����� � ���������.
�������� �� ���������� ��������:
	- ������� ���������� ��� ���������� screen|mobile;
	- � ����������� �� ����, ���������� ������ css ����, ������� �������� � ������� ��� �������� �� ��������� css/screen|mobile;
	- ��� ������ ������������� � ������;
	- ��������� css ���� � ������� ��� ������� � ��������� �������������� ��������� header('Content-type: text/css');
	- ���� ������������ ����������� ������, ����� �������������� �������������� ������ ����� � ��� �� ��� ����� ������������� � ������;
	- ������ ������ ������, ����� ��������� path_to/dynamiccss/index-test.php;

�����������:
1. ��� �����������, ���������� ������� ������ � ��������� ��������� �������.;
2. ��������� ���� � ����� css ������ � ���������������� ����� dynamic_css_conf.php;
	3.1 ���� ����������, �� �� ������ ������� ������ � ����� ����� ������������, �� ��� ���� ����� ����� ������� ���������� ���� � ���� � ����� dynamicoutput.css.php � ���������� $config_path = 'your_path/dynamic_css_conf.php';
4. ���� ������ �� ������ ������ ����, ��� �� �� ������� � dynamic_css_conf.php ���� � ����� �� ������ ������, ����� �� ��������� ����� ���������� css/mobile.css �/��� css/screen.css. �� ������ ������������ ��� ����� ��� ����������� ����� ������.;
5. � ������� ���������� �������� ���� ��� <meta name="viewport" content="width=device-width, initial-scale=1.0">;
6. ��� �� ��������� ������ �� ��� ������������ css ���� <link rel="stylesheet" type="text/css" href="path_to/dynamiccss/dynamicoutput.css.php?get_css" />
7. � ��� �����, ��� �� ������ ������ ������ ������������ ������, ����� �������� ��������� ���:

		<a href="path_to/dynamiccss/dynamicoutput.css.php?user_choice" id="dynamic_css"></a>
		<script src="path_to/dynamiccss/dynamicoutput.css.php?get_js"></script>
		
		����������� script ������ ���������� ����� ������! 

#######################################
������ ������� ��� ������������� ������:

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

