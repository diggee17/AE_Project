
<form  action="" method="post">
<input type="hidden" name="tutor[TutorKey]" value="<?=$tutor['TutorKey'] ?? ''?>">
    <div class="form-group">
        <label for="lname">Last Name</label>
        <input class="form-control"  id="lname" placeholder="Last Name"
        name="tutor[TutorLastName]" value="<?=htmlspecialchars($tutor['TutorLastName'] ?? '')?>">
    </div>
    <div class="form-group">
        <label for="fname">First Name</label>
        <input class="form-control"  id="fname" placeholder="First Name"
        name="tutor[TutorFirstName]" value="<?=htmlspecialchars($tutor['TutorFirstName'] ?? '')?>">
    </div>    
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control"  id="email" placeholder="Email"
        name="tutor[TutorEmail]" value="<?=htmlspecialchars($tutor['TutorEmail'] ?? '')?>">
    </div>    
           
    <div class="form-group">
        <label for="cell">Cell Number</label>
        <input class="form-control"  id="cell" placeholder="Contact Number"
        name="tutor[TutorCellPhone]" value="<?=htmlspecialchars($tutor['TutorCellPhone'] ?? '')?>">
    </div>    
         
<!--     <div class="form-group">
        <label for="bday">Birthday </label>
        <input class="form-control"  id="bday" placeholder="mm/dd"
        name="tutor[TutorBday]" value="<?=htmlspecialchars($tutor['tutorBday'] ?? '')?>">
    </div>     -->
   <!--       
    <div class="form-group">
        <label for="active">Active</label>
        <input class="form-control"  id="active" placeholder="active"
        name="tutor[active]" value="<?=$tutor['active'] ?? ''?>">
    </div>     -->
         

  
    <button class="btn">SaveIT</button>

</form>
