<?php
/*
Plugin Name: School Management System
Description: Plugin for managing student profiles in a school.
Version: 1.0
Author: Your Name
*/

// Activate the plugin
function school_management_activate() {
    // Create the student profile table
    global $wpdb;
    $table_name = $wpdb->prefix . 'student_profiles';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        contact_number VARCHAR(15) NOT NULL,
        email VARCHAR(50) NOT NULL,
        address VARCHAR(100),
        parent_name VARCHAR(50) NOT NULL,
        parent_contact_number VARCHAR(15) NOT NULL,
        parent_email VARCHAR(50) NOT NULL,
        class_level VARCHAR(20) NOT NULL,
        date_of_birth DATE NOT NULL,
        gender ENUM('male', 'female') NOT NULL,
        nationality VARCHAR(50) NOT NULL,
        photo VARCHAR(100),
        medical_conditions VARCHAR(100),
        allergies VARCHAR(100),
        special_needs VARCHAR(100),
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'school_management_activate');

// Deactivate the plugin
function school_management_deactivate() {
    // Perform any necessary cleanup tasks
}
register_deactivation_hook(__FILE__, 'school_management_deactivate');

// Add a student profile
function add_student_profile($name, $contact_number, $email, $address, $parent_name, $parent_contact_number, $parent_email, $class_level, $date_of_birth, $gender, $nationality, $photo, $medical_conditions, $allergies, $special_needs) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'student_profiles';

    $data = array(
        'name' => $name,
        'contact_number' => $contact_number,
        'email' => $email,
        'address' => $address,
        'parent_name' => $parent_name,
        'parent_contact_number' => $parent_contact_number,
        'parent_email' => $parent_email,
        'class_level' => $class_level,
        'date_of_birth' => $date_of_birth,
        'gender' => $gender,
        'nationality' => $nationality,
        'photo' => $photo,
        'medical_conditions' => $medical_conditions,
        'allergies' => $allergies,
        'special_needs' => $special_needs,
    );

    $format = array(
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
    );

    $wpdb->insert($table_name, $data, $format);
}

// Update a student profile
function update_student_profile($id, $name, $contact_number, $email, $address, $parent_name, $parent_contact_number, $parent_email, $class_level, $date_of_birth, $gender, $nationality, $photo, $medical_conditions, $allergies, $special_needs) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'student_profiles';

    $data = array(
        'name' => $name,
        'contact_number' => $contact_number,
        'email' => $email,
        'address' => $address,
        'parent_name' => $parent_name,
        'parent_contact_number' => $parent_contact_number,
        'parent_email' => $parent_email,
        'class_level' => $class_level,
        'date_of_birth' => $date_of_birth,
        'gender' => $gender,
        'nationality' => $nationality,
        'photo' => $photo,
        'medical_conditions' => $medical_conditions,
        'allergies' => $allergies,
        'special_needs' => $special_needs,
    );

    $where = array(
        'id' => $id,
    );

    $wpdb->update($table_name, $data, $where);
}

// Retrieve a student profile by ID
function get_student_profile($id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'student_profiles';

    $sql = "SELECT * FROM $table_name WHERE id = %d";
    $results = $wpdb->get_results($wpdb->prepare($sql, $id));

    if (count($results) == 0) {
        return null;
    }

    return $results[0];
}

// Retrieve all student profiles
function get_all_student_profiles() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'student_profiles';

    $sql = "SELECT * FROM $table_name";
    $results = $wpdb->get_results($sql);

    return $results;
}

// Example usage of the functions

// Adding a student profile
add_student_profile(
    'John Doe',
    '1234567890',
    'john.doe@example.com',
    '123 Street, City',
    'Jane Doe',
    '9876543210',
    'jane.doe@example.com',
    'Grade 8',
    '2005-05-15',
    'male',
    'USA',
    'path/to/photo.jpg',
    'None',
    'None',
    'None'
);

// Updating a student profile
update_student_profile(
    1,
    'John Doe',
    '1234567890',
    'john.doe@example.com',
    '456 Street, City',
    'Jane Doe',
    '9876543210',
    'jane.doe@example.com',
    'Grade 9',
    '2005-05-15',
    'male',
    'USA',
    'path/to/newphoto.jpg',
    'None',
    'None',
    'None'
    );
    
// Retrieving a student profile by ID
$student = get_student_profile(1);
    if ($student) {
    echo "Student ID: " . $student->id . "<br>";
    echo "Name: " . $student->name . "<br>";
    // Display other profile fields as needed
    }


function enqueue_student_profiles_styles() {
    wp_enqueue_style( 'student-profiles', plugins_url( '/css/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_student_profiles_styles' );
    