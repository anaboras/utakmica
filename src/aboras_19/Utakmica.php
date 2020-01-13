<?php
namespace aboras_19;

/**
 * @Entity @Table(name="utakmica")
 **/
class Utakmica
{
    /** @Id @Column(type="integer") @GeneratedValue  **/
    protected $sifra;

    /** @Column(type="datetime") 
	* @var DateTime
	*/
	protected $datum;

    /** @Column(type="string") **/
	protected $opis;

	/** @Column(type="string") **/
	protected $rezultat;


	public function getSifra(){
		return $this->sifra;
	}

	public function setSifra($sifra){
		$this->sifra = $sifra;
	}

	public function getDatum(){
		return $this->datum;
	}

	public function setDatum(DateTIme $datum){
		$this->datum = $datum;
	}

	public function getOpis(){
		return $this->opis;
	}

	public function setOpis($opis){
		$this->opis = $opis;
	}

	public function getRezultat(){
		return $this->rezultat;
	}

	public function setRezultat($rezultat){
		$this->rezultat = $rezultat;
	}

	public function setPodaci($podaci)
	{
		foreach($podaci as $kljuc => $vrijednost){
			$this->{$kljuc} = $vrijednost;
		}
	}

}