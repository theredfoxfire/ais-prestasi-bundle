<?php

namespace Ais\PrestasiBundle\Model;

Interface PrestasiInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set mahasiswaId
     *
     * @param integer $mahasiswaId
     *
     * @return Prestasi
     */
    public function setMahasiswaId($mahasiswaId);

    /**
     * Get mahasiswaId
     *
     * @return integer
     */
    public function getMahasiswaId();

    /**
     * Set semesterId
     *
     * @param integer $semesterId
     *
     * @return Prestasi
     */
    public function setSemesterId($semesterId);

    /**
     * Get semesterId
     *
     * @return integer
     */
    public function getSemesterId();

    /**
     * Set eSksLulus
     *
     * @param integer $eSksLulus
     *
     * @return Prestasi
     */
    public function setESksLulus($eSksLulus);

    /**
     * Get eSksLulus
     *
     * @return integer
     */
    public function getESksLulus();

    /**
     * Set eSksDiambil
     *
     * @param integer $eSksDiambil
     *
     * @return Prestasi
     */
    public function setESksDiambil($eSksDiambil);

    /**
     * Get eSksDiambil
     *
     * @return integer
     */
    public function getESksDiambil();

    /**
     * Set eSksLulusXNa
     *
     * @param integer $eSksLulusXNa
     *
     * @return Prestasi
     */
    public function setESksLulusXNa($eSksLulusXNa);

    /**
     * Get eSksLulusXNa
     *
     * @return integer
     */
    public function getESksLulusXNa();

    /**
     * Set eSksDiambilXNa
     *
     * @param integer $eSksDiambilXNa
     *
     * @return Prestasi
     */
    public function setESksDiambilXNa($eSksDiambilXNa);

    /**
     * Get eSksDiambilXNa
     *
     * @return integer
     */
    public function getESksDiambilXNa();

    /**
     * Set ipk
     *
     * @param string $ipk
     *
     * @return Prestasi
     */
    public function setIpk($ipk);

    /**
     * Get ipk
     *
     * @return string
     */
    public function getIpk();

    /**
     * Set ips
     *
     * @param string $ips
     *
     * @return Prestasi
     */
    public function setIps($ips);

    /**
     * Get ips
     *
     * @return string
     */
    public function getIps();

    /**
     * Set ipsk
     *
     * @param string $ipsk
     *
     * @return Prestasi
     */
    public function setIpsk($ipsk);

    /**
     * Get ipsk
     *
     * @return string
     */
    public function getIpsk();

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Prestasi
     */
    public function setIsActive($isActive);

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Prestasi
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
}
