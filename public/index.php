<?php
/*   this is index on ae_rewrite.
*/
function loadTemplate($templateFileName, $variables = []) {
    extract($variables);
//  echo "extracted variables" . "<br>"; print_r($variables);
    ob_start();
    include  __DIR__ . '/../templates/' . $templateFileName;

    return ob_get_clean();
}

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include  __DIR__ . '/../classes/DatabaseTable.php';
    include __DIR__ . '/../controllers/adminController.php';
    include __DIR__ . '/../controllers/TutorController.php';
    include __DIR__ . '/../controllers/AuthorController.php';

  echo "got here 1";
    $adminsTable = new DatabaseTable($pdo, 'admin', 'AdminID');
    $tutorsTable = new DatabaseTable($pdo, 'tutor', 'TutorKey');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $action = $_GET['action'] ?? 'home';
    $controllerName = $_GET['controller'] ?? 'admin';
   

print_r($controllerName); 

    if ($controllerName === 'admin') {
        $controller = new AdminController($adminsTable, $authorsTable);
  echo "got here 2";
    }
    if ($controllerName === 'tutor') {
        $controller = new TutorController($tutorsTable, $authorsTable);
  echo "got here 3";
//  Remove the following lines   for regular running of code
/*  include './try_this.php';
try_this($pdo); **********************/

    } //  If
    else if ($controllerName === 'author') {
        $controller = new AuthorController($authorsTable);
    }

    if ($action == strtolower($action) && $controllerName == strtolower($controllerName)) {
        $page = $controller->$action();
    } else {
        http_response_code(301);
        header('location: index.php?controller=' . strtolower($controllerName) .'&action=' . strtolower($action));
    }
    $title = $page['title'];

    $variables = $page['variables'] ?? [];
    $output = loadTemplate($page['template'], $variables);
    
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';