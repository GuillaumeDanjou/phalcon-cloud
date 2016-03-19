<?php

class Historique extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $idDisque;

    /**
     *
     * @var string
     */
    protected $date;

    /**
     *
     * @var string
     */
    protected $occupation;

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
     * Method to set the value of field date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Method to set the value of field occupation
     *
     * @param string $occupation
     * @return $this
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

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
     * Returns the value of field date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns the value of field occupation
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('idDisque', 'Disque', 'id', array('alias' => 'Disque'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'historique';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Historique[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Historique
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getId(){
    	return $this->Disque->getId()."_".$this->date;
    }
	public function __toString(){
		return "<b>".$this->Disque."</b> (".$this->date.") => ".DirectoryUtils::formatBytes($this->occupation,2);
	}
}
