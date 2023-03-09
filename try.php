
//  This fetch give Assoc array and an array indexed by numbers $results = $stmt->fetchAll();
 $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

 // Consolidate the article records into a single element for each article,
 // putting the category names into an array
 $articles = [];

 $previous_id = null;

 foreach ($results as $row) {

     $article_id = $row['TutorKey'];

     if ($article_id != $previous_id) {
         $row['SubjectNames'] = [];

         $articles[$article_id] = $row;
     }

     $articles[$article_id]['SubjectNames'][] = $row['SubjectName'];
     $articles[$article_id]['SubjectLevels'][] = $row['SubjectLevel'];
     $articles[$article_id]['SubjectNames'][] .= $row['SubjectLevel'];

     $previous_id = $article_id;
 }


  var_dump($articles); 
  exit;  /******** */