<p><?=$totaltutors?> tutors have been submitted to the Internet AE Database.</p>
<!-- <?php foreach ($tutors as $tutor): ?>
<?php var_dump($tutor);  ?>
 <?php endforeach; ?> -->

<?php
/*    This pagingation logic does not work here. It works in CMS which handles Classes differently  Need to continue in the Ninja book to learn pagination for this !!!!!! 
*/

/*  require_once  __DIR__ . '/../classes/DatabaseTable.php';
 require_once  __DIR__ . '/../classes/Paginator.php';

 $paginator = new Paginator($_GET['page'] ?? 1, 6, $totaltutors);

 
//  require_once  '../includes/pagination.php';
$tutors = $tutorsTable.getPage($pdo, $paginator->limit, $paginator->offset); */

?>

 <div class="container mt-3">
  <p>IN container</p>

<table class="table   table-striped">
        <thead>
            <tr>
                <th>Key</th>
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
                   <?= $tutor['TutorKey']; ?>
                    </td>
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
                       
       <?php if ($tutor['SubjectNames'] ?? "")  : ?>
                        <?php foreach ($tutor['SubjectNames'] as $name) : ?>
                             <?= htmlspecialchars($name ?? ""); ?>
                     <?php endforeach; ?>
             <?php endif; ?>
                    </td>
                    <td> 
                    <a class="btn btn-primary" role= "button"
                     href="index.php?controller=tutor&amp;action=edit&TutorKey=<?=$tutor['TutorKey']?>">   Details     </a>
            
                     <a class="btn btn-info" role= "button"
                     href="#">   Editdfdfd     </a>
                   <form action="index.php?action=delete" method="post" class= "d-inline">
                      <input type="hidden" name="TutorKey" value="<?=$tutor['TutorKey']?>">
                      <input class=" btn btn-danger" type="submit" value="Deactivate">
                    </form>
                  </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table> 
  <!--   <?php require '../includes/pagination.php'; ?> -->

    </div>

    
Select page:

<?php
// Calculate the number of pages
$numPages = ceil($totaltutors/4);

// Display a link for each page
for ($i = 1; $i <= $numPages; $i++):
?>
  <!-- <a href="/joke/list/all/<?=$i?>"><?=$i?></a> -->
  <a href="index.php?controller=tutor&amp;action=list&amp;page=<?=$i?>"><?=$i?></a>
<?php endfor; ?>

href="index.php?controller=tutor&amp;action=list"