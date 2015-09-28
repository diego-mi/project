<?php

namespace Auth\Authentication;

use Doctrine\ORM\EntityManager;
use Auth\Entity\User;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class Adapter implements AdapterInterface
{
    protected $em;
    protected $username;
    protected $password;
    /**
     * @param EntityManager $em
     */
    public function __contruct(EntityManager $em)
    {
        $this->em = $em;
    }
    /**
     * @param mixed $em
     */
    public function setEm(EntityManager $em)
    {
        $this->em = $em;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param mixed $login
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $user = $this->em->getRepository('Auth\Entity\User')
            ->findByLoginAndPassword(
                new User(),
                $this->getUsername(),
                $this->getPassword()
            );
        if ($user) {
            return new Result(Result::SUCCESS, $user, array());
        }
        return new Result(
            Result::FAILURE_CREDENTIAL_INVALID,
            null,
            array('Username ou senha inválidos')
        );
    }
}
