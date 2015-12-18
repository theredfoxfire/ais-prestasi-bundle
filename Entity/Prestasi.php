<?php

namespace Ais\PrestasiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ais\PrestasiBundle\Model\PrestasiInterface;

/**
 * Prestasi
 */
class Prestasi implements PrestasiInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $mahasiswa_id;

    /**
     * @var integer
     */
    private $semester_id;

    /**
     * @var integer
     */
    private $e_sks_lulus;

    /**
     * @var integer
     */
    private $e_sks_diambil;

    /**
     * @var integer
     */
    private $e_sks_lulus_x_na;

    /**
     * @var integer
     */
    private $e_sks_diambil_x_na;

    /**
     * @var string
     */
    private $ipk;

    /**
     * @var string
     */
    private $ips;

    /**
     * @var string
     */
    private $ipsk;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var boolean
     */
    private $is_delete;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mahasiswaId
     *
     * @param integer $mahasiswaId
     *
     * @return Prestasi
     */
    public function setMahasiswaId($mahasiswaId)
    {
        $this->mahasiswa_id = $mahasiswaId;

        return $this;
    }

    /**
     * Get mahasiswaId
     *
     * @return integer
     */
    public function getMahasiswaId()
    {
        return $this->mahasiswa_id;
    }

    /**
     * Set semesterId
     *
     * @param integer $semesterId
     *
     * @return Prestasi
     */
    public function setSemesterId($semesterId)
    {
        $this->semester_id = $semesterId;

        return $this;
    }

    /**
     * Get semesterId
     *
     * @return integer
     */
    public function getSemesterId()
    {
        return $this->semester_id;
    }

    /**
     * Set eSksLulus
     *
     * @param integer $eSksLulus
     *
     * @return Prestasi
     */
    public function setESksLulus($eSksLulus)
    {
        $this->e_sks_lulus = $eSksLulus;

        return $this;
    }

    /**
     * Get eSksLulus
     *
     * @return integer
     */
    public function getESksLulus()
    {
        return $this->e_sks_lulus;
    }

    /**
     * Set eSksDiambil
     *
     * @param integer $eSksDiambil
     *
     * @return Prestasi
     */
    public function setESksDiambil($eSksDiambil)
    {
        $this->e_sks_diambil = $eSksDiambil;

        return $this;
    }

    /**
     * Get eSksDiambil
     *
     * @return integer
     */
    public function getESksDiambil()
    {
        return $this->e_sks_diambil;
    }

    /**
     * Set eSksLulusXNa
     *
     * @param integer $eSksLulusXNa
     *
     * @return Prestasi
     */
    public function setESksLulusXNa($eSksLulusXNa)
    {
        $this->e_sks_lulus_x_na = $eSksLulusXNa;

        return $this;
    }

    /**
     * Get eSksLulusXNa
     *
     * @return integer
     */
    public function getESksLulusXNa()
    {
        return $this->e_sks_lulus_x_na;
    }

    /**
     * Set eSksDiambilXNa
     *
     * @param integer $eSksDiambilXNa
     *
     * @return Prestasi
     */
    public function setESksDiambilXNa($eSksDiambilXNa)
    {
        $this->e_sks_diambil_x_na = $eSksDiambilXNa;

        return $this;
    }

    /**
     * Get eSksDiambilXNa
     *
     * @return integer
     */
    public function getESksDiambilXNa()
    {
        return $this->e_sks_diambil_x_na;
    }

    /**
     * Set ipk
     *
     * @param string $ipk
     *
     * @return Prestasi
     */
    public function setIpk($ipk)
    {
        $this->ipk = $ipk;

        return $this;
    }

    /**
     * Get ipk
     *
     * @return string
     */
    public function getIpk()
    {
        return $this->ipk;
    }

    /**
     * Set ips
     *
     * @param string $ips
     *
     * @return Prestasi
     */
    public function setIps($ips)
    {
        $this->ips = $ips;

        return $this;
    }

    /**
     * Get ips
     *
     * @return string
     */
    public function getIps()
    {
        return $this->ips;
    }

    /**
     * Set ipsk
     *
     * @param string $ipsk
     *
     * @return Prestasi
     */
    public function setIpsk($ipsk)
    {
        $this->ipsk = $ipsk;

        return $this;
    }

    /**
     * Get ipsk
     *
     * @return string
     */
    public function getIpsk()
    {
        return $this->ipsk;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Prestasi
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Prestasi
     */
    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }
}
