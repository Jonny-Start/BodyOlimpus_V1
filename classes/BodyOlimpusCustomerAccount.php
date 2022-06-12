<?php
require_once((__DIR__) . '/db/DB.php');
class BodyOlimpusCustomerAccount extends DB
{
    public $id_customerAccount;
    public $name;
    public $lastName;
    public $identificationNumber;
    public $phoneNumber;
    public $gymName;
    public $location;
    public $accountType;
    public $availableUsers;
    public $paymentMethod;
    public $paymentAmount;
    public $active;
    public $activationDate;
    public $expirationDate;
    public $comments;
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

    public function add(){
        $sql = DB::DBconnect()->prepare("INSERT INTO bo_customeraccount (name, lastName, identificationNumber, phoneNumber, gymName, location, accountType, availableUsers, paymentMethod, paymentAmount, active, activationDate, expirationDate, comments, date_add, date_upd) VALUES (:name, :lastName, :identificationNumber, :phoneNumber, :gymName, :location, :accountType, :availableUsers, :paymentMethod, :paymentAmount, :active, :activationDate, :expirationDate, :comments, :date_add, :date_upd)");
        $sql->bindParam(':id_customerAccount', $this->id_customerAccount);
        $sql->bindParam(':name', $this->name);
        $sql->bindParam(':lastName', $this->lastName);
        $sql->bindParam(':identificationNumber', $this->identificationNumber);
        $sql->bindParam(':phoneNumber', $this->phoneNumber);
        $sql->bindParam(':gymName', $this->gymName);
        $sql->bindParam(':location', $this->location);
        $sql->bindParam(':accountType', $this->accountType);
        $sql->bindParam(':availableUsers', $this->availableUsers);
        $sql->bindParam(':paymentMethod', $this->paymentMethod);
        $sql->bindParam(':paymentAmount', $this->paymentAmount);
        $sql->bindParam(':active', $this->active);
        $sql->bindParam(':activationDate', $this->activationDate);
        $sql->bindParam(':expirationDate', $this->expirationDate);
        $sql->bindParam(':comments', $this->comments);
        $sql->bindParam(':date_add', $this->date_add);
        $sql->bindParam(':date_upd', $this->date_upd);
        $sql->execute();
        return;
    }

    public function update()
    {
        $sql = DB::DBconnect()->prepare("UPDATE bo_customeraccount SET name = :name, lastName = :lastName, identificationNumber = :identificationNumber, phoneNumber = :phoneNumber, gymName = :gymName, location = :location, accountType = :accountType, availableUsers = :availableUsers, paymentMethod = :paymentMethod, paymentAmount = :paymentAmount, active = :active, activationDate = :activationDate, expirationDate = :expirationDate, comments = :comments, date_add = :date_add, date_upd = :date_upd WHERE id_customerAccount = :id_customerAccount;");
        $sql->bindParam(':id_customerAccount', $this->id_customerAccount);
        $sql->bindParam(':name', $this->name);
        $sql->bindParam(':lastName', $this->lastName);
        $sql->bindParam(':identificationNumber', $this->identificationNumber);
        $sql->bindParam(':phoneNumber', $this->phoneNumber);
        $sql->bindParam(':gymName', $this->gymName);
        $sql->bindParam(':location', $this->location);
        $sql->bindParam(':accountType', $this->accountType);
        $sql->bindParam(':availableUsers', $this->availableUsers);
        $sql->bindParam(':paymentMethod', $this->paymentMethod);
        $sql->bindParam(':paymentAmount', $this->paymentAmount);
        $sql->bindParam(':active', $this->active);
        $sql->bindParam(':activationDate', $this->activationDate);
        $sql->bindParam(':expirationDate', $this->expirationDate);
        $sql->bindParam(':comments', $this->comments);
        $sql->bindParam(':date_add', $this->date_add);
        $sql->bindParam(':date_upd', $this->date_upd);
        $sql->execute();
        return;
    }

    public function delete(){
        $sql = DB::DBconnect()->prepare("DELETE FROM bo_customeraccount WHERE bo_customeraccount.id_customerAccount = :id_customerAccount");
        $sql->bindParam(':id_customerAccount', $this->id_customerAccount);
        $sql->execute();
        return;
    }
}
