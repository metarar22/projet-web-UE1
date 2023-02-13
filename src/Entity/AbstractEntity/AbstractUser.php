<?php

namespace App\Entity\AbstractEntity;

Abstract class AbstractUser {
    protected int $userId;
    protected string $userEmail;
    protected string $userPassword;
    protected string $userFname;
    protected string $userLname;
    protected string $userAdress;
    protected int $userRole;


    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of userEmail
     */ 
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set the value of userEmail
     *
     * @return  self
     */ 
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get the value of userPassword
     */ 
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set the value of userPassword
     *
     * @return  self
     */ 
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get the value of userFname
     */ 
    public function getUserFname()
    {
        return $this->userFname;
    }

    /**
     * Set the value of userFname
     *
     * @return  self
     */ 
    public function setUserFname($userFname)
    {
        $this->userFname = $userFname;

        return $this;
    }

    /**
     * Get the value of userLname
     */ 
    public function getUserLname()
    {
        return $this->userLname;
    }

    /**
     * Set the value of userLname
     *
     * @return  self
     */ 
    public function setUserLname($userLname)
    {
        $this->userLname = $userLname;

        return $this;
    }

    /**
     * Get the value of userAdress
     */ 
    public function getUserAdress()
    {
        return $this->userAdress;
    }

    /**
     * Set the value of userAdress
     *
     * @return  self
     */ 
    public function setUserAdress($userAdress)
    {
        $this->userAdress = $userAdress;

        return $this;
    }

    /**
     * Get the value of userRole
     */ 
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * Set the value of userRole
     *
     * @return  self
     */ 
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;

        return $this;
    }
}