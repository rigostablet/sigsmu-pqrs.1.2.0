
<?php 
	return [
		"tempDir" => "uploads/temp/", 
		"import" => [
			"file_name_type" => "timestamp",
			"extensions" => "json,csv",
			"limit" => "10",
			"max_file_size" => "3",
			"return_full_path" => false,
			"filename_prefix" => "",
			"upload_dir" => "uploads/files/"
		],
		"summernote_images_upload" => [
			"file_name_type" => "random",
			"extensions" => "jpg,png,jpeg,gif",
			"limit" => "10",
			"max_file_size" => "3",
			"return_full_path" => false,
			"filename_prefix" => "",
			"upload_dir" => "uploads/photos/"
		],
		
		"regsol_photo" => [
			"file_name_type" => "original",
			"extensions" => "jpg,png,gif,jpeg,pdf",
			"limit" => 1,
			"max_file_size" => 10, //in mb
			"return_full_path" => false,
			"filename_prefix" => "",
			"upload_dir" => "uploads/files",
			"image_resize" => [ 
				"small" => ["width" => 100, "height" => 100, "mode" => "cover"], 
				"medium" => ["width" => 480, "height" => 480, "mode" => "contain"], 
				"large" => ["width" => 1024, "height" => 760, "mode" => "contain"]
			],

		],

		"photo" => [
			"file_name_type" => "random",
			"extensions" => "jpg,png,gif,jpeg",
			"limit" => 1,
			"max_file_size" => 3, //in mb
			"return_full_path" => false,
			"filename_prefix" => "",
			"upload_dir" => "uploads/files",
			"image_resize" => [ 
				"small" => ["width" => 100, "height" => 100, "mode" => "cover"], 
				"medium" => ["width" => 480, "height" => 480, "mode" => "contain"], 
				"large" => ["width" => 1024, "height" => 760, "mode" => "contain"]
			],

		],

		"photo_mun" => [
			"file_name_type" => "random",
			"extensions" => "jpg,png,gif,jpeg",
			"limit" => 1,
			"max_file_size" => 3, //in mb
			"return_full_path" => false,
			"filename_prefix" => "",
			"upload_dir" => "uploads/files",
			"image_resize" => [ 
				"small" => ["width" => 100, "height" => 100, "mode" => "cover"], 
				"medium" => ["width" => 480, "height" => 480, "mode" => "contain"], 
				"large" => ["width" => 1024, "height" => 760, "mode" => "contain"]
			],

		],

	];
