<?php

	//constants
	define('TIREPRICE', 100);
	define('OILPRICE', 10);
	define('SPARKPRICE', 4);
	define('DOCUMENT_ROOT', $_SERVER["DOCUMENT_ROOT"]);

	//DB connection
    $dbconn = null;
    define('HOST', 'localhost');
    define('DB', 'TestDB');
    define('DBUSERNAME', 'root');
    define('DBPASSWORD', '#3_blIndmIce');

    //current User
    define('USER', null);

    //this is a test of the VCS system....

	//function to return File pointer to orders.txt
	function getFileForWrite() {
		$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
		@ $fp = fopen("$DOCUMENT_ROOT/../Orders/orders.txt", 'ab');
		return $fp;
	}

	function getFileForRead() {
		$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
		@ $fp = fopen("$DOCUMENT_ROOT/../Orders/orders.txt", 'r');
		return $fp;
	}

	function isFileEmpty() {
		$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
		return filesize("$DOCUMENT_ROOT/../Orders/orders.txt") == 0;
	}

    function getDBConnection() {
        $dbconn = new mysqli(HOST, DBUSERNAME, DBPASSWORD, DB);
        return $dbconn;
    }


/**
 * @param $query
 * @param array $types
 * @param array $params
 * ---MUST PASS ARGS IN PARAMS ARRAY BY REFERENCE!!
 * args param is a key->value array for binding query params
 * where key = arg object and value = arg type
 * ex: [&$username->"s", 1->"i",.....]
 * @return result of query
 */
    function executeSQLIStatement($query, array $types, array $params) {
        $link = getDBConnection();
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        if ($stmt = mysqli_prepare($link,$query)){

            $mergedArr = array_merge($types, $params);
            call_user_func_array(array($stmt, "bind_param"), $mergedArr);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $result);

            mysqli_stmt_fetch($stmt);

            return $result;
        }
    }

    class User {
        private $userID;
        private $username;
        private $password;
        private $activeUser;
        private $loggedIn;

        function __construct($userID, $username, $password, $activeUser, $loggedIn){
            $this->setUserID($userID);
            $this->setUsername($username);
            $this-> setPassword($password);
            $this->setActiveUser($activeUser);
            $this->setLoggedIn($loggedIn);
        }

        private function setUserID($userID)
        {
            $this->userID = $userID;
        }

        public function getUserID()
        {
            return $this->userID;
        }

        private function setPassword($password){
            $this->password = $password;
        }

        public function getPassword()
        {
            return $this->password;
        }

        private function setUsername($username){
            $this->username = $username;
        }

        public function getUsername()
        {
            return $this->username;
        }

        private function setActiveUser($activeUser){
            $this->activeUser = $activeUser;
        }

        public function getActiveUser()
        {
            return $this->activeUser;
        }

        private function setLoggedIn($loggedIn){
            $this->loggedIn = $loggedIn;
        }

        public function getLoggedIn()
        {
            return $this->loggedIn;
        }
        
        static function createUser($userRow) {
            
        }
    }