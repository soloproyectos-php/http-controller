<?php
require_once "../vendor/autoload.php";
use soloproyectos\http\controller\HttpController;

class MyController extends HttpController
{
    public $errorMessage;
    public $successMessage;
    public $username;
    public $password;
    
    public function __construct()
    {
        parent::__construct();
        $this->addOpenRequestHandler([$this, "onOpenRequest"]);
        $this->addPostRequestHandler([$this, "onPostRequest"]);
    }
    
    /**
     * Processes 'OPEN' requests.
     * 
     * This is a good place to connect to the database, open resources
     * and initialize variables.
     */
    public function onOpenRequest()
    {
        $this->username = "guest";
    }
    
    public function onPostRequest()
    {
        $this->username = $this->getParam("username");
        $this->password = $this->getParam("password");
        
        if (strlen($this->username) == 0 ||
            strlen($this->password) == 0
        ) {
            $this->errorMessage = "Username and password are required.";
            return;
        }
        
        if ($this->username != "guest" || $this->password != "guest") {
            $this->errorMessage = "Invalid credentials.";
            return;
        }
        
        $this->successMessage = "Nice! You are in.";
    }
}

// creates the controller and processes the HTTP request
$c = new MyController();
$c->processRequest();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Demo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <style>
        .error {
            color: brown;
            font-weight: bold;
        }
        
        .success {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlentities($c->username) ?>">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo htmlentities($c->password) ?>">
            <button type="submit">Accept</button>
            
            <?php if (strlen($c->errorMessage) > 0): ?>
            <p class="error"><?php echo htmlentities($c->errorMessage) ?></p>
            <?php endif ?>
            
            <?php if (strlen($c->successMessage) > 0): ?>
            <p class="success"><?php echo htmlentities($c->successMessage) ?></p>
            <?php endif ?>
        </form>
    </div>
</body>
</html>
