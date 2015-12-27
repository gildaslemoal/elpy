<?php

namespace Elpy\Bundle\GeneralBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Elpy\Bundle\GeneralBundle\Entity\ProductType;
use Elpy\Bundle\GeneralBundle\Form\ProductTypeType;

/**
 * ProductType controller.
 *
 */
class ProductTypeController extends Controller
{

    /**
     * Lists all ProductType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ElpyGeneralBundle:ProductType')->findAll();

        return $this->render('ElpyGeneralBundle:ProductType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ProductType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('producttype_show', array('id' => $entity->getId())));
        }

        return $this->render('ElpyGeneralBundle:ProductType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProductType entity.
     *
     * @param ProductType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductType $entity)
    {
        $form = $this->createForm(new ProductTypeType(), $entity, array(
            'action' => $this->generateUrl('producttype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductType entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductType();
        $form   = $this->createCreateForm($entity);

        return $this->render('ElpyGeneralBundle:ProductType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:ProductType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElpyGeneralBundle:ProductType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:ProductType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElpyGeneralBundle:ProductType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProductType entity.
    *
    * @param ProductType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductType $entity)
    {
        $form = $this->createForm(new ProductTypeType(), $entity, array(
            'action' => $this->generateUrl('producttype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElpyGeneralBundle:ProductType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('producttype_edit', array('id' => $id)));
        }

        return $this->render('ElpyGeneralBundle:ProductType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ElpyGeneralBundle:ProductType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('producttype'));
    }

    /**
     * Creates a form to delete a ProductType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producttype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
