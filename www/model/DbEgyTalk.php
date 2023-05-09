<?php

/**
 * Instans av klassen skapar en koppling till databasen egytalk
 * och tillhandahåller ett antal metoder för att hämta och manipulera data i databasen.
 *
 */
class DbEgyTalk
{
   /**
    * Används i metoder genom $this->db</code>
    */
   private $db;

   /**
    * DbEgyTalk constructor.
    *
    * Skapar en koppling till databaseb egytalk
    */
   public function __construct() {
      // Definierar konstanter med användarinformation.
      define('DB_USER', 'egytalk');
      define('DB_PASSWORD', '12345');
      define('DB_HOST', 'mariadb');
      define('DB_NAME', 'egytalk');

      // Skapar en anslutning till MySql och databasen world
      $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
      $this->db = new PDO($dsn, DB_USER, DB_PASSWORD);
   }

   /**
    * Kontrollerar av användare och lösen.
    * Skapar global sessions-array med användarinformation.
    *
    * @param  $userName  Användarnamn
    * @param  $password  Lösenord
    * @return $response användardata eller tom [] om inloggning misslyckas
    */
   function auth($userName, $password){
      $response = [];

      /* Bygger upp sql frågan */
      $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :user");
      $stmt->bindValue(":user", $userName);
      $stmt->execute();


      /* Kontroll att resultat finns */
      if ($stmt->rowCount() == 1) {
         // Hämtar användaren, kan endast vara 1 person
         $user = $stmt->fetch(PDO::FETCH_ASSOC);
         // Kontrollerar lösenordet, och allt ok.
         if (password_verify($password, $user['password'])) {
            $response['uid'] = $user['uid'];
            $response['firstname'] = $user['firstname'];
            $response['surname'] = $user['surname'];
         }
      }

      return $response;
   }

   /**
    * Hämtar anvädardata från användare med secifikt användarID
    * 
    * @param  $uid  användarID
    * @return $response användardata eller tom [] om ingen anvädare hittats eller fel inträffat
    */
   function getUserFromUid($uid){
      $response = [];
      // KOD!
      return $response;
   }

   /**
    * Hämtar alla poster som gjorts på egytalk
    *
    * @return array med alla poster
    */
   function getAllPosts(){
      $posts = [];

      // KOD!

      return $posts;
   }

   /**
    * Hämtar poster för en användare,
    * sorterade efter publiceringsdatum
    *
    * @param   $uid    användar-ID för användaren
    * @return  array med statusuppdateringar sorterade efter datum
    */
   function getPosts($uid){
      $posts = [];

      // KOD!

      return $posts;
   }

   /**
    * Hämtar alla kommentarer till en post
    *
    * @param  $pid postens ID-nummer
    * @return array med kommentarer sorterade efter datum
    */
   function getComments($pid){
      $comments = [];

      // KOD!

      return $comments;
   }

   /**
    * Skapar ny samtalstråd.
    *
    * @param  $uid       Användar-ID
    * @param  $postTxt   Postat inlägg
    * @return true om det lyckades, annars false
    */
   function addPost($uid, $postTxt){
      $postTxt = filter_var($postTxt, FILTER_SANITIZE_SPECIAL_CHARS);
      // KOD!
   }

   /**
    * Lägger till en ny kommentar till en post.
    *
    * @param  $userID    Användar-ID för den som skriver kommentaren
    * @param  $statusID  Status-ID för statusuppdatering som kommenteras
    * @param  $comment   Kommentar
    * @return true om det lyckades, annars false
    */
   function addComment($uid, $pid, $comment){
      $pid = filter_var($pid, FILTER_SANITIZE_NUMBER_INT);
      $comment = filter_var($comment, FILTER_SANITIZE_SPECIAL_CHARS);
      
      // KOD!
   }

   /**
    * Lägger till en ny användare
    *
    * @param  $fname   Förnamn
    * @param  $sname   Efternamn
    * @param  $user    Användarnamn
    * @param  $pwd     Lösenord
    * @return true om det lyckades, annars false
    */
   function addUser($fname, $sname, $user, $pwd){
      $pwd = password_hash($pwd, PASSWORD_DEFAULT);
      $user = filter_input(INPUT_GET, $user,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $fname = filter_input(INPUT_GET, $fname,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $sname = filter_input(INPUT_GET, $sname,FILTER_SANITIZE_FULL_SPECIAL_CHARS);


      // KOD! 
      $sqlCode = "INSERT INTO user(uid, firstname, surname, username, password)
      VALUES ([value-1],$fname,$sname,$user,$pwd)";
      
      $stmt = $this->db->prepare($sqlCode); //fix here!!!

      return $stmt->execute();
   }

   /**
    * Hämtar alla avändare i nätverket
    * @return array med användare
    */
   function getUsers(){
      $users = [];
      
      // KOD!

      return $users;
   }

   /**
    * Söker efter användare.
    *
    * @param  $searchWord    Sökord
    * @return array med användare
    */
   function findUsers($searchWord){
      $searchWord = filter_var($searchWord, FILTER_UNSAFE_RAW);
      $sql = "SELECT uid, firstname, surname FROM user WHERE firstname LIKE :search OR surname LIKE :search  ORDER BY surname, firstname";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue(":search", "%$searchWord%");

      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   /**
    * Returnerar användarinstälningar
    * Förutsätter att mail och phone lagts till i tabllen user
    *
    * @param  $uid    användarens uid
    * @return json-obj med användardata, mail, phone
    */
   function getSettings($uid){
      $settings = [];

      try {
         $stmt = $this->db->prepare("SELECT mail, phone FROM user WHERE uid = :uid");
         $stmt->bindValue(":uid", $uid);

         if ($stmt->execute())
            $settings = $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (Exception $e) {}

      return  $settings;
   }


   /**
    * Uppdaterar användarinstälningar
    * Förutsätter att mail och phone lagts till i tabllen user
    *
    * @param  $uid      användarens uid
    * @param  $settings array med inställningar, $settings['phone'], $settings['mail']
    * @return true om uppdateringen lyckades
    */
   function setSettings($uid, $settings){
      $success = false;

      // KOD!

      return  $success;
   }

   /**
    * Verifierar om lösenord överenstämmer med användarens lösenord
    *
    * @param $uid    Användarens uid 
    * @param $pwd    Lösenord som skall testas
    * @return true   om löseordet är korrekt
    */
    private function verifyPassword($uid, $pwd){
      $verified = false;

      try {
         $stmt = $this->db->prepare("SELECT password FROM user WHERE uid = :uid ");
         $stmt->bindValue(":uid", $uid);

         if ($stmt->execute()){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $verified = password_verify($pwd, $user['password']);
         }
            
      } catch (Exception $e) {}

      return $verified;
   }

   /**
    * Uppdaterar lösenorder
    *
    * @param  $uid      användarens uid
    * @param  $oldpwd   Nuvarande lösenord
    * @param  $pwd      Nytt lösenord
    * @return true om uppdateringen lyckades
    */
   function setPassword($uid, $oldpwd, $pwd){
      $success = false;

      // KOD!

      return  $success;
   }
}
