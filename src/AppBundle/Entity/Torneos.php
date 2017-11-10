<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Torneos
 *
 * @ORM\Table(name="torneos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TorneosRepository")
 */
class Torneos
{

    /**
     *@ORM\ManyToOne(targetEntity="TipoTorneo", inversedBy="tipo")
     *@ORM\JoinColumn(name="tipo_id", referencedColumnName="id", onDelete="CASCADE" )
    */
    private $deporte;

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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="datetime")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="datetime")
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="cartel", type="string", length=255)
     */
    private $cartel;

    /**
     * @var string
     *
     * @ORM\Column(name="urlTorneo", type="string", length=255)
     */
    private $urlTorneo;

    /**
     * @var string
     *
     * @ORM\Column(name="urlInscripcion", type="string", length=255)
     */
    private $urlInscripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="urlProgramacionResultados", type="string", length=255)
     */
    private $urlProgramacion;

    /**
     * @var string
     *
     * @ORM\Column(name="urlEstadisticas", type="string", length=255)
     */
    private $urlEstadisticas;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPublicacion", type="datetime")
     */
    private $fechaPublicacion;



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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Torneos
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

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Torneos
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Torneos
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Torneos
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set cartel
     *
     * @param string $cartel
     *
     * @return Torneos
     */
    public function setCartel($cartel)
    {
        $this->cartel = $cartel;

        return $this;
    }

    /**
     * Get cartel
     *
     * @return string
     */
    public function getCartel()
    {
        return $this->cartel;
    }

    /**
     * Set urlTorneo
     *
     * @param string $urlTorneo
     *
     * @return Torneos
     */
    public function setUrlTorneo($urlTorneo)
    {
        $this->urlTorneo = $urlTorneo;

        return $this;
    }

    /**
     * Get urlTorneo
     *
     * @return string
     */
    public function getUrlTorneo()
    {
        return $this->urlTorneo;
    }

    /**
     * Set urlInscripcion
     *
     * @param string $urlInscripcion
     *
     * @return Torneos
     */
    public function setUrlInscripcion($urlInscripcion)
    {
        $this->urlInscripcion = $urlInscripcion;

        return $this;
    }

    /**
     * Get urlInscripcion
     *
     * @return string
     */
    public function getUrlInscripcion()
    {
        return $this->urlInscripcion;
    }

    /**
     * Set urlProgramacion
     *
     * @param string $urlProgramacion
     *
     * @return Torneos
     */
    public function setUrlProgramacion($urlProgramacion)
    {
        $this->urlProgramacion = $urlProgramacion;

        return $this;
    }

    /**
     * Get urlProgramacion
     *
     * @return string
     */
    public function getUrlProgramacion()
    {
        return $this->urlProgramacion;
    }

    /**
     * Set urlEstadisticas
     *
     * @param string $urlEstadisticas
     *
     * @return Torneos
     */
    public function setUrlEstadisticas($urlEstadisticas)
    {
        $this->urlEstadisticas = $urlEstadisticas;

        return $this;
    }

    /**
     * Get urlEstadisticas
     *
     * @return string
     */
    public function getUrlEstadisticas()
    {
        return $this->urlEstadisticas;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Torneos
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return bool
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set deporte
     *
     * @param \AppBundle\Entity\TipoTorneo $deporte
     *
     * @return Torneos
     */
    public function setDeporte(\AppBundle\Entity\TipoTorneo $deporte = null)
    {
        $this->deporte = $deporte;

        return $this;
    }

    /**
     * Get deporte
     *
     * @return \AppBundle\Entity\TipoTorneo
     */
    public function getDeporte()
    {
        return $this->deporte;
    }

    /**
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     *
     * @return Torneos
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }
}
