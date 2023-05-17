<div class="student-profiles-container">
    <h2>Student Profiles</h2>
    <?php
    $student_profiles = get_all_student_profiles();
    foreach ($student_profiles as $student_profile) {
        ?>
        <div class="student-profile">
            <img src="<?php echo $student_profile->photo; ?>" alt="Student Photo">
            <h3><?php echo $student_profile->name; ?></h3>
            <p><strong>Email:</strong> <?php echo $student_profile->email; ?></p>
            <p><strong>Contact Number:</strong> <?php echo $student_profile->contact_number; ?></p>
            <!-- Display other profile fields as needed -->
        </div>
        <?php
    }
    ?>
</div>
