<?php

class DisqueTarif extends \Phalcon\Mvc\Model
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
    protected $idTarif;

    /**
     *
     * @var string
     */
    protected $startDate;

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
     * Method to set the value of field idTarif
     *
     * @param integer $idTarif
     * @return $this
     */
    public function setIdTarif($idTarif)
    {
        $this->idTarif = $idTarif;

        return $this;
    }

    /**
     * Method to set the value of field startDate
     *
     * @param string $startDate
     * @return $this
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

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
     * Returns the value of field idTarif
     *
     * @return integer
     */
    public function getIdTarif()
    {
        return $this->idTarif;
    }

    /**
     * Returns the value of field startDate
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('idDisque', 'Disque', 'id', array('alias' => 'Disque'));
        $this->belongsTo('idTarif', 'Tarif', 'id', array('alias' => 'Tarif'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'disque_tarif';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DisqueTarif[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DisqueTarif
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
