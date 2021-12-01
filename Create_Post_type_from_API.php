
// add_shortcode( 'suuber-api','suuber_api'  );
// function suuber_api(){
// // Initiate curl session in a variable (resource)
// $curl_handle = curl_init();

// $url = "https://devcms.suuber.ch/api/wp/public/users?zipCode=8004";

// // Set the curl URL option
// curl_setopt($curl_handle, CURLOPT_URL, $url);

// // This option will return data as a string instead of direct output
// curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// // Execute curl & store data in a variable
// $curl_data = curl_exec($curl_handle);

// curl_close($curl_handle);

// // Decode JSON into PHP array
// $response_data = json_decode($curl_data);

// // Print all data if needed
// // print_r($response_data);
// // die();

// // All user data exists in 'data' object
// $user_data = $response_data->users;

// // Extract only first 5 user data (or 5 array elements)
// // $user_data = array_slice($user_data, 0, 1);

// // Traverse array and print employee data
// foreach ($user_data as $user) {
// 	$my_post = array();
// 	$my_post['post_title'] = $user->name;
// 	$my_post['post_type'] = 'cleaner';
// 	$my_post['post_content'] = '';
// 	$my_post['post_status'] = 'publish';
// 	$my_post['post_author'] = 1;
// 	$cat1 = $user->services[0];
// 	$cat1_id = get_cat_ID($cat1);
// 	$cat2 = $user->services[1];
// 	$cat2_id = get_cat_ID($cat2);
// 	$cat3 = $user->services[2];
// 	$cat3_id = get_cat_ID($cat3);
// 	$cat4 = $user->services[3];
// 	$cat4_id = get_cat_ID($cat4);
// 	$cat5 = $user->services[4];
// 	$cat5_id = get_cat_ID($cat5);
// 	$cat6 = $user->services[5];
// 	$cat6_id = get_cat_ID($cat6);
// 	$my_post['post_category'] = array($cat1_id,$cat2_id,$cat3_id,$cat4_id,$cat5_id,$cat6_id);
// 	$post_id = wp_insert_post( $my_post );
// 	$profile_pic = $user->profile_picture;
// 	$pets = $user->pets;
// 	reset($user->rating);
// 	$totalRatings = current($user->rating); //the first one
// 	end($user->rating);echo "<br />";
// 	$averageRating = current($user->rating);//the second one
// 	if ($pets === true){
// 		$pet_value= "I am ok with pets";
// 	}
// 	else{
// 		$pet_value= "I am not ok with pets";
// 	}
	
// // Add Featured Image to Post
// $image_url        = $profile_pic; // Define the image URL here
// $image_name       = $user->name.'.png';
// $upload_dir       = wp_upload_dir(); // Set upload folder
// $image_data       = file_get_contents($image_url); // Get image data
// $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
// $filename         = basename( $unique_file_name ); // Create image file name

// // Check folder permission and define file location
// if( wp_mkdir_p( $upload_dir['path'] ) ) {
//     $file = $upload_dir['path'] . '/' . $filename;
// } else {
//     $file = $upload_dir['basedir'] . '/' . $filename;
// }

// // Create the image  file on the server
// file_put_contents( $file, $image_data );

// // Check image file type
// $wp_filetype = wp_check_filetype( $filename, null );

// // Set attachment data
// $attachment = array(
//     'post_mime_type' => $wp_filetype['type'],
//     'post_title'     => sanitize_file_name( $filename ),
//     'post_content'   => '',
//     'post_status'    => 'inherit'
// );

// // Create the attachment
// $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

// // Include image.php
// require_once(ABSPATH . 'wp-admin/includes/image.php');

// // Define attachment metadata
// $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

// // Assign metadata to attachment
// wp_update_attachment_metadata( $attach_id, $attach_data );

// // And finally assign featured image to post
// set_post_thumbnail( $post_id, $attach_id );
	
	
	
// 	update_post_meta( $post_id, 'name', $user->name);
// 	update_post_meta( $post_id, 'surname', $user->surname);
// 	update_post_meta( $post_id, 'address', $user->address);
// 	update_post_meta( $post_id, 'zip_code',$user->zip_code);
// 	update_post_meta( $post_id, 'city', $user->city);
// 	update_post_meta( $post_id, 'price_per_hour', $user->price_per_hour);
// 	update_post_meta( $post_id, 'total_price_per_hour', $user->total_price_per_hour);
// 	update_post_meta( $post_id, 'pets', $pet_value);
// 	update_post_meta( $post_id, 'distance', $user->distance);
// 	update_post_meta( $post_id, 'total_rating', $totalRatings);
// 	update_post_meta( $post_id, 'average_rating', $averageRating);
// }
// 	}
