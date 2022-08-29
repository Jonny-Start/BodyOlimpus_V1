<?php
require_once((__DIR__) . '/db/DB.php');
class BodyOlimpusCustomerAccount extends DB
{
    public $id_customerAccount;
    public $firstName;
    public $lastName;
    public $identificationNumber;
    public $phoneNumber;
    public $gymName;
    public $email;
    public $locationCustomer;
    public $accountType;
    public $availableUsers;
    public $paymentMethod;
    public $paymentAmount;
    public $active;
    public $activationDate;
    public $expirationDate;
    public $comments;
    public $imgGym;
    public $imgBlackGym;
    public $date_add;
    public $date_upd;

    public function __construct($id_customerAccount = null)
    {
        if ($id_customerAccount) {
            $sql = DB::DBconnect()->prepare("SELECT * FROM bo_customeraccount where id_customerAccount = :id_customerAccount");
            $sql->bindParam(':id_customerAccount', $id_customerAccount);
            $sql->execute();
            $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
            foreach ($dataUser as $key => $data) {
                $this->$key = $data;
            }
        }
        return;
    }

    public function add()
    {
        try {
            $sql = DB::DBconnect()->prepare("INSERT INTO bo_customeraccount (firstName, lastName, identificationNumber, phoneNumber, email, gymName, locationCustomer, accountType, availableUsers, paymentMethod, paymentAmount, active, activationDate, expirationDate, comments, imgGym, imgBlackGym, date_add, date_upd) 
            VALUES (:firstName, :lastName, :identificationNumber, :phoneNumber, :email, :gymName, :locationCustomer, :accountType, :availableUsers, :paymentMethod, :paymentAmount, :active, :activationDate, :expirationDate, :comments, :imgGym, :imgBlackGym, :date_add, :date_upd)");
            $sql->bindParam(':firstName', $this->firstName);
            $sql->bindParam(':lastName', $this->lastName);
            $sql->bindParam(':identificationNumber', $this->identificationNumber);
            $sql->bindParam(':phoneNumber', $this->phoneNumber);
            $sql->bindParam(':email', $this->email);
            $sql->bindParam(':gymName', $this->gymName);
            $sql->bindParam(':locationCustomer', $this->locationCustomer);
            $sql->bindParam(':accountType', $this->accountType);
            $sql->bindParam(':availableUsers', $this->availableUsers);
            $sql->bindParam(':paymentMethod', $this->paymentMethod);
            $sql->bindParam(':paymentAmount', $this->paymentAmount);
            $sql->bindParam(':active', $this->active);
            $sql->bindParam(':activationDate', $this->activationDate);
            $sql->bindParam(':expirationDate', $this->expirationDate);
            $sql->bindParam(':comments', $this->comments);
            $sql->bindParam(':imgGym', $this->imgGym);
            $sql->bindParam(':imgBlackGym', $this->imgBlackGym);
            $sql->bindParam(':date_add', $this->date_add);
            $sql->bindParam(':date_upd', $this->date_upd);
            $result = $sql->execute();
            $hola = $sql->debugDumpParams();
            echo "\nPDO::errorInfo():\n";
            die();
            if ($result == true) {
                return "1";
            }else{
                return "false";
            }
        } catch (PDOException $e) {
            die('Add failed: ' .$e->getMessage());
        }

    }

    public function update()
    {
        $sql = DB::DBconnect()->prepare("UPDATE bo_customeraccount SET firstName = :firstName, lastName = :lastName, identificationNumber = :identificationNumber, phoneNumber = :phoneNumber, email = :email, gymName = :gymName, locationCustomer = :locationCustomer, accountType = :accountType, availableUsers = :availableUsers, paymentMethod = :paymentMethod, paymentAmount = :paymentAmount, active = :active, activationDate = :activationDate, expirationDate = :expirationDate, comments = :comments, date_add = :date_add, date_upd = :date_upd WHERE id_customerAccount = :id_customerAccount;");
        $sql->bindParam(':id_customerAccount', $this->id_customerAccount);
        $sql->bindParam(':firstName', $this->firstName);
        $sql->bindParam(':lastName', $this->lastName);
        $sql->bindParam(':identificationNumber', $this->identificationNumber);
        $sql->bindParam(':phoneNumber', $this->phoneNumber);
        $sql->bindParam(':email', $this->email);
        $sql->bindParam(':gymName', $this->gymName);
        $sql->bindParam(':locationCustomer', $this->locationCustomer);
        $sql->bindParam(':accountType', $this->accountType);
        $sql->bindParam(':availableUsers', $this->availableUsers);
        $sql->bindParam(':paymentMethod', $this->paymentMethod);
        $sql->bindParam(':paymentAmount', $this->paymentAmount);
        $sql->bindParam(':active', $this->active);
        $sql->bindParam(':activationDate', $this->activationDate);
        $sql->bindParam(':expirationDate', $this->expirationDate);
        $sql->bindParam(':comments', $this->comments);
        $sql->bindParam(':imgGym', $this->comments);
        $sql->bindParam(':imgBlackGym', $this->comments);
        $sql->bindParam(':date_add', $this->date_add);
        $sql->bindParam(':date_upd', $this->date_upd);
        $sql->execute();
        return;
    }

    public function delete()
    {
        $sql = DB::DBconnect()->prepare("DELETE FROM bo_customeraccount WHERE bo_customeraccount.id_customerAccount = :id_customerAccount");
        $sql->bindParam(':id_customerAccount', $this->id_customerAccount);
        $sql->execute();
        return;
    }

    public static function getDataContext($id_admin)
    {
        $sql = DB::DBconnect()->prepare("SELECT gymName, imgGym, imgBlackGym, rol_admin FROM bo_customeraccount
                                    LEFT JOIN bo_admins
                                    ON bo_admins.id_customerAccount = bo_customeraccount.id_customerAccount
                                    WHERE bo_admins.id_customerAccount = ".$id_admin);
        $sql->execute();
        $dataAdmin = $sql->fetch(PDO::FETCH_ASSOC);
        return $dataAdmin;
    }

    public static function getDataAllCustomersAdmin()
    {
        $sql = DB::DBconnect()->prepare("SELECT id_customerAccount, firstName, lastName, gymName , locationCustomer, active FROM bo_customeraccount WHERE 1");
        $sql->execute();
        $dataAdmin = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $dataAdmin;
    }

}
