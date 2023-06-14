<?php
session_start();
include "/opt/lampp/htdocs/mesobmagic/php/filterUser.php";
include "/opt/lampp/htdocs/mesobmagic/inc/header.php";

$uid = intval($_REQUEST['user']);
$data = $getUser($uid, $conn);

?>


<div id="profile-viewer">
  <div class = "profile-title"><h2 >User Profile</h2>
  <?php if(isset($_SESSION['uid']) && $_SESSION['uid'] == $uid):?>
    <button class="profile-edit-button"><span class="material-symbols-outlined">
edit
</span></button>
  <?php endif?>
</div>
  <div id="profile-picture">
    <img  alt="Profile Picture" src="<?php echo $data["avatar"]?>" width= "200px" height="200px">
  </div>
  <div class = "username">
    <span id="first-name"> <?php echo $data['first_name'];?></span>
    &nbsp;
    <span id="last-name"><?php 
    $lname = "";
    if(isset($data["last_name"]))
      $lname = $data["last_name"];
    
    echo $lname;?></span>
  </div>
  <div class="profile-info-secs">
  <div class=  "profile-info">
  <span class="material-symbols-outlined">
event
</span>
    <label for="dob">Date of Birth:</label>
    <span class="profile-content" id="dob"><?php $dateString = $data['dob']; // Example date string in dd-mm-yyyy format
        // echo $dateString;
        $date = DateTime::createFromFormat('Y-m-d', $dateString);

        if ($date) {
            $formattedDate = $date->format('M d, Y');
            echo $formattedDate; // Output: Jun 10, 2023
        } else {
            echo "Invalid date format";
        }?></span>
  </div>
  <div class=  "profile-info">
    <span class="material-symbols-outlined">
      mail
    </span>
    <label for="email">Email:</label>
    <span class="profile-content" id="email"><?php echo $data["email"]?></span>
  </div>
  <div class=  "profile-info">
    <span class="material-symbols-outlined">
      language
    </span>
    <label for="country">Country:</label>
    <span class="profile-content" id="country"><?php echo $data["country"]?></span>
  </div>
  <div class=  "profile-info">
    <span class="material-symbols-outlined">
      work
    </span>
    <label for="job-title">Job Title:</label>
    <span class="profile-content" id="job-title"><?php echo $data["job_title"]?></span>
  </div>
  <div class=  "profile-info">
  <span class="material-symbols-outlined">
  restaurant_menu
  </span>
    <label for="password">Joined Since:</label>
    <span class="profile-content" id="password"><?php $dateString = $data['joined']; // Example date string in dd-mm-yyyy format
        // echo $dateString;
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
  
        if ($date) {
            $formattedDate = $date->format('M d, Y');
            echo $formattedDate; // Output: Jun 10, 2023
        } else {
            echo "Invalid date format";
        }?></span>
  </div>
  <div class=  "profile-info">
    <span class="material-symbols-outlined">
military_tech
</span>
    <label for="password">Reputation:</label>
    <span class="profile-content" id="password"><?php echo $calcReputation($data['uid'], $conn);?></span>
  </div>

  </div>
</div>
<?php
include  "/opt/lampp/htdocs/mesobmagic/inc/footer.php";
?>

