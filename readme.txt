
The module is designed to switch styles for desktop and mobile version of the site.
It works on the following principle:
	- first determines the type of device screen | mobile;
	- depending on the type, it loads the appropriate css file, which is registered in the configuration of the default or vyberaem css/screen|mobile;
	- these data are written in the session;
	- It reads the css file and displays it to the client sending the appropriate headers. header('Content-type: text/css');
	- if the user switches version, then takes an alternative version of the file and also his choice is recorded in the session;
	- an example of the module can be viewed path_to/dynamiccss/index-test.php;

Hook up:
1. To connect, you must put the module into an available public catalog.;
2. To register the path to your css files in the configuration file dynamic_css_conf.php;
	3.1 If necessary, you can make configuration to a shared folder with configs, but it will need to specify the absolute path to the file in the variable dynamicoutput.css.php $config_path = 'your_path/dynamic_css_conf.php';
4. If the module config file not found or you do not specify in dynamic_css_conf.php way to one of the versions of styles, then by default loading css/mobile.css и/или css/screen.css. You can use these files to define your style.;
5. The main site template, you must add a meta tag <meta name="viewport" content="width=device-width, initial-scale=1.0">;
6. You also need to add a link to our dynamic css file <link rel="stylesheet" type="text/css" href="path_to/dynamiccss/dynamicoutput.css.php?get_css" />
7. In the place where you want to see a link switching versions to insert the following code:

		<a href="path_to/dynamiccss/dynamicoutput.css.php?user_choice" id="dynamic_css"></a>
		<script src="path_to/dynamiccss/dynamicoutput.css.php?get_js"></script>
		
		Required script must be after the link!

#######################################
Template examples like the use of modules:

<!DOCTYPE html>
<html>
<head> 

	<!-- viewport --><meta name="viewport" content="width=device-width, initial-scale=1.0">	

	<!-- dynamic css --><link rel="stylesheet" type="text/css" href="path_to/dynamiccss/dynamicoutput.css.php?get_css" />	

	<meta charset="utf-8">

	<title>An example of using dynamic css</title>

</head>
 
<body>

    <div class="menu">
		<h1 id="mobile">Mobile version of the site</h1>
		<h1 id="desctop">The desktop version of the site</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque condimentum tempor est in tristique. Ut et blandit metus. Nullam est odio, auctor et molestie ac, molestie vitae purus. Nullam sit amet tempor nulla, quis bibendum nunc. Morbi nec dolor diam. Nulla facilisi. Nullam eu metus elit. In magna neque, placerat sit amet tristique vitae, posuere at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam non nibh lorem. Morbi id pretium metus, ac ultricies quam. Donec risus sem, congue ac viverra a, varius at diam. Curabitur imperdiet nec massa in luctus.</p>

		<p>Morbi at enim fringilla, aliquet ipsum sit amet, fermentum erat. Maecenas est ex, ullamcorper nec diam vel, finibus iaculis odio. Morbi eleifend, orci nec lacinia pulvinar, mauris arcu venenatis diam, ac molestie urna magna at leo. Mauris eget dapibus diam, a tincidunt elit. Quisque accumsan enim ac dictum eleifend. Mauris posuere ante velit, eu tempor nibh dictum vulputate. Etiam fermentum libero ac dui sodales, non feugiat lorem sodales.</p>
    </div>
	
	<!-- dynamic css link -->
		<a href="path_to/dynamiccss/dynamicoutput.css.php?user_choice" id="dynamic_css"></a>
		<script src="path_to/dynamiccss/dynamicoutput.css.php?get_js"></script>
	<!-- end dynamic css link -->	

</body>
</html>

