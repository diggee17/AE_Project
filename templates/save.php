<p><?=$totaltutors?> tutors have been submitted to the Internet AE Database.</p>
<?php foreach ($tutors as $tutor): ?>
<?php endforeach; ?>

 <div class="container mt-3">
  <p>IN container</p>
 
<!-- /*  $query ='SELECT Tutor.TutorLastName, Subject.SubjectKey, Subject.SubjectName
FROM Tutor INNER JOIN (Subject INNER JOIN TutorSubject ON Subject.SubjectKey = TutorSubject.SubjectKey) ON Tutor.TutorKey = TutorSubject.TutorKey
WHERE (((Tutor.TutorLastName)="Gardner"))'; */ -->

<!-- /*  $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $field . '` = :value';

$values = [
    'value' => $value
]; 

$stmt = $this->pdo->prepare($query);
$stmt->execute();

var_dump($stmt->fetchAll()) ;

exit;   // *******
?> */ -->

<table class="table   table-striped">
        <thead>
            <tr>
                <th>Last Name</th>
                 <th>First Name</th>
                  <th>Email</th>
                  <th>Cell Phone</th>
                  <th>Subjects</th>
                  <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tutors as $tutor) : ?>
                
              <?php if (is_null($tutor['TutorCellPhone']))  : ?>
                 <?php $tutor['tutorCellPhone'] = "5551234578"; ?>
               <?php endif; ?>
                <tr>
                    <td>
                   <?= htmlspecialchars($tutor['TutorLastName'] ?? ""); ?>
                    </td>
                    <td>
                   <?= htmlspecialchars($tutor['TutorFirstName'] ?? ""); ?>
                    </td>
                    <td>
                   <?= htmlspecialchars($tutor['TutorEmail'] ?? ""); ?>
                    </td>
                    <td>
                   <?= htmlspecialchars($tutor['TutorCellPhone']?? ""); ?>
                    </td>
                    <td>
       <!-- math, reading, science -->

       <?php if ($tutor['Sub'])  : ?>
                        <?php foreach ($tutor['category_names'] as $name) : ?>
   <!-- The following line was fixed to for null convellance after upgrade to php 8.x, category_names are sometime null-->
   <!-- <?php echo ( " strlen = " . strlen($name ?? "")); ?>
                             <?= htmlspecialchars($name ?? ""); ?> -->
                             <?= $name?>   
                     <?php endforeach; ?>





                    </td>
                    <td> 
                    <a class="btn btn-primary" role= "button"
                     href="index.php?controller=tutor&amp;action=edit&TutorKey=<?=$tutor['TutorKey']?>">   Editdfdfd     </a>
            

                   <form action="index.php?action=delete" method="post" class= "d-inline">
                      <input type="hidden" name="TutorKey" value="<?=$tutor['TutorKey']?>">
                      <input class=" btn btn-danger" type="submit" value="Deactivate">
                    </form>
                  </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table> 
    </div>