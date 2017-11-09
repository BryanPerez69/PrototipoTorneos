<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carnet
 *
 * @ORM\Table(name="carnet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarnetRepository")
 */
class Carnet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="cedula", type="integer", unique=true)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_1", type="string", length=80)
     */
    private $nombre1;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_2", type="string", length=80)
     */
    private $nombre2;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_1", type="string", length=80)
     */
    private $apellido1;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_2", type="string", length=80)
     */
    private $apellido2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="datetime")
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=80, columnDefinition="ENUM('Hombre', 'Mujer')")
     */
    private $genero;

    /**
     * @var string
     *
     * @ORM\Column(name="eps", type="string", length=255)
     */
    private $eps;

    /**
     * @var string
     *
     * @ORM\Column(name="RH", type="string", length=255)
     */
    private $rh;

    /**
     * @var int
     *
     * @ORM\Column(name="grabadoPor", type="integer")
     */
    private $grabadoPor;

    /**
     * @var int
     *
     * @ORM\Column(name="torneo_id", type="integer")
     */
    private $torneoId;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="equipo", type="string", length=80)
     */
    private $equipo;


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
     * Set cedula
     *
     * @param integer $cedula
     *
     * @return Carnet
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return int
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set nombre1
     *
     * @param string $nombre1
     *
     * @return Carnet
     */
    public function setNombre1($nombre1)
    {
        $this->nombre1 = $nombre1;

        return $this;
    }

    /**
     * Get nombre1
     *
     * @return string
     */
    public function getNombre1()
    {
        return $this->nombre1;
    }

    /**
     * Set nombre2
     *
     * @param string $nombre2
     *
     * @return Carnet
     */
    public function setNombre2($nombre2)
    {
        $this->nombre2 = $nombre2;

        return $this;
    }

    /**
     * Get nombre2
     *
     * @return string
     */
    public function getNombre2()
    {
        return $this->nombre2;
    }

    /**
     * Set apellido1
     *
     * @param string $apellido1
     *
     * @return Carnet
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get apellido1
     *
     * @return string
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     *
     * @return Carnet
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * Get apellido2
     *
     * @return string
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Carnet
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set genero
     *
     * @param string $genero
     *
     * @return Carnet
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set eps
     *
     * @param string $eps
     *
     * @return Carnet
     */
    public function setEps($eps)
    {
        $this->eps = $eps;

        return $this;
    }

    /**
     * Get eps
     *
     * @return string
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * Set rh
     *
     * @param string $rh
     *
     * @return Carnet
     */
    public function setRH($rh)
    {
        $this->rh = $rh;

        return $this;
    }

    /**
     * Get rh
     *
     * @return string
     */
    public function getRH()
    {
        return $this->rh;
    }

    /**
     * Set grabadoPor
     *
     * @param integer $grabadoPor
     *
     * @return Carnet
     */
    public function setGrabadoPor($grabadoPor)
    {
        $this->grabadoPor = $grabadoPor;

        return $this;
    }

    /**
     * Get grabadoPor
     *
     * @return int
     */
    public function getGrabadoPor()
    {
        return $this->grabadoPor;
    }

    /**
     * Set torneoId
     *
     * @param integer $torneoId
     *
     * @return Carnet
     */
    public function setTorneoId($torneoId)
    {
        $this->torneoId = $torneoId;

        return $this;
    }

    /**
     * Get torneoId
     *
     * @return int
     */
    public function getTorneoId()
    {
        return $this->torneoId;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Carnet
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set equipo
     *
     * @param string $equipo
     *
     * @return Carnet
     */
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * Get equipo
     *
     * @return string
     */
    public function getEquipo()
    {
        return $this->equipo;
    }
}
