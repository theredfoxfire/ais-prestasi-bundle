<?php

namespace Ais\PrestasiBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Ais\PrestasiBundle\Model\PrestasiInterface;
use Ais\PrestasiBundle\Form\PrestasiType;
use Ais\PrestasiBundle\Exception\InvalidFormException;

class PrestasiHandler implements PrestasiHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a Prestasi.
     *
     * @param mixed $id
     *
     * @return PrestasiInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of Prestasis.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new Prestasi.
     *
     * @param array $parameters
     *
     * @return PrestasiInterface
     */
    public function post(array $parameters)
    {
        $prestasi = $this->createPrestasi();

        return $this->processForm($prestasi, $parameters, 'POST');
    }

    /**
     * Edit a Prestasi.
     *
     * @param PrestasiInterface $prestasi
     * @param array         $parameters
     *
     * @return PrestasiInterface
     */
    public function put(PrestasiInterface $prestasi, array $parameters)
    {
        return $this->processForm($prestasi, $parameters, 'PUT');
    }

    /**
     * Partially update a Prestasi.
     *
     * @param PrestasiInterface $prestasi
     * @param array         $parameters
     *
     * @return PrestasiInterface
     */
    public function patch(PrestasiInterface $prestasi, array $parameters)
    {
        return $this->processForm($prestasi, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param PrestasiInterface $prestasi
     * @param array         $parameters
     * @param String        $method
     *
     * @return PrestasiInterface
     *
     * @throws \Ais\PrestasiBundle\Exception\InvalidFormException
     */
    private function processForm(PrestasiInterface $prestasi, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new PrestasiType(), $prestasi, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $prestasi = $form->getData();
            $this->om->persist($prestasi);
            $this->om->flush($prestasi);

            return $prestasi;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createPrestasi()
    {
        return new $this->entityClass();
    }

}
