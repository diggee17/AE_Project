<p><?=$totaladmins?> administrators have been submitted to the Internet AE Database.</p>
<<!-- ?php var_dump($admins);   exit; ?>
<?php foreach ($admins as $admin): ?>
<?php endforeach; ?>
 -->
 <div class="container mt-3">
  <p>IN container</p>
<table class="table   table-striped">
        <thead>
            <tr>
                <th>Last Name</th>
                 <th>First Name</th>
                  <th>Email</th>
                  <th>Cell Phone</th>
                  <th>Birthday</th>
                  <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin) : ?>
                
     
                <tr>
                    <td>
                   <?= htmlspecialchars($admin['AdminLastName'] ?? ""); ?>
                    </td>
                    <td>
                   <?= htmlspecialchars($admin['AdminFirstName'] ?? ""); ?>
                    </td>
                    <td>
                   <?= htmlspecialchars($admin['AdminEmail'] ?? ""); ?>
                    </td>
                    <td>
                   <?= htmlspecialchars($admin['AdminCellPhone']?? ""); ?>
                    </td>
                    <td>
                   <?php
                        $date=date_create($admin['AdminBday']?? "");
                        echo date_format($date,"m/d");
                    ?>
                    </td>
<!-- <td>  <a href="index.php?action=edit&AdminID=<?=$admin['AdminID']?>">Edit</a></td> -->
                    <td>  <form action="index.php?action=edit&AdminID=<?=$admin['AdminID']?>" method="post">
                    <input type="hidden" name="AdminID" value="<?=$admin['AdminID']?>">
                    <input type="submit" value="    Edit      ">
                     </form>
                   <form action="index.php?action=delete" method="post">
                      <input type="hidden" name="AdminID" value="<?=$admin['AdminID']?>">
                      <input type="submit" value="Deactivate">
                    </form></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table> 
    </div>