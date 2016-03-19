<?php

class Tarif extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $quota;

    /**
     *
     * @var double
     */
    protected $coutDepassement;

    /**
     *
     * @var double
     */
    protected $prix;

    /**
     *
     * @var string
     */
    protected $unite;

    /**
     *
     * @var double
     */
    protected $margeDepassement;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field quota
     *
     * @param string $quota
     * @return $this
     */
    public function setQuota($quota)
    {
        $this->quota = $quota;

        return $this;
    }

    /**
     * Method to set the value of field coutDepassement
     *
     * @param double $coutDepassement
     * @return $this
     */
    public function setCoutDepassement($coutDepassement)
    {
        $this->coutDepassement = $coutDepassement;

        return $this;
    }

    /**
     * Method to set the value of field prix
     *
     * @param double $prix
     * @return $this
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Method to set the value of field unite
     *
     * @param string $unite
     * @return $this
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * Method to set the value of field margeDepassement
     *
     * @param double $margeDepassement
     * @return $this
     */
    public function setMargeDepassement($margeDepassement)
    {
        $this->margeDepassement = $margeDepassement;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field quota
     *
     * @return string
     */
    public function getQuota()
    {
        return $this->quota;
    }

    /**
     * Returns the value of field coutDepassement
     *
     * @return double
     */
    public function getCoutDepassement()
    {
        return $this->coutDepassement;
    }

    /**
     * Returns the value of field prix
     *
     * @return double
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Returns the value of field unite
     *
     * @return string
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Returns the value of field margeDepassement
     *
     * @return double
     */
    public function getMargeDepassement()
    {
        return $this->margeDepassement;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'DisqueTarif', 'idTarif', array('alias' => 'DisqueTarif'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tarif';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tarif[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tarif
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function __toString(){
    	return "prix : ".
    	sprintf('%01.2f', $this->prix)."&euro;, Marge de dépassement : ".
    	sprintf('%01.2f',$this->margeDepassement*100)."%, coût dépassement : ".
    	sprintf('%01.2f', $this->coutDepassement)."&euro;";
    }

}
