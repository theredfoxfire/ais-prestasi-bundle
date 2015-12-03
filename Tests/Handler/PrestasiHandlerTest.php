<?php

namespace Ais\PrestasiBundle\Tests\Handler;

use Ais\PrestasiBundle\Handler\PrestasiHandler;
use Ais\PrestasiBundle\Model\PrestasiInterface;
use Ais\PrestasiBundle\Entity\Prestasi;

class PrestasiHandlerTest extends \PHPUnit_Framework_TestCase
{
    const DOSEN_CLASS = 'Ais\PrestasiBundle\Tests\Handler\DummyPrestasi';

    /** @var PrestasiHandler */
    protected $prestasiHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::DOSEN_CLASS));
    }


    public function testGet()
    {
        $id = 1;
        $prestasi = $this->getPrestasi();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($prestasi));

        $this->prestasiHandler = $this->createPrestasiHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $this->prestasiHandler->get($id);
    }

    public function testAll()
    {
        $offset = 1;
        $limit = 2;

        $prestasis = $this->getPrestasis(2);
        $this->repository->expects($this->once())->method('findBy')
            ->with(array(), null, $limit, $offset)
            ->will($this->returnValue($prestasis));

        $this->prestasiHandler = $this->createPrestasiHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $all = $this->prestasiHandler->all($limit, $offset);

        $this->assertEquals($prestasis, $all);
    }

    public function testPost()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $prestasi = $this->getPrestasi();
        $prestasi->setTitle($title);
        $prestasi->setBody($body);

        $form = $this->getMock('Ais\PrestasiBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($prestasi));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->prestasiHandler = $this->createPrestasiHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $prestasiObject = $this->prestasiHandler->post($parameters);

        $this->assertEquals($prestasiObject, $prestasi);
    }

    /**
     * @expectedException Ais\PrestasiBundle\Exception\InvalidFormException
     */
    public function testPostShouldRaiseException()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $prestasi = $this->getPrestasi();
        $prestasi->setTitle($title);
        $prestasi->setBody($body);

        $form = $this->getMock('Ais\PrestasiBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->prestasiHandler = $this->createPrestasiHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $this->prestasiHandler->post($parameters);
    }

    public function testPut()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $prestasi = $this->getPrestasi();
        $prestasi->setTitle($title);
        $prestasi->setBody($body);

        $form = $this->getMock('Ais\PrestasiBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($prestasi));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->prestasiHandler = $this->createPrestasiHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $prestasiObject = $this->prestasiHandler->put($prestasi, $parameters);

        $this->assertEquals($prestasiObject, $prestasi);
    }

    public function testPatch()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('body' => $body);

        $prestasi = $this->getPrestasi();
        $prestasi->setTitle($title);
        $prestasi->setBody($body);

        $form = $this->getMock('Ais\PrestasiBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($prestasi));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->prestasiHandler = $this->createPrestasiHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $prestasiObject = $this->prestasiHandler->patch($prestasi, $parameters);

        $this->assertEquals($prestasiObject, $prestasi);
    }


    protected function createPrestasiHandler($objectManager, $prestasiClass, $formFactory)
    {
        return new PrestasiHandler($objectManager, $prestasiClass, $formFactory);
    }

    protected function getPrestasi()
    {
        $prestasiClass = static::DOSEN_CLASS;

        return new $prestasiClass();
    }

    protected function getPrestasis($maxPrestasis = 5)
    {
        $prestasis = array();
        for($i = 0; $i < $maxPrestasis; $i++) {
            $prestasis[] = $this->getPrestasi();
        }

        return $prestasis;
    }
}

class DummyPrestasi extends Prestasi
{
}
