<?php

namespace Ais\PrestasiBundle\Handler;

use Ais\PrestasiBundle\Model\PrestasiInterface;

interface PrestasiHandlerInterface
{
    /**
     * Get a Prestasi given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return PrestasiInterface
     */
    public function get($id);

    /**
     * Get a list of Prestasis.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post Prestasi, creates a new Prestasi.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return PrestasiInterface
     */
    public function post(array $parameters);

    /**
     * Edit a Prestasi.
     *
     * @api
     *
     * @param PrestasiInterface   $prestasi
     * @param array           $parameters
     *
     * @return PrestasiInterface
     */
    public function put(PrestasiInterface $prestasi, array $parameters);

    /**
     * Partially update a Prestasi.
     *
     * @api
     *
     * @param PrestasiInterface   $prestasi
     * @param array           $parameters
     *
     * @return PrestasiInterface
     */
    public function patch(PrestasiInterface $prestasi, array $parameters);
}
