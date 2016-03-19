<?php

class DisqueService extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $idDisque;

    /**
     *
     * @var integer
     */
    protected $idService;

    /**
     * Method to set the value of field idDisque
     *
     * @param integer $idDisque
     * @return $this
     */
    public function setIdDisque($idDisque)
    {
        $this->idDisque = $idDisque;

        return $this;
    }

    /**
     * Method to set the value of field idService
     *
     * @param integer $idService
     * @return $this
     */
    public function setIdService($idService)
    {
        $this->idService = $idService;

        return $this;
    }

    /**
     * Returns the value of field idDisque
     *
     * @return integer
     */
    public function getIdDisque()
    {
        return $this->idDisque;
    }

    /**
     * Returns the value of field idService
     *
     * @return integer
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('idDisque', 'Disque', 'id', array('alias' => 'Disque'));
        $this->belongsTo('idService', 'Service', 'id', array('alias' => 'Service'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'disque_service';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DisqueService[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DisqueService
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
