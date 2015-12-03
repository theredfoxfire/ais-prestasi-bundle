<?php

namespace Ais\PrestasiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Ais\PrestasiBundle\Exception\InvalidFormException;
use Ais\PrestasiBundle\Form\PrestasiType;
use Ais\PrestasiBundle\Model\PrestasiInterface;


class PrestasiController extends FOSRestController
{
    /**
     * List all prestasis.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing prestasis.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many prestasis to return.")
     *
     * @Annotations\View(
     *  templateVar="prestasis"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getPrestasisAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('ais_prestasi.prestasi.handler')->all($limit, $offset);
    }

    /**
     * Get single Prestasi.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Prestasi for a given id",
     *   output = "Ais\PrestasiBundle\Entity\Prestasi",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the prestasi is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="prestasi")
     *
     * @param int     $id      the prestasi id
     *
     * @return array
     *
     * @throws NotFoundHttpException when prestasi not exist
     */
    public function getPrestasiAction($id)
    {
        $prestasi = $this->getOr404($id);

        return $prestasi;
    }

    /**
     * Presents the form to use to create a new prestasi.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newPrestasiAction()
    {
        return $this->createForm(new PrestasiType());
    }
    
    /**
     * Presents the form to use to edit prestasi.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisPrestasiBundle:Prestasi:editPrestasi.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the prestasi id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when prestasi not exist
     */
    public function editPrestasiAction($id)
    {
		$prestasi = $this->getPrestasiAction($id);
		
        return array('form' => $this->createForm(new PrestasiType(), $prestasi), 'prestasi' => $prestasi);
    }

    /**
     * Create a Prestasi from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new prestasi from the submitted data.",
     *   input = "Ais\PrestasiBundle\Form\PrestasiType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisPrestasiBundle:Prestasi:newPrestasi.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postPrestasiAction(Request $request)
    {
        try {
            $newPrestasi = $this->container->get('ais_prestasi.prestasi.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newPrestasi->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_prestasi', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing prestasi from the submitted data or create a new prestasi at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\PrestasiBundle\Form\PrestasiType",
     *   statusCodes = {
     *     201 = "Returned when the Prestasi is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisPrestasiBundle:Prestasi:editPrestasi.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the prestasi id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when prestasi not exist
     */
    public function putPrestasiAction(Request $request, $id)
    {
        try {
            if (!($prestasi = $this->container->get('ais_prestasi.prestasi.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $prestasi = $this->container->get('ais_prestasi.prestasi.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $prestasi = $this->container->get('ais_prestasi.prestasi.handler')->put(
                    $prestasi,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $prestasi->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_prestasi', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing prestasi from the submitted data or create a new prestasi at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\PrestasiBundle\Form\PrestasiType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisPrestasiBundle:Prestasi:editPrestasi.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the prestasi id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when prestasi not exist
     */
    public function patchPrestasiAction(Request $request, $id)
    {
        try {
            $prestasi = $this->container->get('ais_prestasi.prestasi.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $prestasi->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_prestasi', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a Prestasi or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return PrestasiInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($prestasi = $this->container->get('ais_prestasi.prestasi.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $prestasi;
    }
    
    public function postUpdatePrestasiAction(Request $request, $id)
    {
		try {
            $prestasi = $this->container->get('ais_prestasi.prestasi.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $prestasi->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_prestasi', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
	}
}
