<?php
	if(!function_exists('dsu_extract_genders_code')):
		function dsu_extract_genders_code()
		{
			return [""=>"Select",'male'=>"Male",'female'=>"Female",'other'=>'Other'];
		}
	endif;

	if(!function_exists('dsu_extract_religion')):
		function dsu_extract_religion()
		{
			return [""=>"Select","hindu"=>'Hindu','catholic'=>"Catholic","christian"=>"Christian","muslim"=>"Muslim","sikh"=>"Sikh","jain"=>"Jain","buddhism"=>"Buddhism",'other'=>'Other'];
		}
	endif;

	if(!function_exists('dsu_extract_country')):
		function dsu_extract_country()
		{
			return [""=>"Select","IN"=>'INDIA'];
		}
	endif;

	if(!function_exists('dsu_extract_category')):
		function dsu_extract_category()
		{
			return [""=>"Select","general"=>'General','sc'=>"SC",'st'=>"ST",'obc'=>"OBC"];
		}
	endif;


	if(!function_exists('dsu_extract_government_id')):
		function dsu_extract_government_id()
		{
			return [""=>"Select","aadhar"=>'Aadhar','passport'=>"Passport"];
		}
	endif;

	if(!function_exists('dsu_extract_profession_male')):
		function dsu_extract_profession_male()
		{
			return [""=>"Select","army"=>'Army','airforce'=>"Airforce","navy"=>"Navy","business"=>"Business","civil_servant"=>"Civil Services","doctor"=>"Doctor","engineer"=>"Engineer","Farmer"=>"Farmer",'govt_job'=>"Government Job",'police'=>"Police",'private_sector'=>"Private Job","others"=>"Other"];
		}
	endif;

	if(!function_exists('dsu_extract_profession_female')):
		function dsu_extract_profession_female()
		{
			return [""=>"Select","army"=>'Army','airforce'=>"Airforce","navy"=>"Navy","housemaker"=>"House Maker","business"=>"Business","civil_servant"=>"Civil Services","doctor"=>"Doctor","engineer"=>"Engineer","Farmer"=>"Farmer",'govt_job'=>"Government Job",'police'=>"Police",'private_sector'=>"Private Job","others"=>"Other"];
		}
	endif;

	if(!function_exists('dsu_extract_qualification')):
		function dsu_extract_qualification()
		{
			return [""=>"Select","illiterate"=>"Never been to school","primary"=>"< 10th","tenth"=>'10th','twelfth'=>"12th",'graduate'=>"Graduate",'post_graduate'=>"Post Graduate","above_post_graduate"=>"Above Post Graduate"];
		}
	endif;
?>