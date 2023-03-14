<p><?=$totaltutors?> tutors have been submitted to the Internet AE Database.</p>
  <!-- <?php foreach ($tutors as $tutor): ?>
<?php var_dump($tutor);  ?>
 <?php endforeach; ?>
 -->
 <?php
 $paginator = new Paginator($_GET['page'] ?? 1, 6, $totaltutors);

$tutors = getPage($conn, $paginator->limit, $paginator->offset);
?>

 <div class="container mt-3">
  <p>IN container</p>

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
                       
       <?php if ($tutor['SubjectNames'])  : ?>
                        <?php foreach ($tutor['SubjectNames'] as $name) : ?>
                             <?= htmlspecialchars($name ?? ""); ?>
                     <?php endforeach; ?>
             <?php endif; ?>
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
    <?php require '../includes/pagination.php'; ?>

    </div>