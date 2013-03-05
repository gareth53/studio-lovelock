<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Alignment
	$button_color = array("blue" => "Blue", "green" => "Green", "orange" => "Orange", "gray" => "Gray", "purple" => "Purple");
	
	// Backgrounds
	$bg_array = array("white" => "White","dark" => "Dark");
	
	// Slider Autplay
	$slider_array = array("false" => "Static","true" => "Autoplay");
	
	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
		
	$options = array();
	
	// Basic Settings Tab
		
	$options[] = array( "name" => __('Basic Settings', okay), 
						"type" => "heading");
						
	$options[] = array( 'name' => __('Logo Upload', okay),
						"desc" => __('Upload your image to use in the header.', okay),
						"id" => "of_logo",
						"type" => "upload");
						
	$options[] = array( "name" => __('Background Color', okay),
						"desc" => __('Choose a light or dark background.', okay),
						"id" => "of_bg_color",
						"type" => "select",
						"options" => $bg_array);	
	
	$options[] = array( "name" => __('Link Color', okay),
						"desc" => __('Select the color you would like your links to be. The demo site uses #60BDDB.', okay),
						"id" => "of_colorpicker",
						"std" => "#60BDDB",
						"type" => "color");				
						
	$options[] = array( "name" => __('Slider Autoplay', okay),
						"desc" => __('Please select whether you would like sliders to autoplay or not', okay),
						"id" => "of_slider_autoplay",
						"type" => "select",
						"std" => "false",
						"options" => $slider_array);															 						
						
	$options[] = array( "name" => __('Homepage Large Slider Category', okay),
						"desc" => __('Please select the category to populate the slider on the homepage.', okay),
						"id" => "of_slider_cat",
						"type" => "select",
						"options" => $options_categories);	
	
	$options[] = array( "name" => __('Blog Category', okay),
						"desc" => __('Please select the category that contains your Blog posts. This category will populate the Blog page.', okay),
						"id" => "of_blog_cat",
						"type" => "select",
						"options" => $options_categories);	
						
	$options[] = array( "name" => __('Portfolio Category', okay),
						"desc" => __('Please select the category that contains your Portfolio posts. This category will populate the Portfolio section of the homepage and the portfolio page.', okay),
						"id" => "of_portfolio_cat",
						"type" => "select",
						"options" => $options_categories);
	
	$options[] = array( "name" => __('Hidden Header Text', okay),
						"desc" => __('Text for the hidden area in the header.', okay),
						"id" => "of_hidden_header_text",
						"std" => "",
						"type" => "textarea"); 		
						
	$options[] = array( "name" => __('Portfolio Page Text', okay),
						"desc" => __('Text for the area under the big image on the portfolio page.', okay),
						"id" => "of_portfolio_text",
						"std" => "",
						"type" => "textarea"); 							
						
	$options[] = array( "name" => __('Tracking Code', 'okay'),
						"desc" => __('Put your Google Analytics or other tracking code here.', 'okay'),
						"id" => "of_tracking_code",
						"std" => "",
						"type" => "textarea"); 		
						
	// Homepage Settings Tab
	
	$options[] = array( "name" => __('Homepage', okay), 
						"type" => "heading");						
						
	$options[] = array( "name" => __('Homepage Header Text', okay), 
						"desc" => __('Text for the large centered titles on the homepage header.', okay),
						"id" => "of_header_text",
						"std" => "",
						"type" => "textarea");
						
	$options[] = array( "name" => __('Services Title', okay),
						"desc" => __('Title for the ribbon above the Services (textbox) section on the homepage.', okay),
						"id" => "of_services_title",
						"std" => "Services",
						"type" => "text");
						
	$options[] = array( "name" => __('Portfolio Title', okay),
						"desc" => __('Title for the ribbon above the Portfolio section on the homepage.', okay),
						"id" => "of_portfolio_title",
						"std" => "Portfolio",
						"type" => "text");
						
	$options[] = array( "name" => __('Blog Title', okay),
						"desc" => __('Title for the ribbon above the Blog section on the homepage.', okay),
						"id" => "of_blog_title",
						"std" => "Blog",
						"type" => "text");	
						
	$options[] = array( "name" => __('Testimonials Title', okay),
						"desc" => __('Title for the ribbon above the Testimonials section on the homepage.', okay),
						"id" => "of_testimonials_title",
						"std" => "Testimonials",
						"type" => "text");																																																						
	// Social Icons Tab
						
	$options[] = array( "name" => __('Social Media Links', okay),
						"type" => "heading");															
	
	$options[] = array( "name" => __('Twitter URL', okay),
						"desc" => __('Enter the full url to your Twitter profile.', okay),
						"id" => "twitter_icon",
						"std" => "",
						"type" => "text");	
						
	$options[] = array( "name" => __('Google+ URL', okay),
						"desc" => __('Enter the full url to your Google+ profile.', okay),
						"id" => "google_icon",
						"std" => "",
						"type" => "text");	
	
	$options[] = array( "name" => __('Dribbble URL', okay),
						"desc" => __('Enter the full url to your Dribbble profile.', okay),
						"id" => "dribbble_icon",
						"std" => "",
						"type" => "text");											
						
	$options[] = array( "name" => __('Vimeo URL', okay),
						"desc" => __('Enter the full url to your Vimeo profile.', okay),
						"id" => "vimeo_icon",
						"std" => "",
						"type" => "text");						
	
	$options[] = array( "name" => __('Facebook URL', okay),
						"desc" => __('Enter the full url to your Facebook profile.', okay),
						"id" => "facebook_icon",
						"std" => "",
						"type" => "text");	
						
	$options[] = array( "name" => __('Flickr URL', okay),
						"desc" => __('Enter the full url to your Flickr profile.', okay),
						"id" => "flickr_icon",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Tumblr URL', okay),
						"desc" => __('Enter the full url to your Tumblr profile.', okay),
						"id" => "tumblr_icon",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('LinkedIn URL', okay),
						"desc" => __('Enter the full url to your LinkedIn profile.', okay),
						"id" => "linkedin_icon",
						"std" => "",
						"type" => "text");		
						
	// ------------- Custom CSS Tab  ------------- //
	
	$options[] = array( "name" => "Custom CSS",
						"type" => "heading");
	
	$options[] = array( "name" => __('Custom CSS', 'okay'),
						"desc" => __('If you would like to make styling modifications, you can do that here. Doing it here will prevent your modifications from being overwritten if/when you update the theme.', 'okay'),
						"id" => "of_theme_css",
						"std" => "",
						"type" => "textarea"); 						
						
	
	// ------------- Okay Themes Tab  ------------- //
						
	$options[] = array( "name" => "Support",
						"type" => "heading");								
	
	$options[] = array( "name" => __('Theme Documentation & Support', 'okay'),
						"desc" => "<p class='okay-text'>Theme support and documentation is available for all customers. Visit <a target='blank' href='http://okaythemes.com/support'>Okay Themes Support Forum</a> to get started. Simply follow the ThemeForest or Okay user instructions to verify your purchase and get a support account.</p>
						
						<div class='okay-buttons'><a target='blank' class='okay-button video-button' href='https://vimeo.com/36747939'><span class='okay-icon icon-video'>Slate Install Video</span></a><a target='blank' class='okay-button help-button' href='http://themes.okaythemes.com/docs/slate/index.html'><span class='okay-icon icon-help'>Slate Help File</span></a><a target='blank' class='okay-button support-button' href='http://okaythemes.com/support'><span class='okay-icon icon-support'>Support Forum</span></a><a target='blank' class='okay-button custom-button' href='http://okaythemes.com/customization'><span class='okay-icon icon-custom'>Customize Theme</span></a></div>
						
						<h4 class='heading'>More Themes by Okay Themes</h4>
						
						<div class='embed-themes'></div>
						
						",
						"type" => "info");												
																																		
								
	return $options;
}