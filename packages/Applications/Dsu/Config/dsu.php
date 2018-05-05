<?php

return [
	'check_document' =>false,

	'course'=>[
		'title' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'callback' => 'dsu_extract_course_title',
		   	'scope' => 'column', //{column, relation, meta}//
		],
		'code' => [
			'title' => 'code',
		   	'type' => 'text',
		   	'callback' => 'dsu_extract_course_code',
		   	'scope' => 'column', //{column, relation, meta}//
		],
		
		'course_session_id' => [
			'title' => 'Session',
		   	'type' => 'select',
		   	'scope' => 'column', //{column, relation, meta}//
		   	'callback' => 'dsu_extract_course_session_list',
		],
		'price' => [
			'title' => 'Application fees',
		   	'type' => 'text',
		   	'callback' => 'dsu_extract_application_fees',
		   	'scope' => 'column', //{column, relation, meta}//
		],
		'enabled' => [
			'title' => 'Status',
		   	'type' => 'select',
		   	'scope' => 'column', //{column, relation, meta}//
		   	'callback' => 'dsu_extract_course_status',
		],

		'documents' => [
		    'title' => 'Course Documents',
		    'type' => 'checkbox',
		    'validations' => array('not_empty'),
		    'callback' => 'dsu_extract_course_requirements',
		    'scope' => 'relation',
		    'builder' => 'default',//'default' (user internal default widget based relationship manager),'external' (user builder_method by callback,
		    'builder_method' => 'sync', //,['sync','attach',detach]
		    'extractor' => 'dsu_course_extractor',
		    'extractor_key'  => 'id',
		    'multiple' => true,
		    'required'  => true,
		],
	],

	'session'=>[
		'title' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'callback' => 'dsu_extract_course_title',
		   	'scope' => 'column', //{column, relation, meta}//
		],
		'application_starts_on' => [
			'title' => 'Application Starts on',
		   	'type' => 'date',
		   	'callback' => 'dsu_extract_course_code',
		   	'scope' => 'column', //{column, relation, meta}//
		],

		'applications_ends_on' => [
			'title' => 'Application Ends on',
		   	'type' => 'date',
		   	'callback' => 'dsu_extract_course_code',
		   	'scope' => 'column', //{column, relation, meta}//
		],

		'starts_from' => [
			'title' => 'Course starts from',
		   	'type' => 'date',
		   	'callback' => 'dsu_extract_course_code',
		   	'scope' => 'column', //{column, relation, meta}//
		],

		'ends_on' => [
			'title' => 'Course ends on',
		   	'type' => 'date',
		   	'callback' => 'dsu_extract_course_code',
		   	'scope' => 'column', //{column, relation, meta}//
		],
	],
	'center'=>[
		'title' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'scope' => 'column', //{column, relation, meta}//
		],
		'address' => [
			'title' => 'Address',
		   	'type' => 'textarea',
		   	'scope' => 'column', //{column, relation, meta}//
		],
		'enabled' => [
			'title' => 'Status',
		   	'type' => 'select',
		   	'scope' => 'column', //{column, relation, meta}//
		   	'callback' => 'widget_true_false_options',
		],
	],

	/**
	 * Reuqest key for applying for the course
	 */
	
	'apply'=>[
		"course_id", 
		"code",
		"first_name",
		"last_name",
		"address",
		"city",
		"state",
		"zip",
		"father_name",
		"mother_name",
		"phone_number",
		"email",
		"examination_center"
	],


	'application'=>[
		'name' => [
			'title' => 'Student name',
		   	'type' => 'text',
		   	'callback' => 'dsu_extract_course_code',
		   	'required' =>true,
		   	'scope' => 'configuration', //{column, relation, meta}//
		],
		'dob' => [
			'title' => 'Date of birth',
		   	'type' => 'date',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'callback' => 'dsu_extract_course_session_list',
		   	'required' =>true,
		],

		'gender' => [
			'title' => 'Gender',
		   	'type' => 'select',
		   	'callback' => 'dsu_extract_genders_code',
		   	'required' =>true,
		   	'scope' => 'confiuration', //{column, relation, meta}//
		],

		'mother_tongue' => [
			'title' => 'Mother tongue',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],

		'nationality' => [
			'title' => 'Nationality',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],
		
		'religion' => [
			'title' => 'Religion',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'callback' => 'dsu_extract_religion',
		   	'required' =>true,
		],
		'category' => [
			'title' => 'Category',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'callback' => 'dsu_extract_category',
		   	'required' =>true,
		],

		'address_1' => [
			'title' => 'Address line 1',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],
		'address_2' => [
			'title' => 'Address line 2',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		],
		'city' => [
			'title' => 'City',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],
		'state' => [
			'title' => 'State/County',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],
		'country' => [
			'title' => 'Country',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_country',
		],

		'govt_id' => [
			'title' => 'ID Issued by government',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_government_id',
		],

		'govt_id_number' => [
			'title' => 'Number of government ID',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],

		'present_address' => [
			'title' => 'Present Address',
		   	'type' => 'textarea',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],
		'residence_phone' => [
			'title' => 'Residence Phone',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],

		'father_name' => [
			'title' => 'Father\'s name',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],


		'father_profession' => [
			'title' => 'Father profession',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_profession_male',
		],

		'father_qualification' => [
			'title' => 'Father\'s Qualification',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_qualification',
		],
		'office_address_father' => [
			'title' => 'Office Address (Father)',
		   	'type' => 'textarea',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_qualification',
		],

		'office_phone_father' => [
			'title' => 'Office Phone (Father)',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_qualification',
		],

		'mobile_phone_father' => [
			'title' => 'Mobile number (Father)',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_qualification',
		],

		'mother_name' => [
			'title' => 'Mother\'s name',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		],


		'mother_profession' => [
			'title' => 'Mother profession',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_profession_female',
		],

		'mother_qualification' => [
			'title' => 'Mother\'s Qualification',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_qualification',
		],
		'office_address_mother' => [
			'title' => 'Office Address (Mother)',
		   	'type' => 'textarea',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_qualification',
		],

		'office_phone_mother' => [
			'title' => 'Office Phone (Mother)',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_qualification',
		],

		'mobile_phone_mother' => [
			'title' => 'Mobile Address (Mother)',
		   	'type' => 'text',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_qualification',
		],

		'examination_center' => [
			'title' => 'Exam Center (Choose max 3)',
		   	'type' => 'select',
		   	'scope' => 'confiuration', //{column, relation, meta}//
		   	'required' =>true,
		   	'callback' => 'dsu_extract_examination_center',
		   	'multiple' => true,
		    'required'  => true,
		],
	],
];
?>