<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TipoTorneo
 *
 * @ORM\Table(name="tipo_torneo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipoTorneoRepository")
 * @UniqueEntity(fields="descripcion")
 */
class TipoTorneo
{
   /**
    * @ORM\OneToMany(targetEntity="Torneos", mappedBy="deporte")
    */
    private $tipo;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", unique=true, length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


    public function __construct()
    {
      $this->tipo = new ArrayCollection();
    }

    public function __toString()
    {
      $this->descripcion;
    }

    ###################################################################
    ###################### GETTERS Y SETTERS ##########################
    ###################################################################


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TipoTorneo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Add tipo
     *
     * @param \AppBundle\Entity\Torneos $tipo
     *
     * @return TipoTorneo
     */
    public function addTipo(\AppBundle\Entity\Torneos $tipo)
    {
        $this->tipo[] = $tipo;

        return $this;
    }

    /**
     * Remove tipo
     *
     * @param \AppBundle\Entity\Torneos $tipo
     */
    public function removeTipo(\AppBundle\Entity\Torneos $tipo)
    {
        $this->tipo->removeElement($tipo);
    }

    /**
     * Get tipo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoTorneo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
