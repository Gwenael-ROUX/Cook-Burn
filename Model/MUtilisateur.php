<?php
include 'Base.php';
Class MUtilisateur extends Base
{

    public function connection($pseudo,$password){

        $query = mysqli_prepare($this->getDbLink(),'SELECT IDU FROM USER WHERE PSEUDO =  ?  AND PASSWORD = ?');
        if ($query) {
            mysqli_stmt_bind_param($query, "ss",$pseudo,$password);
            mysqli_stmt_execute($query);
            $row_cnt = mysqli_num_rows(mysqli_stmt_get_result($query));
            return ($row_cnt != 0) ;
        }

    }
    public function getID($pseudo){
        $query = mysqli_prepare($this->getDbLink(),'SELECT IDU FROM USER WHERE PSEUDO =  ?');
        if ($query) {
            mysqli_stmt_bind_param($query, "s", $pseudo);
            mysqli_stmt_execute($query);
            $result =mysqli_stmt_get_result($query);
            $resultarray =$result->fetch_assoc();
            return $resultarray['IDU'];
        }
    }
    public function getRole($id){
        $query = mysqli_prepare($this->getDbLink(),'SELECT ROLE FROM USER WHERE IDU =  ?');
        if ($query) {
            mysqli_stmt_bind_param($query, "s", $id);
            mysqli_stmt_execute($query);
            $result =mysqli_stmt_get_result($query);
            $resultarray =$result->fetch_assoc();
            return $resultarray['ROLE'];
        }
    }
    public function getEmail($id){
        $query = mysqli_prepare($this->getDbLink(),'SELECT EMAIL FROM USER WHERE IDU =  ?');
        if ($query) {
            mysqli_stmt_bind_param($query, "s", $id);
            mysqli_stmt_execute($query);
            $result =mysqli_stmt_get_result($query);
            $resultarray =$result->fetch_assoc();
            return $resultarray['EMAIL'];
        }
    }
    public function inscription($pseudo,$email,$password){
        $query = mysqli_prepare($this->getDbLink(),"INSERT INTO USER (PSEUDO,EMAIL,PASSWORD,ROLE) VALUES (?,?,?,'MEMBER')");
        if ($query) {
            mysqli_stmt_bind_param($query, "sss", $pseudo,$email, md5($password));
            mysqli_stmt_execute($query);
            return mysqli_insert_id($this->getDbLink());
        }

    }

    public function verifPseudoUsed($pseudo)
    {
        $query = mysqli_prepare($this->getDbLink(), 'SELECT * FROM USER WHERE PSEUDO = ?');
        if ($query) {
            mysqli_stmt_bind_param($query, "s", $pseudo);
            mysqli_stmt_execute($query);
            $row_cnt = mysqli_num_rows(mysqli_stmt_get_result($query));
            return ($row_cnt != 0);
        }

    }

    public function verifEmailUsed($email)
    {
        $query = mysqli_prepare($this->getDbLink(), 'SELECT * FROM USER WHERE EMAIL= ?');
        if ($query) {
            mysqli_stmt_bind_param($query, "s", $email);
            mysqli_stmt_execute($query);
            $row_cnt = mysqli_num_rows(mysqli_stmt_get_result($query));
            return ($row_cnt != 0);
        }
    }
    public function MAJmotdepasse($email, $password)
    {
        $query = mysqli_prepare($this->getDbLink(), 'UPDATE USER SET PASSWORD =? WHERE EMAIL=? ');
        if ($query) {
            mysqli_stmt_bind_param($query, "ss", $password, $email);
            mysqli_stmt_execute($query);

        }

    }
    public function majPseudo($id, $pseudo)
    {
        $query = mysqli_prepare($this->getDbLink(), 'UPDATE USER SET PSEUDO =? WHERE IDU=? ');
        if ($query) {
            mysqli_stmt_bind_param($query, "si", $pseudo, $id);
            mysqli_stmt_execute($query);
        }
    }
}