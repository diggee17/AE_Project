<?php
// added for version control 
class DatabaseTable
{
    public function __construct(private PDO $pdo, private string $table, private string $primaryKey)
    {
    }

    public function find($field, $value)
    {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $field . '` = :value  ';

        $values = [
            'value' => $value,
        ];

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);

        return $stmt->fetchAll();
    }

    public function findAll()
    {
        echo ($this->table);
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table );
        $stmt->execute();
        //  print_r($stmt->fetchAll()) ;  echo " fetch <br>";
        return $stmt->fetchAll();
    }

    public function total()
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM `' . $this->table . '`');
        $stmt->execute();
        $row = $stmt->fetch();
        return $row[0];
    }

    public function save($record)
    {

        try {
            echo "in Save exiting  VARDUMP: ";
            var_dump($record);
            if (empty($record[$this->primaryKey])) {
                echo "empty";
                unset($record[$this->primaryKey]);
            }
            $this->insert($record);
        } catch (PDOException $e) {
            echo "got here database error which causes update to be called";
            $this->update($record);
        }
    }

    private function update($values)
    {
        echo "in Update values = ";
        print_r($values);
        $query = ' UPDATE `' . $this->table . '` SET ';

        foreach ($values as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';
        /* echo $query . "<br> <br>";
        echo $this->primaryKey . "primary key var <br> <br>";  */
        // Set the :primaryKey variable
        //   $values['primaryKey'] = $values['id'];  // ** wont alway be id as in book
        $values['primaryKey'] = $values[$this->primaryKey]; // my fix
        $values = $this->processDates($values);

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);
    }

    private function insert($values)
    {
        echo "in insert ";
        print_r($values);
        $query = 'INSERT INTO `' . $this->table . '` (';

        foreach ($values as $key => $value) {
            $query .= '`' . $key . '`,';
        }

        $query = rtrim($query, ',');

        $query .= ') VALUES (';

        foreach ($values as $key => $value) {
            $query .= ':' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ')';
        //    echo "$query ".  "$$<br>";

        $values = $this->processDates($values);

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);
    }

    public function delete($field, $value)
    {
        $values = [':value' => $value];

        $stmt = $this->pdo->prepare('DELETE FROM `' . $this->table . '` WHERE `' . $field . '` = :value');

        $stmt->execute($values);
    }

    private function processDates($values)
    {
        foreach ($values as $key => $value) {
            if ($value instanceof DateTime) {
                $values[$key] = $value->format('Y-m-d');
            }
        }
        return $values;
    }
    /** Like FindAll but all gets subjects for each entity each table
     *  is retreived via this->table. It can be tutor or student table
     * need to figure out how to  address  join tables tutorsubject   OR student subject
     *************** Active only
     *   tested without the Where Active clause and it works.
     *
     */

    /* Note:  because the AE database fields all have the table name as part of the field.  I need to use a Switch statment or something to build the Select clause. The select clause depends $this->table (Tutor or  Student)a
     */

    public function findAllWithSubjects()
    {
        echo (" table is: " . $this->table);
        $query = 'SELECT t.TutorKey, t.TutorLastName,
       t.TutorFirstName,
       t.TutorFirstName,
       t.TutorEmail,
       t.TutorCellPhone,
        Subject.SubjectName, Subject.SubjectGrade
        FROM `' . $this->table . '` as t INNER JOIN (Subject INNER JOIN TutorSubject ON Subject.SubjectKey = TutorSubject.SubjectKey) ON t.TutorKey = TutorSubject.TutorKey
        WHERE t.TutorStatus = "Active" ';

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        //  This fetch give Assoc array and an array indexed by numbers $results = $stmt->fetchAll();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Consolidate the item records into a single element for each item,
        // putting the category names into an array
        $items = [];

        $previous_id = null;

        foreach ($results as $row) {
            $item_id = $row['TutorKey'];
            if ($item_id != $previous_id) {
                $row['SubjectNames'] = [];
                $items[$item_id] = $row;
            }
            //$items[$item_id]['SubjectNames'][] = $row['SubjectName'];
            //  $items[$item_id]['SubjectLevels'][] = $row['SubjectLevel'];
            $items[$item_id]['SubjectNames'][] = $row['SubjectName'] . " " . $row['SubjectGrade'];

            $previous_id = $item_id;
        }
        // var_dump($items);
        // exit;  /******** */
        return $items;
    }

    /** Get the recored based on the primary key along with associated subjects, if any
     *  have table  this->table      can be tutor or student table
     * have primary key as this->primaryKey
     * need to figure out how to  address  join tables tutorsubject   OR student subject
     * Active only
     *
     *
     */
    public function getSubjectsbyID($key)
    {
        $query = 'SELECT t.TutorLastName, t.TutorFirstName,  Subject.SubjectName FROM Tutor as t INNER JOIN (Subject INNER JOIN TutorSubject ON Subject.SubjectKey = TutorSubject.SubjectKey) ON t.TutorKey = TutorSubject.TutorKey

        WHERE t.TutorKey= :key and t.TutorStatus = "Active" ';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':key', $key, PDO::PARAM_INT);

        $stmt->execute();

        print_r($stmt->fetchAll());
        echo " fetch <br>";
        return $stmt->fetchAll();
    }
    /**
     * Get a page of articles
     *
     * @param object $conn Connection to the database
     * @param integer $limit Number of records to return
     * @param integer $offset Number of records to skip
     * @return array An associative array of the page of records
     */
    
public function getPage($pdo, $limit, $offset)
{
    $TutorStatus = 'Where TutorStatus = "Active"' ;
 // $condition = $TutorStatus ? ' WHERE TutorStatus IS NOT NULL' : '';

$query = "SELECT t.TutorKey, t.TutorLastName, t.TutorFirstName, t.TutorFirstName, t.TutorEmail, t.TutorCellPhone, Subject.SubjectName, Subject.SubjectGrade FROM ( Select * From Tutor
$TutorStatus
order by TutorKey
LIMIT :limit 
OFFSET :offset) as t
Left JOIN TutorSubject ON t.TutorKey =TutorSubject.TutorKey Left Join subject On TutorSubject.SubjectKey = Subject.SubjectKey";

echo $query;  

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //$results = $stmt->fetchAll();
    //var_dump($results);    
    echo "getpage". "<br>" ;
    //    exit;   // *******

    // Consolidate the item records into a single element for each item,
        // putting the category names into an array
        $items = [];

        $previous_id = null;

        foreach ($results as $row) {
            $item_id = $row['TutorKey'];
            if ($item_id != $previous_id) {
                $row['SubjectNames'] = [];
                $items[$item_id] = $row;
            }
            //$items[$item_id]['SubjectNames'][] = $row['SubjectName'];
            //  $items[$item_id]['SubjectLevels'][] = $row['SubjectLevel'];
            $items[$item_id]['SubjectNames'][] = $row['SubjectName'] . " " . $row['SubjectGrade'];

            $previous_id = $item_id;
        }
         var_dump($items);
         exit;  /******** */
        return $items;
    } 
}
