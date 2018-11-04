<?php
include 'Base.php';
Class MUtilisateur extends Base
{

    /** Permet de verifier qu'un utilisateur avec les parametres d'entrée existe bel et bien
     * @param $pseudo
     * @param $password
     * @return bool
     */
    public function connection($pseudo, $password){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(),'SELECT IDU FROM USER WHERE PSEUDO =  ?  AND PASSWORD = ?');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "ss",$pseudo,$password);
            /* Execution de la requete */
            mysqli_stmt_execute($query);
            /* Recuperation du nombre de tuple du resultat de la requete */
            $row_cnt = mysqli_num_rows(mysqli_stmt_get_result($query));
            /* Renvoi vrai si un tuple a été trouvé , sinon renvoi faux */
            return ($row_cnt != 0) ;
        }

    }

    /** Permet de recuperer l'ID d'un utilisateur dans la base de donnée a l'aide de son pseudo
     * @param $pseudo
     * @return mixed
     */
    public function getID($pseudo){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(),'SELECT IDU FROM USER WHERE PSEUDO =  ?');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "s", $pseudo);
            /* Execution de la requete */
            mysqli_stmt_execute($query);
            /* Recuperation du resultat msqli de la requete */
            $result =mysqli_stmt_get_result($query);
            /* Fetch du premier tuble de la requete dans resultarray */
            $resultarray =$result->fetch_assoc();
            /* Renvoi de l'IDU du tuple */
            return $resultarray['IDU'];
        }
    }

    /** Permet de recuperer le role d'un utilisateur dans la base de donnée a l'aide de son ID
     * @param $id
     * @return mixed
     */
    public function getRole($id){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(),'SELECT ROLE FROM USER WHERE IDU =  ?');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "s", $id);
            /* Execution de la requete */
            mysqli_stmt_execute($query);
            /* Recuperation du resultat msqli de la requete */
            $result =mysqli_stmt_get_result($query);
            /* Fetch du premier tuble de la requete dans resultarray */
            $resultarray =$result->fetch_assoc();
            /* Renvoi du Role du tuple */
            return $resultarray['ROLE'];
        }
    }

    /** Permet de recuperer l'email d'un utilisateur dans la base de donnée a l'aide de son ID
     * @param $id
     * @return mixed
     */
    public function getEmail($id){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(),'SELECT EMAIL FROM USER WHERE IDU =  ?');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "s", $id);
            /* Execution de la requete */
            mysqli_stmt_execute($query);
            /* Recuperation du resultat msqli de la requete */
            $result =mysqli_stmt_get_result($query);
            /* Fetch du premier tuble de la requete dans resultarray */
            $resultarray =$result->fetch_assoc();
            /* Renvoi de l'email du tuple */
            return $resultarray['EMAIL'];
        }
    }

    /** Permet d'inserer un utilisateur dans la base de données avec les informations passé en parametre
     * @param $pseudo
     * @param $email
     * @param $password
     * @return int
     */
    public function inscription($pseudo, $email, $password){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(),"INSERT INTO USER (PSEUDO,EMAIL,PASSWORD,ROLE) VALUES (?,?,?,'MEMBER')");
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "sss", $pseudo,$email, md5($password));
            /* Execution de la requete */
            mysqli_stmt_execute($query);
            /* Renvoi de l'id generé lors de l'insert */
            return mysqli_insert_id($this->getDbLink());
        }

    }

    /** Permet de verifier si un pseudo est deja utilisé dans la base de données
     * @param $pseudo
     * @return bool
     */
    public function verifPseudoUsed($pseudo){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(), 'SELECT * FROM USER WHERE PSEUDO = ?');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "s", $pseudo);
            /* Execution de la requete */
            mysqli_stmt_execute($query);
            /* Recuperation du nombre de tuple du resultat de la requete */
            $row_cnt = mysqli_num_rows(mysqli_stmt_get_result($query));
            /* Renvoi vrai si un tuple a été trouvé , sinon renvoi faux */
            return ($row_cnt != 0);
        }

    }

    /** Permet de verifier si un email est deja utilisé dans la base de données
     * @param $email
     * @return bool
     */
    public function verifEmailUsed($email){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(), 'SELECT * FROM USER WHERE EMAIL= ?');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "s", $email);
            /* Execution de la requete */
            mysqli_stmt_execute($query);
            /* Recuperation du nombre de tuple du resultat de la requete */
            $row_cnt = mysqli_num_rows(mysqli_stmt_get_result($query));
            /* Renvoi vrai si un tuple a été trouvé , sinon renvoi faux */
            return ($row_cnt != 0);
        }
    }

    /** Permet de metre a jour le mots de passe d'un utilisateur dans la base de données
     * @param $email
     * @param $password
     */
    public function MAJmotdepasse($email, $password){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(), 'UPDATE USER SET PASSWORD =? WHERE EMAIL=? ');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "ss", $password, $email);
            /* Execution de la requete */
            mysqli_stmt_execute($query);

        }

    }

    /** Permet de metre a jour le pseudo d'un utilisateur dans la base de données
     * @param $id
     * @param $pseudo
     */
    public function majPseudo($id, $pseudo){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(), 'UPDATE USER SET PSEUDO =? WHERE IDU=? ');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "si", $pseudo, $id);
            /* Execution de la requete */
            mysqli_stmt_execute($query);
        }
    }

    /** Permet de metre a jour l'email d'un utilisateur dans la base de données
     * @param $id
     * @param $email
     */
    public function majEmail($id, $email){
        /* Definition de la requete SQL */
        $query = mysqli_prepare($this->getDbLink(), 'UPDATE USER SET EMAIL =? WHERE IDU=? ');
        if ($query) {
            /*Verification de la correspondance des types des parametres avant l'execution de la requete */
            mysqli_stmt_bind_param($query, "si", $email, $id);
            /* Execution de la requete */
            mysqli_stmt_execute($query);
        }
    }
}