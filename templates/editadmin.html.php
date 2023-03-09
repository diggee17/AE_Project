
<form  action="" method="post">
<input type="hidden" name="admin[AdminID]" value="<?=$admin['AdminID'] ?? ''?>">
    <div class="form-group">
        <label for="lname">Last Name</label>
        <input class="form-control"  id="lname" placeholder="Last Name"
        name="admin[AdminLastName]" value="<?=htmlspecialchars($admin['AdminLastName'] ?? '')?>">
    </div>
    <div class="form-group">
        <label for="fname">First Name</label>
        <input class="form-control"  id="fname" placeholder="First Name"
        name="admin[AdminFirstName]" value="<?=htmlspecialchars($admin['AdminFirstName'] ?? '')?>">
    </div>    
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control"  id="email" placeholder="Email"
        name="admin[AdminEmail]" value="<?=htmlspecialchars($admin['AdminEmail'] ?? '')?>">
    </div>    
           
    <div class="form-group">
        <label for="cell">Cell Number</label>
        <input class="form-control"  id="cell" placeholder="Contact Number"
        name="admin[AdminCellPhone]" value="<?=htmlspecialchars($admin['AdminCellPhone'] ?? '')?>">
    </div>    
         
    <div class="form-group">
        <label for="bday">Birthday </label>
        <input class="form-control"  id="bday" placeholder="mm/dd"
        name="admin[AdminBday]" value="<?=htmlspecialchars($admin['AdminBday'] ?? '')?>">
    </div>    
   <!--       
    <div class="form-group">
        <label for="active">Active</label>
        <input class="form-control"  id="active" placeholder="active"
        name="admin[active]" value="<?=$admin['active'] ?? ''?>">
    </div>     -->
         
    <button class="btn">Save</button>

</form>
