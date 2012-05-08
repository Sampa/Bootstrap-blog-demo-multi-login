/**
* Ajax CRUD  Administration
*
*
* @author Spiros Kabasakalis <kabasakalis@gmail.com>,myspace.com/spiroskabasakalis,reverbnation/spiroskabasakalis
* @copyright Copyright &copy; 2011 Spiros Kabasakalis
* @since 1.0
* @version 1.3
* @license The MIT License
*/
   OVERVIEW 
   I always thought that the navigation in the view files that the default gii CRUD generator creates is too complex.
   This CRUD gii template generates a single Administration page with a CGridView.Update/Create forms and model details view are rendered in a Fancybox Window
    and deletions go through a confirmation dialog (jUI).The form works with client validation(given that your model validation rules are included in the rules supported by the current  Yii client validation).You can switch to Ajax Validation simply by setting the relevant option in CActiveForm instantiation in _ajax_form file,and uncommenting the performAjaxValidation call in ReturnForm action of the controller. 
	 	DEMO ONLINE
	 http://libkal.gr/yii_lab/myproduct
	 
	 
	 INSTALLATION
	 1.Hide index.php from your requests,if you have'nt done so yet.You can find detailed instructions on how to do this here.(Paragraph 6)
	     http://www.yiiframework.com/doc/guide/1.1/en/topics.url
	   Also,in urlManager configuration in config/main.php file set
	 'urlFormat'=>'path',
     'showScriptName'=>false,
	 2.   Unzip the downloaded file.
	       Copy the gii folder to your application's protected folder.
	       Copy the js_plugins folder  to the root folder of your application,(same level as protected).
	3.In config/main.php file,in gii configuration, add the path of  your gii folder like so:
	
	'modules'=>array(
	  ......
	      'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                    	'generatorPaths' => array(
                        'application.gii'  //Ajax Crud template path
		     ),
		),
		
		.......
	)
	
	
	
	 USAGE
	 
	 1.Create the table for your model  in the database:
	 2.Navigate to gii page ([application root]/gii).
	      Click Model Generator.
	      Type the table name in the Table Name field.
	      Preview if you want,and then Generate.
		  Your Model class has been generated.
	3.      Click Crud Generator
		     In the Model Class field type the name of the class that was generated in the previous step.
			 Click Code template and select ajax_crud,if it's not already selected.
			 Preview if you want,and then Generate.
    4.  This is it.Navigate to the Administration page:go to [application root]/[controller ID]/
		    You should see the administration page and you are ready to perform CRUD operations on the model.
			 
	 
	 
	RESOURCES

- [jQuery Form Plugin](http://www.malsup.com/jquery/form/ "")	
- [Fancybox](http://fancybox.net/ "")
- [Fancybox2](http://fancyapps.com/fancybox/ "")  //Read the licence for fancybox 2.
- [jQuery UI](http://jqueryui.com/ "")
	



CHANGE LOG

1.3 December 11th 2011.
Form submission is now handled by jQuery Form Plugin (see resources).
This has the advantage that you can include a file field in your form,and it will be submitted
without a page refresh,although this is not technically ajax,(as the XHR object cannot handle this task).
For more information see  online jQuery Form Plugin documentation.

'afterAjaxUpdate' callback of CGridView now does not duplicate the code declared in the script tag.
It just calls a js function declared in the script tag so unnecesssary code repetition has been eliminated.

Fancybox 2 is now used for the form rendering.Please see the licence for fancybox2 online.(resources).


1.2(Deprecated)
1.1 
Made some changes so that the application root folder is not hardcoded in URLs,in generated views and controller.
Now generated code is valid in local and production enviroment as well,without the need to manually change the URLs.
Thanks to Asgaroth for pointing this out to me.

Cheers!
Spiros "drumaddict" Kabasakalis,November 9th 2011.
	 
	 