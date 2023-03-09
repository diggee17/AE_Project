<?php
class AdminController {

	private $authorsTable;
    private $adminsTable;

    public function __construct(DatabaseTable $adminsTable, DatabaseTable $authorsTable) {
        $this->adminsTable = $adminsTable;
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
	    $this->adminsTable->delete('AdminID', $_POST['AdminID']);

	  	header('location: index.php?controller=admin&action=list');
	}

	public function list() {
	    $result = $this->adminsTable->findAll();

	    $admins = [];
	    foreach ($result as $admin) {
	        // $author = $this->authorsTable->find('AdminID', $admin['authorId'])[0];

	        $admins[] = [
	            'AdminID' => $admin['AdminID'],
	            'AdminLastName' => $admin['AdminLastName'],
	            'AdminFirstName' => $admin['AdminFirstName'],
	            'AdminEmail' => $admin['AdminEmail'],
	            'AdminCellPhone' => $admin['AdminCellPhone'],
	            'AdminBday' => $admin['AdminBday']
	        ];

	    }

	    $title = 'admin list';

	    $totaladmins = $this->adminsTable->total();

	    return ['template' => 'admins.html.php',
		    'title' => $title,
		    'variables' => [
		        'totaladmins' => $totaladmins,
		        'admins' => $admins
		    ]
		];

	}

 	public function edit($AdminID = null) {
	  
		echo "got here in edit before post  for ADMIN......"; var_dump($_POST);

		 if (isset($_POST['admin'])) {
	echo "in PoST NOT exiting" ; 
	        $admin = $_POST['admin'];
	       /*  $admin['admindate'] = new DateTime();
	        $admin['authorId'] = 1; */

	        $this->adminsTable->save($admin);

	  		header('location: index.php?controller=admin&action=list');
	    }
	    else {

	      // if (isset($id)) {    wrong  from author!
	  
echo "got here aaaaa";   print_r($_GET);  
//I fixed the following line so it will display text before changing it
			if (isset($_GET['AdminID']) ){
	echo "in GET for admin" ;		
	            $admin = $this->adminsTable->find('AdminID', $_GET['AdminID'])[0];
	        }
	        else {
echo "in Else";
	        	$admin = null;
	        } 


	        $title = 'Edit admin';

	        return ['template' => 'editadmin.html.php',
			    'title' => $title,
			    'variables' => [
			        'admin' => $admin
			    ]
			];
	    }
   }   //  end edit 
}