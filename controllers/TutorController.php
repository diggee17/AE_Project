<?php
class TutorController {
	private $authorsTable;
    private $tutorsTable;

    public function __construct(DatabaseTable $tutorsTable, DatabaseTable $authorsTable) {
        $this->tutorsTable = $tutorsTable;
        $this->authorsTable = $authorsTable;
    }

	public function home() {
	    $title = 'Internet FBCLG Academic Excellence Database';

	    return ['template' => 'home.html.php',
		    'title' => $title,
		    'variables' => []
		];
	}

	public function delete() {
	    $this->tutorsTable->delete('TutorKey', $_POST['TutorKey']);

	  	header('location: index.php?controller=tutor&action=list');
	}

	public function list() {
	   // $result = $this->tutorsTable->findAll();
	    $result = $this->tutorsTable->findAllWithSubjects();
		$tutors = $result;

	 
	    $title = 'AE Tutor List';

	    $totaltutors = $this->tutorsTable->total();

	    return ['template' => 'tutors.html.php',
		    'title' => $title,
		    'variables' => [
		        'totaltutors' => $totaltutors,
		        'tutors' => $tutors
		    ]
		];

	}

 	public function edit($TutorKey = null) {
	  
	echo "got here in edit before post ......"; var_dump($_POST);

		 if (isset($_POST['tutor'])) {
	echo "in PoSTnot exiting" ;  
	        $tutor = $_POST['tutor'];
	       /*  $tutor['tutordate'] = new DateTime();
	        $tutor['authorId'] = 1; */

	        $this->tutorsTable->save($tutor);

	  		header('location: index.php?controller=tutor&action=list');
	    }
	    else {

	      // if (isset($id)) {    wrong  from author!
	  
echo "got here aaaaa";   print_r($_GET);  
//I fixed the following line so it will display text before changing it
			if (isset($_GET['TutorKey']) ){
	echo "in GET";		
	            $tutor = $this->tutorsTable->find('TutorKey', $_GET['TutorKey'])[0];
	        }
	        else {
echo "in Else";
	        	$tutor = null;
	        } 

	        $title = 'Edit tutor';

	        return ['template' => 'edittutor.html.php',
			    'title' => $title,
			    'variables' => [
			        'tutor' => $tutor
			    ]
			];
	    }
   }   //  end edit 
}